<?php
ini_set("memory_limit","256M");
include("../funciones/conexion.php");
include("../funciones/funciones.php");
//echo $_REQUEST['grupo'];
$alumnos_curso=getAlumnosGrupo($_REQUEST['grupo']);
?>
<table border="1" cellspacing="0" cellpadding="0">
<?
for($a=0;$a<count($alumnos_curso);$a++){
?>
	  <tr style="background-color:#CCC;">
		<td style="font-size:14px; border-right:0.1mm solid #220044;"><?=$alumnos_curso[$a]['nombre_alumno']?>
		</td>
			<td width="39px" style="border-right:0.1mm solid #220044;">P1</td>
			<td width="39px" style="border-right:0.1mm solid #220044;">P2</td>
			<td width="39px" style="border-right:0.1mm solid #220044;">P3</td>
			<td width="39px" style="border-right:0.1mm solid #220044;">P4</td>
			<td width="50px" style="border-right:0.1mm solid #220044;">PROM</td>
		  </tr>
<?	
$alumno=getAlumnoBoletinId($alumnos_curso[$a]['identificacion']);
$asignaturas=getAsignaturasGrupo($alumno['id_grupo'],1);
$asignaturas2=getAsignaturasGrupo($alumno['id_grupo'],2);
$asignaturas3=getAsignaturasGrupo($alumno['id_grupo'],3);
$asignaturas4=getAsignaturasGrupo($alumno['id_grupo'],4);
//print_r($asignaturas);
for($i=0;$i<count($asignaturas);$i++){
	$suma=0;
	$cont=0;
	$prom=0;
	$p1=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],1);
	$p2=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],2);
	$p3=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],3);
	$p4=getCalificacionAsignatura($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],4);
	//$p5=getCalificacionAsignaturaFinal($asignaturas[$i]['id_asignatura'],$alumno['identificacion'],2015);
	if($p1){
		$suma=$suma+$p1['calificacion_asignatura'];
		$cont=$cont+1;
	}
	if($p2){
		$suma=$suma+$p2['calificacion_asignatura'];
		$cont=$cont+1;
	}
	if($p3){
		$suma=$suma+$p3['calificacion_asignatura'];
		$cont=$cont+1;
	}
	if($p4){
		$suma=$suma+$p4['calificacion_asignatura'];
		$cont=$cont+1;
	}
	if($suma!=0 && $cont!=0){
		$prom=$suma/$cont;
	}

?>
	  <tr <? if(redondear($prom)<3.7){?>style="background-color:#FF0"<? }else{?>style="background-color:#FFF;"<? }?>>
		<td style="font-size:14px; border-right:0.1mm solid #220044;"><?=$asignaturas[$i]['nombre_asignatura']?>
		</td>
		<td width="70px" style="border-right:0.1mm solid #220044;"><a href="#" onclick="FAjax('./profesor/ver_nota_plan_gestor.php?identificacion=<?=$alumno['identificacion']?>&asignatura=<?=$asignaturas[$i]['id_asignatura']?>$periodo_academico=1&plan_gestor=<?=$asignaturas[$i]['id_plan_gestor']?>','area_trabajo','','post');"><?=$p1['desempenio_asignatura']." ".$p1['calificacion_asignatura']?></a></td>
		<td width="70px" style="border-right:0.1mm solid #220044;"><a href="#" onclick="FAjax('./profesor/ver_nota_plan_gestor.php?identificacion=<?=$alumno['identificacion']?>&asignatura=<?=$asignaturas[$i]['id_asignatura']?>$periodo_academico=2&plan_gestor=<?=$asignaturas2[$i]['id_plan_gestor']?>','area_trabajo','','post');"><?=$p2['desempenio_asignatura']." - ".$p2['calificacion_asignatura']?></a></td>
		<td width="70px" style="border-right:0.1mm solid #220044;"><a href="#" onclick="FAjax('./profesor/ver_nota_plan_gestor.php?identificacion=<?=$alumno['identificacion']?>&asignatura=<?=$asignaturas[$i]['id_asignatura']?>$periodo_academico=2&plan_gestor=<?=$asignaturas3[$i]['id_plan_gestor']?>','area_trabajo','','post');"><?=$p3['desempenio_asignatura']." - ".$p3['calificacion_asignatura']?></a></td>
		<td width="70px" style="border-right:0.1mm solid #220044;"><a href="#" onclick="FAjax('./profesor/ver_nota_plan_gestor.php?identificacion=<?=$alumno['identificacion']?>&asignatura=<?=$asignaturas[$i]['id_asignatura']?>$periodo_academico=2&plan_gestor=<?=$asignaturas4[$i]['id_plan_gestor']?>','area_trabajo','','post');"><?=$p4['desempenio_asignatura']." - ".$p4['calificacion_asignatura']?></a></td>
		<td><? echo redondear($prom);?></td>
	  </tr> 
	  <?
	$dato=seleccionaPlanGestor("tbl_logro", $asignaturas[$i]['id_plan_gestor']);
}
}
?>
</table>
