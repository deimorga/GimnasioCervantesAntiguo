<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<h2>Listado de asignatura registradas.</h2>
<form action="index_sin_arte.php" method="post">
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
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
  <tr>
    <td>Top Head(10)</td>
    <td><input type="number" name="th" value="10" /></td>
  </tr>
  <tr>
    <td>Bottom pie(11)</td>
    <td><input type="number" name="bp" value="11" /></td>
  </tr>
  <tr>
    <td>Top cuerpo(68)</td>
    <td><input type="number" name="tc" value="68" /></td>
  </tr>
  <tr>
    <td>Bottom cuerpo(14)</td>
    <td><input type="number" name="bc" value="14" /></td>
  </tr>
  <tr>
    <td>Izq. Cuerpo(5)</td>
    <td><input type="number" name="ic" value="5" /></td>
  </tr>
  <tr>
    <td>Der. Cuerpo(5)</td>
    <td><input type="number" name="dc" value="5" /></td>
  </tr>
            <tr><td><input name="enviar" value="ENVIAR" type="submit" /></td></tr>
</table>
</form>