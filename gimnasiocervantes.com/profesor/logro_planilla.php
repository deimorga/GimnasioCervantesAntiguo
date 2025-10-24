<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$campo="";

if($_GET['elimina_logro']==1){
	$elimina=delPlanilla("tbl_logro", "id_logro", $_GET['id_logro']);
	if($elimina){
		echo "<script>alert('Se elimino correctamente el logro...');FAjax('./profesor/gestionar_planilla.php','gestion','','post');</script>";
	}else{
		echo "<script>alert('No se elimino correctamente el logro / Posiblemente ya existen calificacion.');</script>";
	}
}

if($_POST['actualiza_logro_planilla']==1){

	$inserta=insertaPlanGestor("tbl_logro", "logro", $_REQUEST['descripcion_logro'], $_SESSION['planilla']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');FAjax('./profesor/gestionar_planilla.php','gestion','','post');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if($_GET['edita_logro_planilla']==1){
	$edita=seleccionaPlanGestorId("tbl_logro", "id_logro", $_GET['id_logro']);
	if($edita){
		$id_campo=$_GET['id_logro'];
		$campo=$edita['logro'];
		//echo $campo;
		?><input type="hidden" name="id_old" id="id_old" value="<?=$id_campo?>" /><?
	}else{
		echo "<script>alert('Problemas al buscar el estandar a editar...');</script>";
	}
}

if($_POST['actualiza_edita_logro_planilla']==1){

	$inserta=actualizaPlanGestor("logro", $_REQUEST['descripcion_logro'], $_REQUEST['id_old']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');FAjax('./profesor/gestionar_planilla.php','gestion','','post');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

$dato=seleccionaPlanGestor("tbl_logro", $_SESSION['planilla']);

?>
<h2>Actividades de Clase.</h2>

        <table width="100px" cellpadding="5" cellspacing="0" border="0">
          <tr>
            <td align="center"><?
if($_GET['edita_logro_planilla']==1){
?>
              <input name="actualiza_edita_logro_planilla" id="actualiza_edita_logro_planilla" type="hidden" value="0" />
              <input class="button_send" name="edita_logro" id="edita_logro" type="button" value="GUARDAR DATOS" onclick="valida_edita_logro_planilla(this.form);" />
              <?
}else{
?>
              <input name="actualiza_logro_planilla" id="actualiza_logro_planilla" type="hidden" value="0" />
              <input class="button_send" name="ingreso_logro" id="ingreso_logro" type="button" value="GUARDAR DATOS" onclick="valida_guardar_logro_planilla(this.form);" />
              <?
}
?></td>
          </tr>
        </table>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Descripcion:</td>
				<td><textarea class="champ3" name="descripcion_logro" id="descripcion_logro"><?=$campo?></textarea> *</td>
			</tr>
		</table>
<?
if($_GET['edita_logro']==1){
	echo "<script>form.descripcion_logro.focus();</script>";
}
?>
