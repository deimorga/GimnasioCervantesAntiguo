<?php
session_start();
ini_set("memory_limit","256M");
include("./MPDF56/mpdf.php");
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$mpdf=new mPDF('utf-8', array(76,297),'','',0,0,5,5,0,0);
/*('en-x',    // mode - default ''
'legal',    // format - A4, for example, default ''
'',     // font size - default 0
'',    // default font family
5,    // margin_left
5,    // margin right
72,     // margin top
41,    // margin bottom
14,     // margin header
5,     // margin footer
'L');  
*/

$forma="Efectivo.";
//die ($alumno_concepto);
$total_pago=0;
$datos=getPagoOtrosId($_SESSION['factura']);
$html='
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-size:14px;">
  <tr>
    <td colspan="2" align="center"><h3>Colegio Gimnasio Cervantes.</h3></td>
  </tr>
  <tr>
    <td colspan="2">Recibo de pago No. '.$_SESSION['factura'].'</td>
  </tr>
  <tr>
    <td colspan="2"><h3>Datos Del Alumno.</h3></td>
  </tr>
  <tr>
    <td colspan="2">Identificaci&oacute;n: '.$datos["identificacion"].'</td>
  </tr>
  <tr>
    <td colspan="2">Nombre: '.$datos["nombre"].'</td>
  </tr>
  <tr>
    <td>Fecha de Pago</td>
    <td align="right">'.$datos['fecha_pago'].'</td>
  </tr>
  <tr>
    <td>Forma de Pago</td>
    <td align="right">'.$forma.'</td>
  </tr>
  <tr>
    <td colspan="2"><h3>Conceptos pagados.</h3></td>
  </tr>';
  $html.='<tr>
    <td>'.$datos['concepto'].'</td>
    <td align="right">'.number_format($datos['valor_pago'],2,',','.').'</td>
  </tr>
  <tr>
    <td>Total Factura</td>
    <td align="right">'.number_format($datos['valor_pago'],2,',','.').'</td>
  </tr>
  <tr>
  	<td colspan="2" align="center" style="border-top:0.1mm solid #220044;border-bottom:0.1mm solid #220044;">Este desprendible es valido como comprobante de pago, en caso de inconsistencias o dudas puede comunicarse con el personal autorizado a la linea (57)(1) 8430744.</td>
  </tr>
</table>';


$mpdf->ignore_invalid_utf8 = true;
//$mpdf->AddPage(); 
$mpdf->WriteHTML($html);
//$mpdf->AddPage();

//echo $html;

$mpdf->Output('./recibos/'.$_SESSION['factura'].'.pdf',"F");
$mpdf->Output($_SESSION['factura'].'.pdf',"D");
exit;

?>
