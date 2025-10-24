<?php
ini_set("memory_limit","256M");
include("./MPDF56/mpdf.php");
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$mpdf=new mPDF('en-x','letter','','',5,5,32,3,4,3);  
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
$mpdf->mirrorMargins = 0;	// Use different Odd/Even headers and footers and mirror margins
$mpdf->SetWatermarkImage('bg_boletin4.jpg', 0.25, 'F');



$mpdf->showWatermarkImage = false;

$anio=$_GET['anio'];
$alumnos_curso=getAlumnosGrupoCertificado($_GET['grupo'],$anio);
$cont=$_GET['cont'];
for($a=0;$a<count($alumnos_curso);$a++){
	
$alumno=getAlumnoBoletinId($alumnos_curso[$a]['identificacion']);
$ciudad="FACATATIVA";
$periodo="FINAL";
$cod=$a+1;
$html="";

$mpdf->defaultheaderfontsize = 10;	/* in pts */
$mpdf->defaultheaderfontstyle = B;	/* blank, B, I, or BI */
$mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */
$mpdf->SetHeader('{PAGENO}');	/* defines footer for Odd and Even Pages - placed at Outer margin */
$pendientes="";
$mpdf->defaultfooterfontsize = 12;	/* in pts */
$mpdf->defaultfooterfontstyle = B;	/* blank, B, I, or BI */
$mpdf->defaultfooterline = 1; 	/* 1 to include line below header/above footer */

$head='
<div class="rounded" style="border:0.0mm solid #220044; 
	border-radius: 0mm;
	padding:0;
	width:900px;
	background-color: #FFF;">
<table width="900px" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200px" align="center" bgcolor="#FFF" style="color:#FFF; border-right:0.0mm solid #FFF;">Libro<br>Registro Escolar<br>Valoraci&oacute;n</td>
    <td>

		<table width="700px" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td colspan="3" style="border-radius:0;
			border-right:0.0mm solid #FFF;
			color:#FFF;
			text-align:center;">CENTRO DOCENTE</td>
			<td colspan="2" style="border-radius:0;
			color:#FFF;border-right:0.0mm solid #FFF;
			text-align:center;">No. RESOLUCION</td>
			<td colspan="2" style="border-radius:0;
			color:#FFF;
			text-align:center;">FECHA RESOLUCION</td>
		  </tr>
		  <tr>
			<td align="center" colspan="3" style="border-top:0.0mm solid #220044;
			padding:0;border-right:0.0mm solid #220044; background-color: #FFF;
			color: #FFF;">"GIMNASIO CERVANTES"</td>
			<td align="center" colspan="2" style="border-right:0.0mm solid #220044;border-top:0.0mm solid #220044;
			padding:0; background-color: #FFF;
			color: #FFF;">006816</td>
			<td align="center" colspan="2" style="border-top:0.0mm solid #220044;
			padding:0; background-color: #FFF;
			color: #FFF;">30-Oct-2008</td>
		  </tr>
		  <tr>
			<td colspan="4" style="border-radius:0;
			border-right:0.0mm solid #FFF;
			color:#FFF;
			text-align:center;">NOMBRE ESTUDIANTE</td>
			<td colspan="2" style="border-radius:0;
			color:#FFF;border-right:0.0mm solid #FFF;
			text-align:center;">IDENTIFICACION</td>
			<td style="border-radius:0;
			color:#FFF;
			text-align:center;">CODIGO</td>
		  </tr>
		  <tr>
			<td align="center" colspan="4" style="border-top:0.0mm solid #220044;
			padding:0;border-right:0.0mm solid #220044; background-color: #FFF;
			color: #000000;">'.$alumno['nombre_alumno'].'</td>
			<td align="center" colspan="2" style="border-right:0.0mm solid #220044; border-top:0.0mm solid #220044;
			padding:0; background-color: #FFF;
			color: #000000;">'.$alumno['identificacion'].'</td>
			<td align="center" style="border-top:0.0mm solid #220044;
			padding:0; background-color: #FFF;
			color: #000000;">'.$cod.'</td>
		  </tr>
		  <tr>
			<td align="center" width="115px" style="border-top:0.0mm solid #220044;
			padding:0;border-right:0.0mm solid #FFF; 
			color: #FFF;">GRADO</td>
			<td align="center" width="115px" style="border-top:0.0mm solid #220044;
			padding:0;border-right:0.0mm solid #FFF;
			color: #FFF;">GRUPO</td>
			<td align="center" width="115px" style="border-top:0.0mm solid #220044;
			padding:0;border-right:0.0mm solid #FFF;
			color: #FFF;">JORNADA</td>
			<td align="center" width="115px" style="border-top:0.0mm solid #220044;
			padding:0;border-right:0.0mm solid #FFF; 
			color: #FFF;">A&Ntilde;O LECTIVO</td>
			<td align="center" width="115px" style="border-top:0.0mm solid #220044F;
			padding:0;border-right:0.0mm solid #FFF;
			color: #FFF;">CIUDAD</td>
			<td align="center" width="115px" style="border-top:0.0mm solid #220044;
			padding:0;border-right:0.0mm solid #FFF;
			color: #FFF;">PERIODO</td>
			<td align="center" width="115px" style="border-top:0.0mm solid #220044;
			padding:0; color: #FFF;">FOLIO</td>
		  </tr>
		  <tr>
			<td align="center" style="border-top:0.0mm solid #220044;
			padding:0;border-right:0.0mm solid #220044; background-color: #FFF;
			color: #000;">'.$alumno['nombre_grado'].'</td>
			<td align="center" style="border-top:0.0mm solid #220044;
			padding:0;border-right:0.0mm solid #220044; background-color: #FFF;
			color: #000;">'.$alumno['nombre_grupo'].'</td>
			<td align="center" style="border-top:0.0mm solid #220044;
			padding:0;border-right:0.0mm solid #220044; background-color: #FFF;
			color: #000;">UNICA</td>
			<td align="center" style="border-top:0.0mm solid #220044;
			padding:0;border-right:0.0mm solid #220044; background-color: #FFF;
			color: #000;">'.$anio.'</td>
			<td align="center" style="border-top:0.0mm solid #220044;
			padding:0;border-right:0.0mm solid #220044; background-color: #FFF;
			color: #000;">'.$ciudad.'</td>
			<td align="center" style="border-top:0.0mm solid #220044;
			padding:0;border-right:0.0mm solid #220044; background-color: #FFF;
			color: #000;">'.$periodo.'</td>
			<td align="center" style="border-top:0.0mm solid #220044;
			padding:0;border-right:0.0mm solid #220044; background-color: #FFF;
			color: #000;">{PAGENO}</td>
		  </tr>
		</table>
	
	</td>
  </tr>
</table>
</div>
<div style="margin: 0px; border:0.1mm solid #FFF;" height="100%"; align="center">
	<table border="0" width="900px" cellspacing="0" cellpadding="0">
		  <tr>
			<td colspan="2" align="center" style="font-size:10px;border-bottom:0.0mm solid #220044;
			padding:0;border-right:0.0mm solid #220044; background-color: #FFF;
			color: #FFF;">&Aacute;REA / ASIGNATURA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONCEPTO FINAL</td>
			<td width="35px" style="color: #FFF;font-size:10px;border-right:0.0mm solid #220044;border-bottom:0.0mm solid #220044;">I.H.</td>
			<td width="35px" style="color: #FFF;font-size:8px; border-right:0.0mm solid #220044;border-bottom:0.0mm solid #220044;">FALLAS</td>
			<td width="35px" style="color: #FFF;font-size:10px;border-right:0.0mm solid #220044;border-bottom:0.0mm solid #220044;">P1</td>
			<td width="35px" style="color: #FFF;font-size:10px;border-right:0.0mm solid #220044;border-bottom:0.0mm solid #220044;">P2</td>
			<td width="35px" style="color: #FFF;font-size:10px;border-right:0.0mm solid #220044;border-bottom:0.0mm solid #220044;">P3</td>
			<td width="35px" style="color: #FFF;font-size:10px;border-right:0.0mm solid #220044;border-bottom:0.0mm solid #220044;">P4</td>
			<td width="35px" style="color: #FFF;font-size:10px;border-bottom:0.0mm solid #220044;">DEF.</td>
		  </tr>
	</table>
</div>';


$mpdf->SetHTMLHeader($head);
$mpdf->SetHTMLHeader($head, 'E');
if($a==0){
	$html.='<pagebreak type="BLANK" resetpagenum="'.$cont.'" pagenumstyle="1" suppress="off" /> 
	<div style="margin: 0px; " height="100%"; align="center">
';
}else{
	$html.='<pagebreak type="BLANK" pagenumstyle="1" suppress="off" /> 
	<div style="margin: 0px; " height="100%"; align="center">
';
}
	$html.='
	<table width="900px" border="0" cellspacing="0" cellpadding="0">';
	$asignaturas=getAsignaturasGrupoFinal($alumno['id_grupo']);
//print_r($asignaturas);
//die('FFFFFFIIIIIIIIINNNNNNN!!!!!!!!!!!!!');
for($i=0;$i<count($asignaturas);$i++){
	$p1=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],1);
	$p2=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],2);
	$p3=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],3);
	$p4=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],4);
	$hj=$p1['horas_justificadas']+$p2['horas_justificadas']+$p3['horas_justificadas']+$p4['horas_justificadas']+$p1['horas_injustificadas']+$p2['horas_injustificadas']+$p3['horas_injustificadas']+$p4['horas_injustificadas'];
	$calificacion_final=getCalificacionAsignaturaFinal($asignaturas[$i]['id_asignatura'], $alumno['identificacion'],$anio);

	if($i==0){
	$html.='
	  <tr>
		<td colspan="2" style="font-size:12px; border-right:0.0mm solid #220044;"><h5>&nbsp;'.$asignaturas[$i]['nombre_area'].'</h5>
		</td>
		<td width="35px" style="border-right:0.0mm solid #220044;">&nbsp;</td>
		<td width="35px" style="border-right:0.0mm solid #220044;">&nbsp;</td>
		<td width="35px" style="border-right:0.0mm solid #220044;">&nbsp;</td>
		<td width="35px" style="border-right:0.0mm solid #220044;">&nbsp;</td>
		<td width="35px" style="border-right:0.0mm solid #220044;">&nbsp;</td>
		<td width="35px" style="border-right:0.0mm solid #220044;">&nbsp;</td>
		<td width="35px">&nbsp;</td>
	  </tr>';
	}elseif($asignaturas[$i]['id_area']!=$asignaturas[$i-1]['id_area'] && $i!=0){
	$html.='  
	<tr>
		<td colspan="2" style="font-size:12px; border-top:0.0mm solid #000; border-right:0.0mm solid #220044"><h5>&nbsp;'.$asignaturas[$i]['nombre_area'].'</h5>
		</td>
		<td width="35px" style="border-top:0.0mm solid #220044; border-right:0.0mm solid #220044">&nbsp;</td>
		<td width="35px" style="border-top:0.0mm solid #220044; border-right:0.0mm solid #220044">&nbsp;</td>
		<td width="35px" style="border-top:0.0mm solid #220044; border-right:0.0mm solid #220044">&nbsp;</td>
		<td width="35px" style="border-top:0.0mm solid #220044; border-right:0.0mm solid #220044">&nbsp;</td>
		<td width="35px" style="border-top:0.0mm solid #220044; border-right:0.0mm solid #220044">&nbsp;</td>
		<td width="35px" style="border-top:0.0mm solid #220044; border-right:0.0mm solid #220044">&nbsp;</td>
		<td width="35px" style="border-top:0.0mm solid #220044;">&nbsp;</td>
	  </tr>';
	}

	$html.='  
	  <tr>
		<td colspan="2" style="font-size:12px; border-right:0.0mm solid #220044;">&nbsp;'.$asignaturas[$i]['nombre_asignatura'].'
		</td>
		<td width="35px" align="center" style="font-size:12px; border-right:0.0mm solid #220044;">'.$asignaturas[$i]['intensidad_horaria'].'</td>
		<td width="35px" align="center" style="font-size:12px; border-right:0.0mm solid #220044;">'.$hj.'</td>
		<td width="35px" align="center" style="font-size:12px;  border-right:0.0mm solid #220044;">'.$p1['desempenio_asignatura'].'</td>
		<td width="35px" align="center" style="font-size:12px; border-right:0.0mm solid #220044;">'.$p2['desempenio_asignatura'].'</td>
		<td width="35px" align="center" style="font-size:12px; border-right:0.0mm solid #220044;">'.$p3['desempenio_asignatura'].'</td>
		<td width="35px" align="center" style="font-size:12px; border-right:0.0mm solid #220044;">'.$p4['desempenio_asignatura'].'</td>
		<td width="35px" align="center" style="font-size:12px;">'.$calificacion_final['desempenio_asignatura_final'].'</td>
	  </tr>';
		//logro y numerico
		$html.='  
		<tr>
			<td width="5px">&nbsp;</td>
			<td style="font-size:12px; border-right:0.0mm solid #220044;">';
			$calificacion=$calificacion_final['calificacion_asignatura_final'];
		if($calificacion<1){
			//$html.="No se ha registrado calificacion para el ultino periodo, comunicarse con el administrador de la plataforma lo mas pronto posible...";
			$pendientes.=$asignaturas[$i]['nombre_asignatura']."<br>";
		}elseif($calificacion>=1 && $calificacion<3.7){
			$pendientes.=$asignaturas[$i]['nombre_asignatura']."<br>";
			//$html.=$asignaturas[$i]['logro_final_bajo'];
		}elseif($calificacion>=3.7 && $calificacion<4.3){
			//$html.=$asignaturas[$i]['logro_final_basico'];
		}elseif($calificacion>=4.3 && $calificacion<4.8){
			//$html.=$asignaturas[$i]['logro_final_alto'];
		}elseif($calificacion>=4.8 && $calificacion<=5){
			//$html.=$asignaturas[$i]['logro_final_superior'];
		}

		$html.='
			</td>
			<td width="35px" style="border-right:0.0mm solid #220044;">&nbsp;</td>
			<td width="35px" style="border-right:0.0mm solid #220044;">&nbsp;</td>
			<td width="35px" align="center" valign="top" style="font-size:12px; border-right:0.0mm solid #220044;">'.$p1['calificacion_asignatura'].'</td>
			<td width="35px" align="center" valign="top" style="font-size:12px; border-right:0.0mm solid #220044;">'.$p2['calificacion_asignatura'].'</td>
			<td width="35px" align="center" valign="top" style="font-size:12px; border-right:0.0mm solid #220044;">'.$p3['calificacion_asignatura'].'</td>
			<td width="35px" align="center" valign="top" style="font-size:12px; border-right:0.0mm solid #220044;">'.$p4['calificacion_asignatura'].'</td>
			<td width="35px" align="center" valign="top" style="font-size:12px;">'.$calificacion_final['calificacion_asignatura_final'].'</td>
		  </tr>';
}
//Materias perdidas....
/*  $perdidos=getDesempenio_perdido($alumno['identificacion']);
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
*/
$promocion=getPromocionAlumno($alumno['identificacion'],$anio);
if($promocion['promocion_alumno']==1){
	  $html.='
	  <tr>
		<td colspan="9" style="font-size:12px;">&nbsp;FUE PROMOVIDO AL SIGUIENTE GRADO.</td>
	  </tr>';
}elseif($promocion['promocion_alumno']==2){
	  $html.='
	  <tr>
		<td colspan="9" style="font-size:12px;">&nbsp;REPROBADO, DEBE REINICIAR EL CURSO.</td>
	  </tr>';
}elseif($promocion['promocion_alumno']==3){
	  $html.='
	  <tr>
		<td colspan="9" style="font-size:12px;">&nbsp;SEG&Uacute;N LO ACORDADO EN LA ULTIMA ENTREGA DE BOLETINES, EL ALUMNO PRESENTO ACTIVIDADES COMPLEMENTARIAS EL DIA 28 DE ENERO DE 2016 EN LAS CUALES SEG&Uacute;N ACTA No. ____, SUPERO CON UNA NOTA DE 3,7 LAS DIFICULTADES QUE PRESENTABA EN LAS SIGUIENTES ASIGNATURAS:<br/>'.$pendientes.'</td>
	  </tr>';
}
$html.='
  <tr>
	<td colspan="9" style="border-bottom:0.1mm solid #000;">&nbsp;Observaciones:</td>
  </tr>
  <tr>
	<td colspan="9" style="border-bottom:0.1mm solid #000;">&nbsp;</td>
  </tr>
  <tr>
	<td colspan="9" height="50px" valign="bottom" style="font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;firma Rector(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma profesor(a)</td>
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