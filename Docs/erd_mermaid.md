```mermaid
erDiagram
  tbl_periodo_academico {
    int(10) id_periodo_academico PK
    varchar(80) nombre_periodo_academico
    int(1) activo
    int(1) visible
  }
  tbl_alumno {
    decimal(12,0) identificacion PK
    varchar(80) lugar_expedicion
    varchar(150) nombre_alumno
    varchar(150) lugar_nacimiento
    date fecha_nacimiento
    varchar(20) rh
    varchar(150) eps
    int(1) estrato
    varchar(8) nivel_sisben
    varchar(150) direccion_alumno
    varchar(40) telefono_alumno
    varchar(150) barrio_alumno
  }
  tbl_area {
    int(10) id_area PK
    varchar(100) nombre_area
  }
  tbl_calificacion_asignatura {
    int(10) id_calificacion_asignatura PK
    int(10) id_asignatura
    decimal(12,0) id_alumno
    decimal(10,1) calificacion_asignatura
    int(2) horas_justificadas
    int(2) horas_injustificadas
    int(1) id_periodo
    varchar(3) desempenio_asignatura
  }
  tbl_grupo_asignatura {
    int(10) id_grupo_asignatura PK
    int(10) id_grupo
    int(10) id_asignatura
    int(3) intensidad_horaria
    decimal(10,0) id_profesor
    varchar(1000) logro_final_superior
    varchar(1000) logro_final_alto
    varchar(1000) logro_final_basico
    varchar(1000) logro_final_bajo
  }
  tbl_grupo {
    int(10) id_grupo PK
    varchar(30) nombre_grupo
    int(10) id_grado
    decimal(10,0) id_profesor
  }
  tbl_calificacion_logro {
    int(10) id_calificacion_logro PK
    decimal(12,0) id_alumno
    int(10) id_logro
    decimal(10,1) calificacion_logro
    varchar(3) desempenio_logro
    int(1) superado
  }
  tbl_usuario {
    decimal(12,0) identificacion_usuario PK
    varchar(15) clave_usuario
    varchar(150) nombre_usuario
    int(2) id_tipo_usuario
  }
  tbl_concepto_pago_alumno {
    decimal(12,0) id_alumno
    int(10) id_concepto_pago
    int(10) factura
    date fecha_facturado
    int(1) estado_concepto_pago
    int(10) id_concepto_pago_alumno PK
    int(10) valor_cancelado
    date periodo_facturado
    varchar(300) observacion_pago
    decimal(10,0) valor_pagar
    decimal(10,0) descuento
    date fecha_consignacion
  }
  tbl_plan_gestor {
    int(10) id_plan_gestor PK
    int(2) id_periodo_academico
    varchar(300) competencia_institucional
    varchar(200) nombre_unidad
    int(10) id_grupo_asignatura
  }
  tbl_profesor {
    decimal(10,0) id_profesor PK
    varchar(100) nombre_profesor
    varchar(50) tel_1
    varchar(50) tel_2
    varchar(100) direccion_profesor
    varchar(100) email_profesor
  }
  tbl_concepto_pago {
    int(10) id_concepto_pago PK
    varchar(100) nombre_concepto_pago
    int(10) valor_concepto_pago
    int(1) tipo_concepto
  }
  tbl_circular {
    int(10) id_circular PK
    varchar(200) emisor
    varchar(300) dirigida
    varchar(300) tema
    date fecha_circular
    varchar(200) archivo
    int(1) tipo
  }
  tbl_logro {
    int(10) id_logro PK
    varchar(1000) logro
    int(10) id_plan_gestor
    int(1) evaluacion
    int(1) id_periodo
    int(3) porcentaje
  }
  tbl_asignatura {
    int(10) id_asignatura PK
    varchar(100) nombre_asignatura
    int(10) id_area
    int(1) tipo_asignatura
  }
  tbl_grado {
    int(10) id_grado PK
    varchar(100) nombre_grado
    int(1) id_consecutivo
  }
  tbl_grado ||--o{ tbl_alumno : "id_grado->id_grado"
  tbl_grupo ||--o{ tbl_alumno : "id_grupo->id_grupo"
  tbl_area ||--o{ tbl_asignatura : "id_area->id_area"
  tbl_alumno ||--o{ tbl_calificacion_asignatura : "id_alumno->identificacion"
  tbl_periodo_academico ||--o{ tbl_calificacion_asignatura : "id_periodo->id_periodo_academico"
  tbl_asignatura ||--o{ tbl_calificacion_asignatura : "id_asignatura->id_asignatura"
  tbl_alumno ||--o{ tbl_calificacion_logro : "id_alumno->identificacion"
  tbl_logro ||--o{ tbl_calificacion_logro : "id_logro->id_logro"
  tbl_asignatura ||--o{ tbl_grupo_asignatura : "id_asignatura->id_asignatura"
  tbl_grupo ||--o{ tbl_grupo_asignatura : "id_grupo->id_grupo"
  tbl_profesor ||--o{ tbl_grupo_asignatura : "id_profesor->id_profesor"
  tbl_plan_gestor ||--o{ tbl_logro : "id_plan_gestor->id_plan_gestor"
  tbl_grupo_asignatura ||--o{ tbl_plan_gestor : "id_grupo_asignatura->id_grupo_asignatura"
  tbl_periodo_academico ||--o{ tbl_plan_gestor : "id_periodo_academico->id_periodo_academico"
```