<?
session_start();
?>
        <table width="100%" cellspacing=0 border="0">
			<tr>
				<td align="right" class="subenlace" valign="top"><input class="button_send2" name="familia_alumno" id="familia_alumno" type="button" value="MIEMBROS DE LA FAMILIA" onclick="FAjax('./nvo_familiar.php','familia','','post');"></td>
			</tr>
				<td valign="top"><div id="familia"></div></td>
			</tr>
<!--
			<tr>
				<td align="right" class="subenlace" valign="top"><input class="button_send2" name="dato" id="dato" type="button" value="INFORMACIÓN ACADÉMICA" onclick="FAjax('./dato_academico.php','academico','','post');"></td>
			</tr>
				<td valign="top"><div id="academico"></div></td>
			</tr>
-->
			<tr>
				<td align="right" class="subenlace" valign="top"><input class="button_send2" name="impresion" id="impresion" type="button" value="ACEPTAR" onclick="FAjax('./manual.php','contenido_usuario','','post');"></td>
			</tr>
        </table>
