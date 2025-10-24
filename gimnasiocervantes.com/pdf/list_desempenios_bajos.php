<?
session_start();
ini_set("memory_limit","256M");
include("./MPDF56/mpdf.php");
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$mpdf=new mPDF('en-x','letter','','',5,5,10,10,5,5);  

$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins
//$mpdf->SetWatermarkImage('bg_boletin3.jpg', 0.35, 'F');

$alumnos_curso=getAlumnosGrupo($_REQUEST['grupo']);

//$mpdf->showWatermarkImage = true;

$html='
<h2>Reporte desempe&ntilde;os bajos - '.date("Y-m-d").'</h2>
<table border="1" width="100%" cellspacing="0" cellpadding="0">';
for($a=0;$a<count($alumnos_curso);$a++){
  $perdidos=getDesempenio_perdido2($alumnos_curso[$a]['identificacion']);
  if($perdidos){
	$html.='
	  <tr>
		<td bgcolor="#0099FF">Desempe&ntilde;os Pendientes '.$alumnos_curso[$a]['nombre_alumno'].':
        </td>
	  </tr>';
	  
  		for($p=0;$p<count($perdidos);$p++){
		
			if($perdidos[$p]['id_asignatura']!=$perdidos[$p-1]['id_asignatura']){

      $html.='<tr bgcolor="#FFFF33">
    	<td><br>'.$perdidos[$p]['nombre_asignatura'].'</td>
      </tr>';
			}
      $html.='<tr>
        <td>&nbsp;'.$perdidos[$p]['id_logro'].'&nbsp;&nbsp;-&nbsp;'.$perdidos[$p]['logro'];
		}
      $html.='  </td>
      </tr>';
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