<?
session_start();
?>
        <table width="100%" cellspacing=0 border="0">
			<tr>
				<td align="right" class="subenlace" valign="top"><input class="button_send2" name="familia_alumno" id="familia_alumno" type="button" value="MIEMBROS DE LA FAMILIA" onclick="FAjax('./administrativo/nvo_familiar.php','familia','','post');"></td>
			</tr>
				<td valign="top"><div id="familia"></div></td>
			</tr>
            <?
            if($_SESSION["user_tipo"]==1){
			?>
			<tr>
				<td align="right" class="subenlace" valign="top"><input class="button_send2" name="fotografia" id="fotografia" type="button" value="FOTOGRAFIA" onclick="window.open('./web_cam/jpegcam/htdocs/test.html');"></td>
			</tr>
				<td valign="top"><div id="foto"></div></td>
			</tr>
			<tr>
				<td align="right" class="subenlace" valign="top"><input class="button_send2" name="candidatura_alumno" id="candidatura_alumno" type="button" value="CANDIDATURA DE ALUMNO" onclick="FAjax('./administrativo/nvo_candidato.php','candidatura','','post');"></td>
			</tr>
				<td valign="top"><div id="candidatura"></div></td>
			</tr>
			<tr>
				<td align="right" class="subenlace" valign="top"><input class="button_send2" name="impresion" id="impresion" type="button" value="FORMATO IMPRESION" onclick="window.open('./administrativo/datos_alumno.php');"></td>
			</tr>
            <?
			}
			?>
        </table>
