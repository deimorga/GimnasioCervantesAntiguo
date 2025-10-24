<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$comunicados=getComunicadosAdmin($_SESSION['user_id']);
?>
<h2>Listado de comunicados.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066CC" style="color:#FFF;">
    <td>Comunicado No.</td>
    <td>Fecha</td>
    <td>Asunto</td>
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
  <tr>
    <td width="80px" align="center"><?=$comunicados[$i]['id_comunicado']?></td>
    <td width="80px" align="center"><?=$comunicados[$i]['fecha']?></td>
    <td><?=$comunicados[$i]['asunto']?></td>
    <td width="80px" align="center"><a href="#" onClick="FAjax('./administrativo/ver_comunicado.php?id=<?=$comunicados[$i]['id_comunicado']?>','area_trabajo','','post');">Ver>></a></td>
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