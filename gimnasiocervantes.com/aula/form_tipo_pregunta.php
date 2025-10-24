<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}
$tipo_e=$_REQUEST["tipo_e"];
//echo "***********".$tipo_e;
?>
	<fieldset>
		<legend class="texte_legende2">Datos de la pregunta.</legend>
        <table cellpadding=5 width="600px" cellspacing=0 border="0">
			<tr>
				<td>Tipo de pregunta:</td>
				<td align="right" valign="top">
                <select name="tipo_pregunta" onchange="FAjax('./aula/form_pregunta.php','div_tipo_pregunta','','post');" class="champ2" id="tipo_pregunta" >
                	<option value="">Seleccione...</option>
<?
$pregunta=getTipoPregunta();
for($j=0;$j<count($pregunta);$j++){
?>
                    <option value="<?=$pregunta[$j]['id_tipo_pregunta']?>" ><?=$pregunta[$j]['nombre_tipo_pregunta']?></option>
<?
}
?>
                </select>
                </td>
			</tr>
			<tr>
				<td colspan="2"><div id="div_tipo_pregunta"></div></td>
			</tr>
		</table>
	</fieldset>