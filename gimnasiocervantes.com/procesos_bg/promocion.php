<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_REQUEST['grupo']){
	$_SESSION['anio']=$_REQUEST['anio'];
	$_SESSION['grado_matricula']=$_REQUEST['grupo'];
}

$alumnos=getAlumnosGrado($_SESSION['grado_matricula']);
  
if($_POST['incripcion_alumnos']){
	for($i=0;$i<count($alumnos);$i++){
		if($_REQUEST[$alumnos[$i]['identificacion']]){
			setPromocionAlumno($alumnos[$i]['identificacion'],$_REQUEST[$alumnos[$i]['identificacion']],$_SESSION['anio'],$_SESSION['grado_matricula']);
		}
	}
	echo "<script>alert('Se actualizo la informacion...'); </script>";
}
?>
<form action="promocion.php" method="post">
<h2>Listado de alumnos.</h2>
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
	$promocion=getPromocionAlumno($alumnos[$i]['identificacion'],$_SESSION['anio']);
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$i+1?></td>
    <td><?=$alumnos[$i]['identificacion']?></td>
    <td><?=$alumnos[$i]['nombre_alumno']?></td>
    <td><?=$alumnos[$i]['nombre_grado']?></td>
    <td>Pasa:<input name="<?=$alumnos[$i]['identificacion']?>" id="<?=$alumnos[$i]['identificacion']?>" checked="checked" type="radio" value="1" <? if($promocion['promocion_alumno']==1){ echo "checked";}?>/>
    No pasa:<input name="<?=$alumnos[$i]['identificacion']?>" id="<?=$alumnos[$i]['identificacion']?>" type="radio" value="2" <? if($promocion['promocion_alumno']==2){ echo "checked";}?>/>
    Enero:<input name="<?=$alumnos[$i]['identificacion']?>" id="<?=$alumnos[$i]['identificacion']?>" type="radio" value="3" <? if($promocion['promocion_alumno']==3){ echo "checked";}?>/>    Recupera:<input name="<?=$alumnos[$i]['identificacion']?>" id="<?=$alumnos[$i]['identificacion']?>" type="radio" value="4" <? if($promocion['promocion_alumno']==4){ echo "checked";}?>/></td>
  </tr>
<?
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input class="button_send" name="incripcion_alumnos" id="incripcion_alumnos" type="submit" value="INSCRIBIR ALUMNOS" ><input class="button_send" name="volver" id="colver" type="button" value="VOLVER" onclick="window.location.href='filtro_promocion.php';" ></td>
  </tr>
</table>
</form>