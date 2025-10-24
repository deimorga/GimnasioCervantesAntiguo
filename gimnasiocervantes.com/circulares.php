<?
session_start();

include_once("./funciones/funciones.php");
include_once("./funciones/conexion.php");

$circulares=getCirculares();
?>
<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content" style="color:#666;">
         <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 id="tituloModal">LISTADO DE CIRCULARES EMITIDAS.</h3>
            <small>Presione (ESC) para Cerrar Ventana.</small>
     	 </div>
         <div class="modal-body">
            <p id="textModal">

<table class="table table-responsive table-hover table-bordered" style="color:#666;">
<thead>
  <tr>
    <th>Fecha</th>
    <th>Tema</th>
    <th>Emisor</th>
    <th>Dirigido a</th>
    <th>Acci&oacute;n</th>
  </tr>
</thead>
<tbody>
<?
if(count($circulares)<1){
?>
  <tr>
    <td colspan="5">NO HAY CIRCULARES REGISTRADAS</td>
  </tr>
<?
}else{
for($i=0;$i<count($circulares);$i++){
?>
  <tr>
    <td><?=$circulares[$i]['fecha_circular']?></td>
    <td><?=$circulares[$i]['tema']?></td>
    <td><?=$circulares[$i]['emisor']?></td>
    <td><?=$circulares[$i]['dirigida']?></td>
    <td><a href='./circulares/<?=$circulares[$i]['archivo']?>' target='_blank'>Descargar</a></td>
  </tr>
<?
}
}
?>
</tbody>
</table>
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