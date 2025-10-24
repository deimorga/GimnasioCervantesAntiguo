				<h2> Ingreso de noticias.</h2>

					<div id="form_contact2">
						<strong>Datos de la noticia</strong><br />
						<br />
							<fieldset>
								<legend class="texte_legende">DATOS
								</legend><table width="100%" cellpadding=5 cellspacing=0 border="0">
								<tr>
									<td class="texte">Titulo :</td>
								</tr>
								<tr>
									<td align="left"><textarea class="hidden" name="nombre" id="nombre"></textarea></td>
								</tr>
								<tr>
									<td class="texte">Descripci&oacute;n :</td>
								</tr>
								<tr>
									<td><textarea name="descripcion" class="hidden" cols="40" rows="70" id="descripcion"></textarea></td>
								</tr>
								</table>
							</fieldset>
					
						<strong>Datos de la imagen</strong><br />
						<br />
							<fieldset>
								<legend class="texte_legende">CARGA DE IMAGENES
								</legend><table cellpadding=5 cellspacing=0 border="0">
								<tr>
									<td class="texte">Imagen :</td>
									<td><input type="file" name="imagen" id="imagen"></td>
								</tr>
								</table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td colspan="3" class="texte">Posicion de imagen:</td>
                                  </tr>
                                  <tr>
                                    <td><img src="./images/arriba.jpg" width="100" height="120" /><br/>Arriba <input name="posicion" type="radio" value="1" checked="checked" /></td>
                                    <td><img src="./images/medio.jpg" width="100" height="120" /><br/>Medio <input name="posicion" type="radio" value="2" /></td>
                                    <td><img src="./images/abajo.jpg" width="100" height="120" /><br/>Abajo <input name="posicion" type="radio" value="3" /></td>
                                  </tr>
                                </table>

							</fieldset>
							<br>
							<table width="380" border="0" cellpadding=0 cellspacing=0>
							<tr>
								<td align="center"><input class="button_send" name="carga_img_noticia" type="submit" value="GUARDAR" onclick="return valida_noticia(this.form);">
                                <a onClick="CKupdate();">Submit</a>
                                </td>
							</tr>
							</table>
</div>
							
				</div>
					
<div class="clear"></div>
    <script type="text/javascript">
		function CKupdate(){
			CKEDITOR.replace("nombre", {
					width: '100%',
					height: 50
				} );
			CKEDITOR.replace("descripcion", {
					width: '100%',
					height: 500
				} );
		}
    </script>
