<?
//session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$circulares=getFormatos();
?>
<h1>LISTADO DE FORMATOS.</h1><br />

<table width="700px" align="center" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td width="70px">ID</td>
    <td width="400px">NOMBRE</td>
    <td width="70px">Acci&oacute;n</td>
  </tr>
<?
if(count($circulares)<1){
?>
  <tr>
    <td colspan="5" align="center">NO HAY FORMATOS CARGADOS</td>
  </tr>
<?
}else{
for($i=0;$i<count($circulares);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$circulares[$i]['id_circular']?></td>
    <td><?=$circulares[$i]['tema']?></td>
    <td><a href='./circulares/<?=$circulares[$i]['archivo']?>' target='_blank'>Descargar</a></td>
  </tr>
<?
}
}
?>
</table>
