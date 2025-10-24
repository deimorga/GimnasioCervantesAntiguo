<?
session_start();
if($_REQUEST['descargar_pagos']==1){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=archivo.xls");
	header("Pragma: no-cache");
	header("Expires: 0"); 
	//echo "lololo";
}
include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$tot_consignaciones=0;
$tot_efectivo=0;



if(isset($_SESSION['esturiante_matriculado'])){
$conceptos=getConceptosPagadosFact($_REQUEST['fechaini'],$_REQUEST['fechafin'],$_SESSION['esturiante_matriculado'],$_REQUEST['nombre_alumno'],$_REQUEST['concepto_pago'],$_REQUEST['id_factura'],$_REQUEST['grupo']);
}else{
$conceptos=getConceptosPagadosFact($_REQUEST['fechaini'],$_REQUEST['fechafin'],$_REQUEST['id_alumno'],$_REQUEST['nombre_alumno'],$_REQUEST['concepto_pago'],$_REQUEST['id_factura'],$_REQUEST['grupo']);
}
?>
<?
if(isset($_SESSION['esturiante_matriculado'])){
include("../aula/botones_retorno.php");
}
?>
<h2>Listado de pagos en efectivo por Factura.</h2>
<table class="table table-hover table-striped table-bordered">
  <thead>
    <tr>
    <th>No. factura</th>
    <th>Identificacion</th>
    <th>Nombre</th>
    <th>Grado</th>
    <th>Fecha_pagado</th>
    <th>Valor</th>
  </tr>
  </thead>
  <tbody>
<?
if(count($conceptos)<1){
?>
  <tr>
    <td colspan="7" align="center">NO HAY PAGOS REGISTRADOS</td>
  </tr>
<?
}else{
for($i=0;$i<count($conceptos);$i++){
	$tot_efectivo=$tot_efectivo+$conceptos[$i]['valor_pago'];
?>
  <tr>
    <td><?=$conceptos[$i]['id_factura']?></td>
    <td><?=$conceptos[$i]['id_alumno']?></td>
    <td><?=$conceptos[$i]['nombre_alumno']?></td>
    <td><?=$conceptos[$i]['nombre_grado']?></td>
    <td><?=$conceptos[$i]['fecha_pago']?></td>
    <td align="right"><?=$conceptos[$i]['valor_pago']?></td>
  </tr>
<?
}}
?>
  <tr bgcolor="#00FF66">
    <td colspan="5">Total Efectivo</td>
    <td><?=$tot_efectivo?></td>
  </tr>
</tbody>
</table>


<h2>Listado de consignaciones por Factura.</h2>
<table class="table table-hover table-striped table-bordered">
  <thead>
    <tr>
    <th>No. factura</th>
    <th>Identificacion</th>
    <th>Nombre</th>
    <th>Grado</th>
    <th>Fecha_Consignacion</th>
    <th>Valor</th>
  </tr>
  </thead>
  <tbody>
<?
$conceptos2=getConceptosConsignadosFact($_REQUEST['fechaini'],$_REQUEST['fechafin'],$_REQUEST['id_alumno'],$_REQUEST['nombre_alumno'],$_REQUEST['concepto_pago'],$_REQUEST['id_factura'],$_REQUEST['grupo']);
if(count($conceptos2)<1){
?>
  <tr>
    <td colspan="7" align="center">NO HAY CONSIGNACIONES REGISTRADAS</td>
  </tr>
<?
}else{
for($i=0;$i<count($conceptos2);$i++){
	$tot_consignaciones=$tot_consignaciones+$conceptos2[$i]['valor_pago'];
?>
  <tr>
    <td><?=$conceptos2[$i]['id_factura']?></td>
    <td><?=$conceptos2[$i]['id_alumno']?></td>
    <td><?=$conceptos2[$i]['nombre_alumno']?></td>
    <td><?=$conceptos2[$i]['nombre_grado']?></td>
    <td><?=$conceptos2[$i]['fecha_pago']?></td>
    <td align="right"><?=$conceptos2[$i]['valor_pago']?></td>
  </tr>
<?
}}
?>
  <tr bgcolor="#00FF66">
    <td colspan="5">Total Consignaciones</td>
    <td><?=$tot_consignaciones?></td>
  </tr>
</tbody>
</table>



<?
if(isset($_SESSION['esturiante_matriculado'])){
$conceptos_otros=getConceptosOtros($_REQUEST['fechaini'],$_REQUEST['fechafin'],$_SESSION['esturiante_matriculado'],$_REQUEST['nombre_alumno'],$_REQUEST['concepto_pago'],$_REQUEST['id_factura'],$_REQUEST['grupo']);
}else{
$conceptos_otros=getConceptosOtros($_REQUEST['fechaini'],$_REQUEST['fechafin'],$_REQUEST['id_alumno'],$_REQUEST['nombre_alumno'],$_REQUEST['concepto_pago'],$_REQUEST['id_factura'],$_REQUEST['grupo']);
}
?>
<h2>Listado de otros conceptos pagados.</h2>
<table class="table table-hover table-striped table-bordered">
  <thead>
    <tr>
    <th>No. factura</th>
    <th>Concepto</th>
    <th>Identificacion</th>
    <th>Nombre</th>
    <th>Fecha_pagado</th>
    <th>Valor</th>
  </tr>
  </thead>
  <tbody>
<?
if(count($conceptos_otros)<1){
?>
  <tr>
    <td colspan="7" align="center">NO HAY PAGOS REGISTRADOS</td>
  </tr>
<?
}else{
for($i=0;$i<count($conceptos_otros);$i++){
?>
  <tr>
    <td><?=$conceptos_otros[$i]['id_factura']?></td>
    <td><?
    echo $conceptos_otros[$i]['concepto'];
	?>
	</td>
    <td><?=$conceptos_otros[$i]['identificacion']?></td>
    <td><?=$conceptos_otros[$i]['nombre']?></td>
    <td><?=$conceptos_otros[$i]['fecha_pago']?></td>
    <td align="right"><?=$conceptos_otros[$i]['valor_pago']?></td>
  </tr>
<?
	$total_pagos_otros=$total_pagos_otros+$conceptos_otros[$i]['valor_pago'];
}}
?>
  <tr bgcolor="#00FF66" align="right">
    <td colspan="5" align="right">TOTAL:</td>
    <td align="right"><?=$total_pagos_otros?></td>
  </tr>
</tbody>
</table>
<?
if($_REQUEST['descargar_pagos']==1){
	echo "<script>window.close();</script>";
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><input type="button" value="IMPRIMIR" class="btn-sm btn-primary" onclick="window.open('./administrativo/listado_pagos_admin_fact.php?fechaini=<?=$_REQUEST['fechaini']?>&fechafin=<?=$_REQUEST['fechafin']?>&id_alumno=<?=$_REQUEST['id_alumno']?>&nombre_alumno=<?=$_REQUEST['nombre_alumno']?>&concepto_pago=<?=$_REQUEST['concepto_pago']?>&id_factura<?=$_REQUEST['id_factura']?>&descargar_pagos=1');"/></td>
  </tr>
</table>
