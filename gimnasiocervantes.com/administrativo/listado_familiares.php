<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$alumno=$_SESSION["alumno_ingreso"];

if($_GET['borrar']){
	$elimina=delFamiliarAlumno($_GET['borrar'],$alumno);
	if($elimina){
		echo "<script>alert('Los datos se borraron correctamente...');</script>";
	}else{
		echo "<script>alert('No se borraron los datos...');</script>";
	}
}
$familiares=getFamiliaresAlumno($alumno);
//print_r($familiares);
?>
<h2>Listado de familiares del alumno.</h2>
<table class="table table-hover table-striped table-bordered">
  <thead>
    <tr>
    <th>Identificaci&oacute;n</th>
    <th>Nombre</th>
    <th>Acci&oacute;n</th>
  	</tr>
  </thead>
  <tbody>
<?
for($i=0;$i<count($familiares);$i++){
?>
  <tr>
    <td><?=$familiares[$i]['identificacion_acudiente']?></td>
    <td><?=$familiares[$i]['nombre_acudiente']?></td>
    <td><a href="#" onClick="if(confirm('Seguro de borrar al familiar?')){ FAjax('./administrativo/listado_familiares.php?borrar=<?=$familiares[$i]['identificacion_acudiente']?>','list_familiares','','post')}else{ return false;};">Borrar>></a>&nbsp;&nbsp;&nbsp;<a href="#" onClick="FAjax('./administrativo/nvo_familiar.php?edita=1&identificacion_familiar=<?=$familiares[$i]['identificacion_acudiente']?>','familia','','post');">Editar>></a></td>
  </tr>
<?
}
?>
</tbody>
</table>
