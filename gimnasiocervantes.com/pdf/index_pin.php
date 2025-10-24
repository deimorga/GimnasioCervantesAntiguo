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


$html='<table width="80%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-size:14px;">
  <tr>
    <td colspan="2" align="center"><h3>Colegio Gimnasio Cervantes.</h3></td>
  </tr>
  <tr>
    <td colspan="2">
PRECESO DE MATRICULA Y REGISTRO 2015.<br>
Datos de registro:<br>
Estudiante: '.$_SESSION["nom"].'<br>
NUIP: '.$_SESSION["id"].'<br>
PIN: '.$_SESSION["pin"].'</td>
  </tr>
</table>';


$mpdf->ignore_invalid_utf8 = true;
//$mpdf->AddPage(); 
$mpdf->WriteHTML($html);
//$mpdf->AddPage();

//echo $html;

//$mpdf->Output('./recibos/'.$_SESSION['factura'].'.pdf',"F");
$mpdf->Output($_SESSION["pin"].'.pdf',"D");
exit;

?>
