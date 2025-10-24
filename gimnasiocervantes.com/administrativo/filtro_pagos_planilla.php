<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_POST['actualiza_gasto']==1){
	$guarda_gasto=setGasto($_POST['nombre_gasto'],$_POST['valor_gasto'],$_POST['observaciones_gasto'],$_SESSION["user_id"]);
	if($guarda_gasto){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

?>

<h2>Informe de pagos recibidos.</h2>


	<fieldset>
		<legend class="texte_legende2">Filtro por datos del alumno.</legend>
        <table cellpadding=5 cellspacing=0 border="0">
 			<tr>
				<td class="texte2">Grupo:</td>
				<td><select name="grupo" class="champ2" id="grupo" >
                	<option value="">Seleccione...</option>
<?
$categoria=getGrupos();
for($i=0;$i<count($categoria);$i++){
?>
                    <option value="<?=$categoria[$i]['id_grupo']?>" ><?=$categoria[$i]['nombre_grupo']?></option>
<?
}
?>
                </select></td>
            </tr>
 			<tr>
				<td class="texte2">A&ntilde;o:</td>
				<td><select name="anio" class="champ2" id="anio" >
                	<option value="">Seleccione...</option>
                    <option value="2016" >2016</option>
                    <option value="2017" >2017</option>
                </select></td>
            </tr>
  		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="informe_pagos" id="informe_pagos" type="button" value="GENERAR INFORME" onClick="valida_informe_pagos_planilla(this.form);"></td>
			</tr>
			<tr>
				<td align="center"><div id="listado_admin"></div></td>
			</tr>
        </table>
