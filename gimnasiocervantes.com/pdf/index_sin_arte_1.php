<?php
ini_set("memory_limit","256M");
include("./MPDF56/mpdf.php");
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$mpdf=new mPDF('en-x','legal','','',5,5,71,42,13,5);
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

$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins
//$mpdf->SetWatermarkImage('bg_boletin3.jpg', 0.35, 'F');



//$mpdf->showWatermarkImage = true;

$alumno=getAlumnoBoletinId($_POST['alumno']);
$anio="2015";
$ciudad="FACATATIVA";
$periodo=$_POST['periodo'];
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
    <td align="center" width="100%" height="128">
	&nbsp;
	</td>
  </tr>
</table>
<div class="rounded" style="border:0mm solid #220044;
	border-radius: 2mm 2mm 0mm 0mm;
	padding:0;
	width:900px;
	">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" style="border-radius:2mm 0 0 0;
	border-right:0mm solid #FFF;
	color:#FFF;
	text-align:center;">&nbsp;</td>
    <td colspan="2" style="border-radius:0 2mm 0 0;
	color:#FFF;
	text-align:center;">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="6" width="111px" style="padding:0; background-color: #FFF;
	color: #000000;">'.$alumno["nombre_alumno"].'</td>
    <td align="center" colspan="2" width="111px" style="padding:0; background-color: #FFF;
	color: #000000;">'.$alumno["identificacion"].'</td>
  </tr>
  <tr>
    <td align="center" width="111px" style="
	padding:0; background-color: #FFF;
	color: #220044;">&nbsp;</td>
    <td align="center" width="111px" style="
	padding:0; background-color: #FFF;
	color: #220044;">&nbsp;</td>
    <td align="center" width="111px" style="
	padding:0; background-color: #FFF;
	color: #220044;">&nbsp;</td>
    <td align="center" width="111px" style="
	padding:0; background-color: #FFF;
	color: #220044;">&nbsp;</td>
    <td align="center" width="111px" style="
	padding:0; background-color: #FFF;
	color: #220044;">&nbsp;</td>
    <td align="center" width="111px" style="
	padding:0; background-color: #FFF;
	color: #220044;">&nbsp;</td>
    <td align="center" width="111px" style="
	padding:0; background-color: #FFF;
	color: #220044;">&nbsp;</td>
    <td align="center" width="111px" style="
	padding:0; background-color: #FFF;
	color: #220044;">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" width="111px" style="
	padding:0; background-color: #FFF;
	color: #000000;">'.$alumno['codigo_alumno'].'</td>
    <td align="center" width="111px" style="
	padding:0; background-color: #FFF;
	color: #000000;">'.$alumno['nombre_grado'].'</td>
    <td align="center" width="111px" style="
	padding:0; background-color: #FFF;
	color: #000000;">'.$alumno['nombre_grupo'].'</td>
    <td align="center" width="111px" style="
	padding:0; background-color: #FFF;
	color: #000000;">Unica</td>
    <td align="center" width="111px" style="
	padding:0; background-color: #FFF;
	color: #000000;">'.$anio.'</td>
    <td align="center" width="111px" style="
	padding:0; background-color: #FFF;
	color: #000000;">'.$ciudad.'</td>
    <td align="center" width="111px" style="
	padding:0; background-color: #FFF;
	color: #000000;">'.$periodo.'</td>
    <td align="center" width="112px" style="
	padding:0; background-color: #FFF;
	color: #000000;">{PAGENO}</td>
  </tr>
  <tr>
    <td align="center" colspan="5" style="
	padding:0; background-color: #FFF;
	color: #220044;">&nbsp;</td>
    <td align="center" colspan="3" style="
	padding:0; background-color: #FFF;
	color: #220044;">

		<table style="color: #220044;" width="290px" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="39px" rowspan="2" >&nbsp;</td>
			<td colspan="2" style="font-size:8px; ">&nbsp;</td>
			<td width="39px" rowspan="2">&nbsp;</td>
			<td width="39px" rowspan="2">&nbsp;</td>
			<td width="39px" rowspan="2">&nbsp;</td>
			<td width="39px" rowspan="2">&nbsp;</td>
			<td width="39px" rowspan="2">&nbsp;</td>
		  </tr>
		  <tr>
			<td style="font-size:8px;">&nbsp;</td>
			<td style="font-size:8px;">&nbsp;</td>
		  </tr>
		</table>

	</td>
  </tr>
