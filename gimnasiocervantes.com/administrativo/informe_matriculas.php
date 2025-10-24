<?
session_start();
if($_REQUEST['descargar_pagos']==1){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=archivo.xls");
	header("Pragma: no-cache");
	header("Expires: 0"); 
	//echo "lololo";
}
include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$conceptos=getAlumnosMatriculados(2015);

?>
<h2>Listado de conceptos pagados.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0033FF" style="color:#FFF;">
    <td>No.</td>
    <td>Identificacion</td>
    <td>Nombre</td>
    <td>Grado</td>
    <td>Pension</td>
  </tr>
<?
if(count($conceptos)<1){
?>
  <tr>
    <td colspan="4" align="center">NO HAY PAGOS REGISTRADOS</td>
  </tr>
<?
}else{
for($i=0;$i<count($conceptos);$i++){
	
if($conceptos[$i]["id_grado"]!=$conceptos[$i-1]["id_grado"]){
	$val=0;
	?>
	</table>
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
      <tr bgcolor="#0033FF" style="color:#FFF;">
        <td>No.</td>
        <td>Identificacion</td>
        <td>Nombre</td>
        <td>Grado</td>
        <td>Pension</td>
      </tr>
	<?	
}
$val=$val+1;
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#CCCCCC'";}?>>
    <td><?=$val?></td>
    <td><?=$conceptos[$i]['identificacion']?></td>
    <td><?=$conceptos[$i]['nombre_alumno']?></td>
    <td align="right"><?=$conceptos[$i]['nombre_grado']?></td>
    <td align="right"><?=$conceptos[$i]['pension']?></td>
  </tr>
<?
}
}
?>
</table>
<?
if($_REQUEST['descargar_pagos']==1){
	echo "<script>window.close();</script>";
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><input type="button" value="IMPRIMIR" class="button_send" onclick="window.open('./administrativo/informe_matriculados.php?descargar_pagos=1');"/></td>
  </tr>
</table>
