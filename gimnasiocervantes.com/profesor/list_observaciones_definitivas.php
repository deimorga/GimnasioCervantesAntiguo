<?php
ini_set("memory_limit","256M");
include("../funciones/conexion.php");
include("../funciones/funciones.php");

if($_GET['elimina_recomendacion']==1){
	$elimina=delPlanGestor("tbl_recomendacion_alumno", "id_recomendacion_alumno", $_GET['id_recomendacion_alumno']);
	if($elimina){
		echo "<script>alert('Se elimino correctamente la recomendacion...');</script>";
	}else{
		echo "<script>alert('No se elimino correctamente la recomendacion...');</script>";
	}
}

$grupo=$_REQUEST['grupo'];
$periodo=$_REQUEST['periodo'];
$alumnos_curso=getAlumnosGrupo($grupo);
?>
<table border="1" cellspacing="0" cellpadding="0">
<?
for($a=0;$a<count($alumnos_curso);$a++){
?>
	  <tr style="background-color:#CCC;">
		<td style="font-size:14px; border-right:0.1mm solid #220044;" width="150px"><?=$alumnos_curso[$a]['nombre_alumno']?>
		</td>
			<td width="500px" style="border-right:0.1mm solid #220044;">PROM</td>
		  </tr>
<?	
$asignaturas=getAsignaturasGrupo($grupo,$periodo);
for($i=0;$i<count($asignaturas);$i++){
	$dato=getRecomendacionesAlumno($alumnos_curso[$a]['identificacion'], $asignaturas[$i]['id_plan_gestor']);
?>
	  <tr style="background-color:#FFF;">
		<td style="font-size:14px; border-right:0.1mm solid #220044;"><?=$asignaturas[$i]['nombre_asignatura']?>
        </td>
		<td>
        <?
        for($j=0;$j<count($dato);$j++){
			echo "*".$dato[$j]['recomendacion'];
			?>
			&nbsp;-&nbsp;<a href='#' onclick="FAjax('./profesor/list_observaciones_definitivas.php?id_recomendacion_alumno=<?=$dato[$j]['id_recomendacion_alumno']?>&elimina_recomendacion=1','div_definitivas','','post');">Eliminar</a><br />
			<?
		}
		?>
        </td>
	  </tr> 
	  <?
}
}
?>
</table>
