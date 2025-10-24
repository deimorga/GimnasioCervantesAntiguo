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
$dato=seleccionaLogrosPlanGestor1($_SESSION['planilla'],0);

if($_REQUEST['guardar_calificacion']){
	for($a=0;$a<count($alumnos);$a++){
		$cont_error=0;
		for($i=0;$i<count($dato);$i++){
			$actualiza=setCalificacionLogro($dato[$i]['id_logro'],$_REQUEST[$dato[$i]['id_logro']."-".$alumnos[$a]['identificacion']], $alumnos[$a]['identificacion']);
			if(!$actualiza){
				$cont_error=$cont_error+1;
				echo "Error - Logro: ".$dato[$i]['id_logro']." / Alumno: ".$alumnos[$a]['identificacion'];
			}
		}
	}
}

if($cont_error==0){
	echo "<h3>Datos registrados con exito.</h3>";
}
?>
		<table width="670px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="recomendacion2" id="recomendacion2" type="button" value="VOLVER" onclick="FAjax('./profesor/filtro_planilla.php','area_trabajo','','post');" /></td>
			</tr>
        </table>