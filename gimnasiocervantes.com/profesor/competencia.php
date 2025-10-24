<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$campo="";

if($_GET['elimina_competencia']==1){
	$elimina=delPlanGestor("tbl_competencia", "id_competencia", $_GET['id_competencia']);
	if($elimina){
		echo "<script>alert('Se elimino correctamente la competencia...');</script>";
	}else{
		echo "<script>alert('No se elimino correctamente la competencia...');</script>";
	}
}

if($_POST['actualiza_competencia']==1){

	$inserta=insertaPlanGestor("tbl_competencia", "competencia", $_REQUEST['descripcion_competencia'], $_SESSION['plan_gestor']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if($_GET['edita_competencia']==1){
	$edita=seleccionaPlanGestorId("tbl_competencia", "id_competencia", $_GET['id_competencia']);
	if($edita){
		$id_campo=$_GET['id_competencia'];
		$campo=$edita['competencia'];
		?><input type="hidden" name="id_old" id="id_old" value="<?=$id_campo?>" /><?
	}else{
		echo "<script>alert('Problemas al buscar el estandar a editar...');</script>";
	}
}

if($_POST['actualiza_edita_competencia']==1){

	$inserta=actualizaPlanGestor("competencia", $_REQUEST['descripcion_competencia'], $_REQUEST['id_old']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

$dato=seleccionaPlanGestor("tbl_competencia", $_SESSION['plan_gestor']);

?>
<h2>Competences(Competencias).</h2>

        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;" width="90%">
			<tr>
				<td class="texte2">Descripcion:</td>
			</tr>
			<tr>
				<td><textarea class="form-control" name="descripcion_competencia" id="descripcion_competencia"><?=$campo?></textarea>*</td>
			</tr>
			<tr>
				<td class="texte2">
				<?
                if($_GET['edita_competencia']==1){
                ?>
              <input name="actualiza_edita_competencia" id="actualiza_edita_competencia" type="hidden" value="0" />
              <input class="button_send" name="edita_competencia" id="edita_competencia" type="button" value="GUARDAR DATOS" onclick="valida_edita_competencia(this.form);" />
              <?
				}else{
				?>
              <input name="actualiza_competencia" id="actualiza_competencia" type="hidden" value="0" />
              <input class="button_send" name="ingreso_competencia" id="ingreso_competencia" type="button" value="GUARDAR DATOS" onclick="valida_guardar_competencia(this.form);" />
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
				echo "* ".$dato[$i]['competencia']; ?>&nbsp;&nbsp;&nbsp;<a href='#' onclick="FAjax('./profesor/competencia.php?id_competencia=<?=$dato[$i]['id_competencia']?>&elimina_competencia=1','competencia_div','','post');">eliminar</a>
                |&nbsp;<a href='#' onclick="FAjax('./profesor/competencia.php?id_competencia=<?=$dato[$i]['id_competencia']?>&edita_competencia=1&descripcion=<?=$dato[$i]['competencia']?>','competencia_div','','post');">editar</a>|
                <br>
			<?
			}
			?>
            </strong>
            </td>
          </tr>
        </table>
<?
if($_GET['edita_competencia']==1){
	echo "<script>form.descripcion_competencia.focus();</script>";
}
?>
