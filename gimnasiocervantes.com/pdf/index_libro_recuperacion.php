<?php
ini_set("memory_limit","256M");
include("./MPDF56/mpdf.php");
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$mpdf=new mPDF('en-x','letter','','',15,15,3,2,3,2);  
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
	<table width="800px" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="4" align="center">"GIMNASIO CERVANTES"</td>
        <td width="150px">FACATATIVA CUND.</td>
      </tr>
      <tr>
        <td width="90px">JORNADA:</td>
        <td width="110px">Unica</td>
        <td colspan="2">ACTAS DE RECUPERACION</td>
        <td align="center">'.$anio.'</td>
      </tr>
      <tr>
        <td>CURSO:</td>
        <td>'.$info['nombre_grado'].'</td>
        <td width="80px">GRUPO:</td>
        <td colspan="2">'.$info['nombre_grupo'].'</td>
      </tr>
	</table>';
	$alumnos_curso=getAlumnosGrupo($c);
	for($a=0;$a<count($alumnos_curso);$a++){
		$alumno=getAlumnoBoletinId($alumnos_curso[$a]['identificacion']);
        $promocion=getPromocionAlumno($alumno['identificacion'],$anio);
		$cod=$a+1;
		if($promocion['promocion_alumno']==3){
		$html.='
	<table width="800px" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td>CODIGO: '.$cod.'</td>
        <td>ALUMNO: '.$alumno['nombre_alumno'].'</td>
 	  </tr>
	</table>
	<table width="800" border="1" cellspacing="0" cellpadding="0">
      <tr>
      	<td>AREA / ASIGNATURA</td>
        <td width="200px">APC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ACTA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FECHA</td>
        <td width="200px">ACE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ACTA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FECHA</td>
      </tr>';
			$asignaturas=getAsignaturasGrupoFinal($alumno['id_grupo']);
			$cont=0;
//print_r($asignaturas);
//die('FFFFFFIIIIIIIIINNNNNNN!!!!!!!!!!!!!');
			for($i=0;$i<count($asignaturas);$i++){
			$calificacion_final=getCalificacionAsignaturaFinal($asignaturas[$i]['id_asignatura'], $alumno['identificacion'],$anio);
			$calificacion=$calificacion_final['calificacion_asignatura_final'];
				if($calificacion<3.7){
					$cont=$cont+1;
                      $html.='
					  <tr>
                        <td>'.$asignaturas[$i]['nombre_asignatura'].'</td>
                        <td>3.7&nbsp;DBs&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$promocion['acta'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;28/01/2016</td>
                        <td>&nbsp;</td>
                      </tr>';
				}		
			}
			if($cont==0){
                      $html.='
					  <tr>
                        <td>'.$calificacion.'</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
					  <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>';
			}
			
		$html.='<tr>
                  <td colspan="3">Observaciones:</td>
				</td>
              </table><br>';
		}
	}
    $html.='
	<table width="800" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td>__________________</td>
		<td>__________________</td>
	  </tr>
	  <tr>
		<td>RECTOR</td>
		<td>SECRETARIA</td>
	  </tr>
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