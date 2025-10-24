<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$campo="";
$campo_porcentaje="";
$porcentaje=getPorcentajeLogrosPlanGestor($_SESSION['plan_gestor']);
$style_bar="progress-bar-info";

if($_GET['elimina_logro']==1){
	$elimina=delPlanGestor("tbl_logro", "id_logro", $_GET['id_logro']);
	$porcentaje=getPorcentajeLogrosPlanGestor($_SESSION['plan_gestor']);
	if($elimina){
		echo "<script>alert('Se elimino correctamente el logro...');</script>";
	}else{
		echo "<script>alert('No se elimino correctamente el logro, posiblemente ya existen calificaciones del mismo...');</script>";
	}
}

if($_POST['actualiza_logro']==1){
	$total=$porcentaje['total_porcentaje']+$_REQUEST['porcentaje_logro'];
	if($total>100){
		echo "<script>alert('La sumatoria de los porcentajes no puede superar 100 y en este caso son ".$total.", valida la informacion...');</script>";
		$campo=$_REQUEST['descripcion_logro'];
		$campo_porcentaje=$_REQUEST['porcentaje_logro'];
	}else{
		$inserta=setLogro($_REQUEST['descripcion_logro'],$_REQUEST['porcentaje_logro'], $_SESSION['plan_gestor']);
		if($inserta){
			$porcentaje=getPorcentajeLogrosPlanGestor($_SESSION['plan_gestor']);
			echo "<script>alert('Los datos se guardaron correctamente...');</script>";
		}else{
			echo "<script>alert('No se guardaron correctamente los datos...');</script>";
		}
	}
}

if($_GET['edita_logro']==1){
	$edita=seleccionaPlanGestorId("tbl_logro", "id_logro", $_GET['id_logro']);
	if($edita){
		$id_campo=$_GET['id_logro'];
		$campo=$edita['logro'];
		$campo_porcentaje=$edita['porcentaje'];
		//echo $campo;
		?><input type="hidden" name="id_old" id="id_old" value="<?=$id_campo?>" /><?
	}else{
		echo "<script>alert('Problemas al buscar el estandar a editar...');</script>";
	}
}

if($_POST['actualiza_edita_logro']==1){

	$logro_data=getLogroId($_REQUEST['id_old']);
	$total=$porcentaje['total_porcentaje']-$logro_data['porcentaje']+$_REQUEST['porcentaje_logro'];
	if($total>100){
		$_GET['edita_logro']=1;
		$campo=$_REQUEST['descripcion_logro'];
		$id_campo=$_REQUEST['id_old'];
		$campo_porcentaje=$_REQUEST['porcentaje_logro'];
		echo "<script>alert('La sumatoria de los porcentajes no puede superar 100 y en este caso son ".$total.", valida la informacion...');</script>";
		?>
        <input type="hidden" name="id_old" id="id_old" value="<?=$id_campo?>" />			
		<?
	}else{
		$inserta=actualizaLogro($_REQUEST['descripcion_logro'],$_REQUEST['porcentaje_logro'], $_REQUEST['id_old']);
		if($inserta){
			$porcentaje=getPorcentajeLogrosPlanGestor($_SESSION['plan_gestor']);
			echo "<script>alert('Los datos se guardaron correctamente...');</script>";
		}else{
			echo "<script>alert('No se guardaron correctamente los datos...');</script>";
		}
	}
}

$dato=seleccionaPlanGestor("tbl_logro", $_SESSION['plan_gestor']);

if($porcentaje['total_porcentaje']<=40){
	$style_bar="progress-bar-danger";
}elseif($porcentaje['total_porcentaje']>40 && $porcentaje['total_porcentaje']<100){
	$style_bar="progress-bar-warning";
}elseif($porcentaje['total_porcentaje']==100){
	$style_bar="progress-bar-success";
}

?>
<h3>APRENDIZAJE(Logros).</h3>
<div class="progress">
  <div class="progress-bar <?=$style_bar?> progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=$porcentaje['total_porcentaje']?>%">
	  <span><?=$porcentaje['total_porcentaje']?>% Complete</span>
  </div>
</div>
<div class="row">
	<div class="col-lg-9 col-md-8 col-sm-6 col-xs-12">
        Descripcion:*
        <textarea class="form-control" name="descripcion_logro" id="descripcion_logro"><?=$campo?></textarea>
    </div>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        Porcentaje(%):*
        <input type="number" class="form-control" name="porcentaje_logro" id="porcentajes_logro" value="<?=$campo_porcentaje?>"  />
    </div>
</div>
<div class="row">
	<div class="col-xs-12">
<?
if($_GET['edita_logro']==1){
?>
              <input name="actualiza_edita_logro" id="actualiza_edita_logro" type="hidden" value="0" />
              <input class="button_send" name="edita_logro" id="edita_logro" type="button" value="ACTUALIZAR DATOS" onclick="valida_edita_logro(this.form);" />
              <?
}else{
?>
              <input name="actualiza_logro" id="actualiza_logro" type="hidden" value="0" />
              <input class="button_send" name="ingreso_logro" id="ingreso_logro" type="button" value="GUARDAR DATOS" onclick="valida_guardar_logro(this.form);" />
              <?
}
?>
	</div>
</div>

<table class="table table-responsive table-hover table-bordered" style="color:#666;">
<thead>
    <th>Cod.</th>
    <th>Descripcion</th>
    <th>Porcentaje(%)</th>
    <th>Acci&oacute;n</th>
</thead>
<tbody>            
<?
for($i=0;$i<count($dato);$i++){
?>
	<tr>
    	<td><?=$dato[$i]['id_logro']?></td>
    	<td><?=$dato[$i]['logro']?></td>
    	<td><?=$dato[$i]['porcentaje']?></td>
    	<td>
            <div class="dropdown">
              <button class="btn-sm btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Acciones
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<li><a href='#' onclick="FAjax('./profesor/logro.php?id_logro=<?=$dato[$i]['id_logro']?>&elimina_logro=1','logro_div','','post');">eliminar</a>
                </li>
                <li><a href='#' onclick="FAjax('./profesor/logro.php?id_logro=<?=$dato[$i]['id_logro']?>&edita_logro=1&descripcion=<?=$dato[$i]['logro']?>','logro_div','','post');">editar</a>
                </li>
              </ul>
            </div>
		</td>
	</tr>
<?	
}
?>
</tbody>
</table>
<?
if($_GET['edita_logro']==1){
	echo "<script>form.descripcion_logro.focus();</script>";
}
?>
