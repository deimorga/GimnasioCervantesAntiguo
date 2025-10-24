<?
include('conexion.php');
$sql="UPDATE tbl_enlace SET url_enlace='./aula/listado_clases_alumno.php' WHERE nombre_enlace='Temario de Clase'";
$query=mysql_query($sql);

?>