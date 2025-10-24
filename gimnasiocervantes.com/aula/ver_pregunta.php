<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

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
}elseif($_REQUEST["val_resp"]==2){
	$respuestas=getRespuestaPregunta($_SESSION["id_pregunta"]);
	for($r=0;$r<count($respuestas);$r++){
		$op1=getRespuestaId($_REQUEST["col_".$r]);
		$op2=getRespuestaId($_REQUEST["resp_".$r]);
		if($_REQUEST["col_".$r]==$_REQUEST["resp_".$r]){
		?>
        <br>
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
          <tr bgcolor="#00FF00">
            <td rowspan="2" width="82"><img src="./images/bien.png" width="80" height="80"></td>
            <td>Opcion</td>
            <td>Seleccion</td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td><?=$op1['respuesta_1']?></td>
            <td><?=$op2['respuesta_2']?></td>
          </tr>
        </table>
		<?
		}else{
		?>
        <br>
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
          <tr bgcolor="#FF0000">
            <td rowspan="2" width="82"><img src="./images/mal.png" width="80" height="80"></td>
            <td>Opcion</td>
            <td>Seleccion</td>
            <td>Correcta</td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td><?=$op1['respuesta_1']?></td>
            <td><?=$op2['respuesta_2']?></td>
            <td><?=$op1['respuesta_2']?></td>
          </tr>
        </table>
		<?
		}
	}
}else{
	$_SESSION["id_pregunta"]=$_GET['id_pregunta'];
}

$func="valida_resp_clase";
$elemento=getPreguntaId($_SESSION["id_pregunta"]);
$tipo_p=$elemento['id_tipo_pregunta'];
?>
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
	$func="valida_resp_clase2";
	$respuestas=getRespuestaPregunta($elemento['id_pregunta']);
	$respuestas2=getRespuestaPregunta($elemento['id_pregunta']);
?>

	<tr>
		<td colspan="2"><?=$elemento['enunciado_pregunta']?></td>
	</tr>
	<?
	for($f=0;$f<count($respuestas2);$f++){
	?>
	<tr>
		<td>
        <input type="hidden" name="col_<?=$f?>" value="<?=$respuestas2[$f]["id_respuesta"]?>">
		<div id="op_res"><div id="text_op_res"><?=$respuestas2[$f]["respuesta_1"]?></div></div>
		</td>
		<td>
		<img src="./images/flecha.png" width="300" height="80">		</td>
		<td>
        <select name="resp_<?=$f?>" class="champ6">
		  <option value="">Seleccione...</option>
          <?
          for($r=0;$r<count($respuestas);$r++){
		  ?>
		  <option value="<?=$respuestas[$r]["id_respuesta"]?>"><?=$respuestas[$r]["respuesta_2"]?></option>
          <?
		  }
		  ?>
        </select></td>
	</tr>
    <?
	}
	?>

<?
}elseif($tipo_p==5){//completar
?>
	<tr>
		<td colspan="2"><?=$elemento['enunciado_pregunta']?></td>
	</tr>
<?
}elseif($tipo_p==6){//columnas imagen
	$func="valida_resp_clase2";
	$respuestas=getRespuestaPregunta($elemento['id_pregunta']);
	$respuestas2=getRespuestaPregunta($elemento['id_pregunta']);
?>

	<tr>
		<td colspan="2"><?=$elemento['enunciado_pregunta']?></td>
	</tr>
	<?
	for($f=0;$f<count($respuestas2);$f++){
	?>
	<tr>
		<td>
        <input type="hidden" name="col_<?=$f?>" value="<?=$respuestas2[$f]["id_respuesta"]?>">
		<div id="op_res"><div id="text_op_res"><img src="./aula/pregunta/<?=$_SESSION['id_actividad_aula']?>/<?=$respuestas2[$f]["respuesta_2"]?>" width="320" height="240" /></div></div>
		</td>
		<td>
		<img src="./images/flecha.png" width="300" height="80">		</td>
		<td>
        <select name="resp_<?=$f?>" class="champ6">
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
	}
	?>

<?
}
?>
</table>
<table width="90%" cellpadding=5 cellspacing=0 border="0">
	<tr>
		<td align="center">
        <input type="hidden" name="val_resp" id="val_resp" value="0"/>
        <input class="button_send" name="ingreso_pregunta_aula" id="ingreso_pregunta_aula" type="button" value="VALIDAR RESPUESTA" onClick="<?=$func?>(this.form);"></td>
	</tr>
</table>
</fieldset>