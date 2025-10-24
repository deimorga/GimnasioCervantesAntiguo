<?
session_start();

include_once("./funciones/funciones.php");
include_once("./funciones/conexion.php");

$enlaces=getEnlacesModulo($_GET['id_modulo_menu']);

if($_SESSION["vistazo_".$_GET['id_modulo_menu']]==1){
	$_SESSION["vistazo_".$_GET['id_modulo_menu']]=0;
}else{
	if(count($enlaces)==0){
		$_SESSION["vistazo_".$_GET['id_modulo_menu']]=1;
		?>
		  <li class="list-group-item">
		  <small>
			&nbsp;No hay características registradas...
		  </small>
		  </li>
		<?
	}else{
		$_SESSION["vistazo_".$_GET['id_modulo_menu']]=1;
	for($j=0;$j<count($enlaces);$j++){
	?>
		  <button type="button" class="list-group-item" onclick="FAjax('<?=$enlaces[$j]['url_enlace']?>','area_trabajo','','post');"><span class="glyphicon glyphicon-link" aria-hidden="true"></span>&nbsp;<?=$enlaces[$j]['nombre_enlace']?></button>
	<?
	}
	}
}
?>