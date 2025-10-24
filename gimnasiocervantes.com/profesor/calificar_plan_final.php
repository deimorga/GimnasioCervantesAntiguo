<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$anio=date('Y');
$asignatura=$_SESSION['asignatura'];
$dato=getAsignaturaGrupoId($_SESSION['grupo_asignatura']);
$alumnos=getAlumnosGrupo($_SESSION['grupo']);

?>
<h2>Logros a calificar.</h2>
<table width="670px" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td width="130px">DESEMPE&Ntilde;O</td>
    <td>Logro</td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td>Superior(DS)/4.8-5.0</td>
    <td><?=$dato['logro_final_superior']?></td>
  </tr>
  <tr bgcolor='#FFFF66'>
    <td>Alto(DA)/4.3-4.7</td>
    <td><?=$dato['logro_final_alto']?></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td>Basico(DBS)/3.7-4.2</td>
    <td><?=$dato['logro_final_basico']?></td>
  </tr>
  <tr bgcolor='#FFFF66'>
    <td>Bajo(DB)/1.0-3.6</td>
    <td><?=$dato['logro_final_bajo']?></td>
  </tr>
</table>
<h2>Listado de alumnos.</h2>
Para las calificaciones solo se aceptan decimales separados por un punto (.) ej: 4.5
<table width="670px" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Identificaci&oacute;n</td>
    <td>Nombre</td>
    <td>P1</td>
    <td>P2</td>
    <td>P3</td>
    <td>P4</td>
    <td>PROM</td>
    <td>Nota final</td>
  </tr>
<?
for($i=0;$i<count($alumnos);$i++){
	
	$calificacion_alumno=getCalificacionAsignaturaFinal($asignatura, $alumnos[$i]['identificacion'],$anio);
	
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
    <td><?  echo $p1['calificacion_asignatura'];?></td>
    <td><?  echo $p2['calificacion_asignatura'];?></td>
    <td><?  echo $p3['calificacion_asignatura'];?></td>
    <td><?  echo $p4['calificacion_asignatura'];?></td>
    <td><?=redondear($prom)?></td>
    <td><input type="text" name="nota_<?=$alumnos[$i]['identificacion']?>" id="nota_<?=$alumnos[$i]['identificacion']?>" value="<?=$calificacion_alumno['calificacion_asignatura_final']?>" size="6" maxlength="3" onkeypress="return numeros2(event);" onpaste="return false" onblur="return comprueba_nota(this);" /></td>
  </tr>
<?
}
?>
</table>

		<table width="670px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><div id="load"></div></td>
			<tr>
				<td align="center"><input class="button_send" name="guardar_calificacion" id="guardar_calificacion" type="button" value="GUARDAR CALIFICACIONES" onClick="valida_guarda_notas_final(this.form);"><!--&nbsp;&nbsp;<input class="button_send" name="recomendacion" id="recomendacion" type="button" value="RECOMENDACIONES" onClick="FAjax('./profesor/recomendacion.php','area_trabajo','','post');">--></td>
			</tr>
        </table>