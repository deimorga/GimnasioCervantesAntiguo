<?
include_once ("../funciones/conexion.php");
include_once ("../funciones/funciones.php");
?>				<h2> Ingreso de circulares.</h2>

					<div id="form_contact2">
						<strong>Datos de la circulara</strong><br />
						<br />
							<fieldset>
								<legend class="texte_legende">DATOS
								</legend><table cellpadding=5 cellspacing=0 border="0">
								<tr>
									<td class="texte">Tema :</td>
									<td align="left"><input class="champ" type="text" name="tema" id="tema"></td>
								</tr>
								<tr>
									<td class="texte">Dirigido a:</td>
									<td align="left"><select name="dirigida" class="champ2" id="dirigida" >
                	<option value="">Seleccione...</option>
<?
$grupo=getGrupos();
for($i=0;$i<count($grupo);$i++){?>
                    <option value="<?=$grupo[$i]["id_grupo"]?>" ><?=$grupo[$i]["nombre_grupo"]?></option>
<? }?>
                </select> *</td>
								</tr>
								</table>
							</fieldset>
							<br>
					
						<strong>Datos de la guia</strong><br />
						<br />
							<fieldset>
								<legend class="texte_legende">CARGA DE ARCHIVO
								</legend><table cellpadding=5 cellspacing=0 border="0">
								<tr>
									<td class="texte">GUIA:</td>
									<td><input type="file" name="imagen" id="imagen"></td>
								</tr>
								</table>

							</fieldset>
							<br>
							<table width="380" border="0" cellpadding=0 cellspacing=0>
							<tr>
								<td colspan="2" align="center"><input class="button_send" name="carga_guia" type="submit" value="GUARDAR" onclick="return valida_circular(this.form);"></td>
							</tr>
							</table>
</div>
							
				</div>
					
<div class="clear"></div>
