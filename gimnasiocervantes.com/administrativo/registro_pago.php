<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_REQUEST['pago_nuevo']==1){
	$_SESSION['alumno_pago']=$_REQUEST['identificacion'];
}

if($_POST['actualiza_pago']==1){
	$concepto_pago=getConceptoId($_POST['concepto_pago']);

	$valor=$_REQUEST['valor_facturar'];
	if($concepto_pago['tipo_concepto']==3 || $concepto_pago['tipo_concepto']==4 || $concepto_pago['tipo_concepto']==5){
	$insert_pago=setPension($_SESSION['alumno_pago'],$valor,$_REQUEST['anio_pago']."-".$_REQUEST['mes_pago']."-00",$_POST['concepto_pago']);
	}elseif($concepto_pago['tipo_concepto']==6){
	$insert_pago=setConsignacionAlumno($_SESSION['alumno_pago'],$_POST['concepto_pago'],$valor,$_POST['fecha_consignacion'],$_POST['descripcion']);
	}else{
	$insert_pago=setConceptoPagoAlumno($_SESSION['alumno_pago'],$_POST['concepto_pago'],$valor);
	}
	if($insert_pago){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('Los datos no se guardaron correctamente...');</script>";
	}
}
?>
<table width="100%" cellspacing=0 border="0">
  <tr>
    <td><div id="concepto"><? include_once("concepto.php");?></div></td>
  </tr>
  <tr>
	<td align="right" class="subenlace" valign="top"><input class="button_send2" name="listado_pendientes" id="listado_pendientes" type="button" value="PENDIENTES X PAGO" onclick="FAjax('./administrativo/list_concepto_facturados.php','list_concepto','','post');"></td>
  </tr>
  <tr>
    <td valign="top"><div id="list_concepto"></div></td>
  </tr>
  <tr>
	<td align="right" class="subenlace" valign="top"><input class="button_send2" name="historial_pagos" id="historial_pagos" type="button" value="HISTORIAL DE PAGOS" onclick="FAjax('./administrativo/list_historial_pagados.php','list_historial','','post');"></td>
  </tr>
  <tr>
    <td valign="top"><div id="list_historial"></div></td>
  </tr>
</table>

