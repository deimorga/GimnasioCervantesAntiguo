<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}
$tipo_e=NULL;
$titulo=NULL;
$descripcion=NULL;
$func="valida_elemento_aula";
if($_GET["editar_elemento"]==1){
	$elemento=getElementosId($_GET['id_elemento']);
	$_SESSION["id_edita_elemento"]=$_GET['id_elemento'];
	$tipo_e=$elemento["id_tipo_elemento"];
	$titulo=$elemento["titulo_elemento"];
	$descripcion=$elemento["descripcion_elemento"];
	$func="valida_edita_elemento_aula";
}else{
	$tipo_e=$_REQUEST["tipo_e"];
}
//echo "***********".$tipo_e;
?>

	<fieldset>
		<legend class="texte_legende2">Datos del elemento.</legend>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td>Titulo/Enunciado:</td>
				<td><input type="text" class="champ5" name="enunciado_elemento" id="tema" value="<?=$titulo?>"/></td>
			</tr>
            <?
            if($tipo_e>=1 && $tipo_e<=3){
			?>
			<tr>
				<td>Archivo:</td>
				<td><input type="file" class="champ5" name="desc_elemento" id="desc_elemento" /></td>
			</tr>
			<?
			}elseif($tipo_e==4){
			?>
			<tr>
				<td>Texto:</td>
				<td><textarea class="champ5" name="desc_elemento" id="desc_elemento" cols="35" rows="10"><?=$descripcion?></textarea></td>
			</tr>
			<?
			}elseif($tipo_e==5 || $tipo_e==6){
			?>
			<tr>
				<td>URL/Enlace:</td>
				<td><input type="text" class="champ5" name="desc_elemento" id="desc_elemento" value="<?=$descripcion?>"/></td>
			</tr>
			<?
			}elseif($tipo_e==7){
				echo "<script>FAjax('./aula/form_tipo_pregunta.php','div_elemento','','post');</script>";
			}
			?>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center">
                <input name="actualiza_elemento_aula" id="actualiza_elemento_aula" type="hidden" value="0" />
                <input class="button_send" name="ingreso_elemento_aula" id="ingreso_elemento_aula" type="submit" value="GUARDAR DATOS" onClick="return <?=$func?>(this.form);"></td>
			</tr>
        </table>
