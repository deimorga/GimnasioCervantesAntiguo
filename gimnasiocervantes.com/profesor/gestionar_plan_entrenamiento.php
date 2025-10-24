<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$_SESSION['grupo']=$_REQUEST['id_grupo_asignatura'];
?>
<table width="100%" cellspacing=0 border="0">
  <tr>
    <td><div id="concepto"><? include_once("form_plan_entrenamiento.php");?></div></td>
  </tr>
  <tr>
    <td valign="top"><div id="list_concepto"><? include_once("info_ejercicio.php");?></div></td>
  </tr>
</table>
