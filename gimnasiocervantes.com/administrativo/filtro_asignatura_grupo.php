<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<h2>Listado de asignatura registradas.</h2>
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
				<td class="texte2">Profesor:</td>
				<td><select name="director" class="champ2" id="director" >
                	<option value="">Seleccione...</option>
<? 
$profesor=getProfesores();
for($i=0;$i<count($profesor);$i++){	
?>
                    <option value="<?=$profesor[$i]["id_profesor"]?>"><?=$profesor[$i]["nombre_profesor"]?></option>
<? }?>
                </select>
                </td>
			</tr>
			<tr>
				<td class="texte2">Asignatura:</td>
				<td><select name="asignatura" class="champ2" id="asignatura" >
                	<option value="">Seleccione...</option>
<? 
$asignatura_select=getAsignaturas();
for($i=0;$i<count($asignatura_select);$i++){	
?>
                    <option value="<?=$asignatura_select[$i]["id_asignatura"]?>"><?=$asignatura_select[$i]["nombre_asignatura"]?></option>
<? }?>
                </select>
                </td>
			</tr>
		</table>
                <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="informe_asignatura" id="informe_asignatura" type="button" value="FILTRAR LISTADO" onClick="FAjax('./administrativo/list_asignatura_grupo.php','div_asignatura_grupo','','post');"></td>
			</tr>
        </table>
        <div id="div_asignatura_grupo"></div>