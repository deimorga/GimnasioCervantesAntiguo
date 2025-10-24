<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

//$circulares=getCircularesTodasAnio(2016);
$circulares=getCircularesTodasInforme();
?>
<h1>LISTADO DE GUÍAS EMITIDAS.</h1><br />

<!--        <table width="700px" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><h3>NOTA: </h3><p>Se informa que para los alumnos de bachillerato no hay por el momento listado de &uacute;tiles escolares, en el momento de ingreso a clases ya cada profesor les indicara lo que necesitan en cada asignatura.</p></td>
  </tr>
  </table>
-->
        <table width="700px" align="center" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td width="70px">Fecha</td>
    <td width="400px">Tema</td>
    <td width="130px">Emisor</td>
    <td width="130px">Dirigido a</td>
    <td width="70px">Acci&oacute;n</td>
  </tr>
<?
if(count($circulares)<1){
?>
  <tr>
    <td colspan="5" align="center">NO HAY GUIAS REGISTRADAS</td>
  </tr>
<?
}else{
for($i=0;$i<count($circulares);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$circulares[$i]['fecha_circular']?></td>
    <td><?=$circulares[$i]['tema']?></td>
    <td><?=$circulares[$i]['nombre_profesor']?></td>
    <td><?=$circulares[$i]['nombre_grupo']?></td>
    <td><a href='./circulares/<?=$circulares[$i]['id_circular'].$circulares[$i]['archivo']?>' target='_blank'>Descargar</a></td>
  </tr>
<?
}
}
?>
</table>
