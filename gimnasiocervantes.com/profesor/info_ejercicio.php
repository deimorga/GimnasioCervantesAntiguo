<?
session_start();
if($_SESSION['id_plan']!=""){
?>
        <table width="600px" cellspacing=0 border="0">
			<tr>
				<td align="right" class="subenlace" valign="top"><input class="button_send2" name="familia_alumno" id="familia_alumno" type="button" value="NUEVA ACTIVIDAD" onclick="FAjax('./profesor/form_ejercicio.php','familia','','post');"></td>
			</tr>
				<td valign="top"><div id="familia"></div></td>
			</tr>
			<tr>
				<td align="right" class="subenlace" valign="top"><input class="button_send2" name="salud_alumno" id="salud_alumno" type="button" value="LISTADO ACTIVIDADES" onclick="FAjax('./profesor/list_ejercicios_plan.php','salud','','post');"></td>
			</tr>
				<td valign="top"><div id="salud"></div></td>
			</tr>
        </table>
<?
}
?>