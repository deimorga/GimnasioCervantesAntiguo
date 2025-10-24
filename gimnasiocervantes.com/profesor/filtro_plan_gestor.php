<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$periodo_seleccionado="";
if($_REQUEST['nuevo_plan']==1){
	$_SESSION['grupo_asignatura']=$_REQUEST['id_grupo_asignatura'];
	$_SESSION['asignatura']=$_GET['id_asignatura'];
	$_SESSION['periodo_academico']=NULL;
	$_SESSION['plan_gestor']=NULL;
}

if($_REQUEST['filtra_periodo']==1){
	if($_REQUEST['periodo_academico']==5){
		echo "<script>FAjax('./profesor/gestionar_final.php','area_trabajo','','post');</script>";
	}else{
		$_SESSION['plan_gestor']=NULL;
		$_SESSION['periodo_academico']=NULL;
		$_SESSION['periodo_academico']=$_REQUEST['periodo_academico'];
	}
}
$periodo=getPeriodos2();
$grupo_asignatura=getAsignaturaGrupoId($_SESSION['grupo_asignatura']);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div id="filtro">
    
<h2>Filtro de Periodo para Matriz Educativa<? echo $grupo_asignatura['nombre_asignatura']." - ".$grupo_asignatura['nombre_grupo'];?></h2>
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
	<input class="btn-sm btn-info" name="puente_usuario" id="puente_usuario" type="button" value="ACEPTAR" onclick="valida_seleccionar_periodo(this.form);">    
    
	</div>
    </td>
  </tr>
  <tr>
    <td><div id="gestion"><?
    if($_SESSION['grupo_asignatura']!="" && $_SESSION['periodo_academico']!=""){
		include('gestionar_plan.php');
	}
	?></div></td>
  </tr>
</table>

