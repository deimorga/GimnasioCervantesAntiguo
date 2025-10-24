<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$elemento=getElementosId($_GET['id_elemento']);
?>
<fieldset>
	<legend class="texte_legende2">Datos Del Elemento.</legend>
<?
if($elemento['id_tipo_elemento']==1){//AUDIO
?>
<table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h4><?=$elemento['titulo_elemento']?></h4></td>
  </tr>
  <tr>
    <td><audio src="./aula/elemento/<?=$_SESSION['id_actividad_aula']?>/<?=$elemento['descripcion_elemento']?>" controls autoplay loop>
<p>Tu navegador no implementa el elemento audio</p>
</audio></td>
  </tr>
</table>
<?
}elseif($elemento['id_tipo_elemento']==2){//DOCUMENTO
?>
<table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h4><?=$elemento['titulo_elemento']?></h4></td>
  </tr>
  <tr>
    <td>
    <a onClick="window.open('./aula/elemento/<?=$_SESSION['id_actividad_aula']?>/<?=$elemento['descripcion_elemento']?>');">
    <img src="./iconos/descargar.gif" width="200" height="200">
    </a></td>
  </tr>
</table>
<?
}elseif($elemento['id_tipo_elemento']==3){//IMAGEN
?>
<table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h4><?=$elemento['titulo_elemento']?></h4></td>
  </tr>
  <tr>
    <td><img src="./aula/elemento/<?=$_SESSION['id_actividad_aula']?>/<?=$elemento['descripcion_elemento']?>" width="725" height="555"></td>
  </tr>
</table>
<?
}elseif($elemento['id_tipo_elemento']==4){//TEXTO
?>
<table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h4><?=$elemento['titulo_elemento']?></h4></td>
  </tr>
  <tr>
    <td><?=nl2br($elemento['descripcion_elemento'])?></td>
  </tr>
</table>
<?
}elseif($elemento['id_tipo_elemento']==5){//ENLACE DE OTRA PAGINA
?>
<table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h4><?=$elemento['titulo_elemento']?></h4></td>
  </tr>
  <tr>
    <td>
    <a onClick="window.open('<?=$elemento['descripcion_elemento']?>');">
    <img src="./iconos/web.png" width="200" height="200">
    </a></td>
  </tr>
</table>
<?
}elseif($elemento['id_tipo_elemento']==6){//ENLACE DE YOUTUBE
?>
<table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h4><?=$elemento['titulo_elemento']?></h4></td>
  </tr>
  <tr>
    <td>
    <a onClick="window.open('<?=$elemento['descripcion_elemento']?>');">
    <img src="./iconos/web.png" width="200" height="200">
    </a></td>
  </tr>
</table>
<?
}elseif($elemento['id_tipo_elemento']==7){//PREGUNTA
}
?>
</fieldset>