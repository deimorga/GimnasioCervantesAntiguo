<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$campo="";

if($_GET['elimina_dificultad']==1){
	$elimina=delPlanGestor("tbl_dificultad", "id_dificultad", $_GET['id_dificultad']);
	if($elimina){
		echo "<script>alert('Se elimino correctamente la dificultad...');</script>";
	}else{
		echo "<script>alert('No se elimino correctamente la dificultad...');</script>";
	}
}

if($_POST['actualiza_dificultad']==1){

	$inserta=insertaPlanGestor("tbl_dificultad", "dificultad", $_REQUEST['descripcion_dificultad'], $_SESSION['plan_gestor']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if($_GET['edita_dificultad']==1){
	$edita=seleccionaPlanGestorId("tbl_dificultad", "id_dificultad", $_GET['id_dificultad']);
	if($edita){
		$id_campo=$_GET['id_dificultad'];
		$campo=$edita['dificultad'];
		?><input type="hidden" name="id_old" id="id_old" value="<?=$id_campo?>" /><?
	}else{
		echo "<script>alert('Problemas al buscar el estandar a editar...');</script>";
	}
}

if($_POST['actualiza_edita_dificultad']==1){

	$inserta=actualizaPlanGestor("dificultad", $_REQUEST['descripcion_dificultad'], $_REQUEST['id_old']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

$dato=seleccionaPlanGestor("tbl_dificultad", $_SESSION['plan_gestor']);

?>
<h2>COMPETENCIAS CIUDADANAS.</h2>

        <table width="100px" cellpadding="5" cellspacing="0" border="0">
          <tr>
            <td align="center"><?
if($_GET['edita_dificultad']==1){
?>
              <input name="actualiza_edita_dificultad" id="actualiza_edita_dificultad" type="hidden" value="0" />
              <input class="button_send" name="edita_dificultad" id="edita_dificultad" type="button" value="GUARDAR DATOS" onclick="valida_edita_dificultad(this.form);" />
              <?
}else{
?>
              <input name="actualiza_dificultad" id="actualiza_dificultad" type="hidden" value="0" />
              <input class="button_send" name="ingreso_dificultad" id="ingreso_dificultad" type="button" value="GUARDAR DATOS" onclick="valida_guardar_dificultad(this.form);" />
              <?
}
?></td>
          </tr>
        </table>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Descripcion:</td>
				<td><textarea class="champ3" name="descripcion_dificultad" id="descripcion_dificultad"><?=$campo?></textarea> *</td>
			</tr>
		</table>
        <table width="315px" border="0" cellspacing="0" cellpadding="0" style="margin:10px">
          <tr>
            <td>
            <h3>Datos ya registrados:</h3>
            <strong>
			<?
            for($i=0;$i<count($dato);$i++){
				echo "* ".$dato[$i]['dificultad']; ?>&nbsp;&nbsp;&nbsp;<a href='#' onclick="FAjax('./profesor/dificultad.php?id_dificultad=<?=$dato[$i]['id_dificultad']?>&elimina_dificultad=1','dificultad_div','','post');">eliminar</a>
                |&nbsp;<a href='#' onclick="FAjax('./profesor/dificultad.php?id_dificultad=<?=$dato[$i]['id_dificultad']?>&edita_dificultad=1&descripcion=<?=$dato[$i]['dificultad']?>','dificultad_div','','post');">editar</a>|
                <br>
			<?
			}
			?>
            </strong>
            </td>
          </tr>
        </table>
<?
if($_GET['edita_dificultad']==1){
	echo "<script>form.descripcion_dificultad.focus();</script>";
}
?>
