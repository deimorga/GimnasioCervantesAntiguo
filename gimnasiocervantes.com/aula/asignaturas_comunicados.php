<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

include("botones_retorno.php");

$_SESSION['grupo_asignatura']=NULL; 
$_SESSION['periodo_academico']=NULL;
$asignatura=getAsignaturaGrupoProfesor($_SESSION['user_id']);
?>
<h2>Listado de asignatura registradas.</h2>
<table width="670px" border="1" cellspacing="0" cellpadding="0" style="font-size:18px;">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>Nombre</td>
    <td>Grupo</td>
    <td>Intensidad horaria</td>
    <td width="100px">Acci&oacute;n</td>
  </tr>
<?
for($i=0;$i<count($asignatura);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?> style="color:#000;">
    <td><?=$asignatura[$i]['nombre_asignatura']?></td>
    <td><?=$asignatura[$i]['nombre_grupo']?></td>
    <td><?=$asignatura[$i]['intensidad_horaria']?> HORAS</td>
    <td>
<a href="#" onClick="FAjax('./aula/gestion_comunicado.php?id_grupo=<?=$asignatura[$i]['id_grupo']?>','area_trabajo_alumno','','post');">Comunicados</a></td>
  </tr>
<?
}
?>
</table>
