<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$visitas=getVisitas();
?>
<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content" style="color:#666;">
         <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 id="tituloModal">LISTADO DE VISITAS EMITIDAS.</h3>
            <small>Presione (ESC) para Cerrar Ventana.</small>
     	 </div>
         <div class="modal-body">
            <p id="textModal">





<table class="table table-responsive table-hover table-bordered" style="color:#666;">
<thead>
  <tr>
    <th>Fecha</th>
    <th>IP</th>
  </tr>
</thead>
<tbody>
<?
if(count($visitas)<1){
?>
  <tr>
    <td colspan="5">NO HAY VISITAS REGISTRADAS</td>
  </tr>
<?
}else{
for($i=0;$i<count($visitas);$i++){
?>
  <tr>
    <td><?=$visitas[$i]['fecha']?></td>
    <td><?=$visitas[$i]['ip']?></td>
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