<?
session_start();

include_once("funciones/funciones.php");
include_once("funciones/conexion.php");

$alumnos=getAlumnos($_REQUEST['grado_alumno'],$_REQUEST['grupo_alumno'],$_REQUEST['nombre_alumno'], $_REQUEST['id_alumno']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"{HTMLDIR}>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--CHARSET--> 
<link rel="stylesheet" href="web_cam/jpegcam/htdocs/style.css" type="text/css" />
<link rel="SHORTCUT ICON" href="web_cam/jpegcam/htdocs/images/icono.ico">
<link href="web_cam/jpegcam/htdocs/style_galeria.css" rel="stylesheet" type="text/css" />
<link href="web_cam/jpegcam/htdocs/calendar/calendar-blue.css" rel="stylesheet" type="text/css">
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
    <td>Telefono</td>
    <td>RH</td>
    <td>Grado</td>
    <td width="90px">Nombre Foto</td>
  </tr>
<?
for($i=0;$i<count($alumnos);$i++){
?>
  <tr>
    <td><?=$i+1?></td>
    <td><?=$alumnos[$i]['identificacion']?></td>
    <td><?=$alumnos[$i]['nombre_alumno']?></td>
    <td>
	<? $tel=getTelefonos($alumnos[$i]['identificacion']); 
	 if(strlen($tel[0]["tel_1"])>1)echo $tel[0]["tel_1"];
	 if(strlen($tel[0]["tel_2"])>1)echo " - ".$tel[0]["tel_2"];
	 if(strlen($tel[1]["tel_1"])>1)echo " - ".$tel[1]["tel_1"];
	 if(strlen($tel[1]["tel_1"])>1)echo " - ".$tel[1]["tel_2"];
	 ?></td>
    <td>
    <? if(strlen($alumnos[$i]['rh'])==1){ echo $alumnos[$i]['rh']."+";}else{ echo $alumnos[$i]['rh'];}?>
     </td>
    <td><?=$alumnos[$i]['nombre_grado']?></td>
    <td align="center"><?=$alumnos[$i]['foto']?></td>
  </tr>
<?
}
?>
</table>
</body>