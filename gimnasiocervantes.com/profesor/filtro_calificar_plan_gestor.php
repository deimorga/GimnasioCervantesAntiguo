<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$periodo_seleccionado="";
if($_REQUEST['nuevo_plan']==1){
	$_SESSION['grupo_asignatura']=$_REQUEST['id_grupo_asignatura'];
	$_SESSION['periodo_academico']="";
	$_SESSION['action']=NULL;
	$grupo_asignatura=getAsignaturaGrupoId($_SESSION['grupo_asignatura']);
	$_SESSION['grupo']=$grupo_asignatura['id_grupo'];
	$_SESSION['asignatura']=$grupo_asignatura['id_asignatura'];
	$_SESSION['tipo_asignatura']=$grupo_asignatura['tipo_asignatura'];
}

if($_REQUEST['filtra_periodo']!=0){
	$_SESSION['periodo_academico']=$_REQUEST['periodo_academico'];
	$_SESSION['action']=$_REQUEST['filtra_periodo'];
}
$grupo_asignatura=getAsignaturaGrupoId($_SESSION['grupo_asignatura']);
$periodo=getPeriodos();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div id="filtro">
    
<h2>Filtro de Periodo para calificaciones <? echo $grupo_asignatura['nombre_asignatura']." - ".$grupo_asignatura['nombre_grupo'];?></h2>
	<fieldset>
		<legend class="texte_legende">Periodo academico</legend>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td class="texte">Periodo:</td>
				<td>
                
                <select name="periodo_academico" class="champ2" id="periodo_academico" >
                	<option value="">Seleccione...</option>
<?
for($i=0;$i<count($periodo);$i++){
?>
                    <option value="<?=$periodo[$i]['id_periodo_academico']?>" <? if($_SESSION['periodo_academico']==$periodo[$i]['id_periodo_academico']){ echo "selected='selected'";}?>><?=$periodo[$i]['nombre_periodo_academico']?></option>
<?
}
?>
                </select>
                
                </td>
			</tr>
		</table>
	</fieldset>
    <input name="filtra_periodo" id="filtra_periodo" type="hidden" value="0">
	<input class="button_send" name="puente_usuario" id="puente_usuario" type="button" value="CALIFICAR" onclick="valida_seleccionar_periodo_calificaciones(this.form);">&nbsp;&nbsp;&nbsp;
	<input class="button_send" name="consolidado" id="consolidado" type="button" value="CONSOLIDADO" onclick="valida_seleccionar_periodo_consolidado(this.form);">&nbsp;&nbsp;&nbsp;
    <input class="button_send" name="califica_recomendaciones" id="califica_recomendaciones" type="button" value="GESTIONAR RECOMENDACIONES" onclick="valida_seleccionar_periodo_recomendaciones(this.form);"><br />
    <input class="button_send" name="califica_pendientes" id="califica_pendientes" type="button" value="GESTIONAR DESEMPEÑOS PENDIENTES" onclick="FAjax('./profesor/list_perdidos_grupo.php','area_trabajo','','post');">   
    
	</div>
    </td>
  </tr>
  <tr>
    <td><div id="gestion"><?
    if($_SESSION['grupo_asignatura']!="" && $_SESSION['periodo_academico']!=""){
		if($_SESSION['action']==1){
			if($_SESSION['periodo_academico']==5){
				include('calificar_plan_final.php');
			}else{
				include('calificar_plan.php');
			}
		}elseif($_SESSION['action']==2){
			if($_SESSION['periodo_academico']==5){
				echo "<script>alert('No se ha definido pra este periodo...');</script>";
			}else{
				include('recomendaciones_grupo.php');
			}
		}elseif($_SESSION['action']==3){
			if($_SESSION['periodo_academico']==5){
				echo "<script>alert('No se ha definido pra este periodo...');</script>";
			}else{
				include('calificar_plan_consolidado.php');
			}
		}
	}
	?></div></td>
  </tr>
</table>