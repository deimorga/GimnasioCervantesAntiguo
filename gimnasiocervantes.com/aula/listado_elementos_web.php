<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET["elimina_elemento"]==1){
	$del=delElemento($_GET["id_elemento"]);
	if($del){
		echo "<script>alert('El elemento se borro correctamente...');</script>";	
	}else{
		echo "<script>alert('Problema al borrar el elemento...');</script>";	
	}
}

$plan=getElementosWeb();

?>
<h2 align="left">Listado elementos para la Web.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0" style="color:#000;">
  <tr bgcolor="#0033CC" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Titulo/Enunciado</td>
    <td>Tipo de Elemento</td>
    <td>Acci&oacute;n</td>
  </tr>
<?
if(count($plan)<1){
?>
  <tr>
    <td colspan="4" align="center">NO HAY ELEMENTOS PARA LA WEB REGISTRADOS</td>
  </tr>
<?
}else{
for($i=0;$i<count($plan);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td width="80px" align="center"><?=$plan[$i]['id_elemento']?></td>
    <td><?=$plan[$i]['titulo_elemento']?></td>
    <td width="280px" align="center"><?=$plan[$i]['nombre_tipo_elemento']?></td>
    <?
    if($_GET["btn_edita"]==1){
	?>
    <td width="80px" align="center"><a href="#" onClick="FAjax('./aula/ver_elemento.php?id_elemento=<?=$plan[$i]['id_elemento']?>','concepto','','post');"><img src="./iconos/ver.png" width="60" height="60" /></a></td>
    <?
	}else{
	?>
    <td width="240px" align="center">
    <a href="#" onClick="FAjax('./aula/ver_elemento.php?id_elemento=<?=$plan[$i]['id_elemento']?>','concepto','','post');"><img src="./iconos/ver.png" width="60" height="60" /></a>
    <?
    if($plan[$i]['id_tipo_elemento']>3){
	?>
    <?
	}
	?>
    <a href="#div_list_elemento" onClick="if(confirm('Seguro de eliminar esta clase?')){FAjax('./aula/listado_elementos_web.php?elimina_elemento=1&id_elemento=<?=$plan[$i]['id_elemento']?>','div_list_elemento','','post');}else{ return false;}"><img src="./iconos/eliminar.png" width="60" height="60" /></a></td>
    <?
	}
	?>
  </tr>
<?
}}
?>
</table>