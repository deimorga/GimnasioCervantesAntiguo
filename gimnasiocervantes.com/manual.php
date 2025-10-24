<?
session_start();

include_once("./funciones/funciones.php");
include_once("./funciones/conexion.php");
?>
<h2>MANUAL DE CONVIVENCIA.<br>COLEGIO GIMNASIO CERVANTES.</h2>
<iframe width="690px" height="800px" id="iframepdf" src="./documentos/MANUAL_DE_CONVIVENCIA.pdf"></iframe> 
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="manual" id="manual" type="button" value="ACEPTO EL MANUAL DE CONVIVENCIA" onclick="alert('Felicidades, completaste el registro correctamente...');FAjax('./registro_alumno.php','contenido_usuario','','post');"><input class="button_send" name="manual" id="manual" type="button" value="NO ACEPTO EL MANUAL DE CONVIVENCIA" onclick="if(confirm('Debes aceptar los contenidos expuestos en el manual de convivencia o no podras continuar con el proceso de matricula, Aceptas el contenido del manual de convivencia?')){ alert('Felicidades, completaste el registro correctamente...');FAjax('./registro_alumno.php','contenido_usuario','','post');}else{  FAjax('./registro_alumno.php','contenido_usuario','','post');}"></td>
			</tr>
        </table>