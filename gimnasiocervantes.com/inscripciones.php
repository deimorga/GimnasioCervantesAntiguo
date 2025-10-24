<?
session_start();

include_once("./funciones/funciones.php");
include_once("./funciones/conexion.php");

$circulares=getCirculares();
?>
<h3 align="center">PROCESO DE INCRIPCION - ALUMNOS 2015.</h3>

<iframe width="690px" height="800px" id="iframepdf" src="./docs/inscripciones.pdf"></iframe>             
        	<ul id="navigation2">
            
<table align="center" border="0" cellspacing="4" cellpadding="0">
  <tr>
    <td><li><a  href="#" onclick="FAjax('./registro.php', 'area_trabajo','','post');" title="Ingreso seguro"><hr class="space" />
    REGISTRO DE FORMULARIO</a></li></td>
</table>
