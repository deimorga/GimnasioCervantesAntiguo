<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$campo="";

if($_GET['elimina_estandar']==1){
	$elimina=delPlanGestor("tbl_estandar", "id_estandar", $_GET['id_estandar']);
	if($elimina){
		echo "<script>alert('Se elimino correctamente el estandar...');</script>";
	}else{
		echo "<script>alert('No se elimino correctamente el estandar...');</script>";
	}
}

if($_GET['edita_estandar']==1){
	$edita=seleccionaPlanGestorId("tbl_estandar", "id_estandar", $_GET['id_estandar']);
	if($edita){
		$id_campo=$_GET['id_estandar'];
		$campo=$edita['estandar'];
		?><input type="hidden" name="id_old" id="id_old" value="<?=$id_campo?>" /><?
	}else{
		echo "<script>alert('Problemas al buscar el estandar a editar...');</script>";
	}
}

if($_POST['actualiza_estandar']==1){

	$inserta=insertaPlanGestor("tbl_estandar", "estandar", $_REQUEST['descripcion'], $_SESSION['plan_gestor']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if($_POST['actualiza_edita_estandar']==1){

	$inserta=actualizaPlanGestor("estandar", $_REQUEST['descripcion'], $_REQUEST['id_old']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

$estandar=seleccionaPlanGestor("tbl_estandar", $_SESSION['plan_gestor']);

?>
<h2>EJES(AXES).</h2>

        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;" width="90%">
			<tr>
				<td class="texte2">Descripcion:</td>
			</tr>
			<tr>
				<td><textarea class="form-control" name="descripcion" id="descripcion"><?=$campo?></textarea> *</td>
			</tr>
			<tr>
				<td>
<?
if($_GET['edita_estandar']==1){
?>
              <input name="actualiza_edita_estandar" id="actualiza_edita_estandar" type="hidden" value="0" />
              <input class="button_send" name="ingreso_edita_estandar" id="ingreso_edita_estandar" type="button" value="GUARDAR DATOS" onclick="valida_edita_estandar(this.form);" />
              <?
}else{
?>
              <input name="actualiza_estandar" id="actualiza_estandar" type="hidden" value="0" />
              <input class="button_send" name="ingreso_estandar" id="ingreso_estandar" type="button" value="GUARDAR DATOS" onclick="valida_guardar_estandar(this.form);" />
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
            for($i=0;$i<count($estandar);$i++){
				echo "* ".$estandar[$i]['estandar']; ?>
                &nbsp;&nbsp;&nbsp;<a href='#' onclick="FAjax('./profesor/estandar.php?id_estandar=<?=$estandar[$i]['id_estandar']?>&elimina_estandar=1','estandar','','post');">eliminar</a>
                |&nbsp;<a href='#' onclick="FAjax('./profesor/estandar.php?id_estandar=<?=$estandar[$i]['id_estandar']?>&descripcion=<?=$estandar[$i]['estandar']?>&edita_estandar=1','estandar','','post');">editar</a>|
                <br>
			<?
			}
			?>
            </strong>
            </td>
          </tr>
        </table>
<?
if($_GET['edita_estandar']==1){
	echo "<script>form.descripcion.focus();</script>";
}
?>
