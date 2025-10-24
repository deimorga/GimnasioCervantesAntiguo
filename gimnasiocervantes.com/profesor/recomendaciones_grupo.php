<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$plan_gestor=getPlanGestor($_SESSION['grupo_asignatura'],$_SESSION['periodo_academico']);
if($plan_gestor){
	$_SESSION['plan_gestor']=$plan_gestor['id_plan_gestor'];
	//die( "*********************".$_SESSION['plan_gestor']);
}else{
	echo "<script>alert('No se ha definido plan gestor para este periodo.'); FAjax('./profesor/asignaturas_profesor.php','area_trabajo','','post');</script>";
}
$campo="";
if($_POST['actualiza_recomendacion_grupo']==1){
	$inserta=setRecomendacion($_REQUEST['descripcion_recomendacion']);
	if($inserta){
		$alumno=getAlumnosGrupo($_SESSION['grupo']);
		for($i=0;$i<count($alumno);$i++){
			if($_REQUEST[$alumno[$i]['identificacion']]==1){		
			$asocia_alumno=setRecomendacionAlumno($inserta, $alumno[$i]['identificacion'], $_SESSION['plan_gestor']);
			}
		}
		echo "<script>alert('Se guardaron correctamente los datos...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

?>
<h2>RECOMENDACIONES.</h2>

        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Recomendaci&oacute;n:</td>
				<td><textarea class="champ2" name="descripcion_recomendacion" id="descripcion_recomendacion"><?=$campo?></textarea> *</td>
			</tr>
  <tr>
    <td colspan="2" valign="top"><div id="list_concepto"><? include_once("../administrativo/filtro_alumnos_grupo.php");?></div></td>
  </tr>
</table>        <table width="370px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><div id="load"></div></td>
			<tr>
			<tr>
				<td align="center">

                <input name="actualiza_recomendacion_grupo" id="actualiza_recomendacion_grupo" type="hidden" value="0"><input class="button_send" type="button" name="ingreso_recomendacion" id="ingreso_recomendacion" value="GUARDAR DATOS" onClick="valida_guardar_recomendaciones_grupo(this.form);">
                <input class="button_send" name="volver" id="volver" type="button" value="VOLVER" onClick="FAjax('./profesor/filtro_calificar_plan_gestor.php','area_trabajo','','post');">
                </td>
			</tr>
        </table>