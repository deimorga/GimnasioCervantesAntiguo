<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$alumno=getAlumnosColegio();

for($i=0;$i<count($alumno);$i++){
	for($j=1;$j<=12;$j++){
		$guarda=setPension($alumno[$i]['identificacion'],$alumno[$i]['pension'],date('Y')."-".completarCeros($j,2)."-00",7);
		if($guarda){
			echo "Guardo ".$alumno[$i]['identificacion']." / ".date('Y')."-".$j."-00<br>";
		}else{
			echo "ERROR AL GUARDAR: ".$alumno[$i]['identificacion']." / ".date('Y')."-".$j."-00<br>";
		}
	}
}
?>