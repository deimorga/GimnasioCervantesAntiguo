<?
session_start();

include_once("./funciones/funciones.php");
include_once("./funciones/conexion.php");

$grupo=getGrupos();
?>
<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" style="color:#666;">
         <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 id="tituloModal">CUADRO DE HONOR.</h3>
            <small>Presione (ESC) para Cerrar Ventana.</small>
     	 </div>
         <div class="modal-body">
            <p id="textModal">

<?
for($g=0;$g<count($grupo);$g++){
	$alumnos=getAlumnosGrupoPuesto2($grupo[$g]['id_grupo'],1,2018);
?>
	<fieldset>
		<legend class="texte_legende2">Alumnos destacados del grupo <?=$grupo[$g]["nombre_grupo"]?>.</legend>
	</fieldset>
<table class="table table-responsive table-hover table-bordered" style="color:#666;">
<thead>
  <tr>
    <td>Puesto</td>
    <td>Identificaci&oacute;n</td>
    <td>Nombre</td>
  </tr>
</thead>
<tbody>
<?
for($i=0;$i<count($alumnos);$i++){
?>
  <tr>
    <td><?=$i+1?></td>
    <td><?=$alumnos[$i]['identificacion']?></td>
    <td><?=$alumnos[$i]['nombre_alumno']?></td>
  </tr>
<?
}
?>
</tbody>
</table>
<?
}
?>
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