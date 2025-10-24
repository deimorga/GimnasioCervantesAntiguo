<?php
session_start();

$_SESSION['alumno']=$_REQUEST['id_alumno'];
$_SESSION['anio']=$_REQUEST['anio'];

echo "<script>window.open('./pdf/index_sin_arte_certificado_alumno2.php');</script>";
?>