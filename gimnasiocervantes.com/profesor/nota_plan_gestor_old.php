<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_REQUEST["califica"]==1){
	$_SESSION['alumno']=$_REQUEST["identificacion"];
}

$dato=seleccionaPlanGestor("tbl_logro", $_SESSION['plan_gestor']);
$recomendacion=getRecomendacionesAlumno($_SESSION['alumno'], $_SESSION['plan_gestor']);

if($_REQUEST['ingreso_calificacion']){
	$definitiva=0;
	$contador=0;
	$suma=0;
	for($i=0;$i<count($dato);$i++){
		$actualiza=setCalificacionLogro($_REQUEST["logro_".$i], $_REQUEST["calificacion_".$i], $_SESSION['alumno']);
		if($actualiza){
			$contador=$contador+1;
			$suma=$suma+$_REQUEST["calificacion_".$i];
		}
	}
	$definitiva=$suma/$contador;
	$definitiva=redondear($definitiva);
	//echo "suma: ".$suma." definitiva: ".$definitiva;
	$actualiza_definitiva=setCalificacionAsignatura($_SESSION['asignatura'], $definitiva, $_SESSION['alumno'],$_POST['justificadas'],$_POST['injustificadas'],$_SESSION['periodo_academico']);
	if($actualiza_definitiva){
		echo "<script>alert('Se actualizo el registro de notas con una definitiva de ".$definitiva."');</script>";
	}else{
		echo "<script>alert('Inconvenientes en el registro de notas');</script>";
	}
}
$datos_alumno=getAlumnoId($_SESSION['alumno']);
 $calificacion=getCalificacionAsignatura($_SESSION['asignatura'], $_SESSION['alumno'],$_SESSION['periodo_academico']);
?>
<h2>CALIFICACION DE LOGROS ALUMNO <?=$datos_alumno['nombre_alumno']?>.</h2>
<h3>Inasistensia.</h3><br /> 
  	&nbsp;&nbsp;Justificadas: 	
  	  <select name="justificadas">
    <? for($k=0;$k<=10;$k++){?>
  	  <option value="<?=$k?>" <? if($calificacion['horas_justificadas']==$k){ echo " selected";}?>><?=$k?> Horas</option>
    <? }?>
  	</select>
  	&nbsp;&nbsp;Injustificadas:	<select name="injustificadas">
    <? for($k=0;$k<=10;$k++){?>
  	  <option value="<?=$k?>" <? if($calificacion['horas_injustificadas']==$k){ echo " selected";}?>><?=$k?> Horas</option>
    <? }?>
  	</select><br /><br />
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
    <td><?=$i+1?></td>
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
          <tr>
            <td>
            <h3>Recomendaciones:</h3>
            <strong>
			<?
            for($j=0;$j<count($recomendacion);$j++){
				echo "* ".$recomendacion[$j]['recomendacion']; ?>&nbsp;&nbsp;&nbsp;<a href='#' onclick="FAjax('./profesor/recomendacion.php?id_recomendacion_alumno=<?=$recomendacion[$j]['id_recomendacion_alumno']?>&elimina_recomendacion=1','area_trabajo','','post');">eliminar</a>
                <br>
			<?
			}
			?>
            </strong>
            </td>
          </tr>
        </table>		<table width="670px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="ingreso_calificacion" id="ingreso_calificacion" type="button" value="GUARDAR CALIFICACIONES" onClick="FAjax('./profesor/nota_plan_gestor.php','area_trabajo','','post');">&nbsp;&nbsp;<input class="button_send" name="recomendacion" id="recomendacion" type="button" value="RECOMENDACIONES" onClick="FAjax('./profesor/recomendacion.php','area_trabajo','','post');">&nbsp;&nbsp;<input class="button_send" name="recomendacion2" id="recomendacion2" type="button" value="VOLVER" onclick="FAjax('./profesor/filtro_calificar_plan_gestor.php','area_trabajo','','post');" /></td>
			</tr>
        </table>