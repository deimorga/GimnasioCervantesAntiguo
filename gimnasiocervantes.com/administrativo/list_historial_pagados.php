<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET['externo']==1){
	$alumno_concepto=getConceptosAlumnoPagados($_GET['identificacion']);
	$alumno_data=getAlumnoId($_GET['identificacion']);
}else{
	$alumno_concepto=getConceptosAlumnoPagados($_SESSION['alumno_pago']);
	$alumno_data=getAlumnoId($_SESSION['alumno_pago']);
}
$total_descuentos=0;
$total_pagos=0;
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



<h3>Listado de conceptos pagados.</h3>
<? echo $alumno_data['identificacion']." - ".$alumno_data['nombre_alumno']?>
<table width="90%" class="table table-responsive table-hover table-bordered">
  <thead>
    <th>Concepto</th>
    <th>Numero factura</th>
    <th>Forma pago</th>
    <th>Fecha facturado</th>
    <th>Fecha pagado</th>
    <th>Descuento</th>
    <th>Valor</th>
  </thead>
  <tbody>
<?
if(count($alumno_concepto)<1){
?>
  <tr>
    <td colspan="7" align="center">NO HAY PAGOS REGISTRADOS</td>
  </tr>
<?
}else{
	$tipo="";
	$tot_efectivo=0;
	$tot_consignacion=0;
for($i=0;$i<count($alumno_concepto);$i++){
	if($alumno_concepto[$i]['tipo_pago']==1){ 
		$tipo="EFECTIVO";
		$tot_efectivo=$tot_efectivo+$alumno_concepto[$i]['valor_cancelado'];
	}else{ 
		$tipo="CONSIGNACION";
		$tot_consignacion=$tot_consignacion+$alumno_concepto[$i]['valor_cancelado'];
	}
?>
  <tr>
    <td><?
    echo $alumno_concepto[$i]['nombre_concepto_pago'];
	if($alumno_concepto[$i]['tipo_concepto']>=3 && $alumno_concepto[$i]['tipo_concepto']<6){ echo " periodo ".$alumno_concepto[$i]['periodo_facturado'];}elseif($alumno_concepto[$i]['tipo_concepto']==6){
		echo " Dia: ".$alumno_concepto[$i]['fecha_consignacion']." / ".$alumno_concepto[$i]['descripcion_consignacion'];}
	?></td>
    <td>
    <a href="#" onclick="window.open('./pdf/recibos/descarga.php?f=<?=$alumno_concepto[$i]['id_factura']?>.pdf&factura=<?=$alumno_concepto[$i]['id_factura']?>');"><?=$alumno_concepto[$i]['id_factura']?></a>
    <?
    if($_SESSION["user_id"]==80771008 || $_SESSION["user_id"]==1070948254){
	?>
    <br /><a href="#" onclick="window.open('./pdf/index_recibo_copia.php?factura=<?=$alumno_concepto[$i]['id_factura']?>');">Reimp</a>
	<?	
	}
	?>
    </td>
    <td><?=$tipo?></td>
    <td><?=$alumno_concepto[$i]['fecha_facturado']?></td>
    <td><?=$alumno_concepto[$i]['fecha_pago']?></td>
    <td><?=$alumno_concepto[$i]['descuento']?></td>
    <td><?=$alumno_concepto[$i]['valor_cancelado']?></td>
  </tr>
<?
$total_descuentos=$total_descuentos+$alumno_concepto[$i]['descuento'];
$total_pagos=$total_pagos+$alumno_concepto[$i]['valor_cancelado'];
}
?>
  <tr>
    <td colspan="6">Total Efectivo</td>
    <td><?=$tot_efectivo?></td>
  </tr>
  <tr>
    <td colspan="6">Total Consignaciones</td>
    <td><?=$tot_consignacion?></td>
  </tr>
  <tr>
    <td colspan="5">Total Ingresos</td>
    <td><?=$total_descuentos?></td>
    <td><?=$total_pagos?></td>
  </tr>
<?
}
?>
<tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><input type="button" value="IMPRIMIR" class="button_send" /></td>
  </tr>
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