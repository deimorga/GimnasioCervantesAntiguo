<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

?>

<h2>Informe de gastos registrados.</h2>

	<fieldset>
		<legend class="texte_legende2">Periodo de tiempo.</legend>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td class="texte2">Fecha inicio:</td>
				<td><input class="champ2" style="width:100px; height:15" name="fechaini" id="fechaini" onFocus='Calendar.setup({inputField:"fechaini",ifFormat:"%Y-%m-%d",button:"calen"});'
  readonly="true"/></td>
			</tr>
			<tr>
				<td class="texte2">Fecha fin:</td>
				<td><input class="champ2" style="width:100px; height:15" name="fechafin" id="fechafin" onFocus='Calendar.setup({inputField:"fechafin",ifFormat:"%Y-%m-%d",button:"calen"});'
  readonly="true"/></td>
			</tr>
			<tr>
				<td class="texte2">Recursos para Pago:</td>
				<td>
                	<input type="checkbox" name="recursos_pago_1" id="recursos_pago_1" value="0"> - Efectivo Diario<br />
                	<input type="checkbox" name="recursos_pago_2" id="recursos_pago_2" value="0"> - Efectivo Conciliado<br />
                	<input type="checkbox" name="recursos_pago_3" id="recursos_pago_3" value="0"> - Banco<br />
                	<input type="checkbox" name="recursos_pago_4" id="recursos_pago_4" value="0"> - Cheque
                </td>
			</tr>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="informe_gastos" id="informe_gastos" type="button" value="GENERAR INFORME" onClick="valida_informe_gastos(this.form);"></td>
			</tr>
			<tr>
				<td align="center"><div id="listado_admin"></div></td>
			</tr>
        </table>
