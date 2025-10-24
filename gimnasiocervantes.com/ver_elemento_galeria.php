<?
session_start();

include_once("./aplicacion/funciones/funciones_galeria.php");
include_once("./funciones/conexion.php");

$elemento=getGaleriaId($_GET['id']);
?>
<fieldset>
	<legend class="texte_legende2">Datos Del Elemento.</legend>
<table width="630px" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h4><?=$elemento['galeria']?></h4></td>
  </tr>
  <tr>
    <td><?=nl2br($elemento['descripcion_galeria'])?></td>
  </tr>

  <tr>
    <td>
    <a onClick="window.open('<?=$elemento['enlace_galeria']?>');">
    <img src="./iconos/web.png" width="200" height="200">
    </a></td>
  </tr>
</table>
</fieldset>