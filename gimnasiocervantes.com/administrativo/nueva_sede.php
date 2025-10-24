<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$sede="";
$action="valida_guardar_sede";

if($_POST['actualiza_sede']==1){

	$inserta=setSede($_POST['nombre'],$_POST['descripcion'],$_POST['direccion'],$_POST['lat'],$_POST['lng']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if($_POST['actualiza_sede']==2){

	$inserta=updSede($_POST['nombre'],$_POST['descripcion'],$_POST['direccion'],$_POST['lat'],$_POST['lng'],$_POST['id']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if(isset($_POST['id_sede']) || isset($_GET['id_sede'])){

	$id_sede=$_REQUEST['id_sede'];
	$existe=getSedeId($id_sede);
	$action="valida_actualiza_sede";
	?>
	<input class="form-control" type="hidden" name="id" id="id" value="<?=$id_sede?>">
	<?
	if($existe){
		$nombre=$existe['nombre'];
		$descripcion=$existe['descripcion'];
		$direccion=$existe['direccion'];
		$lat=$existe['lat'];
		$lng=$existe['lng'];
	}
}
?>
<h2>Creacion de nueva Sede.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos de la Sede.</legend>
        <div class="row">
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            	Nombre
				<input class="form-control" type="text" name="nombre" id="nombre" value="<?=$nombre?>">
			</div>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				Latitud
                <input class="form-control" type="number" name="lat" id="lat" value="<?=$lat?>">
			</div>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				Longitud
                <input class="form-control" type="number" name="lng" id="lng" value="<?=$lng?>">
			</div>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				Dirección
                <input class="form-control" type="text" name="direccion" id="direccion" value="<?=$direccion?>">
			</div>
		</div>
        <div class="row">
			<div class="col-xs-12">
				Descripción
                <textarea class="form-control" type="text" name="descripcion" id="descripcion"><?=$descripcion?></textarea>
			</div>
		</div>
	</fieldset>
        <table width="100%" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza_sede" id="actualiza_sede" type="hidden" value="0"><input class="button_send" name="ingreso_sede" id="ingreso_sede" type="button" value="GUARDAR DATOS" onClick="<?=$action?>(this.form);"></td>
			</tr>
			<tr>
				<td align="center"><div id="list_sedes"><? include('./listado_sedes.php');?></div></td>
			</tr>
        </table>
