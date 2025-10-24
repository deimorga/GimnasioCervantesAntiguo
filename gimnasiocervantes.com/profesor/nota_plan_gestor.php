<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}
?>
<h1>Notas</h1>
<?
//die("*************".$_SESSION['grupo']."-".$_SESSION['asignatura']."-".$_SESSION['periodo_academico']);
$alumnos=getAlumnosGrupo($_SESSION['grupo']);
$dato=seleccionaLogrosPlanGestor1($_SESSION['plan_gestor'],0);

if($_REQUEST['guardar_calificacion']){
	
	for($a=0;$a<count($alumnos);$a++){
		$definitiva=0;
		$definitiva_100=0;
		$contador=0;
		$suma=0;
		for($i=0;$i<count($dato);$i++){
			$actualiza=setCalificacionLogro($dato[$i]['id_logro'],$_REQUEST[$dato[$i]['id_logro']."-".$alumnos[$a]['identificacion']], $alumnos[$a]['identificacion']);
			if($actualiza){
				$contador=$contador+1;
				$suma=$suma+$_REQUEST[$dato[$i]['id_logro']."-".$alumnos[$a]['identificacion']];
			}
		}
		
		$definitiva=$suma/$contador;
		//echo "suma: ".$suma." definitiva: ".$definitiva;
		if($_SESSION['tipo_asignatura']==1){
			$logro_evaluacion=getLogroEvaluacion($_SESSION['plan_gestor'],1);
			$actualiza_evaluacion=setCalificacionLogro($logro_evaluacion['id_logro'],$_REQUEST[$logro_evaluacion['id_logro']."-".$alumnos[$a]['identificacion']], $alumnos[$a]['identificacion']);
			if($actualiza_evaluacion){
				$definitiva_70=$definitiva*0.7;
				$definitiva_30=$_REQUEST[$logro_evaluacion['id_logro']."-".$alumnos[$a]['identificacion']]*0.3;
				$definitiva_100=redondear($definitiva_70+$definitiva_30);
				echo "Descripccion --> Acumulado 70% :".$definitiva_70." / Acumulado 30%: ".$definitiva_30."<br>";
			}
		}else{
			$definitiva_100=redondear($definitiva);
		}
		$actualiza_definitiva=setCalificacionAsignatura($_SESSION['asignatura'], $definitiva_100, $alumnos[$a]['identificacion'],$_REQUEST['justificadas_'.$alumnos[$a]['identificacion']],$_REQUEST['injustificadas_'.$alumnos[$a]['identificacion']],$_SESSION['periodo_academico']);
		if($actualiza_definitiva){
			echo $a.": Se actualizo el registro de notas de ".$alumnos[$a]['identificacion']." con una definitiva de ".$definitiva_100."<br>";
		}else{
			echo "ERROR: Inconvenientes en el registro de notas de ".$alumnos[$a]['identificacion']."<br>";
		}
	}
}

?>
		<table width="670px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="recomendacion2" id="recomendacion2" type="button" value="VOLVER" onclick="FAjax('./profesor/filtro_calificar_plan_gestor.php','area_trabajo','','post');" /></td>
			</tr>
        </table>