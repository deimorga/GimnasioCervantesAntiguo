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
$grupo=getGrupos();
?>
<h2>Listado de grupos registrados.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0033FF" style="color:#FFF;">
    <td>Grupo</td>
    <td>Grado</td>
    <td>Director de grupo</td>
  </tr>
<?
if(count($grupo)<1){
?>
  <tr>
    <td colspan="3" align="center">NO HAY GRUPOS REGISTRADOS</td>
  </tr>
<?
}else{
for($i=0;$i<count($grupo);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$grupo[$i]['nombre_grupo']?></td>
    <td><?=$grupo[$i]['nombre_grado']?></td>
    <td><?=$grupo[$i]['nombre_profesor']?></td>
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