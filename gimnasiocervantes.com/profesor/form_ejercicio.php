<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

?>

<h2>Actividades de la tarea.</h2>
Recuerda que el material de apoyo no debe superar las 4Megas...

	<fieldset>
		<legend class="texte_legende2">Datos de la actividad.</legend>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Nombre:</td>
				<td><input type="text" class="champ2" name="nombre_ej" id="nombre_ej" value="<?=$nombre_ej?>"/> *</td>
			</tr>
			<tr>
				<td class="texte2">Enlace:</td>
				<td><input type="text" class="champ2" name="enlace" id="enlace" /></td>
			</tr>
			<tr>
				<td class="texte2">Archivo:</td>
				<td><input type="file" class="champ2" name="imagen" id="imagen"/></td>
			</tr>
			<tr>
				<td class="texte2">Descripcion:</td>
				<td><textarea class="champ2" name="descripcion_ej" id="descripcion_ej" cols="35" rows="10"><?=$descripcion?></textarea> *</td>
			</tr>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza_ejercicio" type="hidden" value="0" />
                <input class="button_send" name="ingreso_ejercicio" id="ingreso_ejercicio" type="submit" value="GUARDAR DATOS" onClick="return valida_nuevo_ejercicio(this.form);"></td>
			</tr>
        </table>
