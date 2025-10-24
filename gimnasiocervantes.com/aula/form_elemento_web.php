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
$func="valida_elemento_web";
if($_GET["editar_elemento"]==1){
	$elemento=getElementosId($_GET['id_elemento']);
	$_SESSION["id_edita_elemento"]=$_GET['id_elemento'];
	$tipo_e=$elemento["id_tipo_elemento"];
	$titulo=$elemento["titulo_elemento"];
	$descripcion=$elemento["descripcion_elemento"];
	$descripcion2=$elemento["descripcion_web"];
	$func="valida_edita_elemento_web";
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
				<td><input type="file" class="champ5" name="desc_elemento_2" id="desc_elemento_2" /></td>
			</tr>
			<tr>
				<td>Texto:</td>
				<td><textarea class="champ5" name="desc_elemento" id="desc_elemento" cols="35" rows="10"><?=$descripcion?></textarea></td>
			</tr>
			<?
			}elseif($tipo_e==4){
			?>
			<tr>
				<td>Texto:</td>
				<td><textarea class="champ5" name="desc_elemento" id="desc_elemento" cols="35" rows="10"><?=$descripcion?></textarea> <input type="hidden" name="desc_elemento_2" id="desc_elemento_2" value="No data" /></td>
			</tr>
			<?
			}elseif($tipo_e==5 || $tipo_e==6){
			?>
			<tr>
				<td>URL/Enlace:</td>
				<td><input type="text" class="champ5" name="desc_elemento_2" id="desc_elemento_2" value="<?=$descripcion2?>"/></td>
			</tr>
			<tr>
				<td>Texto:</td>
				<td><textarea class="champ5" name="desc_elemento" id="desc_elemento" cols="35" rows="10"><?=$descripcion?></textarea></td>
			</tr>
			<?
			}
			?>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center">
                <input name="actualiza_elemento_web" id="actualiza_elemento_web" type="hidden" value="0" />
                <input class="button_send" name="ingreso_elemento_web" id="ingreso_elemento_web" type="submit" value="GUARDAR DATOS" onClick="return <?=$func?>(this.form);"></td>
			</tr>
        </table>
