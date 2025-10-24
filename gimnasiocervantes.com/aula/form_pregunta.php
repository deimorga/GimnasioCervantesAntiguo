<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$func=NULL;
$tipo_p=NULL;
$descripcion_pregunta=NULL;
if($_GET["editar_pregunta"]==1){
	$elemento=getPreguntaId($_GET["id_pregunta"]);
	$tipo_p=$elemento['id_tipo_pregunta'];
	$descripcion_pregunta=$elemento["enunciado_pregunta"];
}else{
	$tipo_p=$_REQUEST["tipo_pregunta"];
}
?>
<table cellpadding=5 width="600px" cellspacing=0 border="0">
<?
if($tipo_p==1){//abierta
	$func="valida_pregunta_abierta";
?>
	<tr>
		<td>Enunciado:</td>
		<td><textarea class="champ5" name="desc_pregunta" id="desc_pregunta" cols="35" rows="10"><?=$descripcion_pregunta?></textarea></td>
	</tr>
<?
}elseif($tipo_p==2){//V-F
	$func="valida_pregunta_vf";
?>
	<tr>
		<td>Enunciado:</td>
		<td><textarea class="champ5" name="desc_pregunta" id="desc_pregunta" cols="35" rows="10"><?=$descripcion_pregunta?></textarea></td>
	</tr>
	<tr>
		<td>Respuesta:</td>
		<td><select name="respuesta_p" class="champ">
		  <option value="">Seleccione...</option>
		  <option value="1">Verdadero</option>
		  <option value="2">Falso</option>
	  </select></td>
	</tr>
<?
}elseif($tipo_p==3){//opcion multiple
	$func="valida_pregunta_multiple";
	$_SESSION["carro"]=NULL;
?>
	<tr>
		<td>Enunciado:</td>
		<td><textarea class="champ5" name="desc_pregunta" id="desc_pregunta" cols="35" rows="10"><?=$descripcion_pregunta?></textarea></td>
	</tr>
	<tr>
		<td colspan="2"><div id="opcion_respuesta"><? include_once("listado_opciones.php");?></div></td>
	</tr>
<?
}elseif($tipo_p==4){//columnas
	$func="valida_pregunta_columnas";
	$_SESSION["carro"]=NULL;
?>
	<tr>
		<td>Enunciado:</td>
		<td><textarea class="champ5" name="desc_pregunta" id="desc_pregunta" cols="35" rows="10"><?=$descripcion_pregunta?></textarea></td>
	</tr>
	<tr>
		<td colspan="2"><div id="opcion_respuesta"><? include_once("listado_opciones2.php");?></div></td>
	</tr>
<?
}elseif($tipo_p==5){//completar
	$func="valida_pregunta_completar";
?>
	<tr>
		<td>Enunciado:</td>
		<td><input type="button" onclick="reemplazarSeleccion(document.getElementById('desc_pregunta'), '[CAMPO_DE_COMPLETAR]')" value="Adicionar campo de completar"/>
        <textarea class="champ5" name="desc_pregunta" id="desc_pregunta" cols="35" rows="10"><?=$descripcion_pregunta?></textarea></td>
	</tr>
<?
}elseif($tipo_p==6){//columnas con imagen
	$func="valida_pregunta_columnas_imagen";
?>
	<tr>
		<td>Enunciado:</td>
		<td><textarea class="champ5" name="desc_pregunta" id="desc_pregunta" cols="35" rows="10"><?=$descripcion_pregunta?></textarea></td>
	</tr>
	<tr>
		<td colspan="2"><div id="opcion_respuesta"><? include_once("listado_opciones3.php");?></div></td>
	</tr>
<?
}
?>
</table>
<input name="actualiza_pregunta_aula" id="actualiza_pregunta_aula" type="hidden" value="0" />
<?
if($tipo_p==6){
?>
<table width="600px" cellpadding=5 cellspacing=0 border="0">
	<tr>
		<td align="center">
        <input class="button_send" name="ingreso_pregunta_aula" id="ingreso_pregunta_aula" type="submit" value="GUARDAR DATOS" onClick="return <?=$func?>(this.form);"></td>
	</tr>
</table>
<?
}else{
?>
<table width="600px" cellpadding=5 cellspacing=0 border="0">
	<tr>
		<td align="center">
        <input class="button_send" name="ingreso_pregunta_aula" id="ingreso_pregunta_aula" type="button" value="GUARDAR DATOS" onClick="<?=$func?>(this.form);"></td>
	</tr>
</table>
<?	
}
?>