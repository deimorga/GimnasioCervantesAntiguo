<?
include ("funciones/conexion.php");
include ("./aplicacion/funciones/funciones_galeria.php");

$galeria=getGalerias();
//print_r($galeria);
?>
<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content" style="color:#666;">
         <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 id="tituloModal">GALERIAS FOTOGRAFICAS...</h3>
            <small>Presione (ESC) para Cerrar Ventana.</small>
     	 </div>
         <div class="modal-body">
            <p id="textModal">

<?
if(count($galeria)==0){
echo "<center>NO HAY GALERIAS CARGADAS EN LA PLATAFORMA...</center>";
}else{
for($i=0;$i<count($galeria);$i++){
$imagenes = glob("./aplicacion/img/".$galeria[$i]["id_galeria"]."/{*.jpg,*.JPG,*.jpeg,*.JPEG,*PNG,*.png,*GIF,*.gif}",GLOB_BRACE);
if($imagenes[0]==NULL){
	str_replace("JPG","jpg",$imagenes[0]);
}
	if($i%4==0){
	echo '</div><div class="row">';
	}
?>
  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <div class="thumbnail">
      <div class="caption">
        <h3> <?=$galeria[$i]["galeria"]?></h3>
        <p>
        <a href="<?=$imagenes[0]?>" data-lightbox="Galeria" data-title="Galeria"><img id="<?=$imagenes[0]?>" style="box-shadow:0px 0px 15px 5px #09F; margin:15px;" src="<?=$imagenes[0]?>" width="90%" height="90%" alt="<?=$imagenes[0]?>" title="<?=$imagenes[0]?>" />
        </a>
        </p>
        <p><?=$galeria[$i]["descripcion_galeria"]?> 
        <a href="<?=$imagenes[0]?>" data-lightbox="Galeria" data-title="Galeria">        <img src="img/vermas.png" width="80" height="35" /></a>
        <a href="#contenido_usuario_4" data-dismiss="modal" onclick="FAjax('aplicacion/ver_sitio.php?id=<?=$galeria[$i]["id_galeria"]?>','contenido_usuario_4','','post');"><img src="img/vermas.png" width="80" height="35" /></a>
        </p>
      </div>
	</div>
  </div>
<?
}
}
?>
</div>
</div>


     	 </div>
         <div class="modal-footer">
        	<button type="button" data-dismiss="modal" class="btn btn-info">Cerrar</button>
     	 </div>
      </div>
   </div>
</div>
<?
if(true){
	echo '
<script>
FAjax("disparar_popup.php","contenido_popup","","post");
</script>';
}
?>