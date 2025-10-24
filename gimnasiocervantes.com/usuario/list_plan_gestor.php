<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$plan=getPlanGestorGrupo($_SESSION['grupo_estudiante']);
if(isset($_SESSION['esturiante_matriculado'])){
include("../aula/botones_retorno.php");
}
?>
<h2>Listado de Plan Gestor.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0" style="color:#000;">
  <tr bgcolor="#0033CC" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Asignatura</td>
    <td>Periodo</td>
    <td>Acci&oacute;n</td>
  </tr>
<?
if(count($plan)<1){
?>
  <tr>
    <td colspan="4" align="center">NO HAY COMUNICADOS REGISTRADOS</td>
  </tr>
<?
}else{
for($i=0;$i<count($plan);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td width="80px" align="center"><?=$plan[$i]['id_plan_gestor']?></td>
    <td><?=$plan[$i]['nombre_asignatura']?></td>
    <td width="80px" align="center"><?=$plan[$i]['id_periodo_academico']?></td>
    <td width="80px" align="center"><a href="#" onClick="window.open('./administrativo/descargar_plan_gestor.php?id_plan_gestor=<?=$plan[$i]['id_plan_gestor']?>');">Ver>></a></td>
  </tr>
<?
}}
?>
</table>