<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$_SESSION['grupo_asignatura']=NULL; 
$_SESSION['periodo_academico']=NULL;
$asignatura=getAsignaturaGrupoProfesor($_SESSION['user_id']);
?>
<h2>Listado de asignatura registradas.</h2>
<table class="table table-responsive table-hover table-bordered" style="color:#666;">
<thead>
    <th>Acci&oacute;n</th>
    <th>Nombre</th>
    <th>Grupo</th>
    <th>Intensidad horaria</th>
</thead>
<tbody>
<?
for($i=0;$i<count($asignatura);$i++){
?>
  <tr>
  	<td>
            <div class="dropdown">
              <button class="btn-sm btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Acciones
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              
				<? 
                $estado_enlace=getEstadoEnlace(1); 
                if($estado_enlace['valor_estado_enlace']==1){?>
                <li><a href="#" onClick="FAjax('./profesor/filtro_plan_gestor.php?id_grupo_asignatura=<?=$asignatura[$i]['id_grupo_asignatura']?>&id_asignatura=<?=$asignatura[$i]['id_asignatura']?>&nuevo_plan=1','area_trabajo','','post');">Matriz Educativa</a></li>
                            <li role="separator" class="divider"></li>
                <? 
                }else{ ?>
                <li><a href="#" onClick="alert('<?=$estado_enlace['alerta_estado_enlace']?>');return false;">Matriz Educativa</a></li>
                            <li role="separator" class="divider"></li>
                <? }
                $estado_enlace2=getEstadoEnlace(2);
                if($estado_enlace2['valor_estado_enlace']==1){?>
                    <li><a href="#" onClick="FAjax('./profesor/filtro_calificar_plan_gestor.php?id_grupo_asignatura=<?=$asignatura[$i]['id_grupo_asignatura']?>&nuevo_plan=1','area_trabajo','','post');">Calificaciones</a></li>
                            <li role="separator" class="divider"></li>
                    <?
                }else{?>
                    <li><a href="#" onClick="alert('<?=$estado_enlace2['alerta_estado_enlace']?>'); return false;">Calificaciones</a> </li>
                            <li role="separator" class="divider"></li>
                    <? 
                    }
                    ?>
                <li><a href="#" onClick="FAjax('./profesor/filtro_planilla.php?id_grupo_asignatura=<?=$asignatura[$i]['id_grupo_asignatura']?>&id_asignatura=<?=$asignatura[$i]['id_asignatura']?>&nueva_planilla=1','area_trabajo','','post');">Planilla</a> </li>
                <li role="separator" class="divider"></li>             
              
              </ul>
            </div>
    </td>
    <td><?=$asignatura[$i]['nombre_asignatura']?></td>
    <td><?=$asignatura[$i]['nombre_grupo']?></td>
    <td><?=$asignatura[$i]['intensidad_horaria']?> HORAS</td>
  </tr>
<?
}
?>
</tbody>
</table>
