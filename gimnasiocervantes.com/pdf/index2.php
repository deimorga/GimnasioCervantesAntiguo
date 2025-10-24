<?php
ini_set("memory_limit","256M");
include("./MPDF56/mpdf.php");
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$mpdf=new mPDF('en-x','letter','','',5,5,29,5,5,5);  

$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins
$mpdf->SetWatermarkImage('bg_boletin4.jpg', 0.35, 'F');



$mpdf->showWatermarkImage = true;

$html="";

$mpdf->defaultheaderfontsize = 10;	/* in pts */
$mpdf->defaultheaderfontstyle = B;	/* blank, B, I, or BI */
$mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */
$mpdf->SetHeader('{PAGENO}');	/* defines footer for Odd and Even Pages - placed at Outer margin */

$mpdf->defaultfooterfontsize = 12;	/* in pts */
$mpdf->defaultfooterfontstyle = B;	/* blank, B, I, or BI */
$mpdf->defaultfooterline = 1; 	/* 1 to include line below header/above footer */

$head='
<div class="rounded" style="border:0.1mm solid #220044; 
	border-radius: 0mm;
	padding:0;
	width:900px;
	background-color: #336699;">
<table width="900px" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200px" align="center" bgcolor="#336699" style="color:#FFF; border-right:0.1mm solid #FFF;">Libro<br>Registro Escolar<br>Valoraci&oacute;n</td>
    <td>

		<table width="700px" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td colspan="3" style="border-radius:0;
			border-right:0.1mm solid #FFF;
			color:#FFF;
			text-align:center;">CENTRO DOCENTE</td>
			<td colspan="2" style="border-radius:0;
			color:#FFF;border-right:0.1mm solid #FFF;
			text-align:center;">No. RESOLUCION</td>
			<td colspan="2" style="border-radius:0;
			color:#FFF;
			text-align:center;">FECHA RESOLUCION</td>
		  </tr>
		  <tr>
			<td align="center" colspan="3" style="border-top:0.1mm solid #220044;
			padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
			color: #000000;">&nbsp;</td>
			<td align="center" colspan="2" style="border-right:0.1mm solid #220044;border-top:0.1mm solid #220044;
			padding:0; background-color: #FFF;
			color: #000000;">&nbsp;</td>
			<td align="center" colspan="2" style="border-top:0.1mm solid #220044;
			padding:0; background-color: #FFF;
			color: #000000;">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="4" style="border-radius:0;
			border-right:0.1mm solid #FFF;
			color:#FFF;
			text-align:center;">NOMBRE ESTUDIANTE</td>
			<td colspan="2" style="border-radius:0;
			color:#FFF;border-right:0.1mm solid #FFF;
			text-align:center;">IDENTIFICACION</td>
			<td style="border-radius:0;
			color:#FFF;
			text-align:center;">CODIGO</td>
		  </tr>
		  <tr>
			<td align="center" colspan="4" style="border-top:0.1mm solid #220044;
			padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
			color: #000000;">&nbsp;</td>
			<td align="center" colspan="2" style="border-right:0.1mm solid #220044; border-top:0.1mm solid #220044;
			padding:0; background-color: #FFF;
			color: #000000;">&nbsp;</td>
			<td align="center" style="border-top:0.1mm solid #220044;
			padding:0; background-color: #FFF;
			color: #000000;">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center" width="115px" style="border-top:0.1mm solid #220044;
			padding:0;border-right:0.1mm solid #FFF; 
			color: #FFF;">GRADO</td>
			<td align="center" width="115px" style="border-top:0.1mm solid #220044;
			padding:0;border-right:0.1mm solid #FFF;
			color: #FFF;">GRUPO</td>
			<td align="center" width="115px" style="border-top:0.1mm solid #220044;
			padding:0;border-right:0.1mm solid #FFF;
			color: #FFF;">JORNADA</td>
			<td align="center" width="115px" style="border-top:0.1mm solid #220044;
			padding:0;border-right:0.1mm solid #FFF; 
			color: #FFF;">A&Ntilde;O LECTIVO</td>
			<td align="center" width="115px" style="border-top:0.1mm solid #220044;
			padding:0;border-right:0.1mm solid #FFF;
			color: #FFF;">CIUDAD</td>
			<td align="center" width="115px" style="border-top:0.1mm solid #220044;
			padding:0;border-right:0.1mm solid #FFF;
			color: #FFF;">PERIODO</td>
			<td align="center" width="115px" style="border-top:0.1mm solid #220044;
			padding:0; color: #FFF;">FOLIO</td>
		  </tr>
		  <tr>
			<td align="center" style="border-top:0.1mm solid #220044;
			padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
			color: #FFF;">'.$alumno['nombre_grado'].'</td>
			<td align="center" style="border-top:0.1mm solid #220044;
			padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
			color: #FFF;">'.$alumno['nombre_grupo'].'</td>
			<td align="center" style="border-top:0.1mm solid #220044;
			padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
			color: #FFF;">&nbsp;</td>
			<td align="center" style="border-top:0.1mm solid #220044;
			padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
			color: #FFF;">'.$anio.'</td>
			<td align="center" style="border-top:0.1mm solid #220044;
			padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
			color: #FFF;">'.$ciudad.'</td>
			<td align="center" style="border-top:0.1mm solid #220044;
			padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
			color: #FFF;">'.$periodo.'</td>
			<td align="center" style="border-top:0.1mm solid #220044;
			padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
			color: #FFF;">'.$folio.'</td>
		  </tr>
		</table>
	
	</td>
  </tr>
