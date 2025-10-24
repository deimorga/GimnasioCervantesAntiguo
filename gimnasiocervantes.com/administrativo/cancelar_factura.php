<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_POST['filtra_cancelacion']==1){
	$guarda=updEstadoFactura($_POST['id_factura'],2);
	if($guarda){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

?>

<h2>Cancelacion de facturas.</h2>

	<fieldset>
		Datos de la factura.
          <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td class="texte2">Numero de factura:</td>
				<td><input type="text" class="champ2" name="id_factura" id="id_factura"/></td>
			</tr>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="filtra_cancelacion" type="hidden" value="0" /><input class="button_send" name="ingreso_gasto" id="ingreso_gasto" type="button" value="CANCELAR FACTURA" onClick="if(confirm('Seguro de cancelar la factura?')){ valida_cancela_factura(this.form);}else{ return false; }"></td>
			</tr>
        </table>
