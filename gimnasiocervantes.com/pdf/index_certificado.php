<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<h2>Listado de asignatura registradas.</h2>
<form action="index_sin_arte_certificado.php" method="post">
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Grado:</td>
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
			<tr>
				<td class="texte2">A&ntilde;o:</td>
				<td><select name="anio" class="champ2" id="anio" >
                	<option value="">Seleccione...</option>
                    <option value="2013" >2013</option>
                    <option value="2014" >2014</option>
                </select></td>
			</tr>
            <tr><td><input name="enviar" value="ENVIAR" type="submit" /></td></tr>
</table>
</form>