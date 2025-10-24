<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_REQUEST['grado']){
	$_SESSION['grado_matricula']=$_REQUEST['grado'];
}

$alumnos=getAlumnosGrado($_SESSION['grado_matricula']);
$grupo=getGruposGrado($_SESSION['grado_matricula']);

if($_POST['incripcion_alumnos']){
	for($i=0;$i<count($alumnos);$i++){
		if($_REQUEST['grupo_'.$i]){
			updAlumnoGrupo($_REQUEST['id_alumno_'.$i],$_REQUEST['grupo_'.$i]);
		}
	}
	echo "<script>alert('Se actualizo la informacion...'); FAjax('./administrativo/filtro_grados.php','area_trabajo','','post');</script>";
}
?>

<h2>Listado de alumnos a registrar.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Identificaci&oacute;n</td>
    <td>Nombre</td>
    <td>Grado</td>
    <td>Acci&oacute;n</td>
  </tr>
<?
for($i=0;$i<count($alumnos);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$i+1?></td>
    <td><input type="hidden" name="id_alumno_<?=$i?>" id="id_alumno_<?=$i?>" value="<?=$alumnos[$i]['identificacion']?>"><?=$alumnos[$i]['identificacion']?></td>
    <td><?=$alumnos[$i]['nombre_alumno']?></td>
    <td><?=$alumnos[$i]['nombre_grado']?></td>
    <td><? for($j=0;$j<count($grupo);$j++){?><?=$grupo[$j]['nombre_grupo']?><input name="grupo_<?=$i?>" id="grupo_<?=$i?>" type="radio" value="<?=$grupo[$j]['id_grupo']?>" <? if($alumnos[$i]['id_grupo']==$grupo[$j]['id_grupo']){ echo "checked";}?>/><? }?></td>
  </tr>
<?
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input class="button_send" name="incripcion_alumnos" id="incripcion_alumnos" type="button" value="INSCRIBIR ALUMNOS" onClick="FAjax('./administrativo/listado_alumnos_registro.php','area_trabajo','','post');"></td>
  </tr>
</table>
