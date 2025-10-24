<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_GET['descargar_plan_gestor']==1){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=plan_gestor_".$_SESSION['plan_gestor'].".xls");
	header("Pragma: no-cache");
	header("Expires: 0"); 
	//echo "lololo";
}

if($_GET['id_plan_gestor']){
	$_SESSION['plan_gestor']=$_GET['id_plan_gestor'];
}

$plan_gestor=getPlanGestorId($_SESSION['plan_gestor']);
$dato1=seleccionaPlanGestor("tbl_actividad", $_SESSION['plan_gestor']);
$dato2=seleccionaPlanGestor("tbl_competencia", $_SESSION['plan_gestor']);
$dato3=seleccionaPlanGestor("tbl_logro", $_SESSION['plan_gestor']);
$dato4=seleccionaPlanGestor("tbl_indicador_logro", $_SESSION['plan_gestor']);
$dato5=seleccionaPlanGestor("tbl_estandar", $_SESSION['plan_gestor']);
$dato6=seleccionaPlanGestor("tbl_contenido", $_SESSION['plan_gestor']);
$dato7=seleccionaPlanGestor("tbl_recurso", $_SESSION['plan_gestor']);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="8"><div id="info">
    	<table width="100%" border="1" cellspacing="0" cellpadding="0">
          <tr bgcolor="#CCCCCC">
            <td colspan="4" width="50%">PLAN GESTOR PERIODO: <?=$plan_gestor['id_periodo_academico']?></td>
            <td colspan="4">GRUPO: <?=$plan_gestor['nombre_grupo']?></td>
          </tr>
          <tr bgcolor="#CCCCCC">
            <td colspan="8" align="center">"Seres aprendientes intrapersonales e interpersonales para construir la sociedad del siglo XXI"</td>
          </tr>
          <tr>
            <td colspan="4">DOCENTE: <?=$plan_gestor['nombre_profesor']?></td>
            <td colspan="4">ESPACIO ACADEMICO: <?=$plan_gestor['nombre_asignatura']?></td>
          </tr>
        </table>

    </div></td>
  </tr>
  <tr colspan="8" bgcolor="#CCCCCC">
    <td valign="top" width="200px">COMPONENTS(Componentes).</td>
  </tr>
  <tr>
    <td valign="top" colspan="8">
            <strong>
			<?
            for($i=0;$i<count($dato1);$i++){
				echo "* ".$dato1[$i]['actividad']; ?><br>
			<?
			}
			?>
            </strong>
    </td>
  </tr>
  <tr colspan="8" bgcolor="#CCCCCC">
    <td valign="top" width="200px">Competences(Competencias).</td>
  </tr>
    <td valign="top" colspan="8">
            <strong>
			<?
            for($i=0;$i<count($dato2);$i++){
				echo "* ".$dato2[$i]['competencia']; ?><br>
			<?
			}
			?>
            </strong>
    </td>
  </tr>
  <tr colspan="8" bgcolor="#CCCCCC">
    <td valign="top" width="200px">APRENDIZAJE(Logros).</td>
  </tr>
    <td valign="top" colspan="8">
            <strong>
			<?
            for($i=0;$i<count($dato3);$i++){
				echo "* ".$dato3[$i]['logro']; ?><br>
			<?
			}
			?>
            </strong>
    </td>
  </tr>
  <tr colspan="8" bgcolor="#CCCCCC">
    <td valign="top" width="200px">Evidence of learning(Evidencias de aprendizaje).</td>
  </tr>
    <td valign="top" colspan="8">
            <strong>
			<?
            for($i=0;$i<count($dato4);$i++){
				echo "* ".$dato4[$i]['indicador_logro'];?><br>
			<?
			}
			?>
            </strong>
    </td>
  </tr>
  <tr colspan="8" bgcolor="#CCCCCC">
    <td valign="top" width="200px">EJES(AXES).</td>
  </tr>
    <td valign="top" colspan="8">
            <strong>
			<?
            for($i=0;$i<count($dato5);$i++){
				echo "* ".$dato5[$i]['estandar']; ?><br>
			<?
			}
			?>
            </strong>
    </td>
  </tr>
  <tr colspan="8" bgcolor="#CCCCCC">
    <td valign="top" width="200px">Contents(contenido).</td>
  </tr>
    <td valign="top" colspan="8">
            <strong>
			<?
            for($i=0;$i<count($dato6);$i++){
				echo "* ".$dato6[$i]['contenido']; ?><br>
			<?
			}
			?>
            </strong>
    </td>
  </tr>
  <tr colspan="8" bgcolor="#CCCCCC">
    <td valign="top" width="200px">HABILIDADES(ABILITIES).</td>
  </tr>
    <td valign="top" colspan="8">
            <strong>
			<?
            for($i=0;$i<count($dato7);$i++){
				echo "* ".$dato7[$i]['recurso']; ?><br>
			<?
			}
			?>
            </strong>
    </td>
</table>
<?
if($_GET['descargar_plan_gestor']==1){
	echo "<script>window.close();</script>";
}else{
?>
<input type="button" id="cerrar" onClick="window.close();" value="CERRAR VENTANA">
<?
}
?>