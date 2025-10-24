<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET['delete']==1){
	$elimina=delPlanEntrenamiento($_REQUEST['id_plan']);
	if($elimina){
		echo "<script>alert('Se elimino correctamente...');</script>";
	}else{
		echo "<script>alert('No se elimino correctamente...');</script>";
	}
}

$planes=getPlanesEntrenamientoGrupoAlumno($_GET["id_grupo"]);
?>
<h2>Listado de Tareas.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0033CC" style="color:#FFF;">
    <td width="25px">&nbsp;</td>
    <td>Fecha</td>
    <td>Asignatura</td>
    <td>Objetivo</td>
    <td>Acci&oacute;n</td>
  </tr>
<?
if(count($planes)<1){
?>
  <tr>
    <td colspan="5" align="center">NO HAY TAREAS REGISTRADAS</td>
  </tr>
<?
}else{
for($i=0;$i<count($planes);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td align="center"><?=$i+1?></td>
    <td width="60px" align="center"><?=$planes[$i]['fecha_plan']?></td>
    <td width="90px" align="center"><?=$planes[$i]['nombre_asignatura']?></td>
    <td><?=$planes[$i]['objetivo']?></td>
    <td width="50px" align="center"><a href="#" onClick="FAjax('./profesor/ver_plan.php?id=<?=$planes[$i]['id_plan_entrenamiento']?>','area_trabajo','','post');">Ver</a></td>
  </tr>
<?
}}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><input type="button" value="IMPRIMIR LISTADO" class="button_send" /></td>
  </tr>
</table>