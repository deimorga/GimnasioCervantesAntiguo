<?php
ini_set("memory_limit","256M");
include("../funciones/conexion.php");
include("../funciones/funciones.php");
//echo $_REQUEST['grupo'];
$alumnos_curso=getAlumnosGrupo($_REQUEST['grupo']);

for($a=0;$a<count($alumnos_curso);$a++){
$anio=$_REQUEST['anio'];
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
		$notaSumar=$p1['calificacion_asignatura'];
		if($notaSumar<=3.7){
			$existe_no_recupera=getNoRecupera($alumno['identificacion'],$asignaturas[$i]['id_asignatura'],$_REQUEST['grupo']);
			if($existe_no_recupera){
				
			}else{
				$notaSumar=3.7;
				$actualiza=setCalificacionAsignatura2($asignaturas[$i]['id_asignatura'], $notaSumar, $alumno['identificacion'],1);
				if(!$actualiza){
					echo "<br>ERROR: No se actualizo ".$asignaturas[$i]['id_asignatura']." | 3.7 | ".$alumno['identificacion']." | 1 |<br>";
				}
			}
		}
		$suma=$suma+$notaSumar;
		$cont=$cont+1;
	}
	if($p2){
		$notaSumar=$p2['calificacion_asignatura'];
		if($notaSumar<=3.7){
			$existe_no_recupera=getNoRecupera($alumno['identificacion'],$asignaturas[$i]['id_asignatura'],$_REQUEST['grupo']);
			if($existe_no_recupera){
				
			}else{
				$notaSumar=3.7;
				$actualiza=setCalificacionAsignatura2($asignaturas[$i]['id_asignatura'], $notaSumar, $alumno['identificacion'],2);
				if(!$actualiza){
					echo "<br>ERROR: No se actualizo ".$asignaturas[$i]['id_asignatura']." | 3.7 | ".$alumno['identificacion']." | 2 |<br>";
				}
			}
		}
		$suma=$suma+$notaSumar;
		$cont=$cont+1;
	}
	if($p3){
		$notaSumar=$p3['calificacion_asignatura'];
			$existe_no_recupera=getNoRecupera($alumno['identificacion'],$asignaturas[$i]['id_asignatura'],$_REQUEST['grupo']);
		if($existe_no_recupera){
			//para descontar definitiva por no recuperar del año 2017
			$pg=getPlanGestor2($_REQUEST['grupo'], $asignaturas[$i]['id_asignatura'], 3);
			$dato=seleccionaLogrosPlanGestor("logro",$pg['id_plan_gestor']);
			$cantLogros=count($dato);
			//die("TOTAL: ".$cantLogros);
			$nuevaNoRecupera=((($p3['calificacion_asignatura']*$cantLogros)+2.5)/($cantLogros+1));
			
			$actualiza=setCalificacionAsignatura2($asignaturas[$i]['id_asignatura'], $nuevaNoRecupera, $alumno['identificacion'],3);
			if(!$actualiza){
				echo "<br>ERROR: No se actualizo Perdido: ".$asignaturas[$i]['id_asignatura']." , 3.7 , ".$alumno['identificacion']." , 3 <br>";
			}else{
			    echo "Actualizo no recupera con definitiva";
			}
		}else{
			if($notaSumar<=3.7){
				$notaSumar=3.7;
				$actualiza=setCalificacionAsignatura2($asignaturas[$i]['id_asignatura'], $notaSumar, $alumno['identificacion'],3);
				if(!$actualiza){
					echo "<br>ERROR: No se actualizo ".$asignaturas[$i]['id_asignatura']." , 3.7 , ".$alumno['identificacion']." , 3 <br>";
				}
			}
		}
		$suma=$suma+$notaSumar;
		$cont=$cont+1;
	}
	if($p4){
		$notaSumar=$p4['calificacion_asignatura'];
		if($notaSumar<=3.7){
			$existe_no_recupera=getNoRecupera($alumno['identificacion'],$asignaturas[$i]['id_asignatura'],$_REQUEST['grupo']);
			if($existe_no_recupera){
				
			}else{
				$notaSumar=3.7;
				$actualiza=setCalificacionAsignatura2($asignaturas[$i]['id_asignatura'], $notaSumar, $alumno['identificacion'],4);
				if(!$actualiza){
					echo "<br>ERROR: No se actualizo ".$asignaturas[$i]['id_asignatura']." | 3.7 | ".$alumno['identificacion']." | 4 |<br>";
				}
			}
		}
		$suma=$suma+$notaSumar;
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
	//	echo "El alumno ".$alumno['identificacion']." no tiene todas sus notas...<br>";
	//}
}
}
?>
