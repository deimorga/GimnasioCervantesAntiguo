<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$alumnos=getAlumnosPin();
?>
<h2>Listado de alumnos con pin registrado.</h2>
<table class="table table-hover table-striped table-bordered">
  <thead>
    <tr>
    <th>&nbsp;</th>
    <th>Identificaci&oacute;n</th>
    <th>Nombre</th>
    <th>Grado</th>
    <th>PIN</th>
  </tr>
  </thead>
  <tbody>
<?
for($i=0;$i<count($alumnos);$i++){
?>
  <tr>
    <td><?=$i+1?></td>
    <td><?=$alumnos[$i]['identificacion']?></td>
    <td><?=$alumnos[$i]['nombre_alumno']?></td>
    <td><?=$alumnos[$i]['nombre_grado']?></td>
    <td><?=$alumnos[$i]['pin']?></td>
  </tr>
<?
}
?>
  </tbody>
</table>