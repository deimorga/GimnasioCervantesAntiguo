<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET['nvo_alumno_caso_especial']==1){
	$_SESSION['alumno_caso_especial']=$_GET['id'];
}

if($_GET['elimina_logro_caso_especial']==1){
	$elimina=delAlumnoCasoEspecialPersonal($_GET['id_logro_caso_especial'],$_SESSION['alumno_caso_especial']);
	if($elimina){
	echo "<script>alert('Se eliminaron correctamente los datos...');</script>";
	}else{
	echo "<script>alert('No se eliminaros correctamente los datos...');</script>";
	}
	
}

if($_GET['elimina_recomendacion_caso_especial']==1){
	$elimina=delAlumnoRecomendacionCasoEspecial($_GET['id_recomendacion_caso_especial'],$_SESSION['alumno_caso_especial']);
	if($elimina){
	echo "<script>alert('Se eliminaron correctamente los datos...');</script>";
	}else{
	echo "<script>alert('No se eliminaros correctamente los datos...');</script>";
	}
	
}

$logros_caso_especial=getLogrosCasoEspecial();

if($_POST['actualiza_caso_especial']==1){//generales
	$alumno=$_SESSION['alumno_caso_especial'];
	delAlumnoCasoEspecial($alumno);
	for($i=0;$i<count($logros_caso_especial);$i++){
		if($_POST[$logros_caso_especial[$i]['id_logro_caso_especial']]==1){		
			$asocia_alumno=setAlumnoCasoEspecial($alumno, $logros_caso_especial[$i]['id_logro_caso_especial']);
		}
	}
	echo "<script>alert('Se guardaron correctamente los datos...');</script>";
}

