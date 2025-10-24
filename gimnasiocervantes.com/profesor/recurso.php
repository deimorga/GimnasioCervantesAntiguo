<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$campo="";

if($_GET['elimina_recurso']){
	$elimina=delPlanGestor("tbl_recurso", "id_recurso", $_GET['id_recurso']);
	if($elimina){
		echo "<script>alert('Se elimino correctamente el recurso...');</script>";
	}else{
		echo "<script>alert('No se elimino correctamente el recurso...');</script>";
	}
}

if($_POST['actualiza_recurso']==1){

	$inserta=insertaPlanGestor("tbl_recurso", "recurso", $_REQUEST['descripcion_recurso'], $_SESSION['plan_gestor']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if($_GET['edita_recurso']==1){
	$edita=seleccionaPlanGestorId("tbl_recurso", "id_recurso", $_GET['id_recurso']);
	if($edita){
		$id_campo=$_GET['id_recurso'];
		$campo=$edita['recurso'];
		?><input type="hidden" name="id_old" id="id_old" value="<?=$id_campo?>" /><?
	}else{
		echo "<script>alert('Problemas al buscar el estandar a editar...');</script>";
	}
}

if($_POST['actualiza_edita_recurso']==1){

	$inserta=actualizaPlanGestor("recurso", $_REQUEST['descripcion_recurso'], $_REQUEST['id_old']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

$dato=seleccionaPlanGestor("tbl_recurso", $_SESSION['plan_gestor']);

?>
<h2>HABILIDADES(ABILITIES).</h2>

        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;" width="90%">
			<tr>
				<td class="texte2">Descripcion:</td>
			</tr>
            <tr>
 				<td><textarea class="form-control" name="descripcion_recurso" id="descripcion_recurso"><?=$campo?></textarea> *</td>
			</tr>
            <tr>
 				<td>
<?
if($_GET['edita_recurso']==1){
?>
              <input name="actualiza_edita_recurso" id="actualiza_edita_recurso" type="hidden" value="0" />
              <input class="button_send" name="edita_recurso" id="edita_recurso" type="button" value="GUARDAR DATOS" onclick="valida_edita_recurso(this.form);" />
              <?
}else{
?>
              <input name="actualiza_recurso" id="actualiza_recurso" type="hidden" value="0" />
              <input class="button_send" name="ingreso_recurso" id="ingreso_recurso" type="button" value="GUARDAR DATOS" onclick="valida_guardar_recurso(this.form);" />
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
				echo "* ".$dato[$i]['recurso']; ?>&nbsp;&nbsp;&nbsp;<a href='#' onclick="FAjax('./profesor/recurso.php?id_recurso=<?=$dato[$i]['id_recurso']?>&elimina_recurso=1','recurso_div','','post');">eliminar</a>
                |&nbsp;<a href='#' onclick="FAjax('./profesor/recurso.php?id_recurso=<?=$dato[$i]['id_recurso']?>&edita_recurso=1&descripcion=<?=$dato[$i]['recurso']?>','recurso_div','','post');">editar</a>|
                <br>
			<?
			}
			?>
            </strong>
            </td>
          </tr>
        </table>
<?
if($_GET['edita_recurso']==1){
	echo "<script>form.descripcion_recurso.focus();</script>";
}
?>
