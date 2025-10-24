<?
session_start();
include_once ("../funciones/conexion.php");
include_once ("./funciones/funciones_galeria.php");

$id=$_SESSION['id_galeria'];
$galeria=getGaleriaId($id);
?>
<h5>Descripcion...</h5>
<br>
<p><?=$galeria['descripcion_galeria']?></p>
<?php
$imagenes =  glob("../aplicacion/img/".$id."/{*.jpg,*.JPG,*.png,*.PNG,*.gif,*.GIF,*.JPEG,*.jpeg}",GLOB_BRACE);
//echo $imagenes.$_SESSION["sitio"];
for($i=0;$i<count($imagenes);$i++){
	//echo substr($imagenes[$i],1);
	if($i%4==0){
	//echo "</tr><tr>";
	}
?>
  <div class="col-xs-12 col-sm-6 col-md-4">
    <a href="<?=substr($imagenes[$i],1)?>" data-lightbox="Galeria" data-title="Galeria"><img src="<?=substr($imagenes[$i],1)?>" width="100%" height="145"></a>
  </div>
<?
}
?>
