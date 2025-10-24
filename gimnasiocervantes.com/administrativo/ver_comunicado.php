<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$accion="./principal_aulas.php";
$circular=getComunicadoId($_GET['id']);

if(isset($_SESSION['esturiante_matriculado'])){
$accion="./principal_usuario.php";
}
?>
<table border="0" cellspacing="20" cellpadding="0">
	<tr>
    	<td class="left_table_al">
        	<a href="#area_trabajo_alumno" onclick="FAjax('<?=$accion?>','area_trabajo_alumno','','post');">
            <?	if(file_exists("../iconos/23.png")){
			?><img src="./iconos/23.png" width="180" height="165" /><?
			}else{ 
			?><img src="./iconos/default.png" width="180" height="165" /><?
			}
			?><br />Menu Principal</a>
    	</td>
    	<td class="left_table_al">
        	<a href="#area_trabajo_alumno" onclick="FAjax('./cerrar_session.php','area_trabajo_alumno','','post');">
            <?	if(file_exists("../iconos/46.png")){
			?><img src="./iconos/46.png" width="180" height="165" /><?
			}else{ 
			?><img src="./iconos/default.png" width="180" height="165" /><?
			}
			?><br />Cerrar Sesion</a>
    	</td>
	</tr>
</table>
<table width="600" align="center" border="0" cellspacing="10" cellpadding="0" bgcolor="#FFFFFF" style="color:#000;">
  <tr>
    <td><img src="./pdf/header_boletin.jpg" width="600" height="111"></td>
  </tr>
  <tr>
    <td>
    <br>
    Bogotá, <?=$circular['fecha']?>
    <br>
    <br>
    <br>
    Colegio Gimnasio Cervantes - Facatativ&aacute; - Colombia
    <br>
    <br>
    <br>
    <?=$circular['asunto']?>:
    <br>
    <br>
    <p style="color:#000; font-size:12px;"><?=nl2br($circular['comunicado'])?></p>
    <br>
    </td>
  </tr>
</table>
