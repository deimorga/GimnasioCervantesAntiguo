<?
include ("funciones/conexion.php");
include ("funciones/funciones.php");

if(isset($_GET['id_noticia'])){
	$id=$_GET['id_noticia'];
}

$noticia=getNoticiaId($id);
$titulo=$noticia["titulo"];
$img="./img/noticias/".$noticia["id_noticia"].".jpg";
$text=nl2br($noticia["noticia"]);
?>
<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content" align="center" style="color:#666;">
         <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 id="tituloModal"><?=$titulo?></h3>
			<small>Presione (ESC) para Cerrar Ventana.</small>
     	 </div>
         <div class="modal-body">
         	<img id="imgModal" src="<?=$img?>" style="max-width:80%;" />
            <p id="textModal">
            <?=$text?>    
            </p>
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