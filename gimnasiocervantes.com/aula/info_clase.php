<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$id="";
$tema="";
$objetivos="";
$instrucciones="";

if($_SESSION['id_actividad_aula']!=NULL){
	//echo "ENTRO!!!";
	$id=$_SESSION['id_actividad_aula'];
	$existe=getActividadAulaId($id);
	if($existe){
		$tema=$existe['tema_actividad_aula'];
		$objetivos=$existe['objetivos_actividad_aula'];
		$instrucciones=$existe['indicaciones_actividad_aula'];
	}
}
?>

<h2>Informaci&oacute;n De La Clase.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos de la clase.</legend>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td><h4>Tema:</h4></td>
				<td><?=$tema?></td>
			</tr>
			<tr>
				<td><h4>Objetivos:</h4></td>
				<td><?=nl2br($objetivos)?></td>
			</tr>
			<tr>
				<td><h4>Instrucciones:</h4></td>
				<td><?=nl2br($instrucciones)?></td>
			</tr>
		</table>
	</fieldset>