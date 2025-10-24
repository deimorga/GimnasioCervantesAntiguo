<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET['eliminar_concepto_pago_alumno']==1){
	$elimino=delConceptoPagoAlumno($_GET['id_concepto_pago_alumno']);
	if($elimino){
		echo "<script>alert('Los datos se eliminaron correctamente...');</script>";
	}else{
		echo "<script>alert('Los datos no se eliminaron correctamente...');</script>";
	}
}
$alumno_concepto=getConceptosAlumnoPendientes($_SESSION['alumno_pago']);
$fecha = date ( 'Y-m-d' ,strtotime ( '-5 hour' , strtotime ( date("Y-m-d H:i:s") ) ) );
?>
<h2>Listado de conceptos pendientes por pago.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0033FF" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Concepto</td>
    <td>Fecha facturado</td>
    <td>Saldo</td>
    <td>Descuento</td>
    <td>Valor</td>
    <td>Acci&oacute;n</td>
  </tr>
<?
if(count($alumno_concepto)<1){
?>
  <tr>
    <td colspan="7" align="center">NO HAY CONCEPTOS PENDIENTES POR PAGO</td>
  </tr>
<?
}else{
for($i=0;$i<count($alumno_concepto);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><input name="<?=$alumno_concepto[$i]['id_concepto_pago_alumno']?>" id="<?=$alumno_concepto[$i]['id_concepto_pago_alumno']?>" value="<?=$alumno_concepto[$i]['id_concepto_pago_alumno']?>" type="checkbox" /></td>
    <td><? echo $alumno_concepto[$i]['nombre_concepto_pago']; if($alumno_concepto[$i]['tipo_concepto']>=3){ echo " / ".$alumno_concepto[$i]['periodo_facturado'].$alumno_concepto[$i]['fecha_consignacion'];}?></td>
    <td><?=$alumno_concepto[$i]['fecha_facturado']?></td>
    <td><?=$alumno_concepto[$i]['valor_pagar']?><input name="saldo_<?=$alumno_concepto[$i]['id_concepto_pago_alumno']?>" id="saldo_<?=$alumno_concepto[$i]['id_concepto_pago_alumno']?>" value="<?=$alumno_concepto[$i]['valor_pagar']?>" type="hidden" /></td>
    <td><input name="descuento_<?=$alumno_concepto[$i]['id_concepto_pago_alumno']?>" id="descuento_<?=$alumno_concepto[$i]['id_concepto_pago_alumno']?>" value="0" class="champ4" type="text" onblur="suma_saldo(descuento_<?=$alumno_concepto[$i]['id_concepto_pago_alumno']?>,valor_<?=$alumno_concepto[$i]['id_concepto_pago_alumno']?>,saldo_<?=$alumno_concepto[$i]['id_concepto_pago_alumno']?>);" onKeyPress="return numeros(event);"/></td>
    <td><input name="valor_<?=$alumno_concepto[$i]['id_concepto_pago_alumno']?>" id="valor_<?=$alumno_concepto[$i]['id_concepto_pago_alumno']?>" value="<?=$alumno_concepto[$i]['valor_pagar']?>" class="champ4" type="text" onKeyPress="return numeros(event);"/></td>
    <td><a href="#" onClick="if(confirm('Seguro de eliminar el concepto facturado?')){FAjax('./administrativo/list_concepto_facturados.php?id_concepto_pago_alumno=<?=$alumno_concepto[$i]['id_concepto_pago_alumno']?>&eliminar_concepto_pago_alumno=1','list_concepto','','post')}else{ return false;};">Eliminar>></a></td>
  </tr>
<?
}}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="texte2" height="40px">Forma de pago:</td>
				<td height="40px"><select name="tipo_pago" class="champ2" id="tipo_pago" >
                	<option value="">Seleccione...</option>
                    <option value="1" >Efectivo</option>
                    <option value="2" >Consignacion</option>
                </select></td>
			</tr>
				<td class="texte2" height="40px">Fecha pago:</td>
				<td height="40px"><input class="champ2" style="width:100px; height:15" name="fechapago" id="fechapago" onFocus='Calendar.setup({inputField:"fechapago",ifFormat:"%Y-%m-%d",button:"calen"});'
  readonly="true" value="<?=$fecha?>"/></td>
			</tr>
  <tr>
    <td colspan="2" align="center"><input type="button" value="REALIZAR PAGO" class="button_send" onClick="valida_form_pago(this.form);" id="boton_pago" name="boton_pago" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="IMPRIMIR LISTADO" class="button_send" /></td>
  </tr>
</table>