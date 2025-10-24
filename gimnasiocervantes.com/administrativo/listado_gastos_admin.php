<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET['eliminar_gasto']==1){
	$elimino=delGasto($_GET['id']);
	if($elimino){
		echo "<script>alert('Los datos se eliminaron correctamente...');</script>";
	}else{
		echo "<script>alert('Los datos no se eliminaron correctamente...');</script>";
	}
}

$rango="";
for($r=1;$r<=4;$r++){
	if($_REQUEST['recursos_pago_'.$r]==1){
		if(strlen($rango)>=1){
			$rango=$rango.",".$r;
		}else{
			$rango=$rango.$r;
		}
	}
}
$conceptos_gastos=getGastosRecursos($_REQUEST['fechaini'],$_REQUEST['fechafin'],1,$rango);
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
    <th>Recursos Pago</th>
    <th>Valor</th>
    <th>Accion</th>
  </tr>
  </thead>
  <tbody>
<?
if(count($conceptos_gastos)<1){
?>
  <tr>
    <td colspan="8" align="center">NO HAY GASTOS REGISTRADOS</td>
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
    <td><?=$conceptos_gastos[$i]['recursos_pago']?>-<? if($conceptos_gastos[$i]['recursos_pago']==1){ echo "Efectivo Diario";}elseif($conceptos_gastos[$i]['recursos_pago']==2){ echo "Efectivo Conciliado";}elseif($conceptos_gastos[$i]['recursos_pago']==3){ echo "Banco";}elseif($conceptos_gastos[$i]['recursos_pago']==4){ echo "Cheque";}?></td>
    <td align="right"><?=$conceptos_gastos[$i]['valor_gasto']?></td>
    <td align="right"><a href="#" onClick="if(confirm('Seguro de eliminar el gasto?')){FAjax('./administrativo/listado_gastos_admin.php?id=<?=$conceptos_gastos[$i]['id_gasto']?>&eliminar_gasto=1','listado_admin','','post')}else{ return false;};">Eliminar>></a></td>
  </tr>
<?
$total_gastos=$total_gastos+$conceptos_gastos[$i]['valor_gasto'];
}}
$total_total=$total_pagos+$total_pagos_otros-$total_gastos;
?>
  <tr bgcolor="#00FF66" align="right">
    <td colspan="6" align="right">TOTAL:</td>
    <td align="right"><?=$total_gastos?></td>
    <td>&nbsp;</td>
  </tr>
</tbody>
</table>



<?
$conceptos_gastos_2=getGastosRecursos($_REQUEST['fechaini'],$_REQUEST['fechafin'],2,$rango);
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
    <th>Recursos Pago</th>
    <th>Valor</th>
    <th>Accion</th>
  </tr>
  </thead>
  <tbody>
<?
if(count($conceptos_gastos_2)<1){
?>
  <tr>
    <td colspan="8" align="center">NO HAY GASTOS REGISTRADOS</td>
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
    <td><? if($conceptos_gastos_2[$i]['recursos_pago']==1){ echo "Efectivo Diario";}elseif($conceptos_gastos_2[$i]['recursos_pago']==2){ echo "Efectivo Conciliado";}elseif($conceptos_gastos_2[$i]['recursos_pago']==3){ echo "Banco";}elseif($conceptos_gastos_2[$i]['recursos_pago']==4){ echo "Cheque";}?></td>
    <td align="right"><?=$conceptos_gastos_2[$i]['valor_gasto']?></td>
    <td align="right"><a href="#" onClick="if(confirm('Seguro de eliminar el gasto?')){FAjax('./administrativo/listado_gastos_admin.php?id=<?=$conceptos_gastos_2[$i]['id_gasto']?>&eliminar_gasto=1','listado_admin','','post')}else{ return false;};">Eliminar>></a></td>
  </tr>
<?
$total_gastos_2=$total_gastos_2+$conceptos_gastos_2[$i]['valor_gasto'];
}}
$total_total=$total_pagos+$total_pagos_otros-$total_gastos-$total_gastos_2;
?>
  <tr bgcolor="#00FF66" align="right">
    <td colspan="6" align="right">TOTAL:</td>
    <td align="right"><?=$total_gastos_2?></td>
    <td>&nbsp;</td>
  </tr>
</tbody>
</table>





<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><input type="button" value="IMPRIMIR" class="btn-sm btn-primary" /></td>
  </tr>
</table>