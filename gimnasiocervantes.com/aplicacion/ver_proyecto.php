<?
session_start();
include_once("../funciones/conexion.php");
include_once("../funciones/funciones.php");

$id=$_GET['id'];
$_SESSION['id_proyecto']=$id;
$galeria=getProyectoId($id);
//print_r($sitio);
?>
		<div id="content">
                    <h2><?=$galeria['proyecto']?></h2>
                    <table align="center" width="602px" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center">
                        <div id="info">
                        <? include("./informacion_proyecto.php");?>
                        </div>
                        </td>
                      </tr>
                    </table>

            
            
            
            
            
            
			
			<div class="clear"></div>
		</div>
