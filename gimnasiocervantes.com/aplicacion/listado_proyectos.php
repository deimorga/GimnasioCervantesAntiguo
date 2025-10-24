<?
session_start();

include_once("./funciones/funciones_galeria.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}
?>
<h2>Registro Nuevo Proyecto.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos del Proyecto.</legend>
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
				<td colspan="2" align="center"><input type="button" id="enviar_galeria" name="enviar_galeria" value="Guardar Proyecto" onclick="FAjax('./aplicacion/admin_proyecto.php?nvo=2','area_trabajo','','post');" class="button_send" /><input type="button" id="desc" name="desc" value="Descargar Programa" onclick="window.open('./aplicacion/vizualizer_photo_reziser_es.rar');" class="button_send" /></td>
			</tr>
		</table>
	</fieldset>
<?
$galerias=getProyectos();
?>
<h2>Listado de Proyectos.</h2>
<table class="table table-responsive table-hover table-bordered" style="color:#666;">
<thead>
    <td>Proyecto No.</td>
    <td>Titulo</td>
    <td>Acci&oacute;n</td>
</thead>
<tbody>
<?
if(count($galerias)<1){
?>
  <tr>
    <td colspan="4" align="center">NO HAY PROYECTOS REGISTRADOS</td>
  </tr>
<?
}else{
for($i=0;$i<count($galerias);$i++){
?>
  <tr>
    <td width="80px" align="center"><?=$galerias[$i]['id_proyecto']?></td>
    <td><?=$galerias[$i]['proyecto']?></td>
    <td width="80px" align="center"><a href="#" onClick="FAjax('./aplicacion/admin_proyecto.php?id=<?=$galerias[$i]['id_proyecto']?>&nvo=1','area_trabajo','','post');">Ver/Editar>></a></td>
  </tr>
<?
}}
?>
</tbody>
</table>