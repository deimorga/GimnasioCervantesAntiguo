# GimnasioCervantesAntiguo (código legado 2017)
Contexto, requisitos PHP, y cómo correrlo.

# GimnasioCervantesAntiguo — código legado (2017)

> Plataforma de Gestión Administrativa de Colegios (PHP + MySQL + jQuery). Este repositorio conserva el código histórico (2013–2017) **y** los artefactos del **análisis funcional y de datos (2025)** para preparar la migración a un modelo **SaaS (MicroNuba)**.

---

## 📁 Estructura principal

- `gimnasiocervantes.com/` → código PHP legado (sitio y módulos).
- `Docs/` → **documentación generada** (análisis funcional, análisis BD, ERD, matrices).
- `BD/` → materiales de base de datos (backups/scripts si aplica).
- `.github/workflows/audit-legacy.yml` → workflow de **auditoría automática A+B** (métricas + descubrimiento).

---

## 📚 Documentación (leer primero)

- **Análisis funcional (5 puntos)**: [Docs/analisis_funcional.md](Docs/analisis_funcional.md)  
  (Inventario de módulos, matriz CRUD, flujos, actores/permisos, riesgos).
- **Análisis de base de datos**: [Docs/analisis_bd.md](Docs/analisis_bd.md)  
  (Tablas/columnas/FKs/índices + resumen cuantitativo).
- **Diagrama ER (Mermaid)**: [Docs/erd_mermaid.md](Docs/erd_mermaid.md) ← *GitHub lo renderiza directamente.*
- **Matriz CRUD detallada (endpoint ↔ tabla)**: [Docs/matriz_crud.csv](Docs/matriz_crud.csv)
- **Resumen de módulos**: [Docs/modulos_resumen.csv](Docs/modulos_resumen.csv)
- **Columnas por tabla**: [Docs/bd_columnas.csv](Docs/bd_columnas.csv)
- **Relaciones (FK)**: [Docs/bd_relaciones_fk.csv](Docs/bd_relaciones_fk.csv)
- **Índices**: [Docs/bd_indices.csv](Docs/bd_indices.csv)

> Sugerencia: mantener estos documentos actualizados conforme se descubran más rutas o se normalice el esquema.

---

## ▶️ Cómo ejecutar la **auditoría A+B** (GitHub Actions)

1. Ir a la pestaña **Actions** del repo.
2. Seleccionar **“Audit Legacy PHP (A+B)”**.
3. Click en **Run workflow** (rama `main`).  
4. Al finalizar, descargar el artifact **`audit`**. Dentro encontrarás:
   - `_audit/phpmetrics/index.html` (métricas visuales)
   - `_audit/phploc.txt` (volumen de código)
   - `_audit/phpstan.txt` (análisis estático nivel 0)
   - `_audit/endpoints.csv`, `_audit/sql_tables.csv`, `_audit/summary.json` (descubrimiento funcional)

> El workflow vive en `.github/workflows/audit-legacy.yml`. Para actualizar herramientas (p. ej., Composer), editar ese YAML.

---

## 🧭 Hallazgos rápidos (resumen)

- Uso de **`mysql_*` y `mysqli_*`** (sin PDO) → riesgo de inyección / dificultad de migración.
- Alto uso de `$_REQUEST/$_GET/$_POST` sin capa de sanitización central → reforzar validaciones/CSRF.
- Acoplamiento por `include/require` → difícil aislar reglas y testear.
- Librerías antiguas: **PHPExcel (EOL)**, mPDF/FPDI antiguos → plan de reemplazo (PhpSpreadsheet / motor PDF moderno).
- Complejidad elevada y **sin tests**: cubrir flujos críticos con pruebas de regresión.

---

## 🚀 Próximos pasos sugeridos

1. **Entorno reproducible** del legado (Docker/compose con PHP + MySQL compatible).
2. **Seguridad mínima**: wrapper de DB con consultas preparadas en puntos de mayor tráfico; protección CSRF; sanitización central.
3. **Estrategia Strangler Fig**: elegir un **módulo vertical** (p. ej., Pensiones o Académico) y exponerlo como servicio nuevo; migrar endpoints gradualmente.
4. **Reportes**: migrar PHPExcel → **PhpSpreadsheet**; revisar motor de PDF.
5. **CI/CD**: pipeline para ejecutar auditorías en cada push y publicar artefactos en `Docs/` si se desea.

---

## ℹ️ Nota

Este README resume el estado del **código legado** y enlaza a la evidencia del **análisis 2025**. La modernización (stack, arquitectura y plan SaaS) vive en los documentos bajo `Docs/` y se irá actualizando en sprints.