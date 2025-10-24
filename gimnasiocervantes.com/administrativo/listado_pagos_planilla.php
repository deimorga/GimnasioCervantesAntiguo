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

$anio=$_REQUEST["anio"];
$grupo=getGrupoId($_REQUEST["grupo"]);

$alumnos=getAlumnosGrupo($_REQUEST['grupo']);
?>
<h2>Planilla de pagos <?=$anio?> - Grupo <?=$grupo['nombre_grupo']?>.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0" style="color:#000;">
  <tr bgcolor="#0033FF" style="color:#FFF;">
    <td>ID</td>
    <td>Nombre</td>
    <td>Matricula</td>
    <td>Otros</td>
    <td>Guias 1</td>
    <td>Guias 2</td>
    
    <td>Pesion<br />feb</td>
    <td>Interes<br />feb</td>
    <td>Banda<br />feb</td>
    
    <td>Pesion<br />mar</td>
    <td>Interes<br />mar</td>
    <td>Banda<br />mar</td>
    
    <td>Pesion<br />abr</td>
    <td>Interes<br />abr</td>
    <td>Banda<br />abr</td>
    
    <td>Pesion<br />may</td>
    <td>Interes<br />may</td>
    <td>Banda<br />may</td>
    
    <td>Pesion<br />jun</td>
    <td>Interes<br />jun</td>
    <td>Banda<br />jun</td>
    
    <td>Pesion<br />jul</td>
    <td>Interes<br />jul</td>
    <td>Banda<br />jul</td>
    
    <td>Pesion<br />ago</td>
    <td>Interes<br />ago</td>
    <td>Banda<br />feb</td>
    
    <td>Pesion<br />sep</td>
    <td>Interes<br />sep</td>
    <td>Banda<br />sep</td>
    
    <td>Pesion<br />oct</td>
    <td>Interes<br />oct</td>
    <td>Banda<br />oct</td>
    
    <td>Pesion<br />nov</td>
    <td>Interes<br />nov</td>
    <td>Banda<br />nov</td>
    
  </tr>
<?
for($i=0;$i<count($alumnos);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>

	<td><?=$alumnos[$i]['identificacion']?></td>
	<td><?=$alumnos[$i]['nombre_alumno']?></td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,'',8);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,'',19);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,'',14);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,'',18);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>


<!--Pago por conceptos de mes-->    
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,2,7);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,2,15);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,2,17);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
<!--Pago por conceptos de mes-->    
    
    


<!--Pago por conceptos de mes-->    
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,3,7);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,3,15);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,3,17);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
<!--Pago por conceptos de mes-->    
    
    


<!--Pago por conceptos de mes-->    
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,4,7);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,4,15);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,4,17);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
<!--Pago por conceptos de mes-->    
    
    


<!--Pago por conceptos de mes-->    
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,5,7);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,5,15);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,5,17);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
<!--Pago por conceptos de mes-->    
    
    


<!--Pago por conceptos de mes-->    
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,6,7);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,6,15);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,6,17);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
<!--Pago por conceptos de mes-->    
    
    


<!--Pago por conceptos de mes-->    
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,7,7);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,7,15);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,7,17);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
<!--Pago por conceptos de mes-->    
    
    


<!--Pago por conceptos de mes-->    
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,8,7);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,8,15);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,8,17);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
<!--Pago por conceptos de mes-->    
    
    


<!--Pago por conceptos de mes-->    
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,9,7);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,9,15);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,9,17);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
<!--Pago por conceptos de mes-->    
    
    


<!--Pago por conceptos de mes-->    
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,10,7);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,10,15);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,10,17);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
<!--Pago por conceptos de mes-->    
    
    


<!--Pago por conceptos de mes-->    
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,11,7);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,11,15);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
    <td>
    <?
    $pago_mat=getConceptoPeriodoAnioId($alumnos[$i]['identificacion'],$anio,11,17);
	for($j=0;$j<count($pago_mat);$j++){
		if($pago_mat[$j]['tipo_pago']==1){
			echo "EFECTIVO:<br>";
		}else{
			echo "BANCO:<br>";
		}
		echo $pago_mat[$j]['factura'].'| '.$pago_mat[$j]['valor_cancelado'].'| '.$pago_mat[$j]['fecha_pago'].'| ';
	}
	?>
    </td>
<!--Pago por conceptos de mes-->    
    
    
  </tr>
<?
}
?>
</table>

<?
if($_REQUEST['descargar_pagos']==1){
	echo "<script>window.close();</script>";
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><input type="button" value="IMPRIMIR" class="button_send" onclick="window.open('./administrativo/listado_pagos_planilla.php?grupo=<?=$_REQUEST['grupo']?>&descargar_pagos=1');"/></td>
  </tr>
</table>
