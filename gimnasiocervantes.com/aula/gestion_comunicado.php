<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_POST['actualiza_comunicado']==1){
	$guarda_comunicado=setComunicado($_POST['asunto'],$_POST['contenido'],$_SESSION['user_id']);
	if($guarda_comunicado){
		$alumno=getAlumnosGrupo($_SESSION['grupo']);
		
			for($i=0;$i<count($alumno);$i++){
				if($_POST[$alumno[$i]['identificacion']]==1){
					//echo "Entro!!!!";
					$asigna=setComunicadoAlumno($alumno[$i]['identificacion'],$guarda_comunicado);
					if($asigna){
					}else{
						echo "<script>alert('No asigno al alumno...');</script>";
					}
				}
			}
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

include("botones_retorno.php");

?>
<table width="100%" cellspacing=0 border="0">
  <tr>
    <td><div id="concepto"><? include_once("../administrativo/form_comunicado.php");?></div></td>
  </tr>
  <tr>
    <td valign="top"><div id="list_concepto"><? include_once("../administrativo/filtro_alumnos_grupo.php");?></div></td>
  </tr>
</table>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza_comunicado" type="hidden" value="0" />
                <input class="button_send" name="" id="ingreso_circular" type="button" value="GUARDAR DATOS" onClick="valida_nuevo_comunicado(this.form);"></td>
			</tr>
        </table>
