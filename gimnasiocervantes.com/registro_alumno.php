<?
session_start();

include_once("./funciones/funciones.php");
include_once("./funciones/conexion.php");

$id=$_SESSION["alumno_registro"];
$pin=$_SESSION["alumno_pin"];
$expedida="";
$nombre="";
$fecha="";
$lugar="";
$sangre="";
$seguro="";
$nombre_eps="";
$procedencia="";
$grado_alumno="";

if($_POST["actualiza"]==1){
	$inserta=setAlumnoPin($_POST['identificacion'],$_POST['expedida'],$_POST['nombre'],$_POST['fecha'],$_POST['lugar'],$_POST['sangre'],$_POST['seguro'],$_POST['nombre_eps'],$_POST['procedencia'],0,0);
	$_SESSION["alumno_ingreso"]=$_POST['identificacion'];
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if(isset($_SESSION["alumno_registro"])){
	//$id=$_REQUEST["identificacion"];
	$alumno=getAlumnoIdPin($id);
	if($alumno){
		$expedida=$alumno["lugar_expedicion"];
		$nombre=$alumno["nombre_alumno"];
		$fecha=$alumno["fecha_nacimiento"];
		$lugar=$alumno["lugar_nacimiento"];
		$sangre=$alumno["rh"];
		$seguro=$alumno["nivel_sisben"];
		$nombre_eps=$alumno["eps"];
		$procedencia=$alumno["procedencia"];
		$grado_alumno=$alumno["id_grado"];
		$_SESSION["alumno_ingreso"]=$id;
		$pension=$alumno['pension'];
	}
}
$grado=getGrados();
?>
<h2>Inscripci&oacute;n de alumnos.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos del alumno.</legend>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Identificacion:</td>
				<td><input value="<?=$id?>" readonly="readonly" class="champ2" type="text" name="identificacion" id="identificacion"> *</td>
			</tr>
			<tr>
				<td class="texte2">Pin:</td>
				<td><input value="<?=$pin?>" readonly="readonly" class="champ2" type="text" name="pin" id="pin"> *</td>
			</tr>
			<tr>
				<td class="texte2">Expedida:</td>
				<td><input value="<?=$expedida?>" class="champ2" type="text" name="expedida" id="expedida" /> *</td>
			</tr>
			<tr>
				<td class="texte2">Nombre del alumno:</td>
				<td><input class="champ2" type="text" name="nombre" id="nombre" value="<?=$nombre?>"> *</td>
			</tr>
			<tr>
				<td class="texte2">Lugar de nacimiento:</td>
				<td><input class="champ2" type="text" name="lugar" id="lugar" value="<?=$lugar?>"> *</td>
			</tr>
			<tr>
				<td class="texte2">Fecha de nacimiento:</td>
				<td><input class="champ2" style="width:100px; height:15" name="fecha" id="fecha" onFocus='Calendar.setup({inputField:"fecha",ifFormat:"%Y-%m-%d",button:"calen"});'
  readonly="true" value="<?=$fecha?>"/> *</td>
			</tr>
			<tr>
				<td class="texte2">RH:</td>
				<td><select class="champ2" name="sangre" id="sangre">
                	<option value="">Seleccione...</option>
                    <option value="A" <? if($sangre=="A"){ echo "selected='selected'";}?> >A/positivo</option>
                    <option value="A-" <? if($sangre=="A-"){ echo "selected='selected'";}?> >A/negativo</option>
                    <option value="B" <? if($sangre=="B"){ echo "selected='selected'";}?> >B/positivo</option>
                    <option value="B-" <? if($sangre=="B-"){ echo "selected='selected'";}?> >B/negativo</option>
                    <option value="AB" <? if($sangre=="AB"){ echo "selected='selected'";}?> >AB/positivo</option>
                    <option value="AB-" <? if($sangre=="AB-"){ echo "selected='selected'";}?> >AB/negativo</option>
                    <option value="O" <? if($sangre=="O"){ echo "selected='selected'";}?> >O/positivo</option>
                    <option value="O-" <? if($sangre=="O-"){ echo "selected='selected'";}?> >O/negativo</option>
                </select> *</td>
			</tr>
			<tr>
				<td class="texte2">Seguridad social:</td>
				<td><select name="seguro" class="champ2" id="seguro" >
                	<option value="">Seleccione...</option>
                    <option value="EPS" <? if($seguro=="EPS"){ echo "selected='selected'";}?> >EPS</option>
                    <option value="SISBEN" <? if($seguro=="SISBEN"){ echo "selected='selected'";}?> >SISBEN</option>
                    <option value="ARS" <? if($seguro=="ARS"){ echo "selected='selected'";}?> >ARS</option>
                </select> *</td>
			</tr>
			<tr>
				<td class="texte2">Nombre:</td>
				<td><input class="champ2" type="text" name="nombre_eps" id="nombre_eps" value="<?=$nombre_eps?>"></td>
			</tr>
			<tr>
				<td class="texte2">PROCEDENCIA(Ultima Institucion):</td>
				<td><input class="champ2" type="text" name="procedencia" id="procedencia" value="<?=$procedencia?>"></td>
			</tr>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza" id="actualiza" type="hidden" value="0" /><input class="button_send" name="ingreso_alumno" id="ingreso_alumno" type="button" value="ACTUALIZAR INFORMACION" onclick="valida_guardar_registro(this.form);"></td>
			</tr>
			<tr>
				<td align="center"><div id="info"><? include_once("info_alumno.php");?></div></td>
			</tr>
        </table>

