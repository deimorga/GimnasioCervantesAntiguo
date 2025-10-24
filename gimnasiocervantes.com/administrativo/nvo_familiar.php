<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$identificacion_familiar="";
$nombre="";
$parentesco="";
$ocupacion="";
$direccion="";
$telefono="";
$celular="";
$correo="";

if($_POST['actualiza_familiar']==1){

	$inserta=setFamiliar($_SESSION["alumno_ingreso"],$_POST['identificacion_familiar'],$_POST['nombre_familiar'],$_POST['parentesco_familiar'],$_POST['ocupacion_familiar'],$_POST['direccion_familiar'],$_POST['telefono_familiar'],$_POST['celular_familiar'],$_POST['correo_familiar']);
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

        <div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			    Identificacion:</br><input class="form-control" type="text" name="identificacion_familiar" id="identificacion_familiar" onKeyPress="return numeros(event);" onblur="FAjax('./administrativo/nvo_familiar.php','familia','','post');" value="<?=$identificacion_familiar?>"> *
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			    Nombre completo:</br><input class="form-control" type="text" name="nombre_familiar" id="nombre_familiar" value="<?=$nombre?>"> *
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			    Ocupaci&oacute;n:</br><input class="form-control" type="text" name="ocupacion_familiar" id="ocupacion_familiar" value="<?=$ocupacion?>"> *
			</div>
		</div>
        <div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			    Parentesco del Alumno:</br><select name="parentesco_familiar" class="form-control" id="parentesco_familiar" >
                	<option value="">Seleccione...</option>
                    <option value="Padre" <? if($parentesco=="Padre"){ echo "selected='selected'";}?> >Padr&eacute;</option>
                    <option value="Madre" <? if($parentesco=="Madre"){ echo "selected='selected'";}?> >Madr&eacute;</option>
                    <option value="Acudiente" <? if($parentesco=="Acudiente"){ echo "selected='selected'";}?> >Acudiente</option>
                </select> *
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			    Direccion:</br><input class="form-control" type="text" name="direccion_familiar" id="direccion_familiar" value="<?=$direccion?>">
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			    Telefono (fijo):</br><input class="form-control" type="text" name="telefono_familiar" id="telefono_familiar" value="<?=$telefono?>">
			</div>
		</div>
        <div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			    Celular:</br><input class="form-control" type="text" name="celular_familiar" id="celular_familiar" value="<?=$celular?>">
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			    Correo electronico:</br><input class="form-control" type="text" name="correo_familiar" id="correo_familiar" value="<?=$correo?>">
			</div>
		</div>
        <div class="row">

			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			    <input name="actualiza_familiar" id="actualiza_familiar" type="hidden" value="0"><input class="btn-sm btn-primary" name="ingreso_familiar" id="ingreso_familiar" type="button" value="GUARDAR DATOS" onClick="valida_gardar_familiar(this.form);">
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><input class="btn-sm btn-primary" name="listado_familiar" id="listado_familiar" type="button" value="LISTADO DE FAMILIARES" onClick="FAjax('./administrativo/listado_familiares.php','list_familiares','','post');">
			</div>
		</div>
        <div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div id="list_familiares"></div>
			</div>
		</div>