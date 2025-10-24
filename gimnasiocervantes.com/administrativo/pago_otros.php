<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_POST['actualiza_concepto']==1){
	$guarda_pago=setPagoOtros($_POST['id_pago'],$_POST['nombre_pago'],$_POST['concepto_pago'],$_POST['valor_pago'],$_POST['observaciones_pago'],$_SESSION["user_id"]);
	if($guarda_pago){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

?>

<h2>Ingreso por otro concepto.</h2>

	<fieldset>
		<legend class="texte_legende2">Registro del gasto.</legend>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td class="texte2">Identificacion del pagador:</td>
				<td><input type="text" class="champ2" name="id_pago" id="id_pago" onKeyPress="return numeros(event);"/></td>
			</tr>
			<tr>
				<td class="texte2">Nombre del pagador:</td>
				<td><input type="text" class="champ2" name="nombre_pago" id="nombre_pago"/></td>
			</tr>
			<tr>
				<td class="texte2">Concepto de pago:</td>
				<td><input type="text" class="champ2" name="concepto_pago" id="concepto_pago"/></td>
			</tr>
		  <tr>
				<td class="texte2">Valor del pago:</td>
				<td><input type="text" class="champ2" name="valor_pago" id="valor_pago" onKeyPress="return numeros(event);"/></td>
			</tr>
			<tr>
				<td class="texte2">Observaciones del pago:</td>
				<td><textarea class="champ2" name="observaciones_pago" id="observaciones_pago"></textarea></td>
			</tr>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza_concepto" type="hidden" value="0" /><input class="button_send" name="ingreso_gasto" id="ingreso_gasto" type="button" value="GUARDAR DATOS" onClick="valida_guardar_otros(this.form);"></td>
			</tr>
        </table>
