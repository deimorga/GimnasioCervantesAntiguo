<?
session_start();

include_once("./funciones/funciones.php");
include_once("./funciones/conexion.php");

$identificacion_familiar="";
$nombre="";
$parentesco="";
$ocupacion="";
$direccion="";
$telefono="";
$celular="";
$correo="";

if($_POST['actualiza_familiar']==1){

	$inserta=setFamiliar($_SESSION["alumno_registro"],$_POST['identificacion_familiar'],$_POST['nombre_familiar'],$_POST['parentesco_familiar'],$_POST['ocupacion_familiar'],$_POST['direccion_familiar'],$_POST['telefono_familiar'],$_POST['celular_familiar'],$_POST['correo_familiar']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if(isset($_POST['identificacion_familiar']) || isset($_GET['identificacion_familiar'])){

	if($_GET["edita"]==1){
		$identificacion_familiar=$_GET['identificacion_familiar'];
	}else{
		$identificacion_familiar=$_POST['identificacion_familiar'];
	}
	$existe=getFamiliarId($identificacion_familiar);
	if($existe){
		$nombre=$existe['nombre_acudiente'];
		$parentesco=$existe['parentezco'];
		$ocupacion=$existe['empresa_acudiente'];
		$direccion=$existe['direccion_acudiente'];
		$telefono=$existe['tel_1'];
		$celular=$existe['tel_2'];
		$correo=$existe['email_acudiente'];
	}

}
?>
<h2>Miembros de la familia.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos del acudiente.</legend>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Identificacion:</td>
				<td><input class="champ2" type="text" name="identificacion_familiar" id="identificacion_familiar" onKeyPress="return numeros(event);" onblur="FAjax('./nvo_familiar.php','familia','','post');" value="<?=$identificacion_familiar?>"> *</td>
			</tr>
			<tr>
				<td class="texte2">Nombre completo:</td>
				<td><input class="champ2" type="text" name="nombre_familiar" id="nombre_familiar" value="<?=$nombre?>"> *</td>
			</tr>
			<tr>
				<td class="texte2">Ocupaci&oacute;n:</td>
				<td><input class="champ2" type="text" name="ocupacion_familiar" id="ocupacion_familiar" value="<?=$ocupacion?>"> *</td>
			</tr>
			<tr>
				<td class="texte2">Parentesco del Alumno:</td>
				<td><select name="parentesco_familiar" class="champ2" id="parentesco_familiar" >
                	<option value="">Seleccione...</option>
                    <option value="Padre" <? if($parentesco=="Padre"){ echo "selected='selected'";}?> >Padr&eacute;</option>
                    <option value="Madre" <? if($parentesco=="Madre"){ echo "selected='selected'";}?> >Madr&eacute;</option>
                    <option value="Acudiente" <? if($parentesco=="Acudiente"){ echo "selected='selected'";}?> >Acudiente</option>
                </select> *
                </td>
			</tr>
			<tr>
				<td class="texte2">Direccion:</td>
				<td><input class="champ2" type="text" name="direccion_familiar" id="direccion_familiar" value="<?=$direccion?>"></td>
			</tr>
			<tr>
				<td class="texte2">Telefono (fijo):</td>
				<td><input class="champ2" type="text" name="telefono_familiar" id="telefono_familiar" value="<?=$telefono?>"></td>
			</tr>
			<tr>
				<td class="texte2">Celular:</td>
				<td><input class="champ2" type="text" name="celular_familiar" id="celular_familiar" value="<?=$celular?>"></td>
			</tr>
			<tr>
				<td class="texte2">Correo electronico:</td>
				<td><input class="champ2" type="text" name="correo_familiar" id="correo_familiar" value="<?=$correo?>"></td>
			</tr>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza_familiar" id="actualiza_familiar" type="hidden" value="0"><input class="button_send" name="ingreso_familiar" id="ingreso_familiar" type="button" value="GUARDAR DATOS" onClick="valida_gardar_registro(this.form);">&nbsp;&nbsp;&nbsp;<input class="button_send" name="listado_familiar" id="listado_familiar" type="button" value="LISTADO DE FAMILIARES" onClick="FAjax('./listado_familiares.php','list_familiares','','post');"></td>
			</tr>
			<tr>
				<td align="center"><div id="list_familiares"></div></td>
			</tr>
        </table>
