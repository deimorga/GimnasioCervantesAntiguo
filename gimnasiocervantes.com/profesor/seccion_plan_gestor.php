<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$campo="";

if($_GET['elimina_seccion']==1){
	$elimina=delDatoSeccionPlanGestor($_GET['id_seccion']);
	if($elimina){
		echo "<script>alert('Se elimino correctamente la información...');</script>";
	}else{
		echo "<script>alert('No se elimino correctamente la información...');</script>";
	}
}

if($_POST['actualiza_seccion']==1){

	$inserta=setDatoSeccionPlanGestor($_REQUEST['seccion_plan_gestor'], $_REQUEST['descripcion_seccion'], $_SESSION['plan_gestor'],$_SESSION["user_id"]);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if($_GET['edita_seccion']==1){
	$edita=getDatoSeccionPlanGestorId($_GET['id_seccion']);
	if($edita){
		$id_campo=$_GET['id_seccion'];
		$campo=$edita['descripcion_dato_seccion_plan_gestor'];
		$seccion=$edita['id_seccion_plan_gestor'];
		?><input type="hidden" name="id_old" id="id_old" value="<?=$id_campo?>" /><?
	}else{
		echo "<script>alert('Problemas al buscar el estandar a editar...');</script>";
	}
}

if($_POST['actualiza_edita_seccion']==1){

	$inserta=actualizaDatoSeccionPlanGestor($_REQUEST['descripcion_seccion'], $_REQUEST['id_old']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

$seccionesPlanGestor=getSeccionesPlanGestor();
$countSecciones=count($seccionesPlanGestor);
?>
<h4>Registro de información.</h4>
<div class="row">
	<div class="col-sm-6 col-xs-12">
		Descripcion:* <textarea class="form-control" name="descripcion_seccion" id="descripcion_seccion"><?=$campo?></textarea>
    </div>
	<div class="col-sm-6 col-xs-12">
        Seccion Plan Gestor:*
        <select name="seccion_plan_gestor" class="form-control" id="seccion_plan_gestor" <? if($_GET['edita_seccion']==1){ echo "disabled='disabled'";}?>>
            <option value="">Seleccione...</option>
    <?
    for($i=0;$i<$countSecciones;$i++){
    ?>
            <option value="<?=$seccionesPlanGestor[$i]['id_seccion_plan_gestor']?>" <? if($seccion==$seccionesPlanGestor[$i]['id_seccion_plan_gestor']){ echo "selected='selected'";}?>><?=$seccionesPlanGestor[$i]['nombre_seccion_plan_gestor']?></option>
    <?
    }
    ?>
        </select>
    </div>
</div>
<div class="row">
<?
if($_GET['edita_seccion']==1){
?>
    <input name="actualiza_edita_seccion" id="actualiza_edita_seccion" type="hidden" value="0">
    <input class="button_send" name="edita_seccion" id="edita_seccion" type="button" value="ACTUALIZAR DATOS" onClick="valida_edita_seccion(this.form);">
<?
}else{
?>
    <input name="actualiza_seccion" id="actualiza_seccion" type="hidden" value="0">
    <input class="button_send" name="ingreso_seccion" id="ingreso_seccion" type="button" value="GUARDAR DATOS" onClick="valida_guardar_seccion(this.form);">
<?
}
?>                
</div>
<?
for($j=0;$j<$countSecciones;$j++){
$dato=getDatosSeccionPlanGestor($seccionesPlanGestor[$j]['id_seccion_plan_gestor'], $_SESSION['plan_gestor']);
$countDato=count($dato);
?>
<h5><?=$seccionesPlanGestor[$j]['nombre_seccion_plan_gestor']?></h5>
<table class="table table-responsive table-hover table-bordered" style="color:#666;">
<thead>
    <th>Cod.</th>
    <th>Descripcion</th>
    <th>Acci&oacute;n</th>
</thead>
<tbody>            
<?
if($countDato<1){
?>
  <tr>
    <td colspan="3" align="center">NO HAY DATOS REGISTRADOS</td>
  </tr>
<?
}else{
for($a=0;$a<$countDato;$a++){
?>
	<tr>
    	<td><?=$dato[$a]['id_dato_seccion_plan_gestor']?></td>
    	<td><?=$dato[$a]['descripcion_dato_seccion_plan_gestor']?></td>
    	<td>
            <div class="dropdown">
              <button class="btn-sm btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Acciones
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<li><a href='#seccion_div' onclick="FAjax('./profesor/seccion_plan_gestor.php?id_seccion=<?=$dato[$a]['id_dato_seccion_plan_gestor']?>&elimina_seccion=1','seccion_div','','post');">eliminar</a>
                </li>
                <li><a href='#seccion_div' onclick="FAjax('./profesor/seccion_plan_gestor.php?id_seccion=<?=$dato[$a]['id_dato_seccion_plan_gestor']?>&edita_seccion=1','seccion_div','','post');">editar</a>
                </li>
              </ul>
            </div>
        
        
		</td>
	</tr>
<?
}
}
?>
</tbody>
</table>
<?
}
if($_GET['edita_seccion']==1){
	echo "<script>form.descripcion_seccion.focus();</script>";
}
?>
