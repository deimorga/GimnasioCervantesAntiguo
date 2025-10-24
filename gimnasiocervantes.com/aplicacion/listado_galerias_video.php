<?
session_start();

include_once("./funciones/funciones_galeria.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET['nvo']==1){
	$galeria=setGaleriaVideo($_REQUEST['asunto'],$_REQUEST['contenido'],$_REQUEST['enlace']);
}
?>
<h2>Registro Nuevo Video.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos del video.</legend>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td class="texte2">Titulo:</td>
				<td><input type="text" class="champ2" name="asunto" id="asunto"/></td>
			</tr>
			<tr>
				<td class="texte2">Descripcion:</td>
				<td><textarea class="champ2" name="contenido" id="contenido" cols="35" rows="10"></textarea></td>
			</tr>
			<tr>
				<td class="texte2">Enlace Video:</td>
				<td><input type="text" class="champ2" name="enlace" id="enlace"/></td>
			</tr>
			<tr>
			  <td colspan="2" align="center"><input type="button" id="enviar_galeria" name="enviar_galeria" value="Guardar Galeria" onclick="FAjax('./aplicacion/listado_galerias_video.php?nvo=1','area_trabajo','','post');" class="button_send" /></td>
			</tr>
		</table>
	</fieldset>
<?
$galerias=getGalerias(2);
?>
<h2>Listado de Galerias.</h2>
<table class="table table-responsive table-hover table-bordered" style="color:#666;">
<thead>
    <td>Titulo</td>
    <td>Descripcion</td>
    <td>Acci&oacute;n</td>
</thead>
<tbody>
<?
if(count($galerias)<1){
?>
  <tr>
    <td colspan="4" align="center">NO HAY VIDEOS REGISTRADAS</td>
  </tr>
<?
}else{
for($i=0;$i<count($galerias);$i++){
?>
  <tr>
    <td><?=$galerias[$i]['galeria']?></td>
    <td><?=$galerias[$i]['descripcion_galeria']?></td>
    <td width="80px" align="center"><a href="#" onClick="window.open('<?=$galerias[$i]['enlace_galeria']?>');">Ver>></a></td>
  </tr>
<?
}}
?>
</tbody>
</table>