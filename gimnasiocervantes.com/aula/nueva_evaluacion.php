<?
include_once ("../funciones/conexion.php");
include_once ("../funciones/funciones.php");

include("botones_retorno.php");

?>				<h2> Ingreso de evaluaciones.</h2>

					<div id="form_contact2">
						<strong>Datos de la evaluaci&oacute;n</strong><br />
						<br />
							<fieldset>
								<legend class="texte_legende">DATOS
								</legend><table cellpadding=5 cellspacing=0 border="0">
								<tr>
									<td class="texte">Fecha ecaluaci&oacute;n :</td>
									<td align="left"><input class="champ2" style="width:100px; height:15" name="fecha" id="fecha" onFocus='Calendar.setup({inputField:"fecha",ifFormat:"%Y-%m-%d",button:"calen"});'
  readonly="true"/></td>
								</tr>
								<tr>
									<td class="texte">Grupo:</td>
									<td align="left"><select name="grupo" class="champ2" id="grupo" >
                	<option value="">Seleccione...</option>
<?
$grupo=getGrupos();
for($i=0;$i<count($grupo);$i++){?>
                    <option value="<?=$grupo[$i]["id_grupo"]?>" ><?=$grupo[$i]["nombre_grupo"]?></option>
<? }?>
                </select> *</td>
								</tr>
								<tr>
									<td class="texte">Asignatura:</td>
									<td align="left"><select name="asignatura" class="champ2" id="asignatura" >
                	<option value="">Seleccione...</option>
<?
$asignatura=getAsignaturas();
for($i=0;$i<count($asignatura);$i++){?>
                    <option value="<?=$asignatura[$i]["id_asignatura"]?>" ><?=$asignatura[$i]["nombre_asignatura"]?></option>
<? }?>
                </select> *</td>
								</tr>
								</table>
							</fieldset>
							<br>
					
						<strong>Datos de la evaluaci&oacute;n</strong><br />
						<br />
							<fieldset>
								<legend class="texte_legende">CARGA DE ARCHIVO
								</legend><table cellpadding=5 cellspacing=0 border="0">
								<tr>
									<td class="texte">EVALUACI&Oacute;N:</td>
									<td><input type="file" name="imagen_evaluacion" id="imagen_evaluacion"></td>
								</tr>
								</table>

							</fieldset>
							<br>
							<table width="380" border="0" cellpadding=0 cellspacing=0>
							<tr>
								<td colspan="2" align="center"><input class="button_send" name="carga_evaluacion" type="submit" value="GUARDAR" onclick="return valida_evaluacion(this.form);"></td>
							</tr>
							</table>
</div>
							
				</div>
					
<div class="clear"></div>
