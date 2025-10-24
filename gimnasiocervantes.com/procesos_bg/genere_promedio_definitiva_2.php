<?php
ini_set("memory_limit","256M");
include("../funciones/conexion.php");
include("../funciones/funciones.php");
//echo $_REQUEST['grupo'];
for($c=1;$c<=23;$c++){
$alumnos_curso=getAlumnosGrupo($c);
echo "<br><br>GRUPO ".$c."<br>";

for($a=0;$a<count($alumnos_curso);$a++){
$anio=date('Y');
$alumno=getAlumnoBoletinId($alumnos_curso[$a]['identificacion']);
$asignaturas=getAsignaturasGrupo($alumno['id_grupo'],1);
//print_r($asignaturas);
for($i=0;$i<count($asignaturas);$i++){
	$suma=0;
	$cont=0;
	$prom=0;
	$p1=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],1);
	$p2=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],2);
	$p3=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],3);
	$p4=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],4);
	if($p1){
		$suma=$suma+$p1['calificacion_asignatura'];
		$cont=$cont+1;
	}
	if($p2){
		$suma=$suma+$p2['calificacion_asignatura'];
		$cont=$cont+1;
	}
	if($p3){
		$suma=$suma+$p3['calificacion_asignatura'];
		$cont=$cont+1;
	}
	if($p4){
		$suma=$suma+$p4['calificacion_asignatura'];
		$cont=$cont+1;
	}
	if($suma!=0 && $cont!=0){
		$prom=$suma/$cont;
	}
	$definitiva=redondear($prom);
	
	//valida q no exista ya nota y este calificado los 4 periodos//
	$calificacion_alumno=getCalificacionAsignaturaFinal($asignaturas[$i]['id_asignatura'], $alumno['identificacion'], $anio);

	//if($cont==4){
		if(!$calificacion_alumno){
			$actualiza_definitiva=setCalificacionAsignaturaFinal($asignaturas[$i]['id_asignatura'], $definitiva, $alumno['identificacion'], $anio);
			if($actualiza_definitiva){
				echo $a.": Se actualizo el registro de notas de ".$alumno['identificacion']." con una definitiva de ".$definitiva."<br>";
			}else{
				echo "ERROR: Inconvenientes en el registro de notas de ".$alumno['identificacion']."<br>";
			}
		}else{
			echo "El alumno ".$alumno['identificacion']." ya registra notas...<br>";
		}
	//}else{
		//echo "El alumno ".$alumno['identificacion']." no tiene todas sus notas...<br>";
	//}
}
}
}
?>
