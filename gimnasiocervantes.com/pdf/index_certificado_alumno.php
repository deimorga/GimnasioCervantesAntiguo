<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

?>
<h2>Listado de asignatura registradas.</h2>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Identificacion:</td>
				<td><input type="text" name="id_alumno" id="id_alumno" /></td>
			</tr>
			<tr>
				<td class="texte2">A&ntilde;o:</td>
				<td><select name="anio" class="champ2" id="anio" >
                	<option value="">Seleccione...</option>
                    <option value="2013" >2013</option>
                    <option value="2014" >2014</option>
                    <option value="2015" >2015</option>
                    <option value="2016" >2016</option>
                    <option value="2017" >2017</option>
                </select></td>
			</tr>
            <tr><td><input name="enviar" value="ENVIAR" type="button" onclick="FAjax('./pdf/index_sin_arte_certificado_alumno.php','area_trabajo','','post');"/></td></tr>
</table>
