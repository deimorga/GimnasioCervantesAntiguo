<?php
ini_set("memory_limit","256M");
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$periodo=2;
$anio=2014;

for($c=1;$c<=23;$c++){//ciclo para grupos
	$alumnos_curso=getAlumnosGrupo($c);
	for($a=0;$a<count($alumnos_curso);$a++){//alumnos de c/grupo
			
		$puntaje_alumno=0;
		$alumno=getAlumnoBoletinId($alumnos_curso[$a]['identificacion']);
		$asignaturas=getAsignaturasGrupo($alumno['id_grupo'],$periodo);

		for($i=0;$i<count($asignaturas);$i++){//Asignaturas vistas por el elumno
			$calificacion=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumnos_curso[$a]['identificacion'],$periodo);
			$puntaje_alumno=$puntaje_alumno+$calificacion['calificacion_asignatura'];
			$dato=seleccionaPlanGestor("tbl_logro", $asignaturas[$i]['id_plan_gestor']);
			for($j=0;$j<count($dato);$j++){
				$calificacion_logro=getCalificacionLogro($dato[$j]['id_logro'],$alumno['identificacion']);
				if($calificacion_logro['desempenio_logro']=="DB"){
					$db=setDesempenioBasico($alumnos_curso[$a]['identificacion'],$asignaturas[$i]['id_asignatura'],$dato[$j]['id_logro']);
				}
			}
		}
		
		$actualiza_puntaje=setPuntajeAlumno($alumnos_curso[$a]['identificacion'],$puntaje_alumno,$periodo,$anio);
		if($actualiza_puntaje){
			echo "ok ".$alumnos_curso[$a]['identificacion']."<br>";
		}else{
			echo "ERROR AL GUARDAR EL PUNTAJE DE ".$alumnos_curso[$a]['identificacion']." siendo este: ".$puntaje_alumno."<br>";
		}
	}
	$alumnos_puesto=getAlumnosGrupoPuesto($c,$periodo,$anio);
	for($y=0;$y<count($alumnos_puesto);$y++){
		$puesto=$y+1;
		$actualiza_puesto=updAlumnoPuesto($alumnos_puesto[$y]['id_puntaje_alumno'],$puesto,$anio,$periodo);
		if($actualiza_puesto){
			echo "ok <br>";
		}else{
			echo "ERROR AL GUARDAR EL PUESTO DE ".$alumnos_puesto[$y]['identificacion']." siendo este: ".$puesto."<br>";
		}
	}
}
?>