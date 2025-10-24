<?
session_start();
include_once ("./funciones/conexion.php");
include_once ("./funciones/funciones.php");

if($_POST["ingreso_pin"]){
	$id=$_POST["identificacion"];
	$pin=$_POST["pin"];
	
	$ingresa=getPin($id,$pin);
	if($ingresa){
		$_SESSION["alumno_registro"]=$id;
		$_SESSION["alumno_pin"]=$pin;
		echo "<script>FAjax('./registro_alumno.php','contenido_usuario','','post');</script>";
	}else{
		echo "<script>alert('Identificacion o Pin invalidos...');</script>";	
	}
}
?>
	<h2>Ingreso Seguro.</h2>
	<h4>NOTA: Por este formulario ingresan únicamente los estudiantes nuevos a quienes se les entrego número de pin, para los antiguos el ingreso es por la opción de “INGRESO SEGURO”.</h4>
	<fieldset>
		<legend class="texte_legende">Datos de usuario</legend>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td class="texte">Identificacion :</td>
            </tr>
            <tr>
				<td><input class="champ" type="text" name="identificacion" id="identificacion"></td>
			</tr>
			<tr>
				<td class="texte">Pin :</td>
            </tr>
            <tr>
				<td><input class="champ" type="text" name="pin" id="pin"></td>
			</tr>
		</table>
	</fieldset>
	<input class="button_send" name="ingreso_pin" id="ingreso_pin" type="button" value="INGRESAR" onclick="FAjax('./registro.php','contenido_usuario','','post');">