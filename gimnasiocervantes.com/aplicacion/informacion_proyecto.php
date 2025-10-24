<?
session_start();
include_once ("../funciones/conexion.php");
include_once ("../funciones/funciones.php");

$id=$_SESSION['id_proyecto'];
$galeria=getProyectoId($id);
?>
<iframe src="./aplicacion/galeriaNivoProyecto.php" frameborder="0" width="590" height="480"></iframe>
<h1>Descripcion</h1><br>
<p><?=$galeria['descripcion_proyecto']?></p>
<div class="clear"></div>
<br>
<?
if(strlen($galeria["enlace_blogg"])>1){
?>
<h2>Siguenos:</h2>
	<a href="#" onclick="window.open('<?=$galeria["enlace_blogg"]?>');"><img src="../img/blog.png" width="200" height="200" /></a>
<?
}
?>