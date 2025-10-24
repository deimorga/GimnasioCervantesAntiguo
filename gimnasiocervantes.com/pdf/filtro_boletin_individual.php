<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<h2>Generar boletin de calificaciones.</h2>
<form action="index_sin_arte_boletin_solo.php" method="post">
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Identificacion del alumno:</td>
				<td><input type="text" name="identificacion" id="identificacion" /></td>
			</tr>
  <tr>
    <td>Periodo</td>
    <td><select name="periodo" class="champ2" id="periodo" >
                	<option value="">Seleccione...</option>
<?
$periodo=getPeriodos2();
for($a=0;$a<count($periodo);$a++){
?>
                    <option value="<?=$periodo[$a]['id_periodo_academico']?>" ><?=$periodo[$a]['nombre_periodo_academico']?></option>
<?
}
?>
                </select></td>
  </tr>
            <tr><td><input name="enviar" value="ENVIAR" type="submit" /></td></tr>
</table>
</form>