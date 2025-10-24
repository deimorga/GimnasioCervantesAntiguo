<?
session_start();
if($_GET['descargar_planes_gestores']==1){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=listado_planes_gestores.xls");
	header("Pragma: no-cache");
	header("Expires: 0"); 
	//echo "lololo";
}
include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$_SESSION['grupo_asignatura']=NULL;
$_SESSION['periodo_academico']=NULL;

if($_GET['nueva_busqueda']==1){
	$asignatura=NULL;	
	$_SESSION['grupo_busqueda']=NULL;
	$_SESSION['director_busqueda']=NULL;
	$_SESSION['asignatura_busqueda']=NULL;
	$_SESSION['periodo_busqueda']=NULL;
}elseif($_GET['nueva_busqueda']==2){

	if($_SESSION['periodo_busqueda']==5){
		echo "<script>FAjax('./administrativo/list_logros_final.php','area_trabajo','','post');</script>";
	}else{
$asignatura=getPlanesGestores($_SESSION['grupo_busqueda'],$_SESSION['director_busqueda'],$_SESSION['asignatura_busqueda'],$_SESSION['periodo_busqueda']);
	}
	
}else{
	$_SESSION['grupo_busqueda']=$_REQUEST['grupo'];
	$_SESSION['director_busqueda']=$_REQUEST['director'];
	$_SESSION['asignatura_busqueda']=$_REQUEST['asignatura'];
	$_SESSION['periodo_busqueda']=$_REQUEST['periodo_academico'];

	if($_SESSION['periodo_busqueda']==5){
		echo "<script>FAjax('./administrativo/list_logros_final.php','area_trabajo','','post');</script>";
	}else{
$asignatura=getPlanesGestores($_REQUEST['grupo'],$_REQUEST['director'],$_REQUEST['asignatura'],$_REQUEST['periodo_academico']);
	}
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<h2>Listado de Planes Gestores registrados.</h2>
	<div class="row">
 		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                Grupo:
                <select name="grupo" class="form-control" id="grupo" >
                	<option value="">Seleccione...</option>
<?
$grupo=getGrupos();
for($i=0;$i<count($grupo);$i++){
?>
                    <option value="<?=$grupo[$i]['id_grupo']?>" ><?=$grupo[$i]['nombre_grupo']?></option>
<?
}
?>
                </select>
        </div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		Director de grupo:
        	<select name="director" class="form-control" id="director" >
                	<option value="">Seleccione...</option>
<? 
$profesor=getProfesores();
for($i=0;$i<count($profesor);$i++){	
?>
                    <option value="<?=$profesor[$i]["id_profesor"]?>"><?=$profesor[$i]["nombre_profesor"]?></option>
<? }?>
                </select>
        </div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			Asignatura:
            <select name="asignatura" class="form-control" id="asignatura" >
                	<option value="">Seleccione...</option>
<? 
$asignatura_filtro=getAsignaturas();
for($i=0;$i<count($asignatura_filtro);$i++){	
?>
                    <option value="<?=$asignatura_filtro[$i]["id_asignatura"]?>"><?=$asignatura_filtro[$i]["nombre_asignatura"]?></option>
<? }?>
                </select>
        </div>

	</div>
    <div class="row">

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			Periodo:
                <select name="periodo_academico" class="form-control" id="periodo_academico" >
                	<option value="">Seleccione...</option>
<?
$periodo=getPeriodos2();
for($i=0;$i<count($periodo);$i++){
?>
                    <option value="<?=$periodo[$i]['id_periodo_academico']?>" ><?=$periodo[$i]['nombre_periodo_academico']?></option>
<?
}
?>
                </select>
        </div>
	</div>
    <div class="row">
		<div class="col-lg-12">
        	<input class="button_send" name="informe_alumnos" id="informe_alumnos" type="button" value="FILTRAR LISTADO" onClick="FAjax('./administrativo/list_planes_gestores_logros.php','area_trabajo','','post');">
        </div>
	</div>
	
    



<?
if($asignatura==NULL){}else{
?>
<div class="row" id="listado_logros">
<table class="table table-responsive table-hover table-bordered" style="color:#666;">
<thead>
  <tr>
    <th>Profesor</th>
    <th>Asignatura</th>
    <th>Grupo</th>
    <th>Periodo</th>
    <th>Porcentaje</th>
  </tr>
</thead>
<tbody>
<?
for($i=0;$i<count($asignatura);$i++){
	$num=$i+1;
	$campo_porcentaje="";
	$porcentaje=getPorcentajeLogrosPlanGestor($asignatura[$i]['id_plan_gestor']);
	$style_bar="progress-bar-info";
	if($porcentaje['total_porcentaje']<=40){
		$style_bar="progress-bar-danger";
	}elseif($porcentaje['total_porcentaje']>40 && $porcentaje['total_porcentaje']<100){
		$style_bar="progress-bar-warning";
	}elseif($porcentaje['total_porcentaje']==100){
		$style_bar="progress-bar-success";
	}
?>
  <tr onclick="FAjax('./administrativo/sub_list_pg_logros.php?id_pg=<?=$asignatura[$i]['id_plan_gestor']?>','sub_listt_pg_logros_<?=$asignatura[$i]['id_plan_gestor']?>','','post');">
    <td><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>&nbsp;&nbsp;<?=$num.'-'.$asignatura[$i]['nombre_profesor']?></td>
    <td><?=$asignatura[$i]['nombre_asignatura']?></td>
    <td><?=$asignatura[$i]['nombre_grupo']?></td>
    <td><?=$asignatura[$i]['id_periodo_academico']?></td>
    <td>
        <div class="progress">
          <div class="progress-bar <?=$style_bar?> progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$porcentaje['total_porcentaje']?>%">
              <span><?=$porcentaje['total_porcentaje']?>%</span>
          </div>
        </div>
    </td>
  </tr>
  <tr>
  	<td colspan="5">
    	<div id="sub_listt_pg_logros_<?=$asignatura[$i]['id_plan_gestor']?>">
		</div>
  	</td>
  </tr>
<?
}
?>
</tbody>
</table>
</div>
<div class="row">
	<input type="button" value="DESCARGAR" class="button_send" onClick="window.open('./pdf/index_logros.php');"/>
</div>
<?
}
?>