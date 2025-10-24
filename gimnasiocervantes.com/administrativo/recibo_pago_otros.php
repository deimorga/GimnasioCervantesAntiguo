<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_POST['actualiza_concepto']==1){
	$guarda_pago=setPagoOtros($_POST['id_pago'],$_POST['nombre_pago'],$_POST['concepto_pago'],$_POST['valor_pago'],$_POST['observaciones_pago'],$_SESSION["user_id"]);
	if($guarda_pago){
		$factura=setFactura($_SESSION["user_id"],$_POST['id_pago'],3);

		if($factura){
			$_SESSION['factura']=$factura;
			updPagoOtros($guarda_pago,$_SESSION['factura']);
			updTotalFactura($_SESSION['factura'], $_POST['valor_pago']);
		}else{
			echo "<script>alert('No se guardaron correctamente la factura...');</script>";
		}
	}else{
		echo "<script>alert('No se guardaron correctamente el concepto de pago...');</script>";
	}
}

$total_pago=0;
$datos=getPagoOtrosId($_SESSION['factura']);
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
    <td width="180">&nbsp;<?=$datos["identificacion"]?></td>

  </tr>
  <tr>
    <td>Nombre del Alumno:</td>
    <td colspan="3">&nbsp;<? echo $datos["nombre"];?></td>
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
  <tr>
    <td><?=$datos["concepto"]?></td>
    <td><?=$datos['fecha_pago']?></td>
    <td align="right"><?=number_format($datos['valor_pago'],2,',','.')?></td>
  </tr>
  <tr>
	<td align="left">Fecha de Pago(AAAA-MM-DD): <?=date("Y-m-d")?></td>
	<td align="right">Total Pago $&nbsp;</td>
	<td align="right"><?=number_format($datos['valor_pago'],2,',','.')?></td>
  </tr>
  <tr>
  	<td colspan="3" height="80px" align="center">Este desprendible es valido como comprobante de pago, en caso de inconsistencias o dudas puede comunicarse con el personal autorizado a la linea (57)(1) 8430744.</td>
  </tr>
</table>
<table align="center" width="600px" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><input type="button" value="IMPRIMIR RECIBO" class="button_send" onclick="window.open('./pdf/index_recibo_otros.php');form.boton_aceptar.disabled=false;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="ACEPTAR" class="button_send" id="boton_aceptar" name="boton_aceptar" onClick="FAjax('./administrativo/registro_pago.php','area_trabajo','','post');" disabled="disabled" /></td>
  </tr>
</table>