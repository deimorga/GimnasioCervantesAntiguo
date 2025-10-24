<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$id="";
$fecha="";
$tiempo="";
$elementos="";
$objetivo="";
$observaciones="";

if($_GET["nuevo"]==1){
	$_POST["fecha"]="";
	$_GET["fecha"]="";
	$_REQUEST["fecha"]="";
	$_SESSION['id_plan']="";
}

if($_POST['actualiza_plan']==1){
	if($_SESSION['id_plan']!=""){
	$guarda_plan=updPlanEntrenamiento($_SESSION['id_plan'], $_POST['fecha'],$_POST['tiempo'],$_POST['elementos'],$_POST['objetivo'],$_POST['observaciones']);
	}else{
	$guarda_plan=setPlanEntrenamiento($_SESSION['grupo'], $_POST['fecha'],$_POST['tiempo'],$_POST['elementos'],$_POST['objetivo'],$_POST['observaciones']);
if($guarda_plan){
		$_SESSION['id_plan']=$guarda_plan;
		echo "<script>alert('Los datos se guardaron correctamente...');FAjax('./profesor/info_ejercicio.php','list_concepto','','post');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
	}
	
}

if($_GET['id_plan'] || $_POST['id_plan']){
	//echo "ENTRO!!!";
		$id=$_REQUEST['id_plan'];
	$existe=getPlanEntrenamientoId($id);
	if($existe){
		$id=$existe['id_plan_entrenamiento'];
		$_SESSION['id_plan']=$id;
		$fecha=$existe['fecha_plan'];
		$tiempo=$existe['tiempo'];
		$elementos=$existe['elementos'];
		$objetivo=$existe['objetivo'];
		$observaciones=$existe['observaciones'];
	}
}
if($_SESSION['id_plan']!=""){
		//echo "ENTRO1!!!";

		$id=$_SESSION['id_plan'];
	$existe=getPlanEntrenamientoId($id);
	if($existe){
		$fecha=$existe['fecha_plan'];
		$tiempo=$existe['tiempo'];
		$elementos=$existe['elementos'];
		$objetivo=$existe['objetivo'];
		$observaciones=$existe['observaciones'];
	}
}
?>

<h2>Plan de tareas.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos de la tarea.</legend>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Fecha:</td>
				<td><input class="champ2" style="width:100px; height:15" name="fecha" id="fecha" onFocus='Calendar.setup({inputField:"fecha",ifFormat:"%Y-%m-%d",button:"calen"});'
  readonly="true" value="<?=$fecha?>" /> *</td>
			</tr>
			<tr>
				<td class="texte2">Tiempo:</td>
				<td><input type="text" class="champ2" name="tiempo" id="tiempo" value="<?=$tiempo?>"/> *</td>
			</tr>
			<tr>
				<td class="texte2">Elementos:</td>
				<td><input type="text" class="champ2" name="elementos" id="elementos" value="<?=$elementos?>"/> *</td>
			</tr>
			<tr>
				<td class="texte2">Objetivo:</td>
				<td><textarea class="champ2" name="objetivo" id="objetivo" cols="35" rows="10"><?=$objetivo?></textarea> *</td>
			</tr>
			<tr>
				<td class="texte2">Observaciones:</td>
				<td><textarea class="champ2" name="observaciones" id="observaciones" cols="35" rows="10"><?=$observaciones?></textarea></td>
			</tr>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza_plan" type="hidden" value="0" />
                <input class="button_send" name="" id="ingreso_plan" type="button" value="GUARDAR DATOS" onClick="valida_nuevo_plan(this.form);"></td>
			</tr>
        </table>
