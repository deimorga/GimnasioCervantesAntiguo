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
$anio=date('Y');
$alumnos=getAlumnosGrupo($_SESSION['grupo']);

if($_REQUEST['guardar_calificacion']){
	
	for($a=0;$a<count($alumnos);$a++){
		$definitiva=$_POST['nota_'.$alumnos[$a]['identificacion']];
		$actualiza_definitiva=setCalificacionAsignaturaFinal($_SESSION['asignatura'], $definitiva, $alumnos[$a]['identificacion'], $anio);
		if($actualiza_definitiva){
			echo $a.": Se actualizo el registro de notas de ".$alumnos[$a]['identificacion']." con una definitiva de ".$definitiva."<br>";
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