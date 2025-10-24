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

if($_POST['actualiza_grupo']==1){

	$inserta=setGrupo($_POST['grupo'],$_POST['grado'],$_POST['director']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
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
$grado=getGrados();
$profesor=getProfesores();
?>
<h2>Creacion de un nuevo Grupo.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos del Grupo.</legend>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Grupo:</td>
				<td><input class="champ2" type="text" name="grupo" id="grupo" value="<?=$grupo?>"> *</td>
			</tr>
			<tr>
				<td class="texte2">Grado:</td>
				<td><select name="grado" class="champ2" id="grado" >
                	<option value="">Seleccione...</option>
<? for($i=0;$i<count($grado);$i++){?>
                    <option value="<?=$grado[$i]["id_grado"]?>" <? if($grado_alumno==$grado[$i]["id_grado"]){ echo "selected='selected'";}?> ><?=$grado[$i]["nombre_grado"]?></option>
<? }?>
                </select> *</td>
			</tr>
			<tr>
				<td class="texte2">Director de grupo:</td>
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
				<td align="center"><input name="actualiza_grupo" id="actualiza_grupo" type="hidden" value="0"><input class="button_send" name="ingreso_grupo" id="ingreso_grupo" type="button" value="GUARDAR DATOS" onClick="valida_guardar_grupo(this.form);"></td>
			</tr>
			<tr>
				<td align="center"><div id="list_familiares"></div></td>
			</tr>
        </table>
