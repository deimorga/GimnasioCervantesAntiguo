<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$factura=setFactura($_SESSION["user_id"],$_SESSION['alumno_pago'],$_POST["tipo_pago"],$_POST['fechapago']);

if($factura){
	$_SESSION['factura']=$factura;
}
//die("lololo".$factura);
$alumno_concepto=getConceptosAlumnoPendientes($_SESSION['alumno_pago']);
$total_pago=0;
$datos=getAlumnoId($_SESSION['alumno_pago']);
?>
<table width="600" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="170"><img src="./img/logo1.jpg" width="170" height="159"></td>
    <td align="center">Colegio Gimnasio Cervantes.<br>Factura de pago No. <?=$factura?></td>
    <td width="170"><img src="./img/logo2.jpg" width="170" height="115"></td>
  </tr>
</table>


<table width="600" align="center" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" bgcolor="#CCCCCC" align="center"><h3>Datos Del Alumno.</h3></td>
  </tr>
  <tr>
    <td width="120">Identificacion del Alumno:</td>
    <td width="180">&nbsp;<?=$_SESSION["alumno_pago"]?></td>
    <td width="120">Grupo:</td>
    <td width="180">&nbsp;<? echo $datos["nombre_grupo"];?></td>
  </tr>
  <tr>
    <td>Nombre del Alumno:</td>
    <td colspan="3">&nbsp;<? echo $datos["nombre_alumno"];?></td>
  </tr>
</table>


<table align="center" width="600" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="5" align="center" bgcolor="#CCCCCC"><h3>Detalles Del Pago.</h3></td>
  </tr>
  <tr>
    <td>Concepto</td>
    <td>Fecha facturado</td>
    <td>Valor</td>
  </tr>
<?
for($i=0;$i<count($alumno_concepto);$i++){
	if($_POST[$alumno_concepto[$i]['id_concepto_pago_alumno']]){
		if($alumno_concepto[$i]['tipo_concepto']!=2){
			$actualiza=setConceptoPagoPension($alumno_concepto[$i]['id_concepto_pago_alumno'],$factura,$_POST['valor_'.$alumno_concepto[$i]['id_concepto_pago_alumno']],$_POST['descuento_'.$alumno_concepto[$i]['id_concepto_pago_alumno']],$_POST['saldo_'.$alumno_concepto[$i]['id_concepto_pago_alumno']],$alumno_concepto[$i]['id_concepto_pago'],$_SESSION["alumno_pago"],$alumno_concepto[$i]['periodo_facturado']);
		}else{
		$actualiza=updConceptoPagoAlumno($alumno_concepto[$i]['id_concepto_pago_alumno'],$factura,$_POST['valor_'.$alumno_concepto[$i]['id_concepto_pago_alumno']],$_POST['descuento_'.$alumno_concepto[$i]['id_concepto_pago_alumno']],$_POST['saldo_'.$alumno_concepto[$i]['id_concepto_pago_alumno']],$alumno_concepto[$i]['id_concepto_pago'],$_SESSION["alumno_pago"]);
		}
		
		if($actualiza){
			$msj="";
		  if($alumno_concepto[$i]['tipo_concepto']>=3 && $alumno_concepto[$i]['tipo_concepto']<6){ 
		  $msj=" / ".$alumno_concepto[$i]['periodo_facturado'];
		  }
?>
  <tr>
    <td><?=$alumno_concepto[$i]['nombre_concepto_pago'].$msj?></td>
    <td><?=$alumno_concepto[$i]['fecha_facturado']?></td>
    <td align="right"><?=number_format($_POST['valor_'.$alumno_concepto[$i]['id_concepto_pago_alumno']],2,',','.')?></td>
  </tr>
<?
		}else{
			echo "<script>alert('Problemas al registrar el pago, Comunicarse con soporte...');FAjax('./administrativo/registro_pago.php','area_trabajo','','post');</script>";
		}
	$total_pago=$total_pago+$_POST['valor_'.$alumno_concepto[$i]['id_concepto_pago_alumno']];
	}
}
updTotalFactura($factura,$total_pago);
?>
  <tr>
	<td align="left">Fecha de Registro(AAAA-MM-DD): <?=date("Y-m-d")?></td>
	<td align="right">Total Pago $&nbsp;</td>
	<td align="right"><?=number_format($total_pago,2,',','.')?></td>
  </tr>
  <tr>
  	<td colspan="3" height="80px" align="center">Este desprendible es valido como comprobante de pago, en caso de inconsistencias o dudas puede comunicarse con el personal autorizado a la linea (57)(1) 8430744.</td>
  </tr>
</table>
<table align="center" width="600px" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><input type="button" value="IMPRIMIR RECIBO" class="button_send" onclick="window.open('./pdf/index_recibo.php');form.boton_aceptar.disabled=false;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="ACEPTAR" class="button_send" id="boton_aceptar" name="boton_aceptar" onClick="FAjax('./administrativo/registro_pago.php','area_trabajo','','post');" disabled="disabled" /></td>
  </tr>
</table>