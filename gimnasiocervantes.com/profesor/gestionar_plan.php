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
}

$plan_gestor=getPlanGestor($_SESSION['grupo_asignatura'],$_SESSION['periodo_academico']);
if($plan_gestor){
	$_SESSION['plan_gestor']=$plan_gestor['id_plan_gestor'];
}else{
	$inserta=setPlanGestor($_SESSION['grupo_asignatura'],$_SESSION['periodo_academico']);
	if($inserta){
		$_SESSION['plan_gestor']=$inserta;
	}else{
		echo "<script>alert('Problemas al generar el registro.\nComuniquese con soporte...');</script>";
	}
}

	$valida_periodo=getPeriodoActivo($_SESSION['periodo_academico']);
	if($valida_periodo){
		echo "<script>window.open('./administrativo/descargar_plan_gestor.php');</script>";
	}else{
if($_SESSION['asignatura']==28){
?>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><div id="titulo_div"><h2>Modulo para direcctores de curso.</h2><br />Logros que seran evaluados en la convivencia escolar del alumno.</div></td>
  </tr>
  <tr>
    <td valign="top"><div id="logro_div"><? include('logro.php');?></div></td>
  </tr>
</table>
<?
}else{
?>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><div id="logro_div"><? include('logro.php');?></div></td>
  </tr>
  <tr>
    <td width="100%" valign="top"><div id="seccion_div"><? include('seccion_plan_gestor.php');?></div></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><div id="copia_div"><? include('copia_plan.php');?></div></td>
  </tr>
<!--  <tr>
    <td valign="top"><div id="metodologia_div"><? //include('metodologia.php');?></div></td>
  </tr>
  <tr>
    <td valign="top"><div id="dificultad_div"><? //include('dificultad.php');?></div></td>
  </tr>
  <tr>
    <td valign="top"><div id="biblografia_div"><? //include('biblografia.php');?></div></td>
  </tr>
-->  <tr>
    <td align="center" colspan="2">
    <div id="botones_div">
    <input class="button_send" name="descargar" id="descargar" type="button" value="DESCARGAR" onclick="window.open('./administrativo/descargar_plan_gestor.php?descargar_plan_gestor=1');">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input class="button_send" name="ver" id="ver" type="button" value="VISTA PREVIA" onclick="window.open('./administrativo/descargar_plan_gestor.php');">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input class="button_send" name="ver" id="ver" type="button" value="CARGAR EXCEL" onclick="window.open('./administrativo/cargar_plan_gestor.php');">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input class="button_send" name="ver" id="ver" type="button" value="PLANTILLA EXCEL" onclick="window.open('./documentos/PLANILLA_MATRIZ.xlsx');">
    </div>
    </td>
  </tr>
</table>
<? 
}
if($_SESSION["user_tipo"]==1){
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td align="center" colspan="2"><div id="botones_div2"><input class="button_send" name="volver" id="volver" type="button" value="VOLVER" onclick="FAjax('./administrativo/list_planes_gestores.php?nueva_busqueda=2','area_trabajo','','post');"></div></td>
  </tr>
</table>
<?
}
}
?>