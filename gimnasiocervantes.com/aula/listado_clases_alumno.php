<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET["elimina_clase"]==1){
	$elimina=delActividadAula($_GET['id_actividad_aula']);
	if($elimina){
		echo "<script>alert('La clase se borro correctamente...');</script>";	
	}else{
		echo "<script>alert('Problema al borrar la clase...');</script>";	
	}
}

if(isset($_GET['tipo'])){
	$_SESSION['tipo_actividad_aula']=$_GET['tipo'];
}

$plan=getActividadAulaAlumno($_SESSION["user_id"],$_SESSION['tipo_actividad_aula']);

include("./botones_retorno.php");
?>
<h1>Listado de clases preparadas.</h1>
<table width="100%" class="table table-responsive table-hover">
  <thead>
    <td>Cod</td>
    <td>Tema</td>
    <td>Asignatura</td>
    <td>Fecha</td>
    <td>Acci&oacute;n</td>
  </thead>
<?
if(count($plan)<1){
?>
  <tr>
    <td colspan="5" align="center">NO HAY CLASES REGISTRADAS</td>
  </tr>
<?
}else{
for($i=0;$i<count($plan);$i++){
?>
  <tbody>
    <td width="80px" align="center"><?=$plan[$i]['id_actividad_aula']?></td>
    <td><?=$plan[$i]['tema_actividad_aula']?></td>
    <td><?=$plan[$i]['nombre_asignatura']?></td>
    <td width="210px" align="center"><?=$plan[$i]['fecha_actividad_aula']?></td>
    <td align="center"><a href="#" onClick="FAjax('./aula/impartir_clase.php?id_actividad_aula=<?=$plan[$i]['id_actividad_aula']?>','area_trabajo_alumno','','post');"><img src="./iconos/ver.png" width="60" height="60" /></a> 
</td>
  </tbody>
<?
}}
?>
</table>