<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}
?>
<h3>Opciones:</h3>
<table width="650" border="1" cellspacing="0" cellpadding="0" style="font-size:18px">
<?
for($o=1;$o<=10;$o++){
?>
	<tr>
		<td>Texto <?=$o?>:<input type="text" name="op_a_<?=$o?>" class="champ" id="op_a_<?=$o?>"  /></td>
		<td>Imagen <?=$o?>:<input type="file" name="op_b_<?=$o?>" class="champ5" id="op_b_<?=$o?>"  /> 
		</td>
	</tr>
<?
}
?>
</table>