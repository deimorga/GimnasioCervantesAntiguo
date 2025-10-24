<?
session_start();
ini_set("memory_limit","256M");
include("./MPDF56/mpdf.php");
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$mpdf=new mPDF('en-x','letter','','',5,5,10,10,5,5);  

$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins
//$mpdf->SetWatermarkImage('bg_boletin3.jpg', 0.35, 'F');

$alumnos=getAlumnosCasoEspecial();

//$mpdf->showWatermarkImage = true;

$html='<h2>Reporte Casos Especiales / '.date("Y-m-d").'</h2>';

for($i=0;$i<count($alumnos);$i++){
	$html.='<h4>Alumno: '.$alumnos[$i]['nombre_alumno'].' - Grupo: '.$alumnos[$i]['nombre_grupo'].'</h4>';
	$dato=getLogrosCasoEspecialId($alumnos[$i]['identificacion']);
	for($k=0;$k<count($dato);$k++){
		$html.="* ".$dato[$k]['logro_caso_especial']."<br>";
	}
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