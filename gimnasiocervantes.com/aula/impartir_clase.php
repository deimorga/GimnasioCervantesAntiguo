<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET['redirect']==1){
	$_SESSION['redirect_archivo']=NULL;
	//nada, ya existe session $_SESSION['id_actividad_aula']
}else{
	$_SESSION['id_actividad_aula']=$_GET["id_actividad_aula"];
}

//include("botones_retorno.php");
include("botones_clase.php");
?>
<table width="100%" cellspacing=0 border="0" class="contenido_aula">
  <tr>
    <td valign="top"><div id="concepto"><? include_once("info_clase.php");?></div></td>
  </tr>
</table>