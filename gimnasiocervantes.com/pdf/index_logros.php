<?
session_start();
ini_set("memory_limit","256M");
include("./MPDF56/mpdf.php");
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$mpdf=new mPDF('en-x','letter','','',5,5,10,10,5,5);  

$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins
//$mpdf->SetWatermarkImage('bg_boletin3.jpg', 0.35, 'F');

$asignatura=getPlanesGestores($_SESSION['grupo_busqueda'],$_SESSION['director_busqueda'],$_SESSION['asignatura_busqueda'],$_SESSION['periodo_busqueda']);

//$mpdf->showWatermarkImage = true;

$html='
<h2>Reporte logros - planes gestores / '.date("Y-m-d").'</h2>
<table width="680px" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>Profesor</td>
    <td>Asignatura</td>
    <td>Grupo</td>
    <td>Periodo</td>
  </tr>';

for($i=0;$i<count($asignatura);$i++){
	$dato=seleccionaPlanGestor("tbl_logro", $asignatura[$i]['id_plan_gestor']);
	$html.='
	  <tr bgcolor="#CCCCCC" >
    <td>'.$asignatura[$i]['nombre_profesor'].'</td>
    <td>'.$asignatura[$i]['nombre_asignatura'].'</td>
    <td>'.$asignatura[$i]['nombre_grupo'].'</td>
    <td>'.$asignatura[$i]['id_periodo_academico'].'</td>
  </tr>
  <tr>
  	<td colspan="4" bgcolor="#FFFF66">
    	    <h3>Logros registrados:</h3>
            <strong>';
	for($k=0;$k<count($dato);$k++){
		$html.="* ".$dato[$k]['logro']."<br>";
	}
	$html.='</strong>
  	</td>
  </tr>';
}
$html.='</table>';

$mpdf->ignore_invalid_utf8 = true;
//$mpdf->AddPage(); 
$mpdf->WriteHTML($html);
//$mpdf->AddPage();
//echo $html;

$mpdf->Output();
exit;

?>