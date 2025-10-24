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

if($_GET['nueva_busqueda']==1){
	$asignatura=NULL;	
	$_SESSION['grupo_busqueda']=NULL;
	$_SESSION['director_busqueda']=NULL;
	$_SESSION['asignatura_busqueda']=NULL;
	$_SESSION['periodo_busqueda']=NULL;
}elseif($_GET['nueva_busqueda']==2){
$asignatura=getPlanesGestores($_SESSION['grupo_busqueda'],$_SESSION['director_busqueda'],$_SESSION['asignatura_busqueda'],$_SESSION['periodo_busqueda']);
	
}else{
	$_SESSION['grupo_busqueda']=$_REQUEST['grupo'];
	$_SESSION['director_busqueda']=$_REQUEST['director'];
	$_SESSION['asignatura_busqueda']=$_REQUEST['asignatura'];
	$_SESSION['periodo_busqueda']=$_REQUEST['periodo_academico'];

$asignatura=getPlanesGestores($_REQUEST['grupo'],$_REQUEST['director'],$_REQUEST['asignatura'],$_REQUEST['periodo_academico']);
}
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
			<tr>
				<td class="texte2">Director de grupo:</td>
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
$asignatura_filtro=getAsignaturas();
for($i=0;$i<count($asignatura_filtro);$i++){	
?>
                    <option value="<?=$asignatura_filtro[$i]["id_asignatura"]?>"><?=$asignatura_filtro[$i]["nombre_asignatura"]?></option>
<? }?>
                </select>
                </td>
			</tr>
			<tr>
				<td class="texte2">Periodo:</td>
				<td>
                
                <select name="periodo_academico" class="champ2" id="periodo_academico" >
                	<option value="">Seleccione...</option>
<?
$periodo=getPeriodos2();
for($i=0;$i<count($periodo);$i++){
?>
                    <option value="<?=$periodo[$i]['id_periodo_academico']?>" ><?=$periodo[$i]['nombre_periodo_academico']?></option>
<?
}
?>
                </select>
                
                </td>
			</tr>
		</table>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="informe_alumnos" id="informe_alumnos" type="button" value="FILTRAR LISTADO" onClick="FAjax('./administrativo/list_planes_gestores.php','area_trabajo','','post');"></td>
			</tr>
        </table>
<?
if($asignatura==NULL){}else{
?>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>Profesor</td>
    <td>Asignatura</td>
    <td>Grupo</td>
    <td>Periodo</td>
<?
if($_GET['descargar_planes_gestores']==1){}else{
?>
    <td width="70px">Acci&oacute;n</td>
<?
}
?>

  </tr>
<?
for($i=0;$i<count($asignatura);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$asignatura[$i]['nombre_profesor']?></td>
    <td><?=$asignatura[$i]['nombre_asignatura']?></td>
    <td><?=$asignatura[$i]['nombre_grupo']?></td>
    <td><?=$asignatura[$i]['id_periodo_academico']?></td>
<?
if($_GET['descargar_planes_gestores']==1){}else{
?>
    <td><? $estado_enlace=getEstadoEnlace(1); 
	if($estado_enlace['valor_estado_enlace']==1){?>
    <a href="#" onClick="FAjax('./profesor/gestionar_plan.php?id_grupo_asignatura=<?=$asignatura[$i]['id_grupo_asignatura']?>&periodo_academico=<?=$asignatura[$i]['id_periodo_academico']?>&asignatura=<?=$asignatura[$i]['id_asignatura']?>&vista_plan=1','area_trabajo','','post');">Ver/Editar</a><? }else{?>
	<a href="#" onClick="alert('<?=$estado_enlace['alerta_estado_enlace']?>');">Ver/Editar</a>
	<? }?></td>
<?
}
?>

  </tr>
<?
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><input type="button" value="DESCARGAR" class="button_send" onClick="window.open('./administrativo/list_planes_gestores.php?descargar_planes_gestores=1');"/></td>
  </tr>
</table>
<?
}
?>