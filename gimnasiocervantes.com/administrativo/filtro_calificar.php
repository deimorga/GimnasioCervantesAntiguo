<?
session_start();
if($_GET['descargar_planes_gestores']==1){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=listado_planes_gestores.xls");
	header("Pragma: no-cache");
	header("Expires: 0"); 
	//echo "lololo";
}
include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$_SESSION['grupo_asignatura']=NULL;
$_SESSION['periodo_academico']=NULL;

$asignatura=getPlanesGestores($_REQUEST['grupo'],$_REQUEST['director'],$_REQUEST['asignatura'],$_REQUEST['periodo_academico']);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<h2>Listado de Planes Gestores registrados.</h2>
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
		</table>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="informe_definitivas" id="informe_definitivar" type="button" value="FILTRAR LISTADO" onClick="FAjax('./administrativo/list_definitivas.php','div_definitivas','','post');"></td>
			</tr>
        </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div id="div_definitivas"></div></td>
  </tr>
</table>
