<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$campo="";

if($_GET['elimina_metodologia']==1){
	$elimina=delPlanGestor("tbl_metodologia", "id_metodologia", $_GET['id_metodologia']);
	if($elimina){
		echo "<script>alert('Se elimino correctamente la metodologia...');</script>";
	}else{
		echo "<script>alert('No se elimino correctamente la metodologia...');</script>";
	}
}

if($_POST['actualiza_metodologia']==1){

	$inserta=insertaPlanGestor("tbl_metodologia", "metodologia", $_REQUEST['descripcion_metodologia'], $_SESSION['plan_gestor']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if($_GET['edita_metodologia']==1){
	$edita=seleccionaPlanGestorId("tbl_metodologia", "id_metodologia", $_GET['id_metodologia']);
	if($edita){
		$id_campo=$_GET['id_metodologia'];
		$campo=$edita['metodologia'];
		?><input type="hidden" name="id_old" id="id_old" value="<?=$id_campo?>" /><?
	}else{
		echo "<script>alert('Problemas al buscar el estandar a editar...');</script>";
	}
}

if($_POST['actualiza_edita_metodologia']==1){

	$inserta=actualizaPlanGestor("metodologia", $_REQUEST['descripcion_metodologia'], $_REQUEST['id_old']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

$dato=seleccionaPlanGestor("tbl_metodologia", $_SESSION['plan_gestor']);

?>
<h2>METODOLOGIA DE INVESTIGACI&Oacute;N EN EL AREA.</h2>

        <table width="100px" cellpadding="5" cellspacing="0" border="0">
          <tr>
            <td align="center"><?
if($_GET['edita_metodologia']==1){
?>
              <input name="actualiza_edita_metodologia" id="actualiza_edita_metodologia" type="hidden" value="0" />
              <input class="button_send" name="edita_metodologia" id="edita_metodologia" type="button" value="GUARDAR DATOS" onclick="valida_edita_metodologia(this.form);" />
              <?
}else{
?>
              <input name="actualiza_metodologia" id="actualiza_metodologia" type="hidden" value="0" />
              <input class="button_send" name="ingreso_metodologia" id="ingreso_metodologia" type="button" value="GUARDAR DATOS" onclick="valida_guardar_metodologia(this.form);" />
              <?
}
?></td>
          </tr>
        </table>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Descripcion:</td>
				<td><textarea class="champ3" name="descripcion_metodologia" id="descripcion_metodologia"><?=$campo?></textarea> *</td>
			</tr>
		</table>
        <table width="315px" border="0" cellspacing="0" cellpadding="0" style="margin:10px">
          <tr>
            <td>
            <h3>Datos ya registrados:</h3>
            <strong>
			<?
            for($i=0;$i<count($dato);$i++){
				echo "* ".$dato[$i]['metodologia']; ?>&nbsp;&nbsp;&nbsp;<a href='#' onclick="FAjax('./profesor/metodologia.php?id_metodologia=<?=$dato[$i]['id_metodologia']?>&elimina_metodologia=1','metodologia_div','','post');">eliminar</a>
                |&nbsp;<a href='#' onclick="FAjax('./profesor/metodologia.php?id_metodologia=<?=$dato[$i]['id_metodologia']?>&edita_metodologia=1&descripcion=<?=$dato[$i]['metodologia']?>','metodologia_div','','post');">editar</a>|
                <br>
			<?
			}
			?>
            </strong>
            </td>
          </tr>
        </table>
<?
if($_GET['edita_metodologia']==1){
	echo "<script>form.descripcion_metodologia.focus();</script>";
}
?>
