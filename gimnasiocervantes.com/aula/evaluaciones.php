<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

include("botones_retorno.php");

$circulares=getEvaluacionesId($_SESSION["user_id"]);
?>
<h1>LISTADO DE EVALUACIONES EMITIDAS.</h1><br />

<!--        <table width="700px" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><h3>NOTA: </h3><p>Se informa que para los alumnos de bachillerato no hay por el momento listado de &uacute;tiles escolares, en el momento de ingreso a clases ya cada profesor les indicara lo que necesitan en cada asignatura.</p></td>
  </tr>
  </table>
-->
        <table align="center" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF; font-size:24px;">
    <td width="10%">Fecha</td>
    <td width="10%">Grupo</td>
    <td width="10%">Asignatura</td>
    <td width="10%">Emisor</td>
    <td width="10%">Dirigido a</td>
    <td width="10%">Acci&oacute;n</td>
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
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?> style="color:#000; font-size:18px">
    <td><?=$circulares[$i]['fecha_circular']?></td>
    <td><?=$circulares[$i]['nombre_grupo']?></td>
    <td><?=$circulares[$i]['nombre_asignatura']?></td>
    <td><?=$circulares[$i]['nombre_profesor']?></td>
    <td><?=$circulares[$i]['nombre_grupo']?></td>
    <td><a href='./circulares/<?=$circulares[$i]['id_circular'].$circulares[$i]['archivo']?>' target='_blank'>Descargar</a></td>
  </tr>
<?
}
}
?>
</table>
