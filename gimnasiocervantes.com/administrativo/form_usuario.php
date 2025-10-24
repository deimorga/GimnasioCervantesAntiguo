<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

?>

<h2>Registro y control de usuarios.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos del usuario.</legend>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td class="texte2">Identificaci&oacute;n:</td>
				<td><input type="text" class="champ2" name="id_usuario" id="id_usuario" onKeyPress="return numeros(event);"/></td>
			</tr>
			<tr>
				<td class="texte2">Nombre:</td>
				<td><input type="text" class="champ2" name="nombre_usuario" id="nombre_usuario"/></td>
			</tr>
			<tr>
				<td class="texte2">Modulos:</td>
				<td style="color:#333;">
                <? 
				$modulos=getModulos();
				for($i=0;$i<count($modulos);$i++){
				?>
                <input name="registro_<?=$i?>" id="registro_<?=$i?>" type="checkbox" value="0"><?=$modulos[$i]['nombre_permiso']?><br>
                <?
				}
				?>
			</tr>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza_usuario" type="hidden" value="0" /><input class="button_send" name="ingreso_concepto" id="ingreso_concepto" type="button" value="GUARDAR DATOS" onClick="valida_nuevo_usuario(this.form);"></td>
			</tr>
        </table>