</table>
</div>';

$footer='
<div class="rounded" style="
	border-radius: 0mm 0mm 2mm 2mm;
	padding:0;
	width:900px;
	background-color: #FFF;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td align="center" style="font-size:12px; color: #220044;">&nbsp;</td>
	  </tr>
	</table>
</div>
';

$mpdf->SetHTMLHeader($head);
$mpdf->SetHTMLHeader($head, 'E');
$mpdf->SetHTMLFooter($footer);
$mpdf->SetHTMLFooter($footer, 'E');

$html='
<div style="margin: 0px; " height="100%"; align="center">
<table border="0" cellspacing="0" cellpadding="0">
';
$asignaturas=getAsignaturasGrupo($alumno['id_grupo'],$periodo);
//print_r($asignaturas);
for($i=0;$i<count($asignaturas);$i++){
	$p1=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],1);
	$p2=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],2);
	$p3=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],3);
	$p4=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],4);

	if($i==0){
	$html.='  <tr>
		<td colspan="2" style="font-size:14px;"><h5>'.$asignaturas[$i]['nombre_area'].'</h5>
		</td>
		<td width="35px">&nbsp;</td>
		<td width="39px">&nbsp;</td>
		<td width="46px">&nbsp;</td>
		<td width="34px">&nbsp;</td>
		<td width="34px">&nbsp;</td>
		<td width="34px">&nbsp;</td>
		<td width="34px">&nbsp;</td>
		<td width="37px">&nbsp;</td>
	  </tr>';
	}elseif($asignaturas[$i]['id_area']!=$asignaturas[$i-1]['id_area'] && $i!=0){
	$html.='  <tr>
		<td colspan="2" style="font-size:14px; border-top:0.1mm solid #000;"><h5>'.$asignaturas[$i]['nombre_area'].'</h5>
		</td>
		<td width="35px" style="border-top:0.1mm solid #220044;">&nbsp;</td>
		<td width="39px" style="border-top:0.1mm solid #220044;">&nbsp;</td>
		<td width="46px" style="border-top:0.1mm solid #220044;">&nbsp;</td>
		<td width="34px" style="border-top:0.1mm solid #220044;">&nbsp;</td>
		<td width="34px" style="border-top:0.1mm solid #220044;">&nbsp;</td>
		<td width="34px" style="border-top:0.1mm solid #220044;">&nbsp;</td>
		<td width="34px" style="border-top:0.1mm solid #220044;">&nbsp;</td>
		<td width="37px" style="border-top:0.1mm solid #220044;">&nbsp;</td>
	  </tr>';
	}

	$html.='  <tr>
		<td colspan="2" style="font-size:14px; ">'.$asignaturas[$i]['nombre_asignatura'].'
		</td>
		<td width="35px" align="center">'.$asignaturas[$i]['intensidad_horaria'].'</td>
		<td align="center" width="39px">'.$p2['horas_justificadas'].'</td>
		<td align="center" width="46px">'.$p2['horas_injustificadas'].'</td>
		<td width="34px">'.$p1['desempenio_asignatura'].'</td>
		<td width="34px">'.$p2['desempenio_asignatura'].'</td>
		<td width="34px">'.$p3['desempenio_asignatura'].'</td>
		<td width="34px">'.$p4['desempenio_asignatura'].'</td>
		<td width="37px">&nbsp;</td>
	  </tr>';
	$dato=seleccionaPlanGestor("tbl_logro", $asignaturas[$i]['id_plan_gestor']);
	for($j=0;$j<count($dato);$j++){
		$calificacion_logro=getCalificacionLogro($dato[$j]['id_logro'],$alumno['identificacion']);
		if($j==0){
		$html.='  <tr>
			<td valign="top" align="center" width="45px">Posi</td>
			<td style="width:440px font-size:14px; ">'.$dato[$j]['logro'].'
			</td>
			<td width="35px">&nbsp;</td>
			<td width="39px">&nbsp;</td>
			<td width="46px">&nbsp;</td>
			<td width="34px" valign="top">'.$p1['calificacion_asignatura'].'</td>
			<td width="34px" valign="top">'.$p2['calificacion_asignatura'].'</td>
			<td width="34px" valign="top">'.$p3['calificacion_asignatura'].'</td>
			<td width="34px" valign="top">'.$p4['calificacion_asignatura'].'</td>
			<td valign="top" width="37px">'.$calificacion_logro['desempenio_logro'].'<br>'.$calificacion_logro['calificacion_logro'].'</td>
		  </tr>';
		}else{
		$html.='  <tr>
			<td valign="top" align="center" width="45px">Posi</td>
			<td style="width:440px font-size:14px; ">'.$dato[$j]['logro'].'
			</td>
			<td width="35px">&nbsp;</td>
			<td width="39px">&nbsp;</td>
			<td width="46px">&nbsp;</td>
			<td width="34px">&nbsp;</td>
			<td width="34px">&nbsp;</td>
			<td width="34px">&nbsp;</td>
			<td width="34px">&nbsp;</td>
			<td valign="top" width="37px">'.$calificacion_logro['desempenio_logro'].'<br>'.$calificacion_logro['calificacion_logro'].'</td>
		  </tr>';
		}
	}
	$recomendacion=getRecomendacionesAlumno($alumno['identificacion'], $asignaturas[$i]['id_plan_gestor']);
	for($k=0;$k<count($recomendacion);$k++){
		$html.='  <tr>
			<td valign="top" align="center" width="45px">Reco</td>
			<td style="width:440px font-size:14px;" >'.$recomendacion[$k]['recomendacion'].'
			</td>
			<td width="35px">&nbsp;</td>
			<td width="39px">&nbsp;</td>
			<td width="46px">&nbsp;</td>
			<td width="34px">&nbsp;</td>
			<td width="34px">&nbsp;</td>
			<td width="34px">&nbsp;</td>
			<td width="34px">&nbsp;</td>
			<td width="37px">&nbsp;</td>
		  </tr>';
	}
}
$puesto=getPuntajeAlumno($alumno['identificacion'],$periodo,$anio);
$html.='
  <tr>
	<td colspan="10" style="border-top:0.1mm solid #000;">Puntaje del Periodo: '.$puesto['puntaje_total'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Puesto: '.$puesto['puesto_alumno'].'</td>
  </tr>
  <tr>
	<td colspan="10" style="border-bottom:0.1mm solid #000;">Comentarios:</td>
  </tr>
  <tr>
	<td colspan="10" style="border-bottom:0.1mm solid #000;">&nbsp;</td>
  </tr>
  <tr>
	<td colspan="10" style="border-bottom:0.1mm solid #000;">&nbsp;</td>
  </tr>
  <tr>
	<td colspan="10" style="border-bottom:0.1mm solid #000;">&nbsp;</td>
  </tr>';
  $perdidos=getDesempenio_perdido($alumno['identificacion']);
  if($perdidos){
	  $html.='
	  <tr>
		<td colspan="10">Desempe&ntilde;os Pendientes:';
  		for($p=0;$p<count($perdidos);$p++){
			if($perdidos[$p]['id_asignatura']!=$perdidos[$p-1]['id_asignatura']){
			$html.='<br>'.$perdidos[$p]['nombre_asignatura'].'<br>';
			}
			$html.='&nbsp;'.$perdidos[$p]['id_logro'].'&nbsp;&nbsp;&nbsp;';
		}
		$html.='</td>
	  </tr>';
  }
$html.='
  <tr>
	<td colspan="10" height="60px" valign="bottom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;firma Rector(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma profesor(a)</td>
  </tr>
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