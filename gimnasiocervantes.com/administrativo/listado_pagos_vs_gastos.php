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

$total_pagos=0;
$total_pagos_otros=0;
$total_gastos=0;
$total_gastos_2=0;
$total_total=0;
//echo "*****".$_REQUEST['concepto_pago'];
$conceptos=getConceptosPagados($_REQUEST['fechaini'],$_REQUEST['fechafin'],$_REQUEST['id_alumno'],$_REQUEST['nombre_alumno'],$_REQUEST['concepto_pago'],$_REQUEST['id_factura'],$_REQUEST['grupo']);

?>
<h2>Listado de conceptos pagados.</h2>
<table class="table table-hover table-striped table-bordered">
  <thead>
    <tr>
    <th>No. factura</th>
    <th>Concepto</th>
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
?>
  <tr>
    <td><?=$conceptos[$i]['id_factura']?></td>
    <td><?
    echo $conceptos[$i]['nombre_concepto_pago'];

if($conceptos[$i]['tipo_concepto']>=3 && $conceptos[$i]['tipo_concepto']<6){ 
echo " periodo ".$conceptos[$i]['periodo_facturado'];		  }

	?>
	</td>
    <td><?=$conceptos[$i]['id_alumno']?></td>
    <td><?=$conceptos[$i]['nombre_alumno']?></td>
    <td><?=$conceptos[$i]['nombre_grado']?></td>
    <td><?=$conceptos[$i]['fecha_pago']?></td>
    <td align="right"><?=$conceptos[$i]['valor_cancelado']?></td>
  </tr>
<?
	$total_pagos=$total_pagos+$conceptos[$i]['valor_cancelado'];
}}
?>
  <tr bgcolor="#00FF66" align="right">
    <td colspan="6" align="right">TOTAL:</td>
    <td align="right"><?=$total_pagos?></td>
  </tr>
</tbody>
</table>
<?
$conceptos_otros=getConceptosOtros($_REQUEST['fechaini'],$_REQUEST['fechafin'],$_REQUEST['id_alumno'],$_REQUEST['nombre_alumno'],$_REQUEST['concepto_pago'],$_REQUEST['id_factura'],$_REQUEST['grupo']);
?>
<h2>Listado de otros conceptos pagados.</h2>
<table class="table table-hover table-striped table-bordered">
  <thead>
    <tr>
    <th>No. factura</th>
    <th>Concepto</th>
    <th>Identificacion</th>
    <th>Nombre</th>
    <th>Fecha pagado</th>
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
$conceptos_gastos=getGastosSecretaria($_REQUEST['fechaini'],$_REQUEST['fechafin'],1);
?>
<h2>Listado de Gastos Administrativos.</h2>
<table class="table table-hover table-striped table-bordered">
  <thead>
    <tr>
    <th>Concepto</th>
    <th>Usuario</th>
    <th>Fecha gasto</th>
    <th>Descripcion</th>
    <th>Tipo de Gasto</th>
    <th>Valor</th>
  </tr>
  </thead>
  <tbody>
<?
if(count($conceptos_gastos)<1){
?>
  <tr>
    <td colspan="6" align="center">NO HAY GASTOS REGISTRADOS</td>
  </tr>
<?
}else{
for($i=0;$i<count($conceptos_gastos);$i++){
?>
  <tr>
    <td><?=$conceptos_gastos[$i]['nombre_gasto']?></td>
    <td><?=$conceptos_gastos[$i]['id_usuario']?></td>
    <td><?=$conceptos_gastos[$i]['fecha_gasto']?></td>
    <td><?=$conceptos_gastos[$i]['descripcion_gasto']?></td>
    <td><? if($conceptos_gastos[$i]['tipo_gasto']==1){ echo "Administrativo";}elseif($conceptos_gastos[$i]['tipo_gasto']==2){ echo "Institucional";}?></td>
    <td align="right"><?=$conceptos_gastos[$i]['valor_gasto']?></td>
  </tr>
<?
$total_gastos=$total_gastos+$conceptos_gastos[$i]['valor_gasto'];
}}
$total_total=$total_pagos+$total_pagos_otros-$total_gastos;
?>
  <tr bgcolor="#00FF66" align="right">
    <td colspan="5" align="right">TOTAL:</td>
    <td align="right"><?=$total_gastos?></td>
  </tr>
</tbody>
</table>



<?
$conceptos_gastos_2=getGastosSecretaria($_REQUEST['fechaini'],$_REQUEST['fechafin'],2);
?>
<h2>Listado de Gastos Institucionales.</h2>
<table class="table table-hover table-striped table-bordered">
  <thead>
    <tr>
    <th>Concepto</th>
    <th>Usuario</th>
    <th>Fecha gasto</th>
    <th>Descripcion</th>
    <th>Tipo de Gasto</th>
    <th>Valor</th>
  </tr>
  </thead>
  <tbody>
<?
if(count($conceptos_gastos_2)<1){
?>
  <tr>
    <td colspan="6" align="center">NO HAY GASTOS REGISTRADOS</td>
  </tr>
<?
}else{
for($i=0;$i<count($conceptos_gastos_2);$i++){
?>
  <tr>
    <td><?=$conceptos_gastos_2[$i]['nombre_gasto']?></td>
    <td><?=$conceptos_gastos_2[$i]['id_usuario']?></td>
    <td><?=$conceptos_gastos_2[$i]['fecha_gasto']?></td>
    <td><?=$conceptos_gastos_2[$i]['descripcion_gasto']?></td>
    <td><? if($conceptos_gastos_2[$i]['tipo_gasto']==1){ echo "Administrativo";}elseif($conceptos_gastos_2[$i]['tipo_gasto']==2){ echo "Institucional";}?></td>
    <td align="right"><?=$conceptos_gastos_2[$i]['valor_gasto']?></td>
  </tr>
<?
$total_gastos_2=$total_gastos_2+$conceptos_gastos_2[$i]['valor_gasto'];
}}
$total_total=$total_pagos+$total_pagos_otros-$total_gastos-$total_gastos_2;
?>
  <tr bgcolor="#00FF66" align="right">
    <td colspan="5" align="right">TOTAL:</td>
    <td align="right"><?=$total_gastos_2?></td>
  </tr>
</tbody>
</table>

<h2>Totales:</h2>
Ingresos <?=$total_pagos?><br />
Otros Ingresos <?=$total_pagos_otros?><br />
Gastos Administrativos<?=$total_gastos?><br />
Gastos Institucionales<?=$total_gastos_2?><br />
Diferencia <?=$total_total?><br />
<?
if($_REQUEST['descargar_pagos']==1){
	echo "<script>window.close();</script>";
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><input type="button" value="IMPRIMIR" class="btn-sm btn-primary" onClick="window.open('./administrativo/listado_pagos_vs_gastos.php?fechaini=<?=$_REQUEST['fechaini']?>&fechafin=<?=$_REQUEST['fechafin']?>&descargar_pagos=1');"/></td>
  </tr>
</table>
