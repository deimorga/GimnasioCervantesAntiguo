<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$campo="";

if($_GET['elimina_actividad']==1){
	$elimina=delPlanGestor("tbl_actividad", "id_actividad", $_GET['id_actividad']);
	if($elimina){
		echo "<script>alert('Se elimino correctamente la actividad...');</script>";
	}else{
		echo "<script>alert('No se elimino correctamente la actividad...');</script>";
	}
}

if($_POST['actualiza_actividad']==1){

	$inserta=insertaPlanGestor("tbl_actividad", "actividad", $_REQUEST['descripcion_actividad'], $_SESSION['plan_gestor']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if($_GET['edita_actividad']==1){
	$edita=seleccionaPlanGestorId("tbl_actividad", "id_actividad", $_GET['id_actividad']);
	if($edita){
		$id_campo=$_GET['id_actividad'];
		$campo=$edita['actividad'];
		?><input type="hidden" name="id_old" id="id_old" value="<?=$id_campo?>" /><?
	}else{
		echo "<script>alert('Problemas al buscar el estandar a editar...');</script>";
	}
}

if($_POST['actualiza_edita_actividad']==1){

	$inserta=actualizaPlanGestor("actividad", $_REQUEST['descripcion_actividad'], $_REQUEST['id_old']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

$dato=seleccionaPlanGestor("tbl_actividad", $_SESSION['plan_gestor']);

?>
<h2>COMPONENTS (Componentes).</h2>
        <table width="90%" cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Descripcion:</td>
			</tr>
			<tr>
				<td><textarea class="form-control" name="descripcion_actividad" id="descripcion_actividad"><?=$campo?></textarea> *</td>
			</tr>
			<tr>
				<td align="center">
<?
if($_GET['edita_actividad']==1){
?>
                <input name="actualiza_edita_actividad" id="actualiza_edita_actividad" type="hidden" value="0"><input class="button_send" name="edita_actividad" id="edita_actividad" type="button" value="GUARDAR DATOS" onClick="valida_edita_actividad(this.form);">
<?
}else{
?>
                <input name="actualiza_actividad" id="actualiza_actividad" type="hidden" value="0"><input class="button_send" name="ingreso_actividad" id="ingreso_actividad" type="button" value="GUARDAR DATOS" onClick="valida_guardar_actividad(this.form);">
<?
}
?>                
                </td>
			</tr>
          <tr>
            <td class="texte2">
            <h3>Datos ya registrados:</h3>
            <strong>
			<?
            for($i=0;$i<count($dato);$i++){
				echo "* ".$dato[$i]['actividad']; ?>&nbsp;&nbsp;&nbsp;<a href='#' onclick="FAjax('./profesor/actividad.php?id_actividad=<?=$dato[$i]['id_actividad']?>&elimina_actividad=1','actividad_div','','post');">eliminar</a>
                |&nbsp;<a href='#' onclick="FAjax('./profesor/actividad.php?id_actividad=<?=$dato[$i]['id_actividad']?>&edita_actividad=1&descripcion=<?=$dato[$i]['actividad']?>','actividad_div','','post');">editar</a>|
                <br>
			<?
			}
			?>
            </strong>
            </td>
          </tr>
        </table>
<?
if($_GET['edita_actividad']==1){
	echo "<script>form.descripcion_actividad.focus();</script>";
}
?>
