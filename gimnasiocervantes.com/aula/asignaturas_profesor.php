<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$_SESSION['grupo_asignatura']=NULL; 
$_SESSION['periodo_academico']=NULL;
$asignatura=getAsignaturaGrupoProfesor($_SESSION['user_id']);
?>
<h2>Listado de asignatura registradas.</h2>
<table width="670px" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>Nombre</td>
    <td>Grupo</td>
    <td>Intensidad horaria</td>
    <td width="370px">Acci&oacute;n</td>
  </tr>
<?
for($i=0;$i<count($asignatura);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$asignatura[$i]['nombre_asignatura']?></td>
    <td><?=$asignatura[$i]['nombre_grupo']?></td>
    <td><?=$asignatura[$i]['intensidad_horaria']?> HORAS</td>
    <td><? $estado_enlace=getEstadoEnlace(1); 
	if($estado_enlace['valor_estado_enlace']==1){?>
    <a href="#" onClick="FAjax('./profesor/filtro_plan_gestor.php?id_grupo_asignatura=<?=$asignatura[$i]['id_grupo_asignatura']?>&id_asignatura=<?=$asignatura[$i]['id_asignatura']?>&nuevo_plan=1','area_trabajo','','post');">Matriz Educativa2</a> | 
	<? 
	}else{ ?>
    <a href="#" onClick="alert('<?=$estado_enlace['alerta_estado_enlace']?>');return false;">Matriz Educativa2</a> | 
	<? }
	$estado_enlace2=getEstadoEnlace(2);
	if($estado_enlace2['valor_estado_enlace']==1){?>
	    <a href="#" onClick="FAjax('./profesor/filtro_calificar_plan_gestor.php?id_grupo_asignatura=<?=$asignatura[$i]['id_grupo_asignatura']?>&nuevo_plan=1','area_trabajo','','post');">Calificaciones</a> | 
        <?
	}else{?>
	    <a href="#" onClick="alert('<?=$estado_enlace2['alerta_estado_enlace']?>'); return false;">Calificaciones</a> | 
        <? 
		}
		?>
	</td>
  </tr>
<?
}
?>
</table>
