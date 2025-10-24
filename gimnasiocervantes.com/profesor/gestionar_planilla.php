<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET['vista_plan']==1){
	$_SESSION['grupo_asignatura']=$_GET['id_grupo_asignatura'];
	$_SESSION['periodo_academico']=$_GET['periodo_academico'];
	$_SESSION['asignatura']=$_GET['asignatura'];
	$_SESSION['grupo']=$_GET['id_grupo'];
}

$logro_evaluacion=NULL;
$asignatura=$_SESSION['asignatura'];
$plan_gestor=getPlanGestor($_SESSION['grupo_asignatura'],$_SESSION['periodo_academico']);
if($plan_gestor){
	$_SESSION['planilla']=$plan_gestor['id_plan_gestor'];
}else{
	$plan_gestor=setPlanGestor($_SESSION['grupo_asignatura'],$_SESSION['periodo_academico']);
	$_SESSION['planilla']=$plan_gestor;
}

?>
<div id="logro_div"><? include("logro_planilla.php");?></div>
<table width="670px" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>ID</td>
    <td>Logro</td>
    <td>Acciones</td>
  </tr>
<?
$alumnos=getAlumnosGrupo($_SESSION['grupo']);

$dato=seleccionaLogrosPlanGestor1($_SESSION['planilla'],0);
for($l=0;$l<count($dato);$l++){
?>
  <tr <? if(esPar($l+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$dato[$l]['id_logro']?></td>
    <td><?=$dato[$l]['logro']?></td>
    <td><a href='#' onclick="FAjax('./profesor/logro_planilla.php?id_logro=<?=$dato[$l]['id_logro']?>&elimina_logro=1','logro_div','','post');">eliminar</a>
                |&nbsp;<a href='#' onclick="FAjax('./profesor/logro_planilla.php?id_logro=<?=$dato[$l]['id_logro']?>&edita_logro_planilla=1','logro_div','','post');">editar</a></td>
  </tr>
<?
}
?>
</table>
<h2>Listado de alumnos.</h2>
Para las calificaciones solo se aceptan decimales separados por un punto (.) ej: 4.5
<table width="670px" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Identificaci&oacute;n</td>
    <td>Nombre</td>
<?
for($l=0;$l<count($dato);$l++){
?>
    <td><?=$dato[$l]['id_logro']?></td>
<?
}
?>
  </tr>

<?
for($i=0;$i<count($alumnos);$i++){
	$cont=0;
	$suma=0;
	$prom=0;
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$i+1?></td>
    <td><?=$alumnos[$i]['identificacion']?></td>
    <td><?=$alumnos[$i]['nombre_alumno']?></td>
<?
for($l=0;$l<count($dato);$l++){
$calificacion_logro=getCalificacionLogro($dato[$l]['id_logro'],$alumnos[$i]['identificacion']);
?>
    <td><input type="text" name="<?=$dato[$l]['id_logro']."-".$alumnos[$i]['identificacion']?>" id="<?=$dato[$l]['id_logro']."-".$alumnos[$i]['identificacion']?>" value="<?=$calificacion_logro['calificacion_logro']?>" size="1" maxlength="3" onkeypress="return numeros2(event);" onpaste="return false" onblur="return comprueba_nota(this);" /></td>
<?
}
?>
  </tr>
<?
}
?>
</table>

		<table width="670px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><div id="load"></div></td>
			<tr>
				<td align="center"><input class="button_send" name="guardar_calificacion" id="guardar_calificacion" type="button" value="GUARDAR CALIFICACIONES" onClick="valida_guarda_notas_planilla(this.form);"><!--&nbsp;&nbsp;<input class="button_send" name="recomendacion" id="recomendacion" type="button" value="RECOMENDACIONES" onClick="FAjax('./profesor/recomendacion.php','area_trabajo','','post');">--></td>
			</tr>
        </table>