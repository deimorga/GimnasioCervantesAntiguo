# Análisis funcional — Plataforma Colegios (legacy PHP)

**Fuente:** escaneo de código (endpoints + SQL) y métricas automáticas.

## 1) Inventario de módulos (por carpetas principales)

### gimnasiocervantes.com  
Archivos involucrados: **454**

Endpoints representativos: `../funciones/conexion.php, ../funciones/funciones.php, ../mpdf.php, ./funciones/conexion.php, ./funciones/funciones.php`

Tablas más afectadas: `tbl_alumno, tbl_grupo_asignatura, tbl_concepto_pago_alumno, tbl_concepto_pago, tbl_circular`

Descripción inferida: Módulo funcional identificado por actividad en archivos.

### (root)  
Archivos involucrados: **61**

Descripción inferida: Módulo funcional identificado por actividad en archivos.

### funciones  
Archivos involucrados: **13**

Endpoints representativos: `../funciones/conexion.php, ../funciones/funciones.php, ./funciones/conexion.php, ./funciones/funciones.php, ../funciones/funciones_aula.php`

Descripción inferida: Módulo funcional identificado por actividad en archivos.

### administrativo  
Archivos involucrados: **2**

Endpoints representativos: `../administrativo/filtro_alumnos_grupo.php, ../administrativo/form_comunicado.php`

Descripción inferida: Procesos administrativos y configuración.

### Classes  
Archivos involucrados: **1**

Endpoints representativos: `../Classes/PHPExcel/IOFactory.php, ../PHPExcel/Classes/PHPExcel.php`

Descripción inferida: Módulo funcional identificado por actividad en archivos.

### MPDF56  
Archivos involucrados: **1**

Endpoints representativos: `./MPDF56/mpdf.php, ../pdf/MPDF56/mpdf.php`

Descripción inferida: Módulo funcional identificado por actividad en archivos.

### aplicacion  
Archivos involucrados: **1**

Endpoints representativos: `./aplicacion/funciones/funciones_galeria.php`

Descripción inferida: Módulo funcional identificado por actividad en archivos.

### assets  
Archivos involucrados: **1**

Endpoints representativos: `assets/posteddata.php`

Descripción inferida: Módulo funcional identificado por actividad en archivos.

### aula  
Archivos involucrados: **1**

Endpoints representativos: `../aula/botones_retorno.php`

Descripción inferida: Gestión de aula, actividades y contenidos.

### mail  
Archivos involucrados: **1**

Endpoints representativos: `././mail/contact_me.php`

Descripción inferida: Módulo funcional identificado por actividad en archivos.


## 2) Matriz CRUD inicial (endpoint ↔ tabla)

Ver CSV detallado: `matriz_crud.csv`. Abajo, un extracto de las primeras 30 filas:

| endpoint                | table                             |   DELETE |   INSERT |   SELECT |   UPDATE |   total |
|:------------------------|:----------------------------------|---------:|---------:|---------:|---------:|--------:|
| funciones/funciones.php | tbl_alumno                        |        1 |        4 |       19 |        8 |      32 |
| funciones/funciones.php | tbl_circular                      |        1 |        4 |       10 |        0 |      15 |
| funciones/funciones.php | tbl_grupo_asignatura              |        1 |        1 |       10 |        2 |      14 |
| funciones/funciones.php | tbl_concepto_pago_alumno          |        1 |        3 |        8 |        2 |      14 |
| funciones/funciones.php | tbl_concepto_pago                 |        1 |        1 |        6 |        1 |       9 |
| funciones/funciones.php | tbl_grupo                         |        1 |        1 |        5 |        1 |       8 |
| funciones/funciones.php | tbl_usuario                       |        1 |        1 |        4 |        2 |       8 |
| funciones/funciones.php | tbl_logro                         |        0 |        2 |        4 |        1 |       7 |
| funciones/funciones.php | tbl_desempenio_perdido            |        0 |        1 |        4 |        1 |       6 |
| funciones/funciones.php | tbl_plan_gestor                   |        0 |        1 |        4 |        1 |       6 |
| funciones/funciones.php | tbl_comunicado_alumno             |        1 |        1 |        4 |        0 |       6 |
| funciones/funciones.php | tbl_noticia                       |        1 |        1 |        4 |        0 |       6 |
| funciones/funciones.php | tbl_contenido_enlace              |        1 |        1 |        3 |        1 |       6 |
| funciones/funciones.php | tbl_alumno_logro_caso_especial    |        2 |        1 |        3 |        0 |       6 |
| funciones/funciones.php | tbl_calificacion_asignatura       |        0 |        2 |        2 |        2 |       6 |
| funciones/funciones.php | tbl_calificacion_logro            |        0 |        2 |        2 |        2 |       6 |
| funciones/funciones.php | tbl_acudiente                     |        0 |        1 |        3 |        1 |       5 |
| funciones/funciones.php | tbl_gasto                         |        1 |        1 |        3 |        0 |       5 |
| funciones/funciones.php | tbl_asignatura                    |        1 |        1 |        2 |        1 |       5 |
| funciones/funciones.php | tbl_dato_seccion_plan_gestor      |        1 |        1 |        2 |        1 |       5 |
| funciones/funciones.php | tbl_enlace_principal              |        1 |        1 |        2 |        1 |       5 |
| funciones/funciones.php | tbl_profesor                      |        1 |        1 |        2 |        1 |       5 |
| funciones/funciones.php | tbl_sede                          |        1 |        1 |        2 |        1 |       5 |
| funciones/funciones.php | tbl_periodo_academico             |        0 |        0 |        4 |        0 |       4 |
| funciones/funciones.php | tbl_calificacion_asignatura_final |        0 |        1 |        2 |        1 |       4 |
| funciones/funciones.php | tbl_contacto                      |        0 |        1 |        2 |        1 |       4 |
| funciones/funciones.php | tbl_pago_otros                    |        0 |        1 |        2 |        1 |       4 |
| funciones/funciones.php | tbl_tipo_comunicado               |        0 |        1 |        2 |        1 |       4 |
| funciones/funciones.php | tbl_alumno_acudiente              |        1 |        1 |        2 |        0 |       4 |
| funciones/funciones.php | tbl_comunicado                    |        1 |        1 |        2 |        0 |       4 |

