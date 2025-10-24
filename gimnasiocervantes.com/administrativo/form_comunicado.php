<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

?>

<h2>Registro y control de comunicados.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos del comunicado.</legend>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td class="texte2">Asunto:</td>
				<td><input type="text" class="champ2" name="asunto" id="asunto"/></td>
			</tr>
			<tr>
				<td class="texte2">Comunicado:</td>
				<td><textarea class="champ2" name="contenido" id="contenido" cols="35" rows="10"></textarea></td>
			</tr>
		</table>
	</fieldset>