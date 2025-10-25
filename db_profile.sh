#!/usr/bin/env bash
set -euo pipefail

# === TUS VALORES (Docker JSON) ===
CONTAINER="mysql8"
DB_USER="root"
DB_PASS="SuperPassw0rd!"
DB_NAME="appdb"
# ================================

OUT="DB_REPORT"
mkdir -p "$OUT"

MYSQL_DOCKER=(docker exec -i "$CONTAINER" mysql -u"$DB_USER" -p"$DB_PASS" --batch --raw -N)

echo "[1/9] Versión y variables"
"${MYSQL_DOCKER[@]}" -e "SELECT VERSION(), @@sql_mode, @@time_zone, @@character_set_server, @@collation_server;" > "$OUT/00_version_vars.tsv"

echo "[2/9] Tamaños por tabla (MB)"
"${MYSQL_DOCKER[@]}" -e "
SELECT table_name, engine, table_rows,
       ROUND((data_length+index_length)/1024/1024,2) AS size_mb,
       table_collation
FROM information_schema.tables
WHERE table_schema='${DB_NAME}'
ORDER BY size_mb DESC;" > "$OUT/01_table_sizes.tsv"

echo "[3/9] Tablas sin PRIMARY KEY"
"${MYSQL_DOCKER[@]}" -e "
SELECT t.table_name
FROM information_schema.tables t
LEFT JOIN information_schema.table_constraints c
  ON c.table_schema=t.table_schema AND c.table_name=t.table_name AND c.constraint_type='PRIMARY KEY'
WHERE t.table_schema='${DB_NAME}' AND t.table_type='BASE TABLE' AND c.table_name IS NULL
ORDER BY t.table_name;" > "$OUT/02_missing_pk.tsv"

echo "[4/9] Lista de FKs"
"${MYSQL_DOCKER[@]}" -e "
SELECT constraint_name, table_name, column_name, referenced_table_name, referenced_column_name
FROM information_schema.key_column_usage
WHERE table_schema='${DB_NAME}' AND referenced_table_name IS NOT NULL
ORDER BY table_name, constraint_name;" > "$OUT/03_foreign_keys.tsv"

echo "[5/9] Orfandades por FK (child sin parent)"
"${MYSQL_DOCKER[@]}" -e "
SELECT table_name, column_name, referenced_table_name, referenced_column_name
FROM information_schema.key_column_usage
WHERE table_schema='${DB_NAME}' AND referenced_table_name IS NOT NULL;" \
| awk -F'\t' -v db="${DB_NAME}" -v out="$OUT/04_fk_orphans.tsv" '
BEGIN { print "fk\torphans" > out }
{
  child_t=$1; child_c=$2; parent_t=$3; parent_c=$4;
  printf "SELECT \"%s.%s->%s.%s\" AS fk, COUNT(*) AS orphans FROM %s LEFT JOIN %s ON %s.%s=%s.%s WHERE %s.%s IS NOT NULL AND %s.%s IS NULL;\n",
         child_t, child_c, parent_t, parent_c, child_t, parent_t, child_t, child_c, parent_t, parent_c, child_t, child_c, parent_t, parent_c
}' \
| while IFS= read -r q; do
     "${MYSQL_DOCKER[@]}" "${DB_NAME}" -e "$q"
  done >> "$OUT/04_fk_orphans.tsv"

echo "[6/9] Auto-increment headroom"
"${MYSQL_DOCKER[@]}" -e "
SELECT t.table_name, c.column_name, c.column_type, t.auto_increment,
       CASE
         WHEN c.column_type REGEXP 'bigint' AND c.column_type LIKE '%unsigned%' THEN 18446744073709551615
         WHEN c.column_type REGEXP 'bigint' THEN 9223372036854775807
         WHEN c.column_type LIKE '%unsigned%' THEN 4294967295
         ELSE 2147483647
       END AS max_val,
       ROUND(100*t.auto_increment /
             (CASE
               WHEN c.column_type REGEXP 'bigint' AND c.column_type LIKE '%unsigned%' THEN 18446744073709551615
               WHEN c.column_type REGEXP 'bigint' THEN 9223372036854775807
               WHEN c.column_type LIKE '%unsigned%' THEN 4294967295
               ELSE 2147483647
             END), 6) AS pct_used
FROM information_schema.columns c
JOIN information_schema.tables t
  ON c.table_schema=t.table_schema AND c.table_name=t.table_name
WHERE c.table_schema='${DB_NAME}' AND c.extra LIKE '%auto_increment%'
ORDER BY pct_used DESC;" > "$OUT/05_autoinc_headroom.tsv"

echo "[7/9] Collations por tabla"
"${MYSQL_DOCKER[@]}" -e "
SELECT t.table_name, t.table_collation
FROM information_schema.tables t
WHERE t.table_schema='${DB_NAME}'
ORDER BY t.table_name;" > "$OUT/06_table_collations.tsv"

echo "[8/9] Índices por tabla"
"${MYSQL_DOCKER[@]}" -e "
SELECT table_name, index_name, non_unique, GROUP_CONCAT(column_name ORDER BY seq_in_index) AS cols
FROM information_schema.statistics
WHERE table_schema='${DB_NAME}'
GROUP BY table_name, index_name, non_unique
ORDER BY table_name, index_name;" > "$OUT/07_indexes.tsv"

echo "[9/9] Top 10 tablas por filas (estimadas)"
"${MYSQL_DOCKER[@]}" -e "
SELECT table_name, table_rows
FROM information_schema.tables
WHERE table_schema='${DB_NAME}'
ORDER BY table_rows DESC
LIMIT 10;" > "$OUT/08_top_rows.tsv"

echo "OK. Reportes en: $OUT/"