<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET['eliminar_archivo']==1){
	$elimino=delElementoAlumnoActividadAula($_GET['id']);
	if($elimino){
		echo "<script>alert('Los datos se eliminaron correctamente...');</script>";
	}else{
		echo "<script>alert('Los datos no se eliminaron correctamente...');</script>";
	}	
}

?>

	<fieldset>
		<legend class="texte_legende2">Datos del archivo.</legend>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td>Comentarios:</td>
				<td><textarea class="champ" id="comentario_archivo" name="comentario_archivo"></textarea></td>
			</tr>
			<tr>
				<td>Archivo:</td>
				<td><input type="file" class="champ5" name="archivo_taller" id="archivo_taller" /></td>
			</tr>
		</table>
	</fieldset>


        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center">
                <input name="actualiza_archivo_taller" id="actualiza_archivo_taller" type="hidden" value="0" />
                <input class="button_send" name="ingreso_archivo_taller" id="ingreso_archivo_taller" type="submit" value="GUARDAR DATOS" onClick="return valida_archivo_teller(this.form);"></td>
			</tr>
        </table>

<?
$archivos=getElementoAlumnoActividadAula($_SESSION['id_actividad_aula'],$_SESSION['esturiante_matriculado']);

if(count($archivos)>=1){
?>
<table width="95%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>Fecha de carga</td>
    <td>Comentarios</td>
    <td>Extension Archivo</td>
    <td>Accion</td>
  </tr>
<?
for($i=0;$i<count($archivos);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$archivos[$i]['fecha_carga']?></td>
    <td><?=$archivos[$i]['comentario']?></td>
    <td><?=$archivos[$i]['extension_archivo']?></td>
    <td>
    
    <a href='./aula/archivos_taller/<?=$archivos[$i]['id_elemento_alumno_actividad_aula']?>.<?=$archivos[$i]['extension_archivo']?>' target='_blank'>Descargar</a><br />
    
    <a href='#' onclick="FAjax('./aula/subir_archivo_taller.php?eliminar_archivo=1&id=<?=$archivos[$i]['id_elemento_alumno_actividad_aula']?>','concepto','','post');">Borrar</a>
    
    </td>
  </tr>
<?
}
?>
</table>
<?
}
?>