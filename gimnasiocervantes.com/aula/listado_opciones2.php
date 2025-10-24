<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET["op_eliminar"]>=0){
	$_SESSION["carro"][$_GET["op_eliminar"]]=NULL;
}
?>
<table width="600" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>Opcion columna 1:</td>
		<td><input type="text" name="op_respuesta" class="champ" id="op_respuesta"  /></td>
	</tr>
	<tr>
		<td>Opcion columna 2:</td>
		<td><input type="text" name="op_respuesta2" class="champ" id="op_respuesta2"  /> 
        <input type="hidden" name="ingresa_op" id="ingresa_op" value="0" />
        <input type="button" onclick="valida_ingreso_opcion2(this.form);" value="Adicionar" /></td>
	</tr>
</table>
<?
if($_REQUEST["ingresa_op"]==1){
	$_SESSION["carro"][]=array("opcion"=>$_REQUEST["op_respuesta"],"opcion2"=>$_REQUEST["op_respuesta2"]);
	//$opciones_r=getOpcionesRespuesta();
	//print_r($_SESSION["carro"]);
}
	?>
	<h5>Opciones Adicionadas.</h5>
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Columna 1</td>
    <td>Columna 2</td>
    <td>accion</td>
  </tr>
	<?
	for($a=0;$a<count($_SESSION["carro"]);$a++){
		if($_SESSION["carro"][$a]!=NULL){
	?>
  <tr>
    <td><?=$_SESSION["carro"][$a]["opcion"]?></td>
    <td><?=$_SESSION["carro"][$a]["opcion2"]?></td>
    <td><a href="#opcion_respuesta" onClick="FAjax('./aula/listado_opciones2.php?op_eliminar=<?=$a?>','opcion_respuesta','','post');">eliminar</a></td>
  </tr>
	<?
		}
    }

?>
</table>
