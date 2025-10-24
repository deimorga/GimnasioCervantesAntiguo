<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_POST['actualiza_gasto']==1){
	$guarda_gasto=setGasto($_POST['nombre_gasto'],$_POST['valor_gasto'],$_POST['observaciones_gasto'],$_SESSION["user_id"],$_POST['tipo_gasto'],$_POST['recursos_pago'],$_POST['fecha_gasto']);
	if($guarda_gasto){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

?>

<h2>Gastos y egresos.</h2>

	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">Nombre el gasto:
                    <input type="text" class="form-control" name="nombre_gasto" id="nombre_gasto"/>
    </div>                
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">Valor del gasto:
                <input type="text" class="form-control" name="valor_gasto" id="valor_gasto" onKeyPress="return numeros(event);"/>
    </div>            
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">Observaciones del gasto:
                <textarea class="form-control" name="observaciones_gasto" id="observaciones_gasto"></textarea>
    </div>            
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">Tipo de gasto:
                <select  class="form-control" name="tipo_gasto" id="tipo_gasto">
                		<option value="">Selecciones...</option>
                		<option value="1">Gasto Administrativo</option>
                		<option value="2">Gasto Institucional</option>
                	</select>
    </div>                
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">Recursos para Pago:
                <select  class="form-control" name="recursos_pago" id="recursos_pago">
                		<option value="">Selecciones...</option>
                		<option value="1">Efectivo Diario</option>
                		<option value="2">Efectivo Conciliado</option>
                		<option value="3">Banco</option>
                		<option value="4">Cheque</option>
                	</select>
    </div>                
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">Fecha del Gasto:
                <input class="form-control" style="width:100px; height:15" name="fecha_gasto" id="fecha_gasto" onFocus='Calendar.setup({inputField:"fecha_gasto",ifFormat:"%Y-%m-%d",button:"calen"});'
  readonly="true"/>
	</div>  
        <table width="100%" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza_gasto" type="hidden" value="0" /><input class="btn-sm btn-primary" name="ingreso_gasto" id="ingreso_gasto" type="button" value="GUARDAR DATOS" onClick="valida_guardar_gasto(this.form);"></td>
			</tr>
        </table>
