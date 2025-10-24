<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$concepto=getConceptoId($_POST['concepto_pago']);
$valor=$concepto['valor_concepto_pago'];
//print_r($concepto);
//3=registrar periodo, 4=pension, 5=matricula, 6=consignacion
if($concepto['tipo_concepto']==3 || $concepto['tipo_concepto']==4 || $concepto['tipo_concepto']==5){
$anio=date("Y");
?>
<h2>Cotrol de Periodo facturado.</h2>

        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td class="texte2">A&ntilde;o facturado:</td>
				<td><select name="anio_pago" class="champ2" id="anio_pago" >
                	<option value="">Seleccione...</option>
                    <option value="<?=$anio-1?>" ><?=$anio-1?></option>
                    <option value="<?=$anio?>" ><?=$anio?></option>
                    <option value="<?=$anio+1?>" ><?=$anio+1?></option>
                    <option value="<?=$anio+2?>" ><?=$anio+2?></option>
                </select></td>
			</tr>
			<tr>
				<td class="texte2">Mes facturado:</td>
				<td><select name="mes_pago" class="champ2" id="mes_pago" >
                	<option value="">Seleccione...</option>
                    <option value="01" >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03" >Marzo</option>
                    <option value="04" >Abril</option>
                    <option value="05" >Mayo</option>
                    <option value="06" >Junio</option>
                    <option value="07" >Julio</option>
                    <option value="08" >Agosto</option>
                    <option value="09" >Septiembre</option>
                    <option value="10" >Octubre</option>
                    <option value="11" >Noviembre</option>
                    <option value="12" >Diciembre</option>
                </select></td>
			</tr>
   </table>
<?	
}
if($concepto['tipo_concepto']==4){
$alumno=getAlumnoId($_SESSION['alumno_pago']);
$valor=$alumno['pension'];
}elseif($concepto['tipo_concepto']==5){
$alumno=getAlumnoId($_SESSION['alumno_pago']);
$valor=$alumno['matricula'];
}
if($concepto['tipo_concepto']==6){
?>
<table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td class="texte2" colspan="2">Describa los conseptos que se cancelan con la consignacion...</td>					
            </tr>
			<tr>
				<td class="texte2">Valor Consignado:</td>					
                <td class="texte2"><input type="text" class="champ2" name="valor_facturar" id="valor_facturar" onKeyPress="return numeros(event);"/></td>
            </tr>
			<tr>
				<td class="texte2">Fecha Consignacion:</td>					
                <td class="texte2"><input class="champ2" style="width:100px; height:15" name="fecha_consignacion" id="fecha_consignacion" onFocus='Calendar.setup({inputField:"fecha_consignacion",ifFormat:"%Y-%m-%d",button:"calen"});'
  readonly="true"/></td>
            </tr>
			<tr>
				<td class="texte2">Descripccion Consignacion:</td>					
                <td class="texte2"><textarea class="champ2" name="descripcion" id="descripcion" cols="35" rows="10"></textarea></td>
            </tr>
</table>
<?
}else{
?>
<table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td class="texte2" colspan="2">El valor sugeriodo a facturar puede ser modificado seg&uacute;n abonos ya realizados...</td>					
            </tr>
			<tr>
				<td class="texte2">Valor sugerido:</td>					
                <td class="texte2"><input type="text" class="champ2" name="valor_facturar" value="<?=$valor?>" id="valor_facturar" onKeyPress="return numeros(event);"/>
<?
if($concepto['tipo_concepto']==4){
?>                
                <input type="button" onclick="FAjax('./administrativo/upd_pension.php','upd_valor','','post');" value="Actualiza valor" /><div id="upd_valor"></div>
<?
}
?>
                </td>
            </tr>
</table>
<?
}
?>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza_pago" type="hidden" value="0" /><input class="button_send" name="ingreso_concepto" id="ingreso_concepto" type="button" value="ADICIONAR CONCEPTO" onClick="valida_guardar_concepto(this.form);"><!--&nbsp;&nbsp;<input type="button" value="REGISTRAR PAGO PENSION" onclick="FAjax('./administrativo/pago_pension.php','concepto','','post');" class="button_send" />--></td>
			</tr>
        </table>