</table>

</div>';

$footer='
<div class="rounded" style="border:0.1mm solid #220044; 
	border-radius: 0mm 0mm 2mm 2mm;
	padding:0;
	width:900px;
	background-color: #FFF;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td align="center" style="font-size:12px; color: #220044;">Desempe&ntilde;o Superior(DS) 4.8 - 5.0 &bull; Desempe&ntilde;o  Alto(DA) 4.3 - 4.7 &bull; Desempe&ntilde;o B&aacute;sico(DBS) 3.7 - 4.2 &bull; Desempe&ntilde;o Bajo(DB) 1.0 - 3.6</td>
	  </tr>
	</table>
</div>
';

$mpdf->SetHTMLHeader($head);
$mpdf->SetHTMLHeader($head, 'E');

$html='
<div style="margin: 0px; border:0.1mm solid #220044;" height="100%"; align="center">
<table border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td colspan="2" align="center" style="font-size:10px;border-bottom:0.1mm solid #220044;
			padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
			color: #220044;">&Aacute;REA / ASIGNATURA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONCEPTO FINAL</td>
			<td width="35px" style="color: #220044;font-size:10px;border-right:0.1mm solid #220044;border-bottom:0.1mm solid #220044;">I.H.</td>
			<td width="35px" style="color: #220044;font-size:8px; border-right:0.1mm solid #220044;border-bottom:0.1mm solid #220044;">FALLAS</td>
			<td width="35px" style="color: #220044;font-size:10px;border-right:0.1mm solid #220044;border-bottom:0.1mm solid #220044;">P1</td>
			<td width="35px" style="color: #220044;font-size:10px;border-right:0.1mm solid #220044;border-bottom:0.1mm solid #220044;">P2</td>
			<td width="35px" style="color: #220044;font-size:10px;border-right:0.1mm solid #220044;border-bottom:0.1mm solid #220044;">P3</td>
			<td width="35px" style="color: #220044;font-size:10px;border-right:0.1mm solid #220044;border-bottom:0.1mm solid #220044;">P4</td>
			<td width="35px" style="color: #220044;font-size:10px;border-bottom:0.1mm solid #220044;">DEF.</td>
		  </tr>
';
for($i=0;$i<44;$i++){
		$html.='  
		<tr>
			<td valign="top" align="center" width="47px">&nbsp;</td>
			<td width="485px" style="font-size:14px; border-right:0.1mm solid #220044;">&nbsp;</td>
			<td style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>';
}
$html.='
</table>
</div>
';


$mpdf->ignore_invalid_utf8 = true;
//$mpdf->AddPage(); 
$mpdf->WriteHTML($html);
//$mpdf->AddPage();
//echo $html;

$mpdf->Output();
exit;

?>