<?php
ini_set("memory_limit","256M");
include("./MPDF56/mpdf.php");
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$mpdf=new mPDF('en-x','letter','','',5,5,5,5,5,5);  
$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins
//$mpdf->SetWatermarkImage('bg_boletin3.jpg', 0.35, 'F');
//$mpdf->showWatermarkImage = true;
$html="";
$anio=2015;

for($c=1;$c<25;$c++){
	$info=getGradoGrupoId($c);
	$html.='<pagebreak type="BLANK" pagenumstyle="1" suppress="off" /> 
	<div style="margin: 0px; " height="100%"; align="center">';
	$html.='
	<table width="900" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" align="center">"GIMNASIO CERVANTES"</td>
        <td width="150px">FACATATIVA CUND.</td>
      </tr>
      <tr>
        <td width="90px">JORNADA:</td>
        <td width="110px">Unica</td>
        <td colspan="2">ALUMNOS CON ESTADO DE PROMOCION *en Detalle*</td>
        <td align="center">'.$anio.'</td>
      </tr>
      <tr>
        <td>CURSO:</td>
        <td>'.$info['nombre_grado'].'</td>
        <td width="80px">GRUPO:</td>
        <td colspan="2">'.$info['nombre_grupo'].'</td>
      </tr>
      <tr>
        <td height="35px">Codigo</td>
        <td colspan="3">Apellidos y Nombres</td>
        <td>Observacion</td>
      </tr>';
	$alumnos_curso=getAlumnosGrupo($c);
	for($a=0;$a<count($alumnos_curso);$a++){
		$alumno=getAlumnoBoletinId($alumnos_curso[$a]['identificacion']);
		$ciudad="FACATATIVA";
		$cod=$a+1;
		$html.='
      <tr>
        <td>'.$cod.'</td>
        <td colspan="3">'.$alumno['nombre_alumno'].'</td>
        <td>';
        
        $promocion=getPromocionAlumno($alumno['identificacion'],$anio);
		if($promocion['promocion_alumno']==1){
			  $html.='PROMOVIDO';
		}elseif($promocion['promocion_alumno']==2){
			  $html.='***REPROBADO***';
		}elseif($promocion['promocion_alumno']==3){
			  $html.='APLAZADO';
		}
		$html.='
        </td>
      </tr>';
	}
    $html.='
	</table>
	</div>
	';
}
$mpdf->ignore_invalid_utf8 = true;
//$mpdf->AddPage(); 
$mpdf->WriteHTML($html);
//$mpdf->AddPage();
//echo $html;

$mpdf->Output();
exit;

?>