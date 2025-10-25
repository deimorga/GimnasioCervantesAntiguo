# Análisis de esquema de BD (MySQL)

- Tablas: **75** · Columnas: **385** · Claves foráneas: **14**

## Tipos de PK (aprox.)

- **int**: 69
- **decimal**: 5
- **(sin pk)**: 1

## Tablas más referenciadas (FK entrantes)

- **tbl_grupo**: 2 FKs entrantes
- **tbl_alumno**: 2 FKs entrantes
- **tbl_periodo_academico**: 2 FKs entrantes
- **tbl_asignatura**: 2 FKs entrantes
- **tbl_grado**: 1 FKs entrantes
- **tbl_area**: 1 FKs entrantes
- **tbl_logro**: 1 FKs entrantes
- **tbl_profesor**: 1 FKs entrantes
- **tbl_plan_gestor**: 1 FKs entrantes
- **tbl_grupo_asignatura**: 1 FKs entrantes

## Tablas con más dependencias (FK salientes)

- **tbl_calificacion_asignatura**: 3 FKs salientes
- **tbl_grupo_asignatura**: 3 FKs salientes
- **tbl_alumno**: 2 FKs salientes
- **tbl_calificacion_logro**: 2 FKs salientes
- **tbl_plan_gestor**: 2 FKs salientes
- **tbl_asignatura**: 1 FKs salientes
- **tbl_logro**: 1 FKs salientes

## Archivos generados

- Columnas: `bd_columnas.csv`
- Relaciones (FK): `bd_relaciones_fk.csv`
- Índices: `bd_indices.csv`
- ER (Mermaid): `erd_mermaid.md`


> Inserta el contenido de `erd_mermaid.md` en un README de GitHub para ver el diagrama renderizado.
