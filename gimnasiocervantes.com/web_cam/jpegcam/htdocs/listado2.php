<?
session_start();

include_once("../../../funciones/funciones.php");
include_once("../../../funciones/conexion.php");

$alumnos=getAlumnosReimpresion();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"{HTMLDIR}>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--CHARSET--> 
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="SHORTCUT ICON" href="images/icono.ico">
<link href="./style_galeria.css" rel="stylesheet" type="text/css" />
<link href="./calendar/calendar-blue.css" rel="stylesheet" type="text/css">
<!--CSS-->
<title>COLEGIO GIMNASIO CERVANTES</title>
<!--HEAD-->

</head>

<body id="cuerpo">
<h2>Listado de alumnos registrados.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>&nbsp;</td>
    <td>Identificaci&oacute;n</td>
    <td>Nombre</td>
    <td>Grado</td>
    <td>Grupo</td>
    <td width="90px">Foto</td>
  </tr>
<?
for($i=0;$i<count($alumnos);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$i+1?></td>
    <td>IDENTIFOCACI&Oacute;N: <br /><?=$alumnos[$i]['identificacion']?></td>
    <td>NOMBRE: <?=$alumnos[$i]['nombre_alumno']?><br />RH:<? if(strlen($alumnos[$i]['rh'])==1){ echo $alumnos[$i]['rh']."+";}else{ echo $alumnos[$i]['rh'];}?><br />TELEFONOS:
     <? $tel=getTelefonos($alumnos[$i]['identificacion']); 
	 if(strlen($tel[0]["tel_1"])>1)echo $tel[0]["tel_1"];
	 if(strlen($tel[0]["tel_2"])>1)echo " - ".$tel[0]["tel_2"];
	 if(strlen($tel[1]["tel_1"])>1)echo " - ".$tel[1]["tel_1"];
	 if(strlen($tel[1]["tel_1"])>1)echo " - ".$tel[1]["tel_2"];
	 ?>
     </td>
    <td>GRADO: <?=$alumnos[$i]['nombre_grado']?></td>
    <td>GRUPO: <?=$alumnos[$i]['nombre_grupo']?></td>
    <td align="center"><img src="./<?=$alumnos[$i]['identificacion']?>.jpg" width="250" height="175"></td>
  </tr>
<?
}
?>
</table>
</body>