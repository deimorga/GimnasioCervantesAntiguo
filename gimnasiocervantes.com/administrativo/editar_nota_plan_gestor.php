<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_REQUEST["califica"]==1){
	$_SESSION['alumno']=$_REQUEST["identificacion"];
	$_SESSION['plan_gestor']=$_REQUEST['plan_gestor'];
	$_SESSION['asignatura']=$_REQUEST['asignatura'];
	$_SESSION['tipo_asignatura']=$_REQUEST['tipo_asignatura'];
	$_SESSION['periodo_academico']=$_REQUEST['periodo'];
}

$dato=seleccionaPlanGestor("tbl_logro", $_SESSION['plan_gestor']);

if($_REQUEST['ingreso_calificacion']){

	$definitiva=0;
	$definitiva_30=0;
	$definitiva_70=0;
	$contador=0;
	$suma=0;

	if($_SESSION['tipo_asignatura']==1){
		$logro_evaluacion=getLogroEvaluacion($_SESSION['plan_gestor'],1);
		for($i=0;$i<count($dato);$i++){
			$actualiza=setCalificacionLogro($_REQUEST["logro_".$i], $_REQUEST["calificacion_".$i], $_SESSION['alumno']);
			if($actualiza){
				if($logro_evaluacion['id_logro']==$_REQUEST["logro_".$i]){
					$definitiva_30=$_REQUEST["calificacion_".$i]*0.3;
				}else{
					$contador=$contador+1;
					$suma=$suma+$_REQUEST["calificacion_".$i];
				}
			}
		}
		$definitiva_70=($suma/$contador)*0.7;
		
		$definitiva=redondear($definitiva_70+$definitiva_30);
	}else{
		for($i=0;$i<count($dato);$i++){
			$actualiza=setCalificacionLogro($_REQUEST["logro_".$i], $_REQUEST["calificacion_".$i], $_SESSION['alumno']);
			if($actualiza){
				$contador=$contador+1;
				$suma=$suma+$_REQUEST["calificacion_".$i];
			}
		}
		$definitiva=$suma/$contador;
		$definitiva=redondear($definitiva);
	}
	//echo "suma: ".$suma." definitiva: ".$definitiva;
	$actualiza_definitiva=setCalificacionAsignatura2($_SESSION['asignatura'], $definitiva, $_SESSION['alumno'],$_SESSION['periodo_academico']);
	if($actualiza_definitiva){
		echo "<script>alert('Se actualizo el registro de notas con una definitiva de ".$definitiva."');</script>";
	}else{
		echo "<script>alert('Inconvenientes en el registro de notas');</script>";
	}
}
$datos_alumno=getAlumnoId($_SESSION['alumno']);
$calificacion=getCalificacionAsignatura($_SESSION['asignatura'], $_SESSION['alumno'],$_SESSION['periodo_academico']);
?>
<h2>CALIFICACION DE LOGROS ALUMNO <?=$datos_alumno['nombre_alumno']?>-<?=$datos_alumno['identificacion']?>.</h2>

<table width="670px" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Logro</td>
    <td width="100px">Calificacion</td>
  </tr>
<?
for($i=0;$i<count($dato);$i++){
	$calificacion_logro=getCalificacionLogro($dato[$i]['id_logro'],$_SESSION['alumno']);
	//print_r($calificacion_logro);
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$i+1?>-<?=$dato[$i]['id_logro']?></td>
    <td><input type="hidden" name="logro_<?=$i?>" id="logro_<?=$i?>" value="<?=$dato[$i]['id_logro']?>"/><?=$dato[$i]['logro']?></td>
    <td>
    <select name="calificacion_<?=$i?>" id="calificacion_<?=$i?>">
    	<option value="">Nota...</option>
        <? for($nota=0;$nota<=50;$nota++){
			$valor=$nota/10;	
		?>
    	<option value="<?=$valor?>" <? if($calificacion_logro['calificacion_logro']==$valor){ echo "selected";}?>><?=$valor?></option>
        <? }?>
    </select>
    </td>
  </tr>
<?
}
?>
</table>
		<table width="500px" border="0" cellspacing="0" cellpadding="0" style="margin:10px">

        </table>		<table width="670px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="ingreso_calificacion" id="ingreso_calificacion" type="button" value="GUARDAR CALIFICACIONES" onClick="FAjax('./administrativo/editar_nota_plan_gestor.php','area_trabajo','','post');">&nbsp;&nbsp;<input class="button_send" name="recomendacion2" id="recomendacion2" type="button" value="VOLVER" onclick="FAjax('./administrativo/filtro_calificar.php','area_trabajo','','post');" /></td>
			</tr>
        </table>