<?
session_start();
include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form action="promocion.php" method="post">
<h2>Listado de grupos para promocion.</h2>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Año:</td>
				<td><select name="anio" class="champ2" id="anio" >
                	<option value="">Seleccione...</option>
<?
$anio=date("Y");
?>
                    <option value="<?=$anio?>" ><?=$anio?></option>
                </select></td>
			</tr>
			<tr>
				<td class="texte2">Grupo:</td>
				<td><select name="grupo" class="champ2" id="grupo" >
                	<option value="">Seleccione...</option>
<?
$grupo=getGrados();
for($i=0;$i<count($grupo);$i++){
?>
                    <option value="<?=$grupo[$i]['id_grado']?>" ><?=$grupo[$i]['nombre_grado']?></option>
<?
}
?>
                </select></td>
			</tr>
		</table>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="informe_definitivas" id="informe_definitivar" type="submit" value="FILTRAR LISTADO" ></td>
			</tr>
        </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div id="div_definitivas"></div></td>
  </tr>
</table>
</form>