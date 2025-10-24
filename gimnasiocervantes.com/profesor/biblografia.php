<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$campo="";

if($_GET['elimina_biblografia']==1){
	$elimina=delPlanGestor("tbl_biblografia", "id_biblografia", $_GET['id_biblografia']);
	if($elimina){
		echo "<script>alert('Se elimino correctamente la biblografia...');</script>";
	}else{
		echo "<script>alert('No se elimino correctamente la biblografia...');</script>";
	}
}

if($_POST['actualiza_biblografia']==1){

	$inserta=insertaPlanGestor("tbl_biblografia", "biblografia", $_REQUEST['descripcion_biblografia'], $_SESSION['plan_gestor']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if($_GET['edita_biblografia']==1){
	$edita=seleccionaPlanGestorId("tbl_biblografia", "id_biblografia", $_GET['id_biblografia']);
	if($edita){
		$id_campo=$_GET['id_biblografia'];
		$campo=$edita['biblografia'];
		?><input type="hidden" name="id_old" id="id_old" value="<?=$id_campo?>" /><?
	}else{
		echo "<script>alert('Problemas al buscar el estandar a editar...');</script>";
	}
}

if($_POST['actualiza_edita_biblografia']==1){

	$inserta=actualizaPlanGestor("biblografia", $_REQUEST['descripcion_biblografia'], $_REQUEST['id_old']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

$dato=seleccionaPlanGestor("tbl_biblografia", $_SESSION['plan_gestor']);

?>
<h2>BIBLOGRAFIA.</h2>

        <table width="100px" cellpadding="5" cellspacing="0" border="0">
          <tr>
            <td align="center"><?
if($_GET['edita_biblografia']==1){
?>
              <input name="actualiza_edita_biblografia" id="actualiza_edita_biblografia" type="hidden" value="0" />
              <input class="button_send" name="edita_biblografia" id="edita_biblografia" type="button" value="GUARDAR DATOS" onclick="valida_edita_biblografia(this.form);" />
              <?
}else{
?>
              <input name="actualiza_biblografia" id="actualiza_biblografia" type="hidden" value="0" />
              <input class="button_send" name="ingreso_biblografia" id="ingreso_biblografia" type="button" value="GUARDAR DATOS" onclick="valida_guardar_biblografia(this.form);" />
              <?
}
?></td>
          </tr>
        </table>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Descripcion:</td>
				<td><textarea class="champ3" name="descripcion_biblografia" id="descripcion_biblografia"><?=$campo?></textarea> *</td>
			</tr>
		</table>
        <table width="315px" border="0" cellspacing="0" cellpadding="0" style="margin:10px">
          <tr>
            <td>
            <h3>Datos ya registrados:</h3>
            <strong>
			<?
            for($i=0;$i<count($dato);$i++){
				echo "* ".$dato[$i]['biblografia']; ?>&nbsp;&nbsp;&nbsp;<a href='#' onclick="FAjax('./profesor/biblografia.php?id_biblografia=<?=$dato[$i]['id_biblografia']?>&elimina_biblografia=1','biblografia_div','','post');">eliminar</a>
                |&nbsp;<a href='#' onclick="FAjax('./profesor/biblografia.php?id_biblografia=<?=$dato[$i]['id_biblografia']?>&edita_biblografia=1&descripcion1=<?=$dato[$i]['biblografia']?>','biblografia_div','','post');">editar</a>|
                <br>
			<?
			}
			?>
            </strong>
            </td>
          </tr>
        </table>
<?
if($_GET['edita_biblografia']==1){
	echo "<script>form.descripcion_biblografia.focus();</script>";
}
?>
