<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_POST['actualiza_gasto']==1){
	$guarda_gasto=setGasto($_POST['nombre_gasto'],$_POST['valor_gasto'],$_POST['observaciones_gasto'],$_SESSION["user_id"]);
	if($guarda_gasto){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

?>

<h2>Informe de pagos recibidos.</h2>

	<fieldset>
		<legend class="texte_legende2">Filtro por periodo de tiempo.</legend>
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
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center">
                <input class="button_send" name="informe_pagos_fact" id="informe_pagos_fact" type="button" value="GENERAR INFORME POR FACTURA" onClick="valida_informe_pagos_fact(this.form);">
				</td>
			</tr>
			<tr>
				<td align="center"><div id="listado_admin"></div></td>
			</tr>
        </table>
