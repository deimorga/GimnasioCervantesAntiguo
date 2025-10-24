<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET['elimina_recomendacion']==1){
	$elimina=delPlanGestor("tbl_recomendacion_alumno", "id_recomendacion_alumno", $_GET['id_recomendacion_alumno']);
	if($elimina){
		echo "<script>alert('Se elimino correctamente la recomendacion...');</script>";
	}else{
		echo "<script>alert('No se elimino correctamente la recomendacion...');</script>";
	}
}

if($_GET['id_grupo']){
	$_SESSION['grupo']=$_GET['id_grupo'];
}

$alumno=getAlumnosGrupo($_SESSION['grupo']);
//print_r($alumno);
?>
<h2>Alumnos a los que aplica.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0033CC" style="color:#FFF;">
    <td><input value="Seleccionar" type="button" onclick="selecciona_todo(this.form);" /></td>
    <td>Identificaci&oacute;n</td>
    <td>Nombre</td>
  </tr>
<?
if(count($alumno)<1){
?>
  <tr>
    <td colspan="3" align="center">NO HAY ALUMNOS REGISTRADOS EN ESTA CATEGORIA</td>
  </tr>
<?
}else{
for($i=0;$i<count($alumno);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?> style="color:#000; font-size:16px;">
    <td><input name="<?=$alumno[$i]['identificacion']?>" id="<?=$alumno[$i]['identificacion']?>" value="0" type="checkbox" /></td>
    <td><?=$alumno[$i]['identificacion']?></td>
    <td><?=$alumno[$i]['nombre_alumno']?></td>
  </tr>
<?
$dato=getRecomendacionesAlumno($alumno[$i]['identificacion'], $_SESSION['plan_gestor']);
for($j=0;$j<count($dato);$j++){
?>
  <tr>
    <td colspan="3"><?=$dato[$j]['recomendacion']?>
    &nbsp;-&nbsp;<a href='#' onclick="FAjax('./administrativo/filtro_alumnos_grupo.php?id_recomendacion_alumno=<?=$dato[$j]['id_recomendacion_alumno']?>&elimina_recomendacion=1','list_concepto','','post');">Eliminar</a>
    </td>
  </tr>
<?
}
}}
?>
</table>
