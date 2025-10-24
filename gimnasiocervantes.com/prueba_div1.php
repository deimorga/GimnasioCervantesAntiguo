<?
session_start();

include_once("./funciones/funciones_aula.php");
include_once("./funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

//echo "++++++++++++++++++++".$_SESSION["id_pregunta"];

if($_REQUEST["val_resp"]==1){
	//echo "ENTRO!!!";
	$resp_correcta=getRespuestaCorrecta($_SESSION["id_pregunta"]);
	//print_r($resp_correcta);
	//echo $resp_correcta["id_respuesta"]."---------".$_REQUEST["respuesta_p"];
	if($resp_correcta["id_respuesta"]==$_REQUEST["respuesta_p"]){
		echo '<img src="./images/bien.png" width="300" height="240" /><br>FELICIDADES, LA RESPUESTA A LA PREGUNTA ES CORRECTA';
	}else{
		echo '<img src="./images/mal.png" width="300" height="240" /><br>LO SENTIMOS, LA RESPUESTA A LA PREGUNTA ES INCORRECTA';
	}
}

$elemento=getPreguntaId($_SESSION["id_pregunta"]);
//print_r($elemento);
$tipo_p=$elemento['id_tipo_pregunta'];
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<title>Arrastrar y Soltar (Drag and Drop)</title>
<style>
html{
	background-color:#FFF;
}
#panel{
	display:block;
	position:absolute;
	top:50px;
	left:50px;
}
.columna{
	width:200px;
	height:200px;
	float:left;
	border: 2px solid #FFFFFF;
	-webkit-border-radius: 10px;
  -ms-border-radius: 10px;
  -moz-border-radius: 10px;
  border-radius: 10px;
	cursor:move;
}
.columna.over {
  border: 2px solid #FF0000;
}
</style>
</head>
<body>
<fieldset>
	<legend class="texte_legende2"><?=$elemento['nombre_tipo_pregunta']?>.</legend>
<table cellpadding="5" width="600px" cellspacing="10" border="0">
<?
if($tipo_p==1){//abierta
?>
	<tr>
		<td colspan="2"><?=$elemento['enunciado_pregunta']?></td>
	</tr>
	<tr>
		<td>Respuesta:</td>
		<td><textarea class="champ5" name="desc_pregunta" id="desc_pregunta" cols="35" rows="10"></textarea></td>
	</tr>
<?
}elseif($tipo_p==2 || $tipo_p==3){//V-F && opcion multiple
	$respuestas=getRespuestaPregunta($elemento['id_pregunta']);
?>
	<tr>
		<td colspan="2"><?=$elemento['enunciado_pregunta']?></td>
	</tr>
	<tr>
		<td>Respuesta:</td>
		<td>
        <select name="respuesta_p" class="champ">
		  <option value="">Seleccione...</option>
          <?
          for($r=0;$r<count($respuestas);$r++){
		  ?>
		  <option value="<?=$respuestas[$r]["id_respuesta"]?>"><?=$respuestas[$r]["respuesta_1"]?></option>
          <?
		  }
		  ?>
        </select></td>
	</tr>
<?
}elseif($tipo_p==4){//columnas
	$func="valida_pregunta_columnas";
	$respuestas=getRespuestaPregunta($elemento['id_pregunta']);
?>

<div id="panel">
	<div class="columna" draggable="true">1</div>
	<div class="columna" draggable="true">2</div>
	<div class="columna" draggable="true">3</div>
	<div class="columna" draggable="true">4</div>
</div>

<?
}elseif($tipo_p==5){//completar
?>
	<tr>
		<td colspan="2"><?=$elemento['enunciado_pregunta']?></td>
	</tr>
<?
}
?>
</table>
<table width="600px" cellpadding=5 cellspacing=0 border="0">
	<tr>
		<td align="center">
        <input type="hidden" name="val_resp" id="val_resp" value="0"/>
        <input class="button_send" name="ingreso_pregunta_aula" id="ingreso_pregunta_aula" type="button" value="VALIDAR RESPUESTA" onClick="valida_resp_clase(this.form);"></td>
	</tr>
</table>
</fieldset>


<script type="text/javascript">
var dragSrcEl = null;
var cols = document.querySelectorAll('#panel .columna');

function handleDragStart(e) {
  dragSrcEl = this;
  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html', this.innerHTML);
}

function handleDragOver(e) {
  if (e.preventDefault) {
    e.preventDefault(); 
  }

  e.dataTransfer.dropEffect = 'move';  

  return false;
}

function handleDragEnter(e) {
  this.classList.add('over');
}

function handleDragLeave(e) {
  this.classList.remove('over'); 
}

function handleDrop(e) {
  if (e.stopPropagation) {
    e.stopPropagation();
  }
	
	if (dragSrcEl != this) {
		dragSrcEl.innerHTML = this.innerHTML;
		this.innerHTML = e.dataTransfer.getData('text/html');
		this.classList.remove('over');
	}

  return false;
}

function handleDragEnd(e) {
  [].forEach.call(cols, function (col) {
    col.classList.remove('over');
  });
}

[].forEach.call(cols, function(col) {
   col.addEventListener('dragstart', handleDragStart, false);
  col.addEventListener('dragenter', handleDragEnter, false);
  col.addEventListener('dragover', handleDragOver, false);
  col.addEventListener('dragleave', handleDragLeave, false);
  col.addEventListener('drop', handleDrop, false);
  col.addEventListener('dragend', handleDragEnd, false);
});
</script>
</body>
</html>












