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

$asignatura=getPlanesGestores($_SESSION['grupo_busqueda'],$_SESSION['director_busqueda'],$_SESSION['asignatura_busqueda'],$_SESSION['periodo_busqueda']);
	
}else{
	$_SESSION['grupo_busqueda']=$_REQUEST['grupo'];
	$_SESSION['director_busqueda']=$_REQUEST['director'];
	$_SESSION['asignatura_busqueda']=$_REQUEST['asignatura'];
	$_SESSION['periodo_busqueda']=$_REQUEST['periodo_academico'];

$asignatura=getPlanesGestores($_REQUEST['grupo'],$_REQUEST['director'],$_REQUEST['asignatura'],$_REQUEST['periodo_academico']);
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
        	<input class="button_send" name="informe_alumnos" id="informe_alumnos" type="button" value="FILTRAR LISTADO" onClick="FAjax('./administrativo/list_calificaciones_graph.php','area_trabajo','','post');">
        </div>
	</div>
	
    



<?
if($grupo==NULL){}else{
?>
<div class="row" id="listado_logros">
<?
for($i=0;$i<count($asignatura);$i++){
	$numDA=0;
	$numDS=0;
	$numDBS=0;
	$numDb=0;
	$arrayDesempenios=getCountDesempaniosGrupoAsignatura($_SESSION['grupo_busqueda'],$_SESSION['periodo_busqueda'],$asignatura[$i]['id_asignatura']);
	//print_r($arrayDesempenios);
}
?>
<iframe scrolling="auto" src=".//vendor/amcharts/examples/javascript/stacked-3D-column-chart/index.html" frameborder="0" height="500" width="100%"></iframe></div>
<div class="row">
	<input type="button" value="DESCARGAR" class="button_send" onClick="window.open('./pdf/index_logros.php');"/>
</div>
<?
}
?>