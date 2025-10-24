<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$archivos=getElementosActividadAula($_SESSION['id_actividad_aula']);

if(count($archivos)>=1){
?>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>Fecha de carga</td>
    <td>Alumno</td>
    <td>Comentarios</td>
    <td>Extension Archivo</td>
    <td>Accion</td>
  </tr>
<?
for($i=0;$i<count($archivos);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$archivos[$i]['fecha_carga']?></td>
    <td><?=$archivos[$i]['nombre_alumno']?></td>
    <td><?=$archivos[$i]['comentario']?></td>
    <td><?=$archivos[$i]['extension_archivo']?></td>
    <td>
    
    <a href='./aula/archivos_taller/<?=$archivos[$i]['id_elemento_alumno_actividad_aula']?>.<?=$archivos[$i]['extension_archivo']?>' target='_blank'>Descargar</a><br />

    </td>
  </tr>
<?
}
?>
</table>
<?
}else{
	echo "No hay archivos cargados...";
}
?>