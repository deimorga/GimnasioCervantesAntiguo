<?
include ("funciones/conexion.php");
include ("./aplicacion/funciones/funciones_galeria.php");

$limit=4;
$galeria=getGalerias();
if($_GET['ver_todas']==1){
	$limit=count($galeria);
}
//print_r($galeria);
?>

<div class="panel panel-info">
<div class="panel-heading"><h5>Ultimas Galerias Fotográficas</h5></div>
<div class="panel-body">
<div class="row">
<?
for($i=0;$i<$limit;$i++){
$imagenes = glob("./aplicacion/img/".$galeria[$i]["id_galeria"]."/{*.jpg,*.JPG,*.jpeg,*.JPEG,*PNG,*.png,*GIF,*.gif}",GLOB_BRACE);
if($imagenes[0]==NULL){
	str_replace("JPG","jpg",$imagenes[0]);
}
if($i % 4 == 0){
?>
</div><div class="row">
<?
}
?>
  <div class="col-xs-12 col-sm-6 col-md-3">
  <div class="thumbnail">
    <a href="#contenido_usuario_1" onclick="FAjax('aplicacion/ver_sitio.php?id=<?=$galeria[$i]["id_galeria"]?>','contenido_usuario_4','','post');" data-toggle="tooltip" data-placement="top" title="<?=$galeria[$i]["galeria"]?>">
		<img src="<?=$imagenes[0]?>" alt="<?=$imagenes[0]?>" style="width:100%;max-width:350px; height:200px;">
        <div class="caption">
          <?=$galeria[$i]["galeria"]?>
        </div>
    </a>
  </div>
  </div>  
<?
}
?>
</div>
<?
if($_GET['ver_todas']==1){
?>
<div class="row">
<nav aria-label="...">
  <ul class="pager">
    <li>
    <a href="#contenido_usuario_4" onclick="FAjax('ultimas_galerias.php', 'contenido_usuario_1','','post');" data-toggle="tooltip" data-placement="top" title="OCULTAR">
    OCULTAR TODAS LAS GALERIAS <span class="glyphicon glyphicon-folder-close"></span></a>
    </li>
  </ul>
</nav>
</div>
<?
}else{
?>
<div class="row">
<nav aria-label="...">
  <ul class="pager">
    <li>
    <a href="#contenido_usuario_4" onclick="FAjax('ultimas_galerias.php?ver_todas=1', 'contenido_usuario_1','','post');" data-toggle="tooltip" data-placement="top" title="VER TODAS">
    VER TODAS LAS GALERIAS <span class="glyphicon glyphicon-folder-open"></span></a>
    </li>
  </ul>
</nav>
</div>
<?
}
?>

</div>
</div>