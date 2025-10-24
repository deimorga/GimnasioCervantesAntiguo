<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$grupo="";
$grado="";
$director="";

if($_POST['actualiza_grupo_asignatura']==1){

	$inserta=setAsignaturaGrupo($_POST['grupo'],$_POST['asignatura'],$_POST['intensidad'],$_POST['director']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos o ya esta asignada...');</script>";
	}
}

if(isset($_POST['id_grupo']) || isset($_GET['id_grupo'])){

	$id_grupo=$_REQUEST['id_grupo'];
	$existe=getGrupoId($id_grupo);
	if($existe){
		$grupo=$existe['nombre_grupo'];
		$grado=$existe['id_grado'];
		$director=$existe['id_profesor'];
	}
}
$asignatura=getAsignaturas();
$grupo=getGrupos();
$profesor=getProfesores();
?>
<h2>Asignar profesor y asignatura.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos de Grupo/Asignatura.</legend>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Grupo:</td>
				<td><select name="grupo" class="champ2" id="grupo" >
                	<option value="">Seleccione...</option>
<? for($i=0;$i<count($grupo);$i++){?>
                    <option value="<?=$grupo[$i]["id_grupo"]?>" ><?=$grupo[$i]["nombre_grupo"]?></option>
<? }?>
                </select> *</td>
			</tr>
			<tr>
				<td class="texte2">Asignatura:</td>
				<td><select name="asignatura" class="champ2" id="asignatura" >
                	<option value="">Seleccione...</option>
<? for($i=0;$i<count($asignatura);$i++){?>
                    <option value="<?=$asignatura[$i]["id_asignatura"]?>" ><?=$asignatura[$i]["nombre_asignatura"]?></option>
<? }?>
                </select> *</td>
			</tr>
			<tr>
				<td class="texte2">Intensidad horaria:</td>
				<td><select name="intensidad" id="intensidad" class="champ2">
                	<option value="">Seleccione...</option>
                	<option value="1">1 hora</option>
                	<option value="2">2 horas</option>
                	<option value="3">3 horas</option>
                	<option value="4">4 horas</option>
                	<option value="5">5 horas</option>
                	<option value="6">6 horas</option>
                	<option value="7">7 horas</option>
                	<option value="8">8 horas</option>
                	<option value="9">9 horas</option>
                	<option value="10">10 horas</option>
                </select> *</td>
			</tr>
			<tr>
				<td class="texte2">Profesor:</td>
				<td><select name="director" class="champ2" id="director" >
                	<option value="">Seleccione...</option>
<? for($i=0;$i<count($profesor);$i++){?>
                    <option value="<?=$profesor[$i]["id_profesor"]?>" <? if($director==$profesor[$i]["id_profesor"]){ echo "selected='selected'";}?> ><?=$profesor[$i]["nombre_profesor"]?></option>
<? }?>
                </select> *
                </td>
			</tr>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza_grupo_asignatura" id="actualiza_grupo_asignatura" type="hidden" value="0"><input class="button_send" name="ingreso_grupo_asignatura" id="ingreso_grupo_asignatura" type="button" value="GUARDAR DATOS" onClick="valida_guardar_grupo_asignatura(this.form);"></td>
			</tr>
			<tr>
				<td align="center"><div id="list_familiares"></div></td>
			</tr>
        </table>
