<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET['eliminar_comunicado']==1){
	$elimino=delComunicado($_GET['id']);
	if($elimino){
		echo "<script>alert('Los datos se eliminaron correctamente...');</script>";
	}else{
		echo "<script>alert('Los datos no se eliminaron correctamente...');</script>";
	}
}

include("../aula/botones_retorno.php");

$comunicados=getComunicados($_SESSION["user_id"]);
?>
<h2>Listado de comunicados.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0033CC" style="color:#FFF;">
    <td>Comunicado No.</td>
    <td>Fecha</td>
    <td>Contenido</td>
    <td>Acci&oacute;n</td>
  </tr>
<?
if(count($comunicados)<1){
?>
  <tr>
    <td colspan="4" align="center">NO HAY COMUNICADOS REGISTRADOS</td>
  </tr>
<?
}else{
for($i=0;$i<count($comunicados);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?> style="color:#000; font-size:16px;">
    <td width="80px" align="center"><?=$comunicados[$i]['id_comunicado']?></td>
    <td width="80px" align="center"><?=$comunicados[$i]['fecha']?></td>
    <td><?=$comunicados[$i]['asunto']?></td>
    <td width="80px" align="center"><a href="#" onClick="if(confirm('Seguro de eliminar el comunicado?')){FAjax('./administrativo/list_comunicados.php?id=<?=$comunicados[$i]['id_comunicado']?>&eliminar_comunicado=1','area_trabajo_alumno','','post')}else{ return false;};">Eliminar>></a><br /><a href="#" onClick="FAjax('./administrativo/ver_comunicado.php?id=<?=$comunicados[$i]['id_comunicado']?>','area_trabajo_alumno','','post');">Ver>></a></td>
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