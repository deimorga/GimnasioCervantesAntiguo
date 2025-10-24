<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_GET['id'] || $_POST['id']){
	$id=$_REQUEST['id'];
	$existe=getPlanEntrenamientoId($id);
	if($existe){
		//$id=$existe['id_plan_entrenamiento'];
		//$_SESSION['id_plan']=$id;
		$fecha=$existe['fecha_plan'];
		$tiempo=$existe['tiempo'];
		$elementos=$existe['elementos'];
		$objetivo=$existe['objetivo'];
		$observaciones=$existe['observaciones'];
		$categoria=$existe['nombre_asignatura'];
		$ejercicio=getEjerciciosPlan($id);
?>
<table width="600px" align="center" border="1" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="4" align="center" style="color:#333; font-size:16px; font-family:Georgia, 'Times New Roman', Times, serif; font-style:italic;" >Plan de Tareas.</td>
  </tr>
  <tr>
    <td width="120px">Asignatura:<br><?=$categoria?></td>
    <td>Elementos: <br><?=$elementos?></td>
    <td width="120px">Fecha:<br><?=$fecha?></td>
    <td width="120px">Tiempo:<br><?=$tiempo?></td>
  </tr>
  <tr>
    <td colspan="4">Objetivo:<br><?=$objetivo?></td>
  </tr>
  <tr>
    <td colspan="4">Observaciones:<br><?=$observaciones?></td>
  </tr>
    <?
	if(count($ejercicio)<1){
		echo "NO HAY ACTIVIDADES REGISTRADAS...";
	}else{
for($i=0;$i<count($ejercicio);$i++){
?>
  <tr>
    <td colspan="4"><h4><?=$i+1?> - <?=$ejercicio[$i]['nombre_ejercicio']?></h4></td>
  </tr>
<?
	if($ejercicio[$i]['archivo']!=NULL){
?>
  <tr>
    <td colspan="3"><?=$ejercicio[$i]['descripcion_ejercicio']?></td>
    <td width="80px" height="60px" align="center"><a href="#" onclick="window.open('./img/ejercicio/<?=$ejercicio[$i]['archivo']?>');"><img src="./img/descargar.png" width="80" height="60"><br /><?=$ejercicio[$i]['archivo']?></a>
        </td>
  </tr>
<?
		}else{ 
		?>
  <tr>
    <td colspan="5"><?=$ejercicio[$i]['descripcion_ejercicio']?></td>
  </tr>
<?
		}?>
  <? if($ejercicio[$i]['enlace']!=NULL){
	  $enlace="";
	  if(substr($ejercicio[$i]['enlace'],0,7)=="http://" || substr($ejercicio[$i]['enlace'],0,7)=="HTTP://" || substr($ejercicio[$i]['enlace'],0,8)=="HTTPS://" || substr($ejercicio[$i]['enlace'],0,8)=="https://"){
		  $enlace=$ejercicio[$i]['enlace'];
	  }else{
	  	  $enlace="http://".$ejercicio[$i]['enlace'];
	  }
  ?>
  <tr>
    <td colspan="4">Enlace: <a href="#" onclick="window.open('<?=$enlace?>');"><img src="./img/enlace.png" width="30" height="40"><?=$ejercicio[$i]['enlace']?></a></td>
  </tr>
  <?
  }

}}
?>
</table>
<?
	}
}

?>