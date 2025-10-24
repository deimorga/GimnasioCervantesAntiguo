<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$_SESSION['alumno_caso_especial']=NULL;

$alumnos=getAlumnosGrupo($_REQUEST['grupo']);

?>
<h2>Listado de alumnos.</h2>
<table width="670px" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Identificaci&oacute;n</td>
    <td>Nombre</td>
    <td>Estado</td>
    <td>Acci&oacute;n</td>
  </tr>
<?
for($i=0;$i<count($alumnos);$i++){
	$estado=getLogrosCasoEspecialId($alumnos[$i]['identificacion']);
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$i+1?></td>
    <td><?=$alumnos[$i]['identificacion']?></td>
    <td><?=$alumnos[$i]['nombre_alumno']?></td>
    <td><? if($estado){ echo "Presenta dificultades";}else{ echo "OK";}?></td>
    <td><a href="#" onClick="FAjax('./profesor/caso_especial.php?id=<?=$alumnos[$i]['identificacion']?>&nvo_alumno_caso_especial=1','area_trabajo','','post');">Caso Especial>></a></td>
  </tr>
<?
}
?>
</table>