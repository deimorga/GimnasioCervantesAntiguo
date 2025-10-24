<?
include ("funciones/conexion.php");
include ("./aplicacion/funciones/funciones_galeria.php");

$galeria=getGalerias(2);
//print_r($galeria);
?>
<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content" style="color:#666;">
         <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 id="tituloModal">GALERIAS DE VIDEOS...</h3>
            <small>Presione (ESC) para Cerrar Ventana.</small>
     	 </div>
         <div class="modal-body">
            <p id="textModal">
<?
if(count($galeria)==0){
echo "<center>NO HAY VIDEOS CARGADAS EN LA PLATAFORMA...</center>";
}else{
for($i=0;$i<count($galeria);$i++){
	$enlace=str_replace('https://www.youtube.com/watch?v=','https://i.ytimg.com/vi/',$galeria[$i]['enlace_galeria']).'/hqdefault.jpg';
    //echo $enlace;
	if($i%2==0){
		echo '</div><div class="row">';
	}
?>
  <div class="col-xs-12 col-sm-6">
    <div class="thumbnail">
      <div class="caption">
        <h3> <?=$galeria[$i]["galeria"]?></h3>
        <p>
        <a href="#menu_superior" onclick="window.open('<?=$galeria[$i]['enlace_galeria']?>');" class="link_right"><img src="<?=$enlace?>" width="90%" alt="<?=$galeria[$i]["galeria"]?>" title="<?=$galeria[$i]["galeria"]?>" /></a></p>
        <p><?=$galeria[$i]["descripcion_galeria"]?></p>
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