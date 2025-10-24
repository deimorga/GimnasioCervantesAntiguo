<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_POST['actualiza_pin']==1){
	$inserta_pin=setPin($_POST['id'],$_POST['nombre'],$_POST['grado']);
	if($inserta_pin){
		$_SESSION['nom']=$_POST['nombre'];
		$_SESSION['id']=$_POST['id'];
		$_SESSION['pin']=$inserta_pin;
?>
							<fieldset>
								<legend class="texte_legende">REGISTRO DE PIN</legend>Felicitaciones, Su PIN fue generado satisfactoriamente:<br />
                                Estudiante: <?=$_POST['nombre']?><br />
                                NUIP: <?=$_POST['id']?><br />
                                PIN: <?=$inserta_pin?><br />
                                <input type="button" onclick="window.open('./pdf/index_pin.php');" value="IMPRIMIR" />
                                </fieldset>
<?
	}else{
?>
							<fieldset>
								<legend class="texte_legende">REGISTRO DE PIN</legend>No se registro el pin del estudiante...<br />
                                Contacte al administrador.
                                </fieldset>
<?
	}
}
?>
				<h2> Ingreso de material de apoyo.</h2>

					<div id="form_contact2">
						<strong>Datos del aspirante</strong><br />
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            NUIP:
                            <input class="form-control" type="text" name="id" id="id" onkeypress="return numeros(event)">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">    
                            Nombre:
                            <input class="form-control" type="text" name="nombre" id="nombre">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">    
                            Grado:
                            <select name="grado" class="form-control" id="grado" >
                	<option value="">Seleccione...</option>
<?
$categoria=getGrados();
for($i=0;$i<count($categoria);$i++){
?>
                    <option value="<?=$categoria[$i]['id_grado']?>" ><?=$categoria[$i]['nombre_grado']?></option>
<?
}
?>
                </select>
                        </div>
                
							<br>
							<table width="100%" border="0" cellpadding=0 cellspacing=0>
							<tr>
								<td colspan="2" align="center"><input name="actualiza_pin" type="hidden" value="0" /><input class="btn-sm btn-primary" name="carga_material" type="button" value="GUARDAR" onclick="return valida_pin(this.form);"></td>
							</tr>
							</table>    </div>