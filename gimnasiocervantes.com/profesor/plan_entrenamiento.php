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

$planes=getPlanesEntrenamientoGrupo($_GET["id_grupo"]);
?>
<h2>Listado de Tareas.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0033CC" style="color:#FFF;">
    <td width="25px">&nbsp;</td>
    <td>Fecha</td>
    <td>Objetivo</td>
    <td>Acci&oacute;n</td>
  </tr>
<?
if(count($planes)<1){
?>
  <tr>
    <td colspan="4" align="center">NO HAY TAREAS REGISTRADAS</td>
  </tr>
<?
}else{
for($i=0;$i<count($planes);$i++){
?>
  <tr>
    <td align="center"><?=$i+1?></td>
    <td width="80px" align="center"><?=$planes[$i]['fecha_plan']?></td>
    <td><?=$planes[$i]['objetivo']?></td>
    <td width="160px" align="center"><a href="#" onClick="FAjax('./profesor/ver_plan.php?id=<?=$planes[$i]['id_plan_entrenamiento']?>','area_trabajo','','post');">Ver</a><? if($_SESSION["user_tipo"]==2){?> | <a href="#" onClick="FAjax('./profesor/gestionar_plan_entrenamiento.php?id_plan=<?=$planes[$i]['id_plan_entrenamiento']?>','area_trabajo','','post');">Editar</a> | <a href="#" onClick="if(confirm('Seguro de eliminar la tarea?')){ FAjax('./profesor/plan_entrenamiento.php?id_plan=<?=$planes[$i]['id_plan_entrenamiento']?>&delete=1&id_grupo=<?=$_GET["id_grupo"]?>','area_trabajo','','post'); }else{ return false;}">Eliminar</a> <? }?></td>
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