<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

?>
<h2>Registro de pagos estudiante <?=$_SESSION['alumno_pago']?>.</h2>

	<fieldset>
		<legend class="texte_legende2">Conceptos de facturaci&oacute;n.</legend>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td class="texte2">Facturar concepto:</td>
				<td><select name="concepto_pago" class="champ2" id="concepto_pago" onchange="FAjax('./administrativo/periodo_factura.php','periodo_factura','','post');" >
                	<option value="">Seleccione...</option>
<?
$concepto=getConceptosPago();
for($i=0;$i<count($concepto);$i++){
	
?>
                    <option value="<?=$concepto[$i]['id_concepto_pago']?>" ><?=$concepto[$i]['nombre_concepto_pago']?></option>
<?
}
?>
                </select></td>
			</tr>
			<tr>
				<td class="texte2" colspan="2"><div id="periodo_factura"></div></td>
			</tr>
		</table>
	</fieldset>
