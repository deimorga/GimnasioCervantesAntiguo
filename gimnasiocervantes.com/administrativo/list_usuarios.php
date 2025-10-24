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
$concepto=getUsuarios();
?>
<h2>Listado de conceptos de pago.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0033FF" style="color:#FFF;">
    <td>Identificaci&oacute;n</td>
    <td>Nombre usuario</td>
    <td>Tipo de usuario</td>
    <td>Acci&oacute;n</td>
  </tr>
<?
if(count($concepto)<1){
?>
  <tr>
    <td colspan="4" align="center">NO HAY USUARIOS REGISTRADOS</td>
  </tr>
<?
}else{
for($i=0;$i<count($concepto);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$concepto[$i]['identificacion_usuario']?></td>
    <td><?=$concepto[$i]['nombre_usuario']?></td>
    <td><?=$concepto[$i]['nombre_tipo_usuario']?></td>
    <td><a href="#" onClick="if(confirm('Seguro de eliminar el usuario?')){FAjax('./administrativo/list_usuarios.php?id=<?=$concepto[$i]['identificacion_usuario']?>&eliminar_usuario=1','list_concepto','','post')}else{ return false;};">Eliminar>></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="FAjax('./administrativo/form_edita_usuario.php?id=<?=$concepto[$i]['identificacion_usuario']?>&editar_usuario=1','concepto','','post');">Editar>></a></td>
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