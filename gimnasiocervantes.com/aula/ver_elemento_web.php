<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

$elemento=getElementosId($_GET['id_elemento']);
?>
<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content" style="color:#666;">
         <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 id="tituloModal"><?=$elemento['titulo_elemento']?></h3>
            <small>Presione (ESC) para Cerrar Ventana.</small>
     	 </div>
         <div class="modal-body">
            <p id="textModal">
                <div id="info">
                <?=nl2br($elemento['descripcion_elemento'])?>
                </div>
            </p>
            <p>
            <table>
<?
if($elemento['id_tipo_elemento']==1){//AUDIO
?>
  <tr>
    <td><audio src="./aula/elemento_web/<?=$elemento['id_elemento']?>/<?=$elemento['descripcion_elemento']?>" controls autoplay loop>
<p>Tu navegador no implementa el elemento audio</p>
</audio></td>
  </tr>
<?
}elseif($elemento['id_tipo_elemento']==2){//DOCUMENTO
?>
  <tr>
    <td>
    <a onClick="window.open('./aula/elemento_web/<?=$elemento['id_elemento']?>/<?=$elemento['descripcion_elemento']?>');">
    <img src="./iconos/descargar.gif" width="200" height="200">
    </a></td>
  </tr>
<?
}elseif($elemento['id_tipo_elemento']==3){//IMAGEN
?>
  <tr>
    <td>
    
    <img src="./aula/elemento_web/<?=$elemento['id_elemento']?>/<?=$elemento['descripcion_elemento']?>" style="max-width:100%;">
    </td>
  </tr>
<?
}elseif($elemento['id_tipo_elemento']==4){//TEXTO
}elseif($elemento['id_tipo_elemento']==5){//ENLACE DE OTRA PAGINA
?>
  <tr>
    <td>
        <a onClick="window.open('<?=$elemento['descripcion_web']?>');">
	        <img src="./iconos/web.png" width="200" height="200">
        </a>
    </td>
  </tr>
<?
}elseif($elemento['id_tipo_elemento']==6){//ENLACE DE YOUTUBE
?>
  <tr>
    <td>
<?php
    $url = $elemento['descripcion_web'];
    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
    $id = $matches[1];
    $width = '800px';
    $height = '450px';
?>
<iframe id="ytplayer" type="text/html" width="<?php echo $width ?>" height="<?php echo $height ?>"
    src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
    frameborder="0" allowfullscreen style="max-width:100%;">
</iframe> 
    <div class="row">
    <nav aria-label="...">
      <ul class="pager">
        <li>
        <a onClick="window.open('<?=$elemento['descripcion_web']?>');">
        VER VIDEO EN YOUTUBE <span class="glyphicon glyphicon-play-circle"></span></a>
        </li>
      </ul>
    </nav>
    </div>
	</td>
  </tr>
<?
}
?>
</table>
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