<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$usuario=getUsuarioId($_GET['id']);

?>

<h2>Registro y control de conceptos de pago.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos del concepto de pago.</legend>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td class="texte2">Identificaci&oacute;n:</td>
				<td><input type="text" class="champ2" name="id_usuario" id="id_usuario" onKeyPress="return numeros(event);" value="<?=$usuario['identificacion_usuario']?>" readonly='readonly'/></td>
			</tr>
			<tr>
				<td class="texte2">Nombre:</td>
				<td><input type="text" class="champ2" name="nombre_usuario" id="nombre_usuario" value="<?=$usuario['nombre_usuario']?>"/></td>
			</tr>
			<tr>
				<td class="texte2">Permisos:</td>
				<td style="color:#333;">
                <? 
				$modulos=getModulos();
				$modulos_usuario=getModulosUsuario($usuario['identificacion_usuario']);
				//print_r($modulos_usuario);
				for($i=0;$i<count($modulos);$i++){
				?>
                <input name="registro_<?=$i?>" id="registro_<?=$i?>" type="checkbox" value="0" <? for($j=0;$j<count($modulos_usuario);$j++){ if($modulos_usuario[$j]["id_modulo"]==$modulos[$i]["id_modulo"]){ echo "checked='checked'"; $j=count($modulos_usuario);}}?> /><?=$modulos[$i]['nombre_permiso']?><br>
                <?
				}
				?>
                </td>
			</tr>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="edita_usuario" type="hidden" value="0" /><input class="button_send" name="ingreso_concepto" id="ingreso_concepto" type="button" value="GUARDAR DATOS" onClick="valida_edita_usuario(this.form);">&nbsp;&nbsp;&nbsp;&nbsp;<input class="button_send" name="salir_usuario" id="salir_usuario" type="button" value="CANCELAR" onClick="FAjax('./administrativo/gestion_usuario.php','area_trabajo','','post');"></td>
			</tr>
        </table>
