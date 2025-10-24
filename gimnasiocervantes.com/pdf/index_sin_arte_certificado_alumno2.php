<?php
session_start();
ini_set("memory_limit","256M");
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
include("./MPDF56/mpdf.php");
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$mpdf=new mPDF('en-x','letter','','',10,10,72,0);
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

$anio=$_SESSION['anio'];
$alumno=getAlumnoCertificadoId($_SESSION['alumno'],$anio);
$ciudad="FACATATIVA";
$periodo="FINAL";
$prom=0;
$html="";

$html='
<div style="margin: 0px; " height="100%"; align="center">
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="text-align:justify; font-size:12px;">

LA SUSCRITA RECTORA DEL COLEGIO “GIMNASIO CERVANTES” CON APROBACIÓN DE ESTUDIOS No. 006816 DEL 30 DE OCTUBRE DE 2008 PARA LOS GRADOS DEL NIVEL DE PREESCOLAR Y EDUCACIÓN CICLOS DE BÁSICA PRIMARIA Y SECUNDARIA Y RESOLUCION No. 1278 DE OCTUBRE 28 DE 2010 PARA EDUCACION MEDIA ACADEMICA. CUMPLIENDO CON LOS LINEAMIENTOS GENERALES DE LOS PROCESOS CURRICULARES E INDICADORES DE LOGROS ESTABLECIDOS POR EL PROYECTO EDUCATIVO INSTITUCIONAL (PEI) Y LA LEY (ART.51, 52 Y 53) Y RESOLUCION 2343 DE 1996.
	
	</td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px;"><h4>CERTIFICA</h4></td>
  </tr>
  <tr>
    <td style="text-align:justify; font-size:13px">Que '.$alumno["nombre_alumno"].', Identificado(a) con Documento de Identidad No. '.$alumno["identificacion"].' expedido en '.$alumno["lugar_expedicion"].' curs&oacute; en este Establecimiento Educativo, el grado '.$alumno['nombre_grado'].' de '.$alumno['nombre_ciclo'].' Durante el a&ntilde;o lectivo de '.$anio.' Jornada Unica de acuerdo a Decretos y Resoluciones vigentes se expiden a continuacion las siguientes calificaciones:</td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px;">&nbsp;</td>
  </tr>
</table>
';
	
	$calificacion_final=getCalificacionAsignaturaFinalAlumno($alumno['identificacion'],$anio);
for($i=0;$i<count($calificacion_final);$i++){
    $asignaturas=getAsignaturaId($calificacion_final[$i]['id_asignatura']);
	$prom=$prom+$calificacion_final[$i]['calificacion_asignatura_final'];
	$html.='
<table width="680px" align="center" border="1" cellspacing="0" cellpadding="0">
';

	if($i==0){
	$html.='  <tr>
		<td style="font-size:11px;"><h5>AREA OBLIGATORIAS Y FUNDAMENTALES</h5></td>
		<td width="80px" style="font-size:11px;"><h5>INTENSIDAD<br>HORARIA</h5></td>
		<td width="120px" style="font-size:11px;"><h5>LETRAS</h5></td>
		<td width="120px" style="font-size:11px;"><h5>JUICIO<br>VALORATIVO</h5></td>
	  </tr>
	    <tr>
		<td style="font-size:9px; "  width="80px">'.$asignaturas['nombre_area']." - ".$asignaturas['nombre_asignatura'].'
		</td>
		<td align="center" style="font-size:9px;  width="120px"">'.$asignaturas['intensidad_horaria'].'</td>
		<td style="font-size:9px; ">'.$calificacion_final[$i]['desempenio_asignatura_final'].'</td>
			<td valign="top" style="font-size:9px; "  width="120px">'.$calificacion_final[$i]['calificacion_asignatura_final'].'</td>
		  </tr>';
	}elseif($asignaturas['id_area']){
	$html.='  <tr>
		<td style="font-size:9px; " >'.$asignaturas['nombre_area']." - ".$asignaturas['nombre_asignatura'].'
		</td>
		<td align="center" style="font-size:9px; "  width="80px">'.$asignaturas['intensidad_horaria'].'</td>
		<td style="font-size:9px; "  width="120px">'.$calificacion_final[$i]['desempenio_asignatura_final'].'</td>
			<td valign="top" style="font-size:9px; "  width="120px">'.$calificacion_final[$i]['calificacion_asignatura_final'].'</td>
		  </tr>';
	}else{

	$html.='  <tr>
		<td style="font-size:9px; ">'.$asignaturas['nombre_asignatura'].'
		</td>
		<td align="center" style="font-size:9px; "  width="80px">'.$asignaturas['intensidad_horaria'].'</td>
		<td style="font-size:9px; "  width="120px">'.$calificacion_final[$i]['desempenio_asignatura_final'].'</td>
			<td valign="top" style="font-size:9px; "  width="120px">'.$calificacion_final[$i]['calificacion_asignatura_final'].'</td>
		  </tr>';
	}
$html.='
	</table>';
}
//$prom=$prom/count($asignaturas);
$html.='
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
<table align="center" width="600px" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="font-size:10px;">Desempe&ntilde;o Superior (DS) 4.8 - 5.0<br />Desempe&ntilde;o B&aacute;sico (DBS) 3.7 - 4.2</td>
    <td style="font-size:10px;">Desempe&ntilde;o Alto (DA) 4.3 - 4.7<br />Desempe&ntilde;o Bajo (DB) 1.0 - 3.6</td>
  </tr>
</table>
	</td>
  </tr>
  <tr>
    <td style="font-size:13px;">Con un promedio de '.number_format($prom,2).' y conducta Excelente.</td>
  </tr>
  ';

$html.='
  <tr>
    <td style="font-size:13px;">Se expide en Facatativ&aacute; (Cundinamarca) el '.strftime('%A %d de %B del %Y').'.</td>
  </tr>
  <tr>
    <td style="font-size:13px;">Atentamente,</td>
  </tr>
  <tr>
    <td style="font-size:12px;">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-size:12px;">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-size:12px;">LIBIA INÉS BELTRÁN C.<br>RECTORA</td>
  </tr>
</table>
</div>
';
//echo $html;

$mpdf->ignore_invalid_utf8 = true;
//$mpdf->AddPage(); 
$mpdf->WriteHTML($html);
//$mpdf->AddPage();
//echo $html;

$mpdf->Output();
exit;

?>