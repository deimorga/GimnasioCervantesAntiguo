<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET['eliminar_usuario']==1){
	$elimino=delUsuario($_GET['id']);
	if($elimino){
		echo "<script>alert('Los datos se eliminaron correctamente...');</script>";
	}else{
		echo "<script>alert('Los datos no se eliminaron correctamente...');</script>";
	}
}
$concepto=getAsignaturas();
?>
<h2>Listado de conceptos de pago.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0033FF" style="color:#FFF;">
    <td>Area</td>
    <td>Nombre Asignatura</td>
    <td>Acci&oacute;n</td>
  </tr>
<?
if(count($concepto)<1){
?>
  <tr>
    <td colspan="3" align="center">NO HAY ASIGNATURAS REGISTRADAS</td>
  </tr>
<?
}else{
for($i=0;$i<count($concepto);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$concepto[$i]['nombre_area']?></td>
    <td><?=$concepto[$i]['nombre_asignatura']?></td>
    <td width="100px"><a href="#" onClick="FAjax('./administrativo/nueva_asignatura.php?id_asignatura=<?=$concepto[$i]['id_asignatura']?>','area_trabajo','','post');">Editar>></a></td>
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