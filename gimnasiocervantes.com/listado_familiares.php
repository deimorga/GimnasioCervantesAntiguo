<?
session_start();

include_once("./funciones/funciones.php");
include_once("./funciones/conexion.php");

$alumno=$_SESSION["alumno_registro"];

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
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>Identificaci&oacute;n</td>
    <td>Nombre</td>
    <td>Acci&oacute;n</td>
  </tr>
<?
for($i=0;$i<count($familiares);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$familiares[$i]['identificacion_acudiente']?></td>
    <td><?=$familiares[$i]['nombre_acudiente']?></td>
    <td><a href="#" onClick="if(confirm('Seguro de borrar al familiar?')){ FAjax('./listado_familiares.php?borrar=<?=$familiares[$i]['identificacion_acudiente']?>','list_familiares','','post')}else{ return false;};">Borrar>></a>&nbsp;&nbsp;&nbsp;<a href="#" onClick="FAjax('./nvo_familiar.php?edita=1&identificacion_familiar=<?=$familiares[$i]['identificacion_acudiente']?>','familia','','post');">Editar>></a></td>
  </tr>
<?
}
?>
</table>
