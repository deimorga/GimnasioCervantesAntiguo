<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$campo="";

if($_GET['elimina_indicador']){
	$elimina=delPlanGestor("tbl_indicador_logro", "id_indicador_logro", $_GET['id_indicador']);
	if($elimina){
		echo "<script>alert('Se elimino correctamente el indicador de logro...');</script>";
	}else{
		echo "<script>alert('No se elimino correctamente el indicador de logro...');</script>";
	}
}

if($_POST['actualiza_indicador']==1){

	$inserta=insertaPlanGestor("tbl_indicador_logro", "indicador_logro", $_REQUEST['descripcion_indicador'], $_SESSION['plan_gestor']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if($_GET['edita_indicador']==1){
	$edita=seleccionaPlanGestorId("tbl_indicador_logro", "id_indicador_logro", $_GET['id_indicador']);
	if($edita){
		$id_campo=$_GET['id_indicador'];
		$campo=$edita["indicador_logro"];
		?><input type="hidden" name="id_old" id="id_old" value="<?=$id_campo?>" /><?
	}else{
		echo "<script>alert('Problemas al buscar el estandar a editar...');</script>";
	}
}

if($_POST['actualiza_edita_indicador']==1){

	$inserta=actualizaPlanGestor("indicador_logro", $_REQUEST['descripcion_indicador'], $_REQUEST['id_old']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

$dato=seleccionaPlanGestor("tbl_indicador_logro", $_SESSION['plan_gestor']);

?>
<h2>Evidence of learning(Evidencias de aprendizaje).</h2>


        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;" width="90%">
			<tr>
				<td class="texte2">Descripcion:</td>
			</tr>
			<tr>
				<td><textarea class="form-control" name="descripcion_indicador" id="descripcion_indicador"><?=$campo?></textarea> *</td>
			</tr>
			<tr>
				<td class="texte2">
<?
if($_GET['edita_indicador']==1){
?>
              <input name="actualiza_edita_indicador" id="actualiza_edita_indicador" type="hidden" value="0" />
              <input class="button_send" name="edita_indicador" id="edita_indicador" type="button" value="GUARDAR DATOS" onclick="valida_edita_indicador(this.form);" />
              <?
}else{
?>
              <input name="actualiza_indicador" id="actualiza_indicador" type="hidden" value="0" />
              <input class="button_send" name="ingreso_indicador" id="ingreso_indicador" type="button" value="GUARDAR DATOS" onclick="valida_guardar_indicador(this.form);" />
              <?
}
?>
			</tr>
          <tr>
            <td class="texte2">
            <h3>Datos ya registrados:</h3>
            <strong>
			<?
            for($i=0;$i<count($dato);$i++){
				echo "* ".$dato[$i]['indicador_logro']; ?>&nbsp;&nbsp;&nbsp;<a href='#' onclick="FAjax('./profesor/indicador.php?id_indicador=<?=$dato[$i]['id_indicador_logro']?>&elimina_indicador=1','indicador_div','','post');">eliminar</a>
                |&nbsp;<a href='#' onclick="FAjax('./profesor/indicador.php?id_indicador=<?=$dato[$i]['id_indicador_logro']?>&edita_indicador=1&descripcion=<?=$dato[$i]['indicador_logro']?>','indicador_div','','post');">editar</a>|
                <br>
			<?
			}
			?>
            </strong>
            </td>
          </tr>
        </table>
<?
if($_GET['edita_indicador']==1){
	echo "<script>form.descripcion_indicador.focus();</script>";
}
?>
