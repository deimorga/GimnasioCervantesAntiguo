<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if(updValorPension($_POST['valor_facturar'],$_SESSION['alumno_pago'])){
echo "Actualizado.";	
}