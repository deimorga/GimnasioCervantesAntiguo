				<h2> Ingreso de formatos.</h2>

					<div id="form_contact2">
						<strong>Datos de la formatos</strong><br />
						<br />
							<fieldset>
								<legend class="texte_legende">DATOS
								</legend><table cellpadding=5 cellspacing=0 border="0">
								<tr>
									<td class="texte">Nombre:</td>
									<td align="left"><input class="champ" type="text" name="tema" id="tema"></td>
								</tr>
								</table>
							</fieldset>
							<br>
					
						<strong>Datos del formatos</strong><br />
						<br />
							<fieldset>
								<legend class="texte_legende">CARGA DE ARCHIVO
								</legend><table cellpadding=5 cellspacing=0 border="0">
								<tr>
									<td class="texte">Formato:</td>
									<td><input type="file" name="imagen_formato" id="imagen"></td>
								</tr>
								</table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                </table>

							</fieldset>
							<br>
							<table width="380" border="0" cellpadding=0 cellspacing=0>
							<tr>
								<td colspan="2" align="center"><input class="button_send" name="carga_formato" type="submit" value="GUARDAR" onclick="return valida_formato(this.form);"></td>
							</tr>
							</table>
</div>
							
				</div>
					
<div class="clear"></div>

<div>
<?
include_once("./formatos.php");
?>
</div>