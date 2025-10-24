<?
include ("../funciones/conexion.php");
include ("../funciones/funciones.php");

if($_REQUEST['borrar']){
	$campo=$_REQUEST['borrar'];
	$borro=delNoticia($campo);
	if($borro){
		echo "<script>alert('Se borro la noticia');</script>";
	}else{
		echo "<script>alert('No se borro la noticia');</script>";
	}
//echo $campo."*****".$valor;
}

$evento=getNoticiasAdmin();
//print_r($hotel);
?>
<table width="90%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#EEEEEE">
    <td>Nombres</td>
    <td>&nbsp;</td>
  </tr>
<?
for($i=0;$i<count($evento);$i++){
?>

  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$evento[$i]['titulo']?></td>
    <td>
	<a href="#" class="link_right" onClick="if(confirm('Seguro de eliminar la noticia?')){
	FAjax('./administrativo/listado_noticias.php?borrar=<?=$evento[$i]['id_noticia']?>','area_trabajo','','post');
	}else{
	return false;
	}
	">Borrar >></a>    
	</td>
  </tr>

<?
}
?>                    
<div class="clear"></div>
</table>
			<div class="clear"></div>
