<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$campo="";

if($_GET['elimina_contenido']==1){
	$elimina=delPlanGestor("tbl_contenido", "id_contenido", $_GET['id_contenido']);
	if($elimina){
		echo "<script>alert('Se elimino correctamente el contenido...');</script>";
	}else{
		echo "<script>alert('No se elimino correctamente el contenido...');</script>";
	}
}

if($_POST['actualiza_contenido']==1){

	$inserta=insertaPlanGestor("tbl_contenido", "contenido", $_REQUEST['descripcion_contenido'], $_SESSION['plan_gestor']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if($_GET['edita_contenido']==1){
	$edita=seleccionaPlanGestorId("tbl_contenido", "id_contenido", $_GET['id_contenido']);
	if($edita){
		$id_campo=$_GET['id_contenido'];
		$campo=$edita['contenido'];
		?><input type="hidden" name="id_old" id="id_old" value="<?=$id_campo?>" /><?
	}else{
		echo "<script>alert('Problemas al buscar el estandar a editar...');</script>";
	}
}

if($_POST['actualiza_edita_contenido']==1){

	$inserta=actualizaPlanGestor("contenido", $_REQUEST['descripcion_contenido'], $_REQUEST['id_old']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

$dato=seleccionaPlanGestor("tbl_contenido", $_SESSION['plan_gestor']);

?>
<h2>Contents(contenido).</h2>

        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;" width="90%">
			<tr>
				<td class="texte2">Descripcion:</td>
			</tr>
			<tr>
				<td><textarea class="form-control" name="descripcion_contenido" id="descripcion_contenido"><?=$campo?></textarea> *</td>
			</tr>
			<tr>
				<td class="texte2">
<?
if($_GET['edita_contenido']==1){
?>
              <input name="actualiza_edita_contenido" id="actualiza_edita_contenido" type="hidden" value="0" />
              <input class="button_send" name="edita_contenido" id="edita_contenido" type="button" value="GUARDAR DATOS" onclick="valida_edita_contenido(this.form);" />
              <?
}else{
?>
              <input name="actualiza_contenido" id="actualiza_contenido" type="hidden" value="0" />
              <input class="button_send" name="ingreso_contenido" id="ingreso_contenido" type="button" value="GUARDAR DATOS" onclick="valida_guardar_contenido(this.form);" />
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
				echo "* ".$dato[$i]['contenido']; ?>&nbsp;&nbsp;&nbsp;<a href='#' onclick="FAjax('./profesor/contenido.php?id_contenido=<?=$dato[$i]['id_contenido']?>&elimina_contenido=1','contenido_div','','post');">eliminar</a>
                |&nbsp;<a href='#' onclick="FAjax('./profesor/contenido.php?id_contenido=<?=$dato[$i]['id_contenido']?>&edita_contenido=1&descripcion=<?=$dato[$i]['contenido']?>','contenido_div','','post');">editar</a>|
                <br>
			<?
			}
			?>
            </strong>
            </td>
          </tr>
        </table>
<?
if($_GET['edita_contenido']==1){
	echo "<script>form.descripcion_contenido.focus();</script>";
}
?>
