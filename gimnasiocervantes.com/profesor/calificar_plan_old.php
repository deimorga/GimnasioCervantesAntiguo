<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$asignatura=$_SESSION['asignatura'];
$plan_gestor=getPlanGestor($_SESSION['grupo_asignatura'],$_SESSION['periodo_academico']);
if($plan_gestor){
	$_SESSION['plan_gestor']=$plan_gestor['id_plan_gestor'];
}else{
	echo "<script>alert('No se ha definido plan gestor para este periodo.'); FAjax('./profesor/asignaturas_profesor.php','area_trabajo','','post');</script>";
}

$alumnos=getAlumnosGrupo($_SESSION['grupo']);
?>
<h2>Listado de alumnos.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Identificaci&oacute;n</td>
    <td>Nombre</td>
    <td>Grupo</td>
    <td>P1</td>
    <td>P2</td>
    <td>P3</td>
    <td>P4</td>
    <td>PROM</td>
    <td>Acci&oacute;n</td>
  </tr>
<?
for($i=0;$i<count($alumnos);$i++){
	$cont=0;
	$suma=0;
	$prom=0;
	$p1=getCalificacionAsignatura($asignatura,$alumnos[$i]['identificacion'],1);
	$p2=getCalificacionAsignatura($asignatura,$alumnos[$i]['identificacion'],2);
	$p3=getCalificacionAsignatura($asignatura,$alumnos[$i]['identificacion'],3);
	$p4=getCalificacionAsignatura($asignatura,$alumnos[$i]['identificacion'],4);
	if($p1){
		$suma=$suma+$p1['calificacion_asignatura'];
		$cont=$cont+1;
	}
	if($p2){
		$suma=$suma+$p2['calificacion_asignatura'];
		$cont=$cont+1;
	}
	if($p3){
		$suma=$suma+$p3['calificacion_asignatura'];
		$cont=$cont+1;
	}
	if($p4){
		$suma=$suma+$p4['calificacion_asignatura'];
		$cont=$cont+1;
	}
	if($suma!=0 && $cont!=0){
		$prom=$suma/$cont;
	}
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$i+1?></td>
    <td><?=$alumnos[$i]['identificacion']?></td>
    <td><?=$alumnos[$i]['nombre_alumno']?></td>
    <td><?=$alumnos[$i]['nombre_grupo']?></td>
    <td><?  echo $p1['calificacion_asignatura'];?></td>
    <td><?  echo $p2['calificacion_asignatura'];?></td>
    <td><?  echo $p3['calificacion_asignatura'];?></td>
    <td><?  echo $p4['calificacion_asignatura'];?></td>
    <td><?=$prom?></td>
    <td><a href="#" onClick="FAjax('./profesor/nota_plan_gestor.php?identificacion=<?=$alumnos[$i]['identificacion']?>&califica=1','area_trabajo','','post');">Calificar>></a></td>
  </tr>
<?
}
?>
</table>
