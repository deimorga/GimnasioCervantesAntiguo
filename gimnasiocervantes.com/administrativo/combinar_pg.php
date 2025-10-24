<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$asignatura=getAsignaturas();
$grupo=getGrupos();
$periodo=getPeriodos();

if($_REQUEST['actualiza_combina']==1){
	$asignatura_grupo1=getAsignaturaGrupo($_REQUEST['grupo1'],$_REQUEST['asignatura']);
	$asignatura_grupo2=getAsignaturaGrupo($_REQUEST['grupo2'],$_REQUEST['asignatura2']);
	if(!$asignatura_grupo1){
		echo "<script>alert('No se asigno la asignatura para grupo 1...');</script>";
	}else{
		if(!$asignatura_grupo2){
			echo "<script>alert('No se asigno la asignatura para grupo 2...');</script>";
		}else{
			if($_REQUEST['periodo']==5){
				$inserta=updAsignaturaGrupoFinal($asignatura_grupo1['logro_final_superior'],$asignatura_grupo1['logro_final_alto'],$asignatura_grupo1['logro_final_basico'],$asignatura_grupo1['logro_final_bajo'],$asignatura_grupo2['id_grupo_asignatura']);
				if($inserta){
					echo "<script>alert('Los datos se guardaron correctamente...');</script>";
				}else{
					echo "<script>alert('No se guardaron correctamente los datos...');</script>";
				}
				//print_r($asignatura_grupo2);
			}else{
				$plan_gestor1=getPlanGestor($asignatura_grupo1['id_grupo_asignatura'],$_REQUEST['periodo']);
				$plan_gestor2=getPlanGestor($asignatura_grupo2['id_grupo_asignatura'],$_REQUEST['periodo']);
				if(!$plan_gestor1){
					echo "<script>alert('No se ha registrado un plan gestor...');</script>";
				}else{
					$id_plan_gestor1=$plan_gestor1['id_plan_gestor'];
					if($plan_gestor2){
						$id_plan_gestor2=$plan_gestor2['id_plan_gestor'];
					}else{
						$inserta=setPlanGestor($asignatura_grupo2['id_grupo_asignatura'],$_REQUEST['periodo']);
						if($inserta){
							$id_plan_gestor2=$inserta;
						}else{
							echo "<script>alert('Problemas al generar el registro.\nComuniquese con soporte...');</script>";
						}
					}
					
					if($id_plan_gestor1 && $id_plan_gestor2){
						if($_POST['1']){
							//para unidad y competencia institucional
							$info_plan_gestor=getPlanGestorId($id_plan_gestor1);
							$inserta_info=updPlanGestor($info_plan_gestor['nombre_unidad'],$info_plan_gestor['competencia_institucional'],$id_plan_gestor2);
						}
						for($i=2;$i<=11;$i++){
							if($_POST[$i]=="logro"){
								//para los logros del pg
								//echo "vale ".$i.$_POST[$i]."<br>";
								$dato=seleccionaPlanGestor("tbl_".$_POST[$i], $id_plan_gestor1);
								delPlanGestor2("tbl_".$_POST[$i],"id_".$_POST[$i],$id_plan_gestor2);
								for($j=0;$j<count($dato);$j++){
									$inserta=insertaLogroPlanGestor("tbl_".$_POST[$i], $_POST[$i], $dato[$j][$_POST[$i]], $id_plan_gestor2,$dato[$j]["evaluacion"]);
								}
							}else{
								//para los demas componentes del pg
								//echo "vale ".$i.$_POST[$i]."<br>";
								$dato=seleccionaPlanGestor("tbl_".$_POST[$i], $id_plan_gestor1);
								delPlanGestor2("tbl_".$_POST[$i],"id_".$_POST[$i],$id_plan_gestor2);
								for($j=0;$j<count($dato);$j++){
									$inserta=insertaPlanGestor("tbl_".$_POST[$i], $_POST[$i], $dato[$j][$_POST[$i]], $id_plan_gestor2);
								}
							}
						}
					}
				}
			}
		}
	}
	
}
?>
<h2>Combinar componentes de Planes Gestor.</h2>
<table width="450px" border="0" cellspacing="15" cellpadding="0">
  <tr>
    <td>Periodo</td>
    <td><select name="periodo" class="champ2" id="periodo" >
                	<option value="">Seleccione...</option>
