<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$identificacion_profesor="";
$nombre="";
$telefono="";
$celular="";
$direccion="";
$correo="";

if($_POST['actualiza_profesor']==1){

	$inserta=setProfesor($_POST['identificacion_profesor'],$_POST['nombre_profesor'],$_POST['telefono_profesor'],$_POST['celular_profesor'],$_POST['direccion_profesor'],$_POST['correo_profesor']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if(isset($_POST['identificacion_profesor']) || isset($_GET['identificacion_profesor'])){
	//echo "Endro!!!!".$_GET['identificacion_profesor'];
	$identificacion_profesor=$_REQUEST['identificacion_profesor'];
	$existe=getProfesorId($identificacion_profesor);
	if($existe){
		$nombre=$existe['nombre_profesor'];
		$telefono=$existe['tel_1'];
		$celular=$existe['tel_2'];
		$direccion=$existe['direccion_profesor'];
		$correo=$existe['email_profesor'];
	}

}
?>
<h2>Personal Docente.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos del Profesor.</legend>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Identificacion:</td>
				<td><input class="champ2" type="text" name="identificacion_profesor" id="identificacion_profesor" onKeyPress="return numeros(event);" onblur="FAjax('./administrativo/nuevo_profesor.php','area_trabajo','','post');" value="<?=$identificacion_profesor?>"> *</td>
			</tr>
			<tr>
				<td class="texte2">Nombre completo:</td>
				<td><input class="champ2" type="text" name="nombre_profesor" id="nombre_profesor" value="<?=$nombre?>"> *</td>
			</tr>
			<tr>
				<td class="texte2">Telefono (fijo):</td>
				<td><input class="champ2" type="text" name="telefono_profesor" id="telefono_profesor" value="<?=$telefono?>"> *</td>
			</tr>
			<tr>
				<td class="texte2">Celular:</td>
				<td><input class="champ2" type="text" name="celular_profesor" id="celular_profesor" value="<?=$celular?>"></td>
			</tr>
			<tr>
				<td class="texte2">Direccion:</td>
				<td><input class="champ2" type="text" name="direccion_profesor" id="direccion_profesor" value="<?=$direccion?>"></td>
			</tr>
			<tr>
				<td class="texte2">Correo electronico:</td>
				<td><input class="champ2" type="text" name="correo_profesor" id="correo_profesor" value="<?=$correo?>"> *</td>
			</tr>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza_profesor" id="actualiza_profesor" type="hidden" value="0"><input class="button_send" name="ingreso_profesor" id="ingreso_profesor" type="button" value="GUARDAR DATOS" onClick="valida_guardar_profesor(this.form);"></td>
			</tr>
			<tr>
				<td align="center"><div id="list_familiares"></div></td>
			</tr>
        </table>
