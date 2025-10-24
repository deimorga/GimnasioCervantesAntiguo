<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$enlace="";
$action="valida_guardar_enlace";

if($_POST['actualiza_enlace']==1){

	$inserta=setEnlacePrincipal($_POST['nombre'],$_POST['descripcion']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if($_POST['actualiza_enlace']==2){

	$inserta=updEnlacePrincipal($_POST['nombre'],$_POST['descripcion'],$_POST['id']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if(isset($_POST['id_enlace_principal']) || isset($_GET['id_enlace_principal'])){

	$id_enlace=$_REQUEST['id_enlace_principal'];
	$existe=getEnlacePrincipalId($id_enlace);
	$action="valida_actualiza_enlace";
	?>
	<input class="form-control" type="hidden" name="id" id="id" value="<?=$id_enlace?>">
	<?
	if($existe){
		$nombre=$existe['nombre_enlace_principal'];
		$descripcion=$existe['descripcion_enlace_principal'];
	}
}
?>
<h2>Creacion de Menús Web.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos del Menú.</legend>
        <div class="row">
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            	Nombre
				<input class="form-control" type="text" name="nombre" id="nombre" value="<?=$nombre?>">
			</div>
			<div class="col-lg-9 col-md-8 col-sm-6 col-xs-12">
				Titulo/Ayuda
                <textarea class="form-control" type="text" name="descripcion" id="descripcion"><?=$descripcion?></textarea>
			</div>
		</div>
	</fieldset>
        <table width="100%" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza_enlace" id="actualiza_enlace" type="hidden" value="0"><input class="button_send" name="ingreso_enlace" id="ingreso_enlace" type="button" value="GUARDAR DATOS" onClick="<?=$action?>(this.form);"></td>
			</tr>
			<tr>
				<td align="center"><div id="list_enlace_principal"><? include('./listado_enlaces.php');?></div></td>
			</tr>
        </table>