if($_POST['actualiza_caso_especial']==2){//personal
	$alumno=$_SESSION['alumno_caso_especial'];
	
	$asocia_alumno=setAlumnoCasoEspecialPersonal($alumno, $_POST['caso_especial_personal']);
	if($asocia_alumno){
	echo "<script>alert('Se guardaron correctamente los datos...');</script>";
	}else{
	echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if($_POST['actualiza_caso_especial']==3){//recomendacion
	$alumno=$_SESSION['alumno_caso_especial'];
	
	$asocia_alumno=setAlumnoRecomendacionCasoEspecial($alumno, $_POST['caso_especial_recomendacion']);
	if($asocia_alumno){
	echo "<script>alert('Se guardaron correctamente los datos...');</script>";
	}else{
	echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

?>

<?
if($_SESSION['user_tipo']==1){
?>
<h2>COMENTARIOS PARA CASOS ESPECIALES.</h2>
<?
/*
<table width="650px" cellpadding="0" cellspacing="0" border="1" style="color:#F00;">
  <tr bgcolor="#0033CC" style="color:#FFF;">
    <td width="85px"><input value="Seleccionar" type="button" onclick="selecciona_todo(this.form);" /></td>
    <td>Logro</td>
    <td>Tipo</td>
  </tr>
<? 
if(count($logros_caso_especial)<1){
?>
  <tr>
  	<td align="center" colspan="2">NO HAY LOGROS PARA CASOS ESPECIALES REGISTRADOS.</td>
  </tr>
<?
}else{
for($y=0;$y<count($logros_caso_especial);$y++){
	$estado=getLogrosCasoEspecialId($_SESSION['alumno_caso_especial']);
?>       
  <tr <? if(esPar($y+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
  	<td><input name="<?=$logros_caso_especial[$y]['id_logro_caso_especial']?>" id="<?=$logros_caso_especial[$y]['id_logro_caso_especial']?>" value="0" type="checkbox" <? for($z=0;$z<count($estado);$z++){ if($estado[$z]['id_logro_caso_especial']==$logros_caso_especial[$y]['id_logro_caso_especial']){ echo 'checked="checked"'; }}?> /></td>
    <td valign="top"><?=$logros_caso_especial[$y]['logro_caso_especial']?></td>
    <td valign="top"><? if($logros_caso_especial[$y]['tipo_logro_caso_especial']==1){ echo "Academico";}else{ echo "Diciplinario";};?></td>
  </tr>
<?
}
}
?>
</table>
*/
?>
<table width="650" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="texte2">Comentarios de la instituci&oacute;n:</td>
				<td><textarea class="champ2" name="caso_especial_recomendacion" id="caso_especial_recomendacion"></textarea> *</td>
			</tr>
         <tr>
            <td colspan="2">
            <h3>Comentarios Institucionales ya registrados:</h3>
            <strong>
			<?
			$dato1=getRecomendacionesCasoEspecialId($_SESSION['alumno_caso_especial']);
            for($i=0;$i<count($dato1);$i++){
				echo "* ".$dato1[$i]['recomendacion_caso_especial']; ?>&nbsp;&nbsp;&nbsp;<a href='#' onclick="FAjax('./profesor/caso_especial.php?id_recomendacion_caso_especial=<?=$dato1[$i]['id_recomendacion_caso_especial']?>&elimina_recomendacion_caso_especial=1','area_trabajo','','post');">eliminar</a>
                <br>
			<?
			}
			?>
            </strong>
            </td>
          </tr>
         <tr>
            <td colspan="2">
            <h3>Dificultades personales ya registradas:</h3>
            <strong>
			<?
			$dato=getLogrosCasoEspecialId2($_SESSION['alumno_caso_especial']);
            for($i=0;$i<count($dato);$i++){
				echo "* ".$dato[$i]['logro_caso_especial']; ?>
                <br>
			<?
			}
			?>
            </strong>
            </td>
          </tr>
</table>


<table width="370px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center">

                <input name="actualiza_caso_especial" id="actualiza_caso_especial" type="hidden" value="0"><input class="button_send" name="ingreso_caso_especial" id="ingreso_caso_especial" type="button" value="GUARDAR DATOS" onClick="valida_guardar_caso_especial_recomendacion(this.form);">                <input class="button_send" name="volver" id="ingreso_recomendacion" type="button" value="VOLVER" onClick="FAjax('./administrativo/filtro_dc.php','area_trabajo','','post');">
                </td>
			</tr>
        </table>
<?
}else{
?>
<h2>LOGROS PARA CASOS ESPECIALES.</h2>
<?
/*
<table width="650px" cellpadding="0" cellspacing="0" border="1" style="color:#F00;">
  <tr bgcolor="#0033CC" style="color:#FFF;">
    <td width="85px"><input value="Seleccionar" type="button" onclick="selecciona_todo(this.form);" /></td>
    <td>Logro</td>
    <td>Tipo</td>
  </tr>
<? 
if(count($logros_caso_especial)<1){
?>
  <tr>
  	<td align="center" colspan="2">NO HAY LOGROS PARA CASOS ESPECIALES REGISTRADOS.</td>
  </tr>
<?
}else{
for($y=0;$y<count($logros_caso_especial);$y++){
	$estado=getLogrosCasoEspecialId($_SESSION['alumno_caso_especial']);
?>       
  <tr <? if(esPar($y+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
  	<td><input name="<?=$logros_caso_especial[$y]['id_logro_caso_especial']?>" id="<?=$logros_caso_especial[$y]['id_logro_caso_especial']?>" value="0" type="checkbox" <? for($z=0;$z<count($estado);$z++){ if($estado[$z]['id_logro_caso_especial']==$logros_caso_especial[$y]['id_logro_caso_especial']){ echo 'checked="checked"'; }}?> /></td>
    <td valign="top"><?=$logros_caso_especial[$y]['logro_caso_especial']?></td>
    <td valign="top"><? if($logros_caso_especial[$y]['tipo_logro_caso_especial']==1){ echo "Academico";}else{ echo "Diciplinario";};?></td>
  </tr>
<?
}
}
?>
</table>
*/
?>
<table width="650" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="texte2">Dificultades personales:</td>
				<td><textarea class="champ2" name="caso_especial_personal" id="caso_especial_personal"></textarea> *</td>
			</tr>
         <tr>
            <td colspan="2">
            <h3>Dificultades personales ya registradas:</h3>
            <strong>
			<?
			$dato=getLogrosCasoEspecialId2($_SESSION['alumno_caso_especial']);
            for($i=0;$i<count($dato);$i++){
				echo "* ".$dato[$i]['logro_caso_especial']; ?>&nbsp;&nbsp;&nbsp;<a href='#' onclick="FAjax('./profesor/caso_especial.php?id_logro_caso_especial=<?=$dato[$i]['id_logro_caso_especial']?>&elimina_logro_caso_especial=1','area_trabajo','','post');">eliminar</a>
                <br>
			<?
			}
			?>
            </strong>
            </td>
  </tr>
</table>


<table width="370px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center">

                <input name="actualiza_caso_especial" id="actualiza_caso_especial" type="hidden" value="0"><input class="button_send" name="ingreso_caso_especial" id="ingreso_caso_especial" type="button" value="GUARDAR DATOS" onClick="valida_guardar_caso_especial_2(this.form);">                <input class="button_send" name="volver" id="ingreso_recomendacion" type="button" value="VOLVER" onClick="FAjax('./profesor/filtro_dc.php','area_trabajo','','post');">
                </td>
			</tr>
</table>
<?
}
?>
