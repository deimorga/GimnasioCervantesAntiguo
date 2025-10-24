<?php
ini_set("memory_limit","256M");
include("../funciones/conexion.php");
include("../funciones/funciones.php");
//echo $_REQUEST['grupo'];
$anio=2018;
$alumnos_curso=getAlumnosGrupo($_REQUEST['grupo']);
?>
<table border="1" cellspacing="0" cellpadding="0">
	  <tr style="background-color:#CCC;">
		<td style="font-size:14px; border-right:0.1mm solid #220044;">Alumno</td>
			<td width="39px" colspan="2" style="border-right:0.1mm solid #220044;">P1</td>
			<td width="39px" colspan="2" style="border-right:0.1mm solid #220044;">P2</td>
			<td width="39px" colspan="2" style="border-right:0.1mm solid #220044;">P3</td>
		  </tr>
<?
for($a=0;$a<count($alumnos_curso);$a++){
	$puesto1=getPuntajeAlumno($alumnos_curso[$a]['identificacion'],1,$anio);
	$puesto2=getPuntajeAlumno($alumnos_curso[$a]['identificacion'],2,$anio);
	$puesto3=getPuntajeAlumno($alumnos_curso[$a]['identificacion'],3,$anio);
?>
	  <tr>
		<td style="font-size:14px; border-right:0.1mm solid #220044;"><?=$alumnos_curso[$a]['nombre_alumno']?></td>
			<td width="39px" style="border-right:0.1mm solid #220044;"><?=$puesto1['puntaje_total']?></td>
			<td width="39px" style="border-right:0.1mm solid #220044;"><?=$puesto1['puesto_alumno']?></td>
			<td width="39px" style="border-right:0.1mm solid #220044;"><?=$puesto2['puntaje_total']?></td>
			<td width="39px" style="border-right:0.1mm solid #220044;"><?=$puesto2['puesto_alumno']?></td>
			<td width="39px" style="border-right:0.1mm solid #220044;"><?=$puesto3['puntaje_total']?></td>
			<td width="39px" style="border-right:0.1mm solid #220044;"><?=$puesto3['puesto_alumno']?></td>
		  </tr>
<?
}
?>
</table>
