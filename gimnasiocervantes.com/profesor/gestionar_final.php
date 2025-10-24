<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$competencia="";

if($_POST['actualiza_final']==1){

	$inserta=updAsignaturaGrupoFinal($_POST['logro_final_superior'],$_POST['logro_final_alto'],$_POST['logro_final_basico'],$_POST['logro_final_bajo'],$_SESSION['grupo_asignatura']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

$grupo_asignatura=getAsignaturaGrupoId($_SESSION['grupo_asignatura']);
?>
<h2>Datos Logro Final / <? echo $grupo_asignatura['nombre_asignatura']." - ".$grupo_asignatura['nombre_grupo'];?>.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos del Logro.</legend>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Logro desempe&ntilde;o superio<br />(DS 4.8-5.0):</td>
				<td><textarea name="logro_final_superior" class="champ2" id="logro_final_superior"><?=$grupo_asignatura['logro_final_superior']?></textarea> *</td>
			</tr>
			<tr>
				<td class="texte2">Logro desempe&ntilde;o alto<br />(DA 4.3-4.7):</td>
				<td><textarea name="logro_final_alto" class="champ2" id="logro_final_alto"><?=$grupo_asignatura['logro_final_alto']?></textarea> *</td>
			</tr>
			<tr>
				<td class="texte2">Logro desempe&ntilde;o b&aacute;sico<br />(DBS 3.7-4.2):</td>
				<td><textarea name="logro_final_basico" class="champ2" id="logro_final_basico"><?=$grupo_asignatura['logro_final_basico']?></textarea> *</td>
			</tr>
			<tr>
				<td class="texte2">Logro desempe&ntilde;o bajo<br />(DB 1.0-3.6):</td>
				<td><textarea name="logro_final_bajo" class="champ2" id="logro_final_bajo"><?=$grupo_asignatura['logro_final_bajo']?></textarea> *</td>
			</tr>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza_final" id="actualiza_final" type="hidden" value="0"><input class="button_send" name="ingreso_plan_gestor" id="ingreso_plan_gestor" type="button" value="GUARDAR DATOS" onClick="valida_guardar_final(this.form);"></td>
			</tr>
			<tr>
				<td align="center"><div id="list_familiares"></div></td>
			</tr>
        </table>
