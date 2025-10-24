<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$campo="";
if($_GET['nva_recomendacion']==1){
$_SESSION['alumno']=NULL;
$_SESSION['alumno']=$_GET['identificacion'];
}
if($_GET['elimina_recomendacion']==1){
	$elimina=delPlanGestor("tbl_recomendacion_alumno", "id_recomendacion_alumno", $_GET['id_recomendacion_alumno']);
	if($elimina){
		echo "<script>alert('Se elimino correctamente la recomendacion...');</script>";
	}else{
		echo "<script>alert('No se elimino correctamente la recomendacion...');</script>";
	}
}

if($_POST['actualiza_recomendacion']==1){

	$inserta=setRecomendacion($_REQUEST['descripcion_recomendacion']);
	if($inserta){
		$asocia_alumno=setRecomendacionAlumno($inserta, $_SESSION['alumno'], $_SESSION['plan_gestor']);
		if($asocia_alumno){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
		}else{
		echo "<script>alert('No se asociaron los datos al boletin del alumno...');</script>";
		}
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if($_POST['actualiza_recomendacion']==2){

		$asocia_alumno=setRecomendacionAlumno($_POST['recomendacion_general'], $_SESSION['alumno'], $_SESSION['plan_gestor']);
		if($asocia_alumno){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
		}else{
		echo "<script>alert('No se asociaron los datos al boletin del alumno...');</script>";
		}
}

$dato=getRecomendacionesAlumno($_SESSION['alumno'], $_SESSION['plan_gestor']);
$recomendaciones_generales=getRecomendaciones();

?>
<script>

function cargaTexto(f){
	//alert("!!!"+f.recomendacion_general.value);
	if(f.recomendacion_general.value.length>=1){
	j=document.forms[0].recomendacion_general.selectedIndex;

	dato=document.forms[0].recomendacion_general[j].text; 
	f.recomendacion_seleccionada.value=dato;
	}else{
	f.recomendacion_seleccionada.value="";
	}
}
</script>
<h2>RECOMENDACIONES.</h2>

        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Recomendaci&oacute;n general:</td>
				<td>
				
<select name="recomendacion_general" id="recomendacion_general" size="9" onchange="cargaTexto(this.form);" style="width:300px;">
   	    <option value="">Seleccione...</option>
<?
for($i=0;$i<count($recomendaciones_generales);$i++){
?>
        <option style="width:300px;" value="<?=$recomendaciones_generales[$i]['id_recomendacion']?>"><?=$recomendaciones_generales[$i]['id_recomendacion']?> - <?=$recomendaciones_generales[$i]['recomendacion']?></option>
<?
}
?>
                </select> 
                *
                
                <textarea style="background:none; width:150px; height:150px;" name="recomendacion_seleccionada" id="recomendacion_seleccionada" readonly="readonly"></textarea></td>
			</tr>
			<tr>
				<td class="texte2">Recomendaci&oacute;n personal:</td>
				<td><textarea class="champ2" name="descripcion_recomendacion" id="descripcion_recomendacion"><?=$campo?></textarea> *</td>
			</tr>
		</table>
        <table width="370px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center">

                <input name="actualiza_recomendacion" id="actualiza_recomendacion" type="hidden" value="0"><input class="button_send" name="ingreso_recomendacion" id="ingreso_recomendacion" type="button" value="GUARDAR DATOS" onClick="valida_guardar_recomendacion(this.form);">
                <input class="button_send" name="volver" id="ingreso_recomendacion" type="button" value="VOLVER" onClick="FAjax('./profesor/filtro_calificar_plan_gestor.php','area_trabajo','','post');">
                </td>
			</tr>
        </table>
		<table width="500px" border="0" cellspacing="0" cellpadding="0" style="margin:10px">
          <tr>
            <td>
            <h3>Datos ya registrados:</h3>
            <strong>
			<?
            for($i=0;$i<count($dato);$i++){
				echo "* ".$dato[$i]['recomendacion']; ?>&nbsp;&nbsp;&nbsp;<a href='#' onclick="FAjax('./profesor/recomendacion.php?id_recomendacion_alumno=<?=$dato[$i]['id_recomendacion_alumno']?>&elimina_recomendacion=1','area_trabajo','','post');">eliminar</a>
                <br>
			<?
			}
			?>
            </strong>
            </td>
          </tr>
        </table>
