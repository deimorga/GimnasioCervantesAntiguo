<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$asignatura="";
$area_registrada="";

if($_POST['actualiza_asignatura']==1){

	$inserta=setAsignatura($_POST['asignatura'],$_POST['area']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if(isset($_POST['id_asignatura']) || isset($_GET['id_asignatura'])){

	$id_asignatura=$_REQUEST['id_asignatura'];
	$existe=getAsignaturaId($id_asignatura);
	if($existe){
		$asignatura=$existe['nombre_asignatura'];
		$area_registrada=$existe['id_area'];
	}
}
$area=getAreas();
?>
<h2>Creacion de nueva Asignatura.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos de la Asignatura.</legend>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Asignatura:</td>
				<td><input class="champ2" type="text" name="asignatura" id="asignatura" value="<?=$asignatura?>"> *</td>
			</tr>
			<tr>
				<td class="texte2">Area:</td>
				<td><select name="area" class="champ2" id="area" >
                	<option value="">Seleccione...</option>
<? for($i=0;$i<count($area);$i++){?>
                    <option value="<?=$area[$i]["id_area"]?>" <? if($area_registrada==$area[$i]["id_area"]){ echo "selected='selected'";}?> ><?=$area[$i]["nombre_area"]?></option>
<? }?>
                </select> *</td>
			</tr>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza_asignatura" id="actualiza_asignatura" type="hidden" value="0"><input class="button_send" name="ingreso_asignatura" id="ingreso_asignatura" type="button" value="GUARDAR DATOS" onClick="valida_guardar_asignatura(this.form);"></td>
			</tr>
			<tr>
				<td align="center"><div id="list_familiares"></div></td>
			</tr>
        </table>
