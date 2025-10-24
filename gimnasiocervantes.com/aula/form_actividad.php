<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$id="";
$tema="";
$objetivos="";
$instrucciones="";

if($_GET["nuevo"]==1){
	$_SESSION['id_actividad_aula']=NULL;
	$_SESSION['tipo_actividad_aula']=$_GET['tipo'];
}

if($_POST['actualiza_actividad_aula']==1){
	if($_SESSION['id_actividad_aula']!=NULL){
	$guarda_plan=updActividadAula($_SESSION['id_actividad_aula'], $_POST['tema'],$_POST['objetivos'],$_POST['instrucciones']);
	}else{
	$guarda_plan=setActividadAula($_POST['tema'],$_POST['objetivos'],$_POST['instrucciones'],$_SESSION["user_id"],$_SESSION['tipo_actividad_aula']);
		if($guarda_plan){
			$_SESSION['id_actividad_aula']=$guarda_plan;
			echo "<script>alert('Los datos se guardaron correctamente...');FAjax('./aula/info_elemento.php','list_concepto','','post');</script>";
		}else{
			echo "<script>alert('No se guardaron correctamente los datos...');</script>";
		}
	}
	
}

if($_GET['id_actividad_aula'] || $_POST['id_actividad_aula']){
	//echo "ENTRO!!!";
	$id=$_REQUEST['id_actividad_aula'];
	$existe=getActividadAulaId($id);
	if($existe){
		$id=$existe['id_actividad_aula'];
		$_SESSION['id_actividad_aula']=$id;
		$tema=$existe['tema_actividad_aula'];
		$objetivos=$existe['objetivos_actividad_aula'];
		$instrucciones=$existe['indicaciones_actividad_aula'];
		$_SESSION['tipo_actividad_aula']=$existe['tipo_actividad_aula'];
		echo "<script>FAjax('./aula/info_elemento.php','list_concepto','','post');</script>";
	}
}

if($_SESSION['id_actividad_aula']!=NULL){
	//echo "ENTRO!!!";
	$id=$_SESSION['id_actividad_aula'];
	$existe=getActividadAulaId($id);
	if($existe){
		$tema=$existe['tema_actividad_aula'];
		$objetivos=$existe['objetivos_actividad_aula'];
		$instrucciones=$existe['indicaciones_actividad_aula'];
	}
}
?>

<h2>CENTRO DE ACTIVIDADES.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos de la actividad.</legend>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td>Tema:</td>
				<td><input type="text" class="champ5" name="tema" id="tema" value="<?=$tema?>"/> *</td>
			</tr>
			<tr>
				<td>Objetivos:</td>
				<td><textarea class="champ5" name="objetivos" id="objetivos" cols="35" rows="10"><?=$objetivos?></textarea> *</td>
			</tr>
			<tr>
				<td>Instrucciones:</td>
				<td><textarea class="champ5" name="instrucciones" id="instrucciones" cols="35" rows="10"><?=$instrucciones?></textarea></td>
			</tr>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center">
                <input name="actualiza_actividad_aula" id="actualiza_actividad_aula" type="hidden" value="0" />
                <input class="button_send" name="ingreso_actividad_aula" id="ingreso_actividad_aula" type="button" value="GUARDAR DATOS" onClick="valida_actividad_aula(this.form);"></td>
			</tr>
        </table>
