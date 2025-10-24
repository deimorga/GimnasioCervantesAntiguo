<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET["elimina_grupo_clase"]==1){
	$del=delGrupoClase($_GET["id_grupo_clase"]);
	if($del){
		echo "<script>alert('La asignacion de clase se borro correctamente...');</script>";	
	}else{
		echo "<script>alert('Problema al borrar la asignacion de clase...');</script>";	
	}
}

$grupo_actividad=getAsignaturaGrupoActividad($_SESSION['id_actividad_aula']);

?>
<h2 align="left">Listado Grupos de Asignaci&oacute;n de clase.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0" style="color:#000;">
  <tr bgcolor="#0033CC" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Grupo</td>
    <td>Asignatura</td>
    <td>Acci&oacute;n</td>
  </tr>
<?
if(count($grupo_actividad)<1){
?>
  <tr>
    <td colspan="4" align="center">NO HAY GRUPOS ASIGNADOS A LA CLASE</td>
  </tr>
<?
}else{
for($i=0;$i<count($grupo_actividad);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td width="80px" align="center"><?=$i+1?></td>
    <td><?=$grupo_actividad[$i]['nombre_grupo']?></td>
    <td width="280px" align="center"><?=$grupo_actividad[$i]['nombre_asignatura']?></td>
    <td width="80px" align="center"><a href="#" onClick="FAjax('./aula/listado_grupo_clase.php?id_grupo_clase=<?=$grupo_actividad[$i]['id_actividad_aula_grupo_asignatura']?>&elimina_grupo_clase=1','div_grupo_clase','','post');"><img src="./iconos/eliminar.png" width="60" height="60" /></a></td>
  </tr>
<?
}}
?>
</table>