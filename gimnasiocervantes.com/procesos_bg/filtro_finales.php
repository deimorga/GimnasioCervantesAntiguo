<?
session_start();
include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form action="genere_promedio_definitiva.php" method="post">
  <h2> Generar promedio de calificaciones definitivas por grupo.</h2>
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
$grupo=getGrupos();
for($i=0;$i<count($grupo);$i++){
?>
                    <option value="<?=$grupo[$i]['id_grupo']?>" ><?=$grupo[$i]['nombre_grupo']?></option>
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