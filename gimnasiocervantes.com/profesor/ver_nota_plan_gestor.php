<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$dato=seleccionaPlanGestor("tbl_logro", $_REQUEST['plan_gestor']);
$recomendacion=getRecomendacionesAlumno($_REQUEST["identificacion"], $_REQUEST['plan_gestor']);

$datos_alumno=getAlumnoId($_REQUEST["identificacion"]);
$calificacion=getCalificacionAsignatura($_REQUEST['asignatura'],$_REQUEST["identificacion"],$_REQUEST['periodo_academico']);
?>
<h2>CALIFICACION DE LOGROS ALUMNO <?=$datos_alumno['nombre_alumno']?>.</h2>
<h3>Inasistensia.</h3><br /> 
  	&nbsp;&nbsp;Justificadas: 	
  	  <? echo $calificacion['horas_justificadas'];?>
  	
  	&nbsp;&nbsp;Injustificadas:	
    <? echo $calificacion['horas_injustificadas'];?><br /><br />
<table width="670px" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Logro</td>
    <td width="100px">Calificacion</td>
  </tr>
<?
for($i=0;$i<count($dato);$i++){
	$calificacion_logro=getCalificacionLogro($dato[$i]['id_logro'],$_REQUEST["identificacion"]);
	//print_r($calificacion_logro);
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$i+1?>-<?=$dato[$i]['id_logro']?></td>
    <td><?=$dato[$i]['logro']?></td>
    <td>
    <? echo $calificacion_logro['calificacion_logro'];?>
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
				echo "* ".$recomendacion[$j]['recomendacion']; ?>
                <br>
			<?
			}
			?>
            </strong>
            </td>
          </tr>
        </table>		<table width="670px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="recomendacion2" id="recomendacion2" type="button" value="VOLVER" onclick="FAjax('./profesor/list_definitivas.php?grupo=<?=$datos_alumno['id_grupo']?>','area_trabajo','','post');" /></td>
			</tr>
        </table>