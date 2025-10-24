<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$usuario=$_SESSION["user_id"];

if($_POST['actualiza_clave']==1){
	$guarda_clave=setClaveUsuario($usuario,$_POST['clave0'],$_POST['clave1']);
	if($guarda_clave){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}
if(isset($_SESSION['esturiante_matriculado'])){

include("../aula/botones_retorno.php");
}
?>


<div class="row">
<h2>Contrase&ntilde;a.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos de contrase&ntilde;a.</legend>


				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				    Contrase&ntilde;a actual:
				    <input class="form-control" type="password" name="clave0" id="clave0">
				</div>

				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				    Contrase&ntilde;a nueva:</td>
					<input class="form-control" type="password" name="clave1" id="clave1">
				</div>

				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				    Repetir contrase&ntilde;a:
				    <input class="form-control" type="password" name="clave2" id="clave2">
				</div>

</div>
<div class="row">
				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				    <input name="actualiza_clave" type="hidden" value="0"><input class="button_send" name="ingreso_educacion" id="ingreso_educacion" type="button" value="GUARDAR DATOS" onClick="valida_guardar_clave(this.form);">
				</div>

</div>
