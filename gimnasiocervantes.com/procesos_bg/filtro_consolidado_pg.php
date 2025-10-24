<?
session_start();
include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form action="generar_consolidado_pg.php" method="post">
<h2>Listado de grupos para promocion.</h2>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Periodo:</td>
				<td><select name="periodo" class="champ2" id="periodo" >
                	<option value="">Seleccione...</option>
                    <option value="1" >Primero</option>
                    <option value="2" >Segundo</option>
                    <option value="3" >Tercero</option>
                    <option value="4" >Cuarto</option>
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