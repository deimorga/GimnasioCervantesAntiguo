<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$nombre_unidad="";
$competencia="";

if($_POST['actualiza_plan_gestor']==1){

	$inserta=updPlanGestor($_POST['nombre_unidad'],$_POST['competencia'],$_SESSION['plan_gestor']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

$plan_gestor=getPlanGestorId($_SESSION['plan_gestor']);
$grupo_asignatura=getAsignaturaGrupoId($_SESSION['grupo_asignatura']);
if($plan_gestor){
	$nombre_unidad=$plan_gestor['nombre_unidad'];
	$competencia=$plan_gestor['competencia_institucional'];
}
?>
<h2>Datos Matriz Educativa <? echo $grupo_asignatura['nombre_asignatura']." - ".$grupo_asignatura['nombre_grupo'];?>.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos de la Matriz.</legend>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;" width="90%">
			<tr>
				<td class="texte2">COMPONENTE:</td>
				<td><input class="champ2" type="text" name="nombre_unidad" id="nombre_unidad" value="<?=$nombre_unidad?>"> *</td>
			</tr>
			<tr>
				<td class="texte2"></td>
				<td><input class="champ2" type="hidden" name="competencia" id="competencia" value="<?=$competencia?>"></td>
			</tr>
		</table>
	</fieldset>
        <table width="90%" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza_plan_gestor" id="actualiza_plan_gestor" type="hidden" value="0"><input class="button_send" name="ingreso_plan_gestor" id="ingreso_plan_gestor" type="button" value="GUARDAR DATOS" onClick="valida_guardar_plan_gestor(this.form);"></td>
			</tr>
			<tr>
				<td align="center"><div id="list_familiares"></div></td>
			</tr>
        </table>
