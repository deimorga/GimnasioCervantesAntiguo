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
<h2>Listado de noticias.</h2>
<table class="table table-hover table-striped table-bordered">
  <thead>
    <tr>
    <th>Nombre</th>
    <th>Accion</th>
  </tr>
  </thead>
  <tbody>
<?
for($i=0;$i<count($evento);$i++){
?>

  <tr>
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
</tbody>
</table>
			<div class="clear"></div>
