<?php
ini_set("memory_limit","256M");
include("./MPDF56/mpdf.php");
include("../funciones/conexion.php");
include("../funciones/funciones.php");

//die($_REQUEST['ic'].','.$_REQUEST['dc'].','.$_REQUEST['tc'].','.$_REQUEST['bc'].','.$_REQUEST['th'].','.$_REQUEST['bp']);
$mpdf=new mPDF('en-x',array(220, 330),'','',$_REQUEST['ic'],$_REQUEST['dc'],$_REQUEST['tc'],$_REQUEST['bc'],$_REQUEST['th'],$_REQUEST['bp']);
//$mpdf=new mPDF('en-x',array(216, 330),'','',5,5,68,16,10,11);
/*('en-x',    // mode - default ''
'legal',    // format - A4, for example, default '' //array(216, 330) ->oficio
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

$alumnos_curso=getAlumnosGrupo($_REQUEST['grupo']);

$count_alumnos=count($alumnos_curso);
for($a=0;$a<$count_alumnos;$a++){
//for($a=0;$a<1;$a++){
//if($alumnos_curso[$a]['identificacion']=='1070384325'){

	
$alumno=getAlumnoBoletinId($alumnos_curso[$a]['identificacion']);
$anio="2017";
$ciudad="FACATATIVA";
$periodo=$_REQUEST['periodo'];
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
    <td align="center" height="130px">
	&nbsp;
	</td>
  </tr>
</table>
<div class="rounded" style="border:0mm solid #220044; 
	border-radius: 2mm 2mm 0mm 0mm;
	padding:0;
	width:900px;
	background-color: #FFF;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" style="border-radius:2mm 0 0 0;
	border-right:0mm solid #FFF;
	color:#FFF;
	text-align:center;">NOMBRE ESTUDIANTE</td>
    <td colspan="2" style="border-radius:0 2mm 0 0;
	color:#FFF;
	text-align:center;">IDENTIFICACION</td>
  </tr>
  <tr>
    <td align="center" colspan="6" width="111px" style="border-top:0mm solid #220044;
	padding:0;border-right:0mm solid #220044; background-color: #FFF;
	color: #000000;">'.$alumno["nombre_alumno"].'</td>
    <td align="center" colspan="2" width="111px" style="border-top:0mm solid #220044;
	padding:0; background-color: #FFF;
	color: #000000;">'.$alumno["identificacion"].'</td>
  </tr>
  <tr>
    <td align="center" width="111px" style="border-top:0mm solid #220044;
	padding:0;border-right:0mm solid #220044; background-color: #FFF;
	color: #220044;">&nbsp;</td>
    <td align="center" width="111px" style="border-top:0mm solid #220044;
	padding:0;border-right:0mm solid #220044; background-color: #FFF;
	color: #220044;">&nbsp;</td>
    <td align="center" width="111px" style="border-top:0mm solid #220044;
	padding:0;border-right:0mm solid #220044; background-color: #FFF;
	color: #220044;">&nbsp;</td>
    <td align="center" width="111px" style="border-top:0mm solid #220044;
	padding:0;border-right:0mm solid #220044; background-color: #FFF;
	color: #220044;">&nbsp;</td>
    <td align="center" width="111px" style="border-top:0mm solid #220044;
	padding:0;border-right:0mm solid #220044; background-color: #FFF;
	color: #220044;">&nbsp;</td>
    <td align="center" width="111px" style="border-top:0mm solid #220044;
	padding:0;border-right:0mm solid #220044; background-color: #FFF;
	color: #220044;">&nbsp;</td>
    <td align="center" width="111px" style="border-top:0mm solid #220044;
	padding:0;border-right:0mm solid #220044; background-color: #FFF;
	color: #220044;">&nbsp;</td>
    <td align="center" width="111px" style="border-top:0mm solid #220044;
	padding:0; background-color: #FFF;
	color: #220044;">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" width="111px" style="border-top:0mm solid #220044;
	padding:0;border-right:0mm solid #220044; background-color: #FFF;
	color: #000000;">'.$alumno['codigo_alumno'].'</td>
    <td align="center" width="111px" style="border-top:0mm solid #220044;
	padding:0;border-right:0mm solid #220044; background-color: #FFF;
	color: #000000;">'.$alumno['nombre_grado'].'</td>
    <td align="center" width="111px" style="border-top:0mm solid #220044;
	padding:0;border-right:0mm solid #220044; background-color: #FFF;
	color: #000000;">'.$alumno['nombre_grupo'].'</td>
    <td align="center" width="111px" style="border-top:0mm solid #220044;
	padding:0;border-right:0mm solid #220044; background-color: #FFF;
	color: #000000;">DIURNA.</td>
    <td align="center" width="111px" style="border-top:0mm solid #220044;
	padding:0;border-right:0mm solid #220044; background-color: #FFF;
	color: #000000;">'.$anio.'</td>
    <td align="center" width="111px" style="border-top:0mm solid #220044;
	padding:0;border-right:0mm solid #220044; background-color: #FFF;
	color: #000000;">'.$ciudad.'</td>
    <td align="center" width="111px" style="border-top:0mm solid #220044;
	padding:0;border-right:0mm solid #220044; background-color: #FFF;
	color: #000000;">'.$periodo.'</td>
    <td align="center" width="112px" style="border-top:0mm solid #220044;
	padding:0; background-color: #FFF;
	color: #000000;">{PAGENO}</td>
  </tr>
  <tr>
    <td align="center" colspan="5" style="border-top:0mm solid #220044;
	padding:0;border-right:0mm solid #220044; background-color: #FFF;
	color: #220044;">&nbsp;</td>
    <td align="center" colspan="3" style="border-top:0mm solid #220044;
	padding:0; background-color: #FFF;
	color: #220044;">

		<table style="color: #220044;" width="290px" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="39px" rowspan="2" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td colspan="2" style="font-size:8px; border-right:0mm solid #220044;border-bottom:0mm solid #220044;">&nbsp;</td>
			<td width="39px" rowspan="2" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="39px" rowspan="2" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="39px" rowspan="2" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="39px" rowspan="2" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="39px" rowspan="2">&nbsp;</td>
		  </tr>
		  <tr>
			<td style="font-size:8px;border-right:0mm solid #220044;">&nbsp;</td>
			<td style="font-size:8px;border-right:0mm solid #220044;">&nbsp;</td>
		  </tr>
		</table>
	
	</td>
  </tr>
</table>
</div>';



$mpdf->SetHTMLHeader($head);
$mpdf->SetHTMLHeader($head, 'E');

$html='
<pagebreak type="BLANK" resetpagenum="1" pagenumstyle="1" suppress="off" /> 
<div style="margin: 0px; border:0mm solid #220044;" height="100%"; align="center">
<table border="0" cellspacing="0" cellpadding="0">
';
$asignaturas=getAsignaturasGrupo($alumno['id_grupo'],$periodo);
//print_r($asignaturas);
$count_asignaturas=count($asignaturas);
for($i=0;$i<$count_asignaturas;$i++){
	$p1=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],1);
	$p2=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],2);
	$p3=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],3);

	$horas_justificadas=0;
	$horas_injustificadas=0;
	
	if($periodo==1){
		$horas_justificadas=$p1['horas_justificadas'];
		$horas_injustificadas=$p1['horas_injustificadas'];
	}elseif($periodo==2){
		$horas_justificadas=$p2['horas_justificadas'];
		$horas_injustificadas=$p2['horas_injustificadas'];
	}elseif($periodo==3){
		$horas_justificadas=$p3['horas_justificadas'];
		$horas_injustificadas=$p3['horas_injustificadas'];
	}

	if($i==0){
	$html.='  <tr>
		<td colspan="2" style="font-size:14px; border-right:0mm solid #220044;"><h5>&nbsp;'.$asignaturas[$i]['nombre_area'].'</h5>
		</td>
		<td width="35px" style="border-right:0mm solid #220044;">&nbsp;</td>
		<td width="39px" style="border-right:0mm solid #220044;">&nbsp;</td>
		<td width="46px" style="border-right:0mm solid #220044;">&nbsp;</td>
		<td width="34px" style="border-right:0mm solid #220044;">&nbsp;</td>
		<td width="34px" style="border-right:0mm solid #220044;">&nbsp;</td>
		<td width="34px" style="border-right:0mm solid #220044;">&nbsp;</td>
		<td width="37px">&nbsp;</td>
	  </tr>';
	}elseif($asignaturas[$i]['id_area']!=$asignaturas[$i-1]['id_area'] && $i!=0){
	$html.='  <tr>
		<td colspan="2" style="font-size:14px; border-top:0.3mm solid #220044; border-right:0mm solid #220044;"><h5>&nbsp;'.$asignaturas[$i]['nombre_area'].'</h5>
		</td>
		<td width="35px" style="border-top:0.3mm solid #000; border-right:0mm solid #220044;">&nbsp;</td>
		<td width="39px" style="border-top:0.3mm solid #000; border-right:0mm solid #220044;">&nbsp;</td>
		<td width="46px" style="border-top:0.3mm solid #000; border-right:0mm solid #220044;">&nbsp;</td>
		<td width="34px" style="border-top:0.3mm solid #000; border-right:0mm solid #220044;">&nbsp;</td>
		<td width="34px" style="border-top:0.3mm solid #000; border-right:0mm solid #220044;">&nbsp;</td>
		<td width="34px" style="border-top:0.3mm solid #000; border-right:0mm solid #220044;">&nbsp;</td>
		<td width="37px" style="border-top:0.3mm solid #000;">&nbsp;</td>
	  </tr>';
	}

	$html.='  <tr>
		<td colspan="2" style="font-size:14px; border-right:0mm solid #220044;">&nbsp;'.$asignaturas[$i]['nombre_asignatura'].'
		</td>
		<td width="35px" align="center" style="border-right:0mm solid #220044;">'.$asignaturas[$i]['intensidad_horaria'].'</td>
		<td align="center" width="39px" style="border-right:0mm solid #220044;">'.$horas_justificadas.'</td>
		<td align="center" width="46px" style="border-right:0mm solid #220044;">'.$horas_injustificadas.'</td>
		<td width="34px" style="border-right:0mm solid #220044;">'.$p1['desempenio_asignatura'].'</td>
		<td width="34px" style="border-right:0mm solid #220044;">'.$p2['desempenio_asignatura'].'</td>
		<td width="34px" style="border-right:0mm solid #220044;">'.$p3['desempenio_asignatura'].'</td>
		<td width="37px">&nbsp;</td>
	  </tr>';
	$dato=seleccionaPlanGestor("tbl_logro", $asignaturas[$i]['id_plan_gestor']);

	$count_dato=count($dato);
	for($j=0;$j<$count_dato;$j++){
		$calificacion_logro=getCalificacionLogro($dato[$j]['id_logro'],$alumno['identificacion']);
		if($j==0){
		$html.='  <tr>
			<td valign="top" align="center" width="45px">Posi</td>
			<td style="font-size:14px;  border-right:0mm solid #220044;">'.$dato[$j]['logro'].'
			</td>
			<td width="35px" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="39px" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="46px" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="34px" valign="top" style="border-right:0mm solid #220044;">'.$p1['calificacion_asignatura'].'</td>
			<td width="34px" valign="top" style="border-right:0mm solid #220044;">'.$p2['calificacion_asignatura'].'</td>
			<td width="34px" valign="top" style="border-right:0mm solid #220044;">'.$p3['calificacion_asignatura'].'</td>
			<td valign="top" width="37px">'.$calificacion_logro['desempenio_logro'].'<br>'.$calificacion_logro['calificacion_logro'].'</td>
		  </tr>';
		}else{
		$html.='  <tr>
			<td valign="top" align="center" width="45px">Posi</td>
			<td style="font-size:14px; border-right:0mm solid #220044;">'.$dato[$j]['logro'].'
			</td>
			<td width="35px" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="39px" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="46px" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="34px" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="34px" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="34px" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td valign="top" width="37px">'.$calificacion_logro['desempenio_logro'].'<br>'.$calificacion_logro['calificacion_logro'].'</td>
		  </tr>';
		}
	}
	//fragmento para ultimo periodo...
	if($periodo==3){
	$calificacion_final=getCalificacionAsignaturaFinal($asignaturas[$i]['id_asignatura'], $alumno['identificacion'],$anio);
		//logro y numerico
		$html.='  <tr>
			<td valign="top" align="center" width="15px">DEF.</td>
			<td style="font-size:14px; ">';
			$calificacion=$calificacion_final['calificacion_asignatura_final'];
		if($calificacion<1){
			$html.="No se ha registrado calificacion para el ultino periodo, comunicarse con el administrador de la plataforma lo mas pronto posible...";
			$pendientes.=$asignaturas[$i]['nombre_asignatura']."<br>";
		}elseif($calificacion>=1 && $calificacion<3.7){
			$pendientes.=$asignaturas[$i]['nombre_asignatura']."<br>";
			$html.=$asignaturas[$i]['logro_final_bajo'];
		}elseif($calificacion>=3.7 && $calificacion<4.3){
			$html.=$asignaturas[$i]['logro_final_basico'];
		}elseif($calificacion>=4.3 && $calificacion<4.8){
			$html.=$asignaturas[$i]['logro_final_alto'];
		}elseif($calificacion>=4.8 && $calificacion<=5){
			$html.=$asignaturas[$i]['logro_final_superior'];
		}

		$html.='
			</td>
			<td width="35px">&nbsp;</td>
			<td width="39px">&nbsp;</td>
			<td width="46px">&nbsp;</td>
			<td width="34px" valign="top">&nbsp;</td>
			<td width="34px" valign="top">&nbsp;</td>
			<td width="34px" valign="top">&nbsp;</td>
			<td valign="top" width="37px">'.$calificacion_final['calificacion_asignatura_final'].' '.$calificacion_final['desempenio_asignatura_final'].'</td>
		  </tr>';	
	}
	//Fin fragmento para ultimo periodo...
	$recomendacion=getRecomendacionesAlumno($alumno['identificacion'], $asignaturas[$i]['id_plan_gestor']);
	$count_reco=count($recomendacion);
	for($k=0;$k<$count_reco;$k++){
		$html.='  <tr>
			<td valign="top" align="center" width="45px">Reco</td>
			<td style="font-size:14px;" style="border-right:0mm solid #220044;">'.$recomendacion[$k]['recomendacion'].'
			</td>
			<td width="35px" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="39px" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="46px" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="34px" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="34px" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="34px" style="border-right:0mm solid #220044;">&nbsp;</td>
			<td width="37px">&nbsp;</td>
		  </tr>';
	}
}
$puesto=getPuntajeAlumno($alumno['identificacion'],$periodo,$anio);
$html.='
  <tr>
	<td colspan="9" style="border-top:0mm solid #000;">Puntaje del Periodo: '.$puesto['puntaje_total'].' de '.$puesto['total_puntos'].' puntos.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Puesto: '.$puesto['puesto_alumno'].'</td>
  </tr>
  <tr>
	<td colspan="9" style="border-bottom:0.3mm solid #000;">Comentarios:</td>
  </tr>
  <tr>
	<td colspan="9" style="border-bottom:0.3mm solid #000;">&nbsp;</td>
  </tr>
  <tr>
	<td colspan="9" style="border-bottom:0.3mm solid #000;">&nbsp;</td>
  </tr>
  <tr>
	<td colspan="9" style="border-bottom:0.3mm solid #000;">&nbsp;</td>
  </tr>';
  $perdidos=getDesempenio_perdido($alumno['identificacion']);
  if($perdidos){
	  $html.='  
	  <tr>
		<td colspan="9">Desempe&ntilde;os Pendientes:';
  		for($p=0;$p<count($perdidos);$p++){
			if($perdidos[$p]['id_asignatura']!=$perdidos[$p-1]['id_asignatura']){
			$html.='<br>'.$perdidos[$p]['nombre_asignatura'].'<br>';
			}
			$html.='&nbsp;'.$perdidos[$p]['id_logro'].'&nbsp;&nbsp;&nbsp;';
		}
		$html.='</td>
	  </tr>';
  }
//Promocion Alumno
if($periodo==3){
$promocion=getPromocionAlumno($alumno['identificacion'],$anio);
if($promocion['promocion_alumno']==1){
	  $html.='  
	  <tr>
		<td colspan="9">FUE PROMOVIDO AL SIGUIENTE GRADO.</td>
	  </tr>';
}elseif($promocion['promocion_alumno']==2){
	  $html.='  
	  <tr>
		<td colspan="9">REPROBADO, DEBE REINICIAR EL CURSO.</td>
	  </tr>';
}elseif($promocion['promocion_alumno']==3){
	  $html.='  
	  <tr>
		<td colspan="9">DEBE PRESENTAR ACTIVIDADES DE NIVELACI&Oacute;N EN ENERO.</td>
	  </tr>';
}
}
//Fin Promonion Alimno
$html.='
  <tr>
	<td colspan="9" height="60px" valign="bottom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;firma Rector(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma profesor(a)</td>
  </tr>
</table>
</div>
';


$mpdf->ignore_invalid_utf8 = true;
//$mpdf->AddPage(); 
$mpdf->WriteHTML($html);
//$mpdf->AddPage();
//}
}
//echo $html;

$mpdf->Output();
exit;

?>