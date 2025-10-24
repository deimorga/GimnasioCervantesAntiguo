<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$profesores=getProfesores();
?>
<h2>Listado de profesores registrados.</h2>
<table width="660px" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Identificaci&oacute;n</td>
    <td>Nombre</td>
    <td>Telefono</td>
    <td>Direccion</td>
    <td>Email</td>
    <td>Director de curso</td>
    <td width="50px">Acci&oacute;n</td>
  </tr>
<?
for($i=0;$i<count($profesores);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$i+1?></td>
    <td><?=$profesores[$i]['id_profesor']?> / <?=$profesores[$i]['clave_usuario']?></td>
    <td><?=$profesores[$i]['nombre_profesor']?></td>
    <td><?=$profesores[$i]['tel_1']?> - <?=$profesores[$i]['tel_2']?></td>
    <td><?=$profesores[$i]['direccion_profesor']?></td>
    <td><?=$profesores[$i]['email_profesor']?></td>
    <td><? 
	$grupo=getGruposProfesor($profesores[$i]['id_profesor']);
	for($j=0;$j<count($grupo);$j++){
		echo "| ".$grupo[$j]["nombre_grupo"]." ";
	}
	?></td>
    <td align="center"><a href="#" onClick="FAjax('./administrativo/nuevo_profesor.php?identificacion_profesor=<?=$profesores[$i]['id_profesor']?>','area_trabajo','','post');">Editar</a></td>
  </tr>
<?
}
?>
</table>
