<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_GET['actualiza_copia']==2){
	$msj="Está Seguro de Copiar<br>La Matriz Educativa?";
	if(!$_REQUEST['asignaturaGrupo']){
	    echo "NO SELECCIONO EL GRUPO ASIGNATURA A DONDE VA A COPIAR LA MATRIZ EDUCATIVA.";
	}else{
	    $grupoAsignatura=getAsignaturaGrupoId($_REQUEST['asignaturaGrupo']);
	    $msj.="Al Grupo/Asignatura:<br>".$grupoAsignatura['nombre_grupo']."/".$grupoAsignatura['nombre_asignatura']."?</br>";
	    echo "<strong style='color:#F00; font-size:16px;'>".$msj."<strong>";
	?>
        <input type="hidden" name="asignaturaGrupo" id="asignaturaGrupo" value="<?=$_REQUEST['asignaturaGrupo']?>" />
        <input class="button_send" type="button" value="ACEPTAR" onClick="FAjax('./profesor/copia_plan.php?actualiza_copia=1','copia_div','','post');">
	<?
	}

?>
<input class="button_send" type="button" value="CANCELAR" onClick="FAjax('./profesor/copia_plan.php','copia_div','','post');">
<?	
}elseif($_GET['actualiza_copia']==1){
	$asignatura_grupo1=getAsignaturaGrupoId($_SESSION['grupo_asignatura']);

	$asignatura_grupo2=getAsignaturaGrupoId($_REQUEST['asignaturaGrupo']);
	if(!$asignatura_grupo1){
		echo "<script>alert('No se asigno la asignatura para grupo 1...');</script>";
	}else{
		if(!$asignatura_grupo2){
			echo "<script>alert('No se asigno la asignatura para grupo 2...');</script>";
		}else{
				$plan_gestor1=getPlanGestorId($_SESSION['plan_gestor']);
				$plan_gestor2=getPlanGestor($asignatura_grupo2['id_grupo_asignatura'],$_SESSION['periodo_academico']);
				if(!$plan_gestor1){
					echo "<script>alert('No se ha registrado un plan gestor...');</script>";
				}else{
					$id_plan_gestor1=$plan_gestor1['id_plan_gestor'];
					if($plan_gestor2){
						$id_plan_gestor2=$plan_gestor2['id_plan_gestor'];
					}else{
						$inserta=setPlanGestor($asignatura_grupo2['id_grupo_asignatura'],$_SESSION['periodo_academico']);
						if($inserta){
							$id_plan_gestor2=$inserta;
						}else{
							echo "<script>alert('Problemas al generar el registro.\nComuniquese con soporte...');</script>";
						}
					}
					
					if($id_plan_gestor1 && $id_plan_gestor2){



								//para los logros del pg
								$copiadoVal=true;
								$dato=seleccionaLogrosPlanGestor("logro", $id_plan_gestor1);
								$dato2=seleccionaLogrosPlanGestor("logro", $id_plan_gestor2);

								if($dato2){
									//die("existen");
									$borrado=delPlanGestor("tbl_logro","id_logro",$id_plan_gestor2);
									if($borrado){
										for($j=0;$j<count($dato);$j++){
											$inserta=insertaLogroPlanGestor("tbl_logro", "logro", $dato[$j]['logro'], $id_plan_gestor2);
											if(!$inserta){
												$copiadoVal=false;
											}
										}
									}else{
										echo "<script>alert('No se Copiaron las actividades pues ya el sistema registra notas para actividades de esta semana.\nDebe hacerlo desde la respectiva matriz educativa...');</script>";
									}
								
								}else{
									//die("No existen");
										for($j=0;$j<count($dato);$j++){
											$inserta=insertaLogroPlanGestor("tbl_logro", "logro", $dato[$j]['logro'], $id_plan_gestor2, $dato[$j]['evaluacion']);
											if(!$inserta){
												$copiadoVal=false;
											}
								}
							}
							if($copiadoVal==true){
								echo "<script>alert('Actividades Copiadas Satisfactoriamente...');</script>";
							}else{
								echo "<script>alert('Problemas con el registro de Actividades...');</script>";
							}


							//para los demas componentes del pg
							$arreglo_recorrer=array("estandar","competencia","contenido","indicador_logro","recurso","actividad");
							foreach($arreglo_recorrer as $campo){
								$dato=seleccionaPlanGestor("tbl_".$campo, $id_plan_gestor1);
								//print_r($dato);
								delPlanGestor2("tbl_".$campo,"id_".$campo,$id_plan_gestor2);
								for($j=0;$j<count($dato);$j++){
									$inserta=insertaPlanGestor("tbl_".$campo, $campo, $dato[$j][$campo], $id_plan_gestor2, $dato[$j]['id_semana']);
								}
							}//die();
							echo "<script>alert('Parcelador Copiado Satisfactoriamente...');</script>";
					}
				}
		}
	}
	
	echo "<script>FAjax('./profesor/copia_plan.php','copia_div','','post');</script>";
}else{
?>
<h2>Copiar esta matriz Educatíva a:</h2>
<table width="450px" border="0" cellspacing="15" cellpadding="0">
  <tr>
    <td>Grupo-Asignatura:</td>
    <td><select name="asignaturaGrupo" class="champ2" id="asignaturaGrupo" >
                	<option value="">Seleccione...</option>
<?
$asignatura=getAsignaturaGrupoProfesor($_SESSION['user_id']);
for($i=0;$i<count($asignatura);$i++){
?>
                    <option value="<?=$asignatura[$i]['id_grupo_asignatura']?>" <? if($asignatura[$i]['id_grupo_asignatura']==$_SESSION['grupo_asignatura']){ echo "disabled";}?>><?=$asignatura[$i]['nombre_grupo']?> - <?=$asignatura[$i]['nombre_asignatura']?></option>
<?
}
?>
                </select></td>
  </tr>
  <tr>
  	<td colspan="2">Componentes a combinar:</td>
  </tr>
  <tr>
  	<td colspan="2">
    	<input name="1" type="checkbox" value="logro"> - Actividades<br />
    	<input name="2" type="checkbox" value="parcelador"> - Parcelador
    </td>
  </tr>
  <tr>
  	<td colspan="2"><input class="button_send" type="button" value="COPIAR" onClick="FAjax('./profesor/copia_plan.php?actualiza_copia=2','copia_div','','post');"></td>
  </tr>
</table>
<?
}
?>