## 3) Flujos funcionales candidatos (User Journeys)

### Matrícula de Estudiantes
Tablas involucradas (indicativas): `tbl_alumno, tbl_matricula, tbl_grupo, tbl_grupo_asignatura`
Pasos (borrador):
- **Entrada**: parámetros vía formulario/AJAX.
- **Procesamiento**: validaciones + operaciones CRUD.
- **Salida**: confirmación, actualización de estado y (cuando aplique) generación de reporte/recibo.

### Gestión de Calificaciones y Logros
Tablas involucradas (indicativas): `tbl_calificacion_logro, tbl_logro, tbl_grupo_asignatura, tbl_alumno_logro_caso_especial`
Pasos (borrador):
- **Entrada**: parámetros vía formulario/AJAX.
- **Procesamiento**: validaciones + operaciones CRUD.
- **Salida**: confirmación, actualización de estado y (cuando aplique) generación de reporte/recibo.

### Gestión de Circulares/Comunicados
Tablas involucradas (indicativas): `tbl_circular, tbl_comunicado, tbl_usuario`
Pasos (borrador):
- **Entrada**: parámetros vía formulario/AJAX.
- **Procesamiento**: validaciones + operaciones CRUD.
- **Salida**: confirmación, actualización de estado y (cuando aplique) generación de reporte/recibo.

### Pensiones: Facturación y Pagos
Tablas involucradas (indicativas): `tbl_concepto_pago, tbl_concepto_pago_alumno, tbl_pago, tbl_usuario`
Pasos (borrador):
- **Entrada**: parámetros vía formulario/AJAX.
- **Procesamiento**: validaciones + operaciones CRUD.
- **Salida**: confirmación, actualización de estado y (cuando aplique) generación de reporte/recibo.

### Generación de Reportes (PDF/Excel)
Tablas involucradas (indicativas): `mpdf, phpexcel, phpspreadsheet`
Pasos (borrador):
- **Entrada**: parámetros vía formulario/AJAX.
- **Procesamiento**: validaciones + operaciones CRUD.
- **Salida**: confirmación, actualización de estado y (cuando aplique) generación de reporte/recibo.

### Asistencia por Curso/Periodo
Tablas involucradas (indicativas): `tbl_asistencia, tbl_grupo, tbl_periodo`
Pasos (borrador):
- **Entrada**: parámetros vía formulario/AJAX.
- **Procesamiento**: validaciones + operaciones CRUD.
- **Salida**: confirmación, actualización de estado y (cuando aplique) generación de reporte/recibo.


## 4) Actores y permisos (borrador RBAC)

- **Admin MicroNuba**: Gestiona tenants, usuarios globales, parámetros del sistema, auditoría.
- **Rector/Coordinador**: Configura año/periodos, crea grupos y asigna docentes, aprueba circulares, valida reportes.
- **Docente**: Carga calificaciones y asistencia, genera reportes de su curso, crea comunicados a su grupo.
- **Administrativo**: Gestiona pensiones y cobros, concilia pagos, emite recibos, exporta informes.
- **Acudiente/Estudiante**: Consulta calificaciones, asistencia, circulares, estados de cuenta y realiza pagos.


## 5) Riesgos funcionales

- Procesos críticos (pagos, calificaciones) dependen de endpoints con múltiples responsabilidades y parámetros en $_REQUEST.
- Falta de confirmaciones/validaciones transaccionales (idempotencia) en cobros/pagos y cargas masivas.
- Reportes acoplados a librerías EOL (PHPExcel), dificultando mantenimiento y performance.
- Uso mixto de mysql_/mysqli sin capa de repositorio; difícil controlar reglas de negocio y permisos en un solo lugar.
- Ausencia de trazabilidad/auditoría funcional (quién cambió qué/ cuándo) en varias tablas clave.