<?
for($i=0;$i<count($periodo);$i++){
?>
                    <option value="<?=$periodo[$i]['id_periodo_academico']?>" ><?=$periodo[$i]['nombre_periodo_academico']?></option>
<?
}
?>
                </select></td>
  </tr>
  <tr>
    <td>Asignaturao Plan Gestor diligenciado</td>
    <td><select name="asignatura" class="champ2" id="asignatura" >
                	<option value="">Seleccione...</option>
<? for($i=0;$i<count($asignatura);$i++){?>
                    <option value="<?=$asignatura[$i]["id_asignatura"]?>" ><?=$asignatura[$i]["nombre_asignatura"]?></option>
<? }?>
                </select> *</td>
  </tr>
  <tr>
    <td>Curso Plan Gestor diligenciado</td>
    <td><select name="grupo1" class="champ2" id="grupo1" >
                	<option value="">Seleccione...</option>
<? for($i=0;$i<count($grupo);$i++){?>
                    <option value="<?=$grupo[$i]["id_grupo"]?>" ><?=$grupo[$i]["nombre_grupo"]?></option>
<? }?>
                </select> *</td>
  </tr>
  <tr>
    <td>Asignatura Plan Gestor a combinar</td>
    <td><select name="asignatura2" class="champ2" id="asignatura2" >
                	<option value="">Seleccione...</option>
<? for($i=0;$i<count($asignatura);$i++){?>
                    <option value="<?=$asignatura[$i]["id_asignatura"]?>" ><?=$asignatura[$i]["nombre_asignatura"]?></option>
<? }?>
                </select> *</td>
  </tr>
  <tr>
    <td>Curso Plan Gestor a combinar</td>
    <td><select name="grupo2" class="champ2" id="grupo2" >
                	<option value="">Seleccione...</option>
<? for($i=0;$i<count($grupo);$i++){?>
                    <option value="<?=$grupo[$i]["id_grupo"]?>" ><?=$grupo[$i]["nombre_grupo"]?></option>
<? }?>
                </select> *</td>
  </tr>
  <tr>
  	<td colspan="2">Componentes a combinar:</td>
  </tr>
  <tr>
  	<td colspan="2">
    	<input name="1" type="checkbox" value="unidad"> Nombre de la unidad / Competencia Institucional<br>
    	<input name="2" type="checkbox" value="estandar"> ESTANDAR<br>
    	<input name="3" type="checkbox" value="competencia"> COMPETENCIAS<br>
    	<input name="4" type="checkbox" value="contenido"> CONTENIDOS<br>
    	<input name="5" type="checkbox" value="logro"> LOGROS<br>
    	<input name="6" type="checkbox" value="indicador_logro"> INDICADORES DE LOGRO<br>
    	<input name="7" type="checkbox" value="recurso"> RECURSOS<br>
    	<input name="8" type="checkbox" value="metodologia"> METODOLOGIA<br>
    	<input name="9" type="checkbox" value="actividad"> ACTIVIDADES<br>
    	<input name="10" type="checkbox" value="dificultad"> DIFICULTADES<br>
    	<input name="11" type="checkbox" value="biblografia"> BIBLOGRAFIA<br>
    </td>
  </tr>
  <tr>
  	<td colspan="2"><input type="hidden" name="actualiza_combina" value="0"><input class="button_send" type="button" value="COMBINAR" onClick="valida_combina_planes(this.form);"></td>
  </tr>
</table>
