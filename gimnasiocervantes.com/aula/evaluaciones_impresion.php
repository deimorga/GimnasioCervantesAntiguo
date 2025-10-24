<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

//include("botones_retorno.php");

$circulares=getEvaluacionesImpresion();

$fecha = date ( 'Y-m-d' ,strtotime ( '-5 hour' , strtotime ( date("Y-m-d H:i:s") ) ) );

?>
<h1>EVALUACIONES PARA IMPRESI&Oacute;N.</h1><br />

<!--        <table width="700px" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><h3>NOTA: </h3><p>Se informa que para los alumnos de bachillerato no hay por el momento listado de &uacute;tiles escolares, en el momento de ingreso a clases ya cada profesor les indicara lo que necesitan en cada asignatura.</p></td>
  </tr>
  </table>
-->
        <table align="center" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF; font-size:24px;">
    <td width="4%">ID.</td>
    <td width="7%">Fecha</td>
    <td width="12%">Grupo</td>
    <td width="14%">Asignatura</td>
    <td width="20%">Emisor</td>
    <td width="10%">Vencimiento</td>
    <td width="7%">Acci&oacute;n</td>
  </tr>
<?
if(count($circulares)<1){
?>
  <tr>
    <td colspan="6" align="center">NO HAY EVALUACIONES REGISTRADAS</td>
  </tr>
<?
}else{
for($i=0;$i<count($circulares);$i++){
	
	$fecha_evaluacion=$circulares[$i]['fecha_circular'];
	$segundos=strtotime($fecha_evaluacion) - strtotime($fecha);
	$diferencia_dias=intval($segundos/60/60/24);
	//echo "La cantidad de días entre el ".$fecha_evaluacion." y hoy es <b>".$diferencia_dias."</b>";

?>
  <tr <? if($diferencia_dias<0){ echo ' bgcolor="#FF0000"';}elseif($diferencia_dias>=0 && $diferencia_dias<=2){ echo " bgcolor='#FFFF66'";}else{ echo ' bgcolor="#00FF66"';}?> style="color:#000; font-size:18px">
    <td><?=$circulares[$i]['id_circular']?></td>
    <td><?=$circulares[$i]['fecha_circular']?></td>
    <td><?=$circulares[$i]['nombre_grupo']?></td>
    <td><?=$circulares[$i]['nombre_asignatura']?></td>
    <td><?=$circulares[$i]['nombre_profesor']?></td>
    <td><?=$diferencia_dias?></td>
    <td><a href='./circulares/<?=$circulares[$i]['id_circular'].$circulares[$i]['archivo']?>' target='_blank'>Descargar</a></td>
  </tr>
<?
}
}
?>
</table>
