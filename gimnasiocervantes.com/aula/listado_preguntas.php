<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET["elimina_pregunta"]==1){
	$del=delPregunta($_GET["id_pregunta"]);
	if($del){
		echo "<script>alert('El elemento se borro correctamente...');</script>";	
	}else{
		echo "<script>alert('Problema al borrar el elemento...');</script>";	
	}
}

$plan=getPreguntasActividad($_SESSION['id_actividad_aula']);

?>
<h2 align="left">Listado preguntas para la clases.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0" style="color:#000;">
  <tr bgcolor="#0033CC" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Enunciado</td>
    <td>Tipo de Pregunta</td>
    <td>Acci&oacute;n</td>
  </tr>
<?
if(count($plan)<1){
?>
  <tr>
    <td colspan="4" align="center">NO HAY PREGUNTAS REGISTRADOS</td>
  </tr>
<?
}else{
for($i=0;$i<count($plan);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td width="80px" align="center"><?=$plan[$i]['id_pregunta']?></td>
    <td><?=$plan[$i]['enunciado_pregunta']?></td>
    <td align="center"><?=$plan[$i]['nombre_tipo_pregunta']?></td>
    <?
    if($_GET["btn_edita"]==1){
	?>
    <td width="80px" align="center"><a href="#div_elemento" onClick="FAjax('./aula/ver_pregunta.php?editar_pregunta=1&id_pregunta=<?=$plan[$i]['id_pregunta']?>','concepto','','post');"><img src="./iconos/ver.png" width="60" height="60" /></a></td>
    <?
	}else{
	?>
    <td width="240px" align="center"><a href="#" onClick="FAjax('./aula/ver_pregunta.php?id_pregunta=<?=$plan[$i]['id_pregunta']?>','concepto','','post');"><img src="./iconos/ver.png" width="60" height="60" /></a>
<!--    <a href="#div_elemento" onClick="FAjax('./aula/form_pregunta.php?editar_pregunta=1&id_pregunta=<?$plan[$i]['id_pregunta']?>','div_elemento','','post');"><img src="./iconos/editar.png" width="60" height="60" /></a> 
-->    <a href="#div_list_pregunta" onClick="if(confirm('Seguro de eliminar esta clase?')){FAjax('./aula/listado_preguntas.php?elimina_pregunta=1&id_pregunta=<?=$plan[$i]['id_pregunta']?>','div_list_pregunta','','post');}else{ return false;}"><img src="./iconos/eliminar.png" width="60" height="60" /></a></td>
    <?
	}
	?>
  </tr>
<?
}}
?>
</table>