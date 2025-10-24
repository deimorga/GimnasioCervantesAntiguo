<?
session_start();

include_once("../../../funciones/funciones.php");
include_once("../../../funciones/conexion.php");

$alumnos=getAlumnos($_REQUEST['grado_alumno'],$_REQUEST['grupo_alumno'],$_REQUEST['nombre_alumno'], $_REQUEST['id_alumno']);
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
<h2>Listado de profesores y administrativos registrados.</h2>
<table cellspacing="0" border="1" cellpadding="0">
  <col width="80" />
  <col width="282" />
  <col width="77" span="2" />
  <col width="172" />
  <col width="243" />
  <tr>
    <td width="80">id_profesor</td>
    <td width="282">nombre_profesor</td>
    <td width="77">tel_1</td>
    <td width="77">tel_2</td>
    <td width="172">roll</td>
    <td width="243">foto</td>
  </tr>
  <tr>
    <td align="right">11431939</td>
    <td>Eduardo Alejandro    Bernal Baron</td>
    <td>3105556305</td>
    <td>&nbsp;</td>
    <td>DOCENTE</td>
    <td><img src="./fotos_profesores/11431939.jpg" width="150" height="175"></td>
  </tr>
  <tr>
    <td align="right">11435821</td>
    <td>Juan Manuel Califa    Alvarez</td>
    <td>&nbsp;</td>
    <td>3013842402</td>
    <td>DOCENTE</td>
    <td><img src="./fotos_profesores/11435821.jpg" width="150" height="175"></td>
  </tr>
  <tr>
    <td align="right">11443982</td>
    <td>GEMÁN GUTIÉRREZ    RIVERA</td>
    <td>3123119355</td>
    <td>&nbsp;</td>
    <td>DOCENTE</td>
    <td><img src="./fotos_profesores/11443982.jpg" width="150" height="175"></td>
  </tr>
  <tr>
    <td align="right">11445595</td>
    <td>WILLIAM LEANDRO    GUTIERREZCACERES</td>
    <td>3112328241</td>
    <td>&nbsp;</td>
    <td>DOCENTE</td>
    <td><img src="./fotos_profesores/11445595.jpg" width="150" height="175"></td>
  </tr>
  <tr>
    <td align="right">20405021</td>
    <td>Marinela Roa Parra</td>
    <td>&nbsp;</td>
    <td>3103367645</td>
    <td>DOCENTE</td>
    <td><img src="./fotos_profesores/20405021.jpg" width="150" height="175"></td>
  </tr>
  <tr>
    <td align="right">35517935</td>
    <td>CARMENZA CAÑON</td>
    <td>3115091008</td>
    <td>&nbsp;</td>
    <td>DOCENTE</td>
    <td><img src="./fotos_profesores/35517935.jpg" width="150" height="175"></td>
  </tr>
  <tr>
    <td align="right">35518570</td>
    <td>Libia Ines Beltran    Castiblanco</td>
    <td>&nbsp;</td>
    <td>3124471246</td>
    <td>RECTORA</td>    <td><img src="./fotos_profesores/35518570.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">35520544</td>
    <td>Claudia Cristina    Sanchez Buitrago</td>
    <td>&nbsp;</td>
    <td>3138297161</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/35520544.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">35527362</td>
    <td>FETECUA GUZMAN    CLAUDIA ADRIANA</td>
    <td>3165846076</td>
    <td>&nbsp;</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/35527362.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">35529102</td>
    <td>Diana Patricia Ortiz    Cuellar</td>
    <td>&nbsp;</td>
    <td>3208085799</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/35529102.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">35531671</td>
    <td>Marlen Pedraza    Barbosa</td>
    <td>&nbsp;</td>
    <td>3167730337</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/35531671.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">38288410</td>
    <td>Maribel Ortiz Robayo</td>
    <td>3134545481</td>
    <td>&nbsp;</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/38288410.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">39732635</td>
    <td>Mariana Andrea Ubaque    Roa</td>
    <td>&nbsp;</td>
    <td>3125926038</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/39732635.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">52115345</td>
    <td>Diana Constanza    Bernal Bernal</td>
    <td>&nbsp;</td>
    <td>3115592130</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/52115345.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">52662911</td>
    <td>Diana Alexandra Leon    Martinez</td>
    <td>&nbsp;</td>
    <td>3203186822</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/52662911.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">1032380913</td>
    <td>Andr&eacute;s Rodrigo Tovar M.</td>
    <td>3012311067</td>
    <td>8934957</td>
    <td>SISTEMAS</td>    <td><img src="./fotos_profesores/1032380913.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">1069729619</td>
    <td>Sandra Milena Oviedo    Mejia</td>
    <td>&nbsp;</td>
    <td>3143335451</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/1069729619.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">1070942859</td>
    <td>Alexander Rueda    Velandia</td>
    <td>3153765906</td>
    <td>&nbsp;</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/1070942859.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">1070943207</td>
    <td>Andrea Forero Ramirez</td>
    <td>&nbsp;</td>
    <td>3102132380</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/1070943207.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">1070944144</td>
    <td>karol Andrea Torres    Lozano</td>
    <td>&nbsp;</td>
    <td>3144269706</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/1070944144.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">1070947857</td>
    <td>Paola Yizel Suarez    Castillo</td>
    <td>&nbsp;</td>
    <td>3133031903</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/1070947857.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">1070948254</td>
    <td>Guisell Alejandra    Castañeda Beltran</td>
    <td>8430744</td>
    <td>&nbsp;</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/1070948254.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">1070955647</td>
    <td>MARIA CAMILA    DUARTE </td>
    <td>3112961917</td>
    <td>&nbsp;</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/1070955647.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">1070962674</td>
    <td>KAREN RODRIGUEZ    RODRIGUEZ</td>
    <td>8921635</td>
    <td>3115165129</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/1070962674.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">1070962938</td>
    <td>JENNY ALEXANDRA    CORONADO CARDONA</td>
    <td>8437595</td>
    <td>3142087105</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/1070962938.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">1070968280</td>
    <td>Daniel Rodriguez</td>
    <td>11111111</td>
    <td>&nbsp;</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/1070968280.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">1073234217</td>
    <td>Diego Alejandro    Bernal Beltran</td>
    <td>3124473524</td>
    <td>&nbsp;</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/1073234217.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right">1088246574</td>
    <td>Jorge Luis Quintero</td>
    <td>3134066568</td>
    <td>&nbsp;</td>
    <td>DOCENTE</td>    <td><img src="./fotos_profesores/1088246574.jpg" width="150" height="175"></td>
  </tr>
<tr>
    <td align="right" width="80">35528154</td>
    <td width="282">Yenith    Alexandra Arevalo Rojas</td>
    <td align="right">3002196843</td>
    <td>&nbsp;</td>
    <td width="172">administrativo</td>    <td><img src="./fotos_profesores/35528154.jpg" width="150" height="175"></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>