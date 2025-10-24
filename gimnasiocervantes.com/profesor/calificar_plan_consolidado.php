<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$logro_evaluacion=NULL;
$asignatura=$_SESSION['asignatura'];
$plan_gestor=getPlanGestor($_SESSION['grupo_asignatura'],$_SESSION['periodo_academico']);
if($plan_gestor){
	$_SESSION['plan_gestor']=$plan_gestor['id_plan_gestor'];
}else{
	echo "<script>alert('No se ha definido plan gestor para este periodo.'); FAjax('./profesor/asignaturas_profesor.php','area_trabajo','','post');</script>";
}

$alumnos=getAlumnosGrupo($_SESSION['grupo']);

$dato=seleccionaLogrosPlanGestor1($_SESSION['plan_gestor'],0);
?>
<h2>Logros a calificar.</h2>
<table width="670px" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>ID</td>
    <td>Logro</td>
  </tr>
<?
for($l=0;$l<count($dato);$l++){
?>
  <tr <? if(esPar($l+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$dato[$l]['id_logro']?></td>
    <td><?=$dato[$l]['logro']?></td>
  </tr>
<?
}
if($_SESSION['tipo_asignatura']==1){
	$logro_evaluacion=getLogroEvaluacion($_SESSION['plan_gestor'],1);
	if($logro_evaluacion){
?>
  <tr  bgcolor="#FF2D22">
    <td><?=$logro_evaluacion['id_logro']?></td>
    <td><?=$logro_evaluacion['logro']?></td>
  </tr>
<?
	}else{
		echo "<script>alert('No se ha cargado el logro de evaluacion, Comunicate con el administrador de la plataforma...');window.location.href='principal_admin.php';</script>";
	}
}
?>
</table>
<h2>Listado de alumnos.</h2>
Para las calificaciones solo se aceptan decimales separados por un punto (.) ej: 4.5
<?
if($_SESSION['tipo_asignatura']==1){//con logro de evaluaciones
?>
<table width="670px" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">Identificaci&oacute;n</td>
    <td rowspan="2">Nombre</td>
    <td rowspan="2">H. injus.</td>
    <td rowspan="2">H. jus.</td>
    <td bgcolor="#FF9900" align="center" colspan="<?=count($dato)?>">70%</td>
    <td bgcolor="#FF0000" align="center">30%</td>
    <td rowspan="2">P1</td>
    <td rowspan="2">P2</td>
    <td rowspan="2">P3</td>
    <td rowspan="2">P4</td>
    <td rowspan="2">PROM</td>
  </tr>
  <tr bgcolor="#0066FF" style="color:#FFF;">
<?
for($l=0;$l<count($dato);$l++){
?>
    <td><?=$dato[$l]['id_logro']?></td>
<?
}
?>
	<td><?=$logro_evaluacion['id_logro']?></td>
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
	$p_actual=getCalificacionAsignatura($asignatura,$alumnos[$i]['identificacion'],$_SESSION['periodo_academico']);
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
    <td><?=$p_actual['horas_justificadas']?> Horas</td>
    <td><?=$p_actual['horas_injustificadas']?> Horas</td>
<?
for($l=0;$l<count($dato);$l++){
$calificacion_logro=getCalificacionLogro($dato[$l]['id_logro'],$alumnos[$i]['identificacion']);
?>
    <td><?=$calificacion_logro['calificacion_logro']?></td>
<?
}/////////////////////////
$calificacion_logro_eval=getCalificacionLogro($logro_evaluacion['id_logro'],$alumnos[$i]['identificacion']);
?>
    <td><?=$calificacion_logro_eval['calificacion_logro']?></td>
    <td><?  echo $p1['calificacion_asignatura'];?></td>
    <td><?  echo $p2['calificacion_asignatura'];?></td>
    <td><?  echo $p3['calificacion_asignatura'];?></td>
    <td><?  echo $p4['calificacion_asignatura'];?></td>
    <td><?=redondear($prom)?></td>
  </tr>
<?
}
?>
</table>



<?
}else{//sin logro de evaluaciones
?>
<table width="670px" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Identificaci&oacute;n</td>
    <td>Nombre</td>
    <td>H. injus.</td>
    <td>H. jus.</td>
<?
for($l=0;$l<count($dato);$l++){
?>
    <td><?=$dato[$l]['id_logro']?></td>
<?
}
?>
    <td>P1</td>
    <td>P2</td>
    <td>P3</td>
    <td>P4</td>
    <td>PROM</td>
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
	$p_actual=getCalificacionAsignatura($asignatura,$alumnos[$i]['identificacion'],$_SESSION['periodo_academico']);
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
    <td><?=$p_actual['horas_justificadas']?> Horas</td>
    <td><?=$p_actual['horas_injustificadas']?> Horas</td>
<?
for($l=0;$l<count($dato);$l++){
$calificacion_logro=getCalificacionLogro($dato[$l]['id_logro'],$alumnos[$i]['identificacion']);
?>
    <td><?=$calificacion_logro['calificacion_logro']?></td>
<?
}/////////////////////////
?>
    <td><?  echo $p1['calificacion_asignatura'];?></td>
    <td><?  echo $p2['calificacion_asignatura'];?></td>
    <td><?  echo $p3['calificacion_asignatura'];?></td>
    <td><?  echo $p4['calificacion_asignatura'];?></td>
    <td><?=redondear($prom)?></td>
  </tr>
<?
}
?>
</table>
<?
}
?>

		<table width="670px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><div id="load"></div></td>
			<tr>
				<td align="center"><input class="button_send" name="descargar_calificacion" id="descargar_calificacion" type="button" value="DESCARGAR CALIFICACIONES"><!--&nbsp;&nbsp;<input class="button_send" name="recomendacion" id="recomendacion" type="button" value="RECOMENDACIONES" onClick="FAjax('./profesor/recomendacion.php','area_trabajo','','post');">--></td>
			</tr>
        </table>