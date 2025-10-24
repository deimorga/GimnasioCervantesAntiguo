<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET['eliminar_ejercicio']==1){
	$elimina=delEjercicio($_GET['id']);
	if($elimina){
		echo "<script>alert('Los datos se eliminaron correctamente...');</script>";
	}else{
		echo "<script>alert('Los datos no se eliminaron correctamente...');</script>";
	}
}

$ejercicio=getEjerciciosPlan($_SESSION['id_plan']);
//print_r($alumno);
?>
<h2>Actividades programadas.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0033CC" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Actividad</td>
    <td>Accion</td>
  </tr>
<?
if(count($ejercicio)<1){
?>
  <tr>
    <td colspan="3" align="center">NO HAY EJERCICIOS REGISTRADOS</td>
  </tr>
<?
}else{
for($i=0;$i<count($ejercicio);$i++){
?>
  <tr>
    <td><?=$i+1?></td>
    <td><?=$ejercicio[$i]['nombre_ejercicio']?></td>
    <td rowspan="2" width="100px"><a href="#" onClick="if(confirm('Seguro de eliminar el ejercicio?')){ FAjax('./profesor/list_ejercicios_plan.php?id=<?=$ejercicio[$i]['id_ejercicio']?>&eliminar_ejercicio=1','salud','','post');}else{ return false;}">Eliminar>></a></td>
  </tr>
  <tr>
    <td width="80px" height="60px" align="center"><? if($ejercicio[$i]['archivo']!=NULL){
		?><a href="#" onclick="window.open('./img/ejercicio/<?=$ejercicio[$i]['archivo']?>');"><img src="./img/descargar.png" width="80" height="60"><br /><?=$ejercicio[$i]['archivo']?></a><?
		}else{ 
		?><img src="./img/nulo.png" onclick="alert('No se cargo archivo!!!');" width="80" height="60"><?
		}?>
        </td>
    <td><?=$ejercicio[$i]['descripcion_ejercicio']?></td>
  </tr>
  <? if($ejercicio[$i]['enlace']!=NULL){
	  $enlace="";
	  if(substr($ejercicio[$i]['enlace'],0,7)=="http://" || substr($ejercicio[$i]['enlace'],0,7)=="HTTP://" || substr($ejercicio[$i]['enlace'],0,8)=="HTTPS://" || substr($ejercicio[$i]['enlace'],0,8)=="https://"){
		  $enlace=$ejercicio[$i]['enlace'];
	  }else{
	  	  $enlace="http://".$ejercicio[$i]['enlace'];
	  }
  ?>
  <tr>
    <td>ENLACE:</td>
    <td colspan="2"><a onclick="window.open('<?=$enlace?>');" ><img src="./img/enlace.png" width="80" height="60"><?=$ejercicio[$i]['enlace']?></a></td>
  </tr>
<?
  }
}}
?>
</table>