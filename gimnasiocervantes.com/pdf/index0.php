<?php
ini_set("memory_limit","256M");
include("./MPDF56/mpdf.php");
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$mpdf=new mPDF('en-x','legal','','',5,5,63,10,5,5);  

$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins
$mpdf->SetWatermarkImage('bg_boletin3.jpg', 0.35, 'F');



$mpdf->showWatermarkImage = true;

$alumnos_curso=getAlumnosGrupo($_REQUEST['grupo']);
for($a=0;$a<count($alumnos_curso);$a++){
	
$alumno=getAlumnoBoletinId($alumnos_curso[$a]['identificacion']);
$anio="2013";
$ciudad="FACATATIVA";
$periodo="1";
$html="";

$mpdf->defaultheaderfontsize = 10;	/* in pts */
$mpdf->defaultheaderfontstyle = B;	/* blank, B, I, or BI */
$mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */
$mpdf->SetHeader('{PAGENO}');	/* defines footer for Odd and Even Pages - placed at Outer margin */

$mpdf->defaultfooterfontsize = 12;	/* in pts */
$mpdf->defaultfooterfontstyle = B;	/* blank, B, I, or BI */
$mpdf->defaultfooterline = 1; 	/* 1 to include line below header/above footer */

$head='
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">
	<img src="header_boletin.jpg" width="1053" height="195" />
	</td>
  </tr>
</table>
<div class="rounded" style="border:0.1mm solid #220044; 
	border-radius: 2mm 2mm 0mm 0mm;
	padding:0;
	width:900px;
	background-color: #B9BBFF;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" style="border-radius:2mm 0 0 0;
	border-right:0.1mm solid #FFF;
	color:#FFF;
	text-align:center;">NOMBRE ESTUDIANTE</td>
    <td colspan="2" style="border-radius:0 2mm 0 0;
	color:#FFF;
	text-align:center;">IDENTIFICACION</td>
  </tr>
  <tr>
    <td align="center" colspan="6" width="111px" style="border-top:0.1mm solid #220044;
	padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
	color: #000000;">'.$alumno["nombre_alumno"].'</td>
    <td align="center" colspan="2" width="111px" style="border-top:0.1mm solid #220044;
	padding:0; background-color: #FFF;
	color: #000000;">'.$alumno["identificacion"].'</td>
  </tr>
  <tr>
    <td align="center" width="111px" style="border-top:0.1mm solid #220044;
	padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
	color: #220044;">C&Oacute;DIGO</td>
    <td align="center" width="111px" style="border-top:0.1mm solid #220044;
	padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
	color: #220044;">GRADO</td>
    <td align="center" width="111px" style="border-top:0.1mm solid #220044;
	padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
	color: #220044;">GRUPO</td>
    <td align="center" width="111px" style="border-top:0.1mm solid #220044;
	padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
	color: #220044;">JORNADA</td>
    <td align="center" width="111px" style="border-top:0.1mm solid #220044;
	padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
	color: #220044;">A&Ntilde;O LECTIVO</td>
    <td align="center" width="111px" style="border-top:0.1mm solid #220044;
	padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
	color: #220044;">CIUDAD</td>
    <td align="center" width="111px" style="border-top:0.1mm solid #220044;
	padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
	color: #220044;">PERIODO</td>
    <td align="center" width="111px" style="border-top:0.1mm solid #220044;
	padding:0; background-color: #FFF;
	color: #220044;">PAGINA</td>
  </tr>
  <tr>
    <td align="center" width="111px" style="border-top:0.1mm solid #220044;
	padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
	color: #000000;">'.$alumno['codigo_alumno'].'</td>
    <td align="center" width="111px" style="border-top:0.1mm solid #220044;
	padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
	color: #000000;">'.$alumno['nombre_grado'].'</td>
    <td align="center" width="111px" style="border-top:0.1mm solid #220044;
	padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
	color: #000000;">'.$alumno['nombre_grupo'].'</td>
    <td align="center" width="111px" style="border-top:0.1mm solid #220044;
	padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
	color: #000000;">Unica</td>
    <td align="center" width="111px" style="border-top:0.1mm solid #220044;
	padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
	color: #000000;">'.$anio.'</td>
    <td align="center" width="111px" style="border-top:0.1mm solid #220044;
	padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
	color: #000000;">'.$ciudad.'</td>
    <td align="center" width="111px" style="border-top:0.1mm solid #220044;
	padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
	color: #000000;">'.$periodo.'</td>
    <td align="center" width="112px" style="border-top:0.1mm solid #220044;
	padding:0; background-color: #FFF;
	color: #000000;">{PAGENO}/{nb}</td>
  </tr>
  <tr>
    <td align="center" colspan="5" style="border-top:0.1mm solid #220044;
	padding:0;border-right:0.1mm solid #220044; background-color: #FFF;
	color: #220044;">&Aacute;REA / ASIGNATURA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DESCRIPCION DESEMPE&Ntilde;OS</td>
    <td align="center" colspan="3" style="border-top:0.1mm solid #220044;
	padding:0; background-color: #FFF;
	color: #220044;">

		<table style="color: #220044;" width="290px" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="39px" rowspan="2" style="border-right:0.1mm solid #220044;">IH</td>
			<td colspan="2" style="font-size:8px; border-right:0.1mm solid #220044;border-bottom:0.1mm solid #220044;">AUSENCIAS</td>
			<td width="39px" rowspan="2" style="border-right:0.1mm solid #220044;">P1</td>
			<td width="39px" rowspan="2" style="border-right:0.1mm solid #220044;">P2</td>
			<td width="39px" rowspan="2" style="border-right:0.1mm solid #220044;">P3</td>
			<td width="39px" rowspan="2" style="border-right:0.1mm solid #220044;">P4</td>
			<td width="39px" rowspan="2">DEF</td>
		  </tr>
		  <tr>
			<td style="font-size:8px;border-right:0.1mm solid #220044;">JUST</td>
			<td style="font-size:8px;border-right:0.1mm solid #220044;">INJUST</td>
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
$mpdf->SetHTMLFooter($footer);
$mpdf->SetHTMLFooter($footer, 'E');

$html='
<pagebreak type="BLANK" resetpagenum="1" pagenumstyle="1" suppress="off" /> 
<div style="margin: 0px; border:0.1mm solid #220044;" height="100%"; align="center">
<table border="0" cellspacing="0" cellpadding="0">
';
$asignaturas=getAsignaturasGrupo($alumno['id_grupo'],1);
//print_r($asignaturas);
for($i=0;$i<count($asignaturas);$i++){
	$p1=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],1);
	$p2=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],2);
	$p3=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],3);
	$p4=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],4);

	if($asignaturas[$i]['id_area']!=$asignaturas[$i-1]['id_area']){
	$html.='  <tr>
		<td colspan="2" style="font-size:14px; border-right:0.1mm solid #220044;border-top:0.1mm solid #220044;"><h5>'.$asignaturas[$i]['nombre_area'].'</h5>
		</td>
		<td width="35px" style="border-right:0.1mm solid #220044;border-top:0.1mm solid #220044;">&nbsp;</td>
		<td width="39px" style="border-right:0.1mm solid #220044;border-top:0.1mm solid #220044;">&nbsp;</td>
		<td width="46px" style="border-right:0.1mm solid #220044;border-top:0.1mm solid #220044;">&nbsp;</td>
		<td width="34px" style="border-right:0.1mm solid #220044;border-top:0.1mm solid #220044;">&nbsp;</td>
		<td width="34px" style="border-right:0.1mm solid #220044;border-top:0.1mm solid #220044;">&nbsp;</td>
		<td width="34px" style="border-right:0.1mm solid #220044;border-top:0.1mm solid #220044;">&nbsp;</td>
		<td width="34px" style="border-right:0.1mm solid #220044;border-top:0.1mm solid #220044;">&nbsp;</td>
		<td width="37px" style="border-top:0.1mm solid #220044;">&nbsp;</td>
	  </tr>';
	}
	$html.='  <tr>
		<td colspan="2" style="font-size:14px; border-right:0.1mm solid #220044;">'.$asignaturas[$i]['nombre_asignatura'].'
		</td>
		<td width="35px" align="center" style="border-right:0.1mm solid #220044;">'.$asignaturas[$i]['intensidad_horaria'].'</td>
		<td align="center" width="39px" style="border-right:0.1mm solid #220044;">'.$p1['horas_justificadas'].'</td>
		<td align="center" width="46px" style="border-right:0.1mm solid #220044;">'.$p1['horas_injustificadas'].'</td>
		<td width="34px" style="border-right:0.1mm solid #220044;">'.$p1['desempenio_asignatura'].'</td>
		<td width="34px" style="border-right:0.1mm solid #220044;">'.$p2['desempenio_asignatura'].'</td>
		<td width="34px" style="border-right:0.1mm solid #220044;">'.$p3['desempenio_asignatura'].'</td>
		<td width="34px" style="border-right:0.1mm solid #220044;">'.$p4['desempenio_asignatura'].'</td>
		<td width="37px">&nbsp;</td>
	  </tr>';
	$dato=seleccionaPlanGestor("tbl_logro", $asignaturas[$i]['id_plan_gestor']);
	for($j=0;$j<count($dato);$j++){
		$calificacion_logro=getCalificacionLogro($dato[$j]['id_logro'],$alumno['identificacion']);
		if($j==0){
		$html.='  <tr>
			<td valign="top" align="center" width="45px">Posi</td>
			<td style="width:440px font-size:14px; border-right:0.1mm solid #220044;">'.strtoupper($dato[$j]['logro']).'
			</td>
			<td width="35px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td width="39px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td width="46px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td width="34px" valign="top" style="border-right:0.1mm solid #220044;">'.$p1['calificacion_asignatura'].'</td>
			<td width="34px" valign="top" style="border-right:0.1mm solid #220044;">'.$p2['calificacion_asignatura'].'</td>
			<td width="34px" valign="top" style="border-right:0.1mm solid #220044;">'.$p3['calificacion_asignatura'].'</td>
			<td width="34px" valign="top" style="border-right:0.1mm solid #220044;">'.$p4['calificacion_asignatura'].'</td>
			<td valign="top" width="37px">'.$calificacion_logro['desempenio_logro'].'</td>
		  </tr>';
		}else{
		$html.='  <tr>
			<td valign="top" align="center" width="45px">Posi</td>
			<td style="width:440px font-size:14px; border-right:0.1mm solid #220044;">'.strtoupper($dato[$j]['logro']).'
			</td>
			<td width="35px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td width="39px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td width="46px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td width="34px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td width="34px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td width="34px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td width="34px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td valign="top" width="37px">'.$calificacion_logro['desempenio_logro'].'</td>
		  </tr>';
		}
	}
	$recomendacion=getRecomendacionesAlumno($alumno['identificacion'], $asignaturas[$i]['id_plan_gestor']);
	for($k=0;$k<count($recomendacion);$k++){
		$html.='  <tr>
			<td valign="top" align="center" width="45px">Reco</td>
			<td style="width:440px font-size:14px; border-right:0.1mm solid #220044;">'.$recomendacion[$k]['recomendacion'].'
			</td>
			<td width="35px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td width="39px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td width="46px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td width="34px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td width="34px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td width="34px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td width="34px" style="border-right:0.1mm solid #220044;">&nbsp;</td>
			<td width="37px">&nbsp;</td>
		  </tr>';
	}
}

$html.='
  <tr>
	<td colspan="10" style="border-top:0.1mm solid #220044;">&nbsp;</td>
  </tr>
</table>
</div>
';


$mpdf->ignore_invalid_utf8 = true;
//$mpdf->AddPage(); 
$mpdf->WriteHTML($html);
//$mpdf->AddPage();
}
//echo $html;

$mpdf->Output();
exit;

?>