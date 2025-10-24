<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

include("botones_retorno.php");

$_SESSION['redirect_elemento']=NULL;
?>
<table width="100%" cellspacing=0 border="0" class="contenido_aula">
  <tr>
    <td><div id="concepto"><? include_once("form_actividad.php");?></div></td>
  </tr>
  <tr>
    <td valign="top"><div id="list_concepto"><? include_once("info_elemento.php");?></div></td>
  </tr>
</table>
