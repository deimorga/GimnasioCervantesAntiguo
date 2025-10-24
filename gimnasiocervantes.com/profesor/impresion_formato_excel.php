<?php
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=archivo.xls");
	header("Pragma: no-cache");
	header("Expires: 0"); 
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$alumnos=getAlumnosGrupo($_REQUEST['grupo']);
$grupo=getGrupoId($_REQUEST['grupo']);

//$mpdf=new mPDF('',array(332,215),'','',20,10,5,5,0,0);  

$html='<h2>Listado de alumnos '.$grupo['nombre_grupo'].'.</h2>
Asignatura: __________________________&nbsp;&nbsp;&nbsp;Profesor: ____________________________&nbsp;&nbsp;&nbsp;Periodo:______________
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="400px">Alumno</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="350px">DESCRIPCION DE LA ACTIVIDAD</td>
  </tr>';

for($i=0;$i<count($alumnos);$i++){
	$a=$i+1;
	$html.="  
  <tr>
    <td>".$a." - ".$alumnos[$i]['nombre_alumno']."</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align='left'>".$a.".&nbsp;</td>
  </tr>";
}
$html.="</table>";
//$mpdf->ignore_invalid_utf8 = true;
//$mpdf->AddPage(); 
//$mpdf->WriteHTML($html);
//$mpdf->AddPage();

//$mpdf->Output();
//exit;
echo $html;
?>