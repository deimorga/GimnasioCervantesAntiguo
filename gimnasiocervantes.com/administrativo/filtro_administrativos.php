<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$usuario=getUsuariosAdmin();
//print_r($alumno);
?>
<h2>Usuarios a los que aplica el comunicado.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066CC" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Identificaci&oacute;n</td>
    <td>Nombre</td>
    <td>Tipo usuario</td>
  </tr>
<?
if(count($usuario)<1){
?>
  <tr>
    <td colspan="4" align="center">NO HAY USUARIOS REGISTRADOS EN ESTA CATEGORIA</td>
  </tr>
<?
}else{
for($i=0;$i<count($usuario);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><input name="<?=$usuario[$i]['identificacion_usuario']?>" id="<?=$usuario[$i]['identificacion_usuario']?>" value="<?=$usuario[$i]['identificacion_usuario']?>" type="checkbox" checked="checked" /></td>
    <td><?=$usuario[$i]['identificacion_usuario']?></td>
    <td><?=$usuario[$i]['nombre_usuario']?></td>
    <td><?=$usuario[$i]['nombre_tipo_usuario']?></td>
  </tr>
<?
}}
?>
</table>
