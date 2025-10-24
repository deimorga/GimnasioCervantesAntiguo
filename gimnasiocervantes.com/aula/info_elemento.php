<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_REQUEST["actualiza_grupo_clase"]==1){
	//echo $_REQUEST["grupo_asignatura"]."ENTRO!!!".$_SESSION['id_actividad_aula'];
	$fecha=NULL;
	if($_SESSION['tipo_actividad_aula']==2){
		$fecha=$_REQUEST['fechaini'];
	}else{
		$fecha="0000-00-00";
	}
	$guarda_grupo=setAsignaturaGrupoActividad($_REQUEST["grupo_asignatura"],$_SESSION['id_actividad_aula'],$fecha);
	if($guarda_grupo){
		echo "<script>alert('Los datos se guardaron satisfactoriamente...');</script>";
	}else{
		echo "<script>alert('Los datos NO se guardaron satisfactoriamente...');</script>";
	}
}

if($_REQUEST["actualiza_pregunta_aula"]==1){
	//echo "Tipo pregunta".$_REQUEST["tipo_pregunta"]." Desc:".$_REQUEST["desc_pregunta"];
	$guarda=NULL;
	if($_REQUEST["tipo_pregunta"]==1){
		$guarda=setPreguntaAbierta($_REQUEST["tipo_pregunta"],$_REQUEST["desc_pregunta"],$_SESSION['id_actividad_aula']);


	}elseif($_REQUEST["tipo_pregunta"]==2){
		$guarda=setPreguntaAbierta($_REQUEST["tipo_pregunta"],$_REQUEST["desc_pregunta"],$_SESSION['id_actividad_aula']);
		if($guarda){
			
			$guarada_res1=setRespuesta($guarda,"Verdadero");
			$guarada_res2=setRespuesta($guarda,"Falso");
			if($_REQUEST["respuesta_p"]==1){
				actualizaPreguntaOpcion($guarda,$guarada_res1);
			}elseif($_REQUEST["respuesta_p"]==2){
				actualizaPreguntaOpcion($guarda,$guarada_res2);
			}
		}else{
			echo "<script>alert('Se presentaron inconvenientes al guardar el elemento...');</script>";
		}


	}elseif($_REQUEST["tipo_pregunta"]==3){//opcion multiple
		$guarda=setPreguntaAbierta($_REQUEST["tipo_pregunta"],$_REQUEST["desc_pregunta"],$_SESSION['id_actividad_aula']);
		
		if($guarda){
			for($a=0;$a<count($_SESSION["carro"]);$a++){
				if($_SESSION["carro"][$a]!=NULL){
					$guarada_res=setRespuesta($guarda,$_SESSION["carro"][$a]["opcion"]);
					if($_REQUEST[$a]==1){
						actualizaPreguntaOpcion($guarda,$guarada_res);
					}
				}
			}
		}else{
			echo "<script>alert('Se presentaron inconvenientes al guardar el elemento...');</script>";
		}
				

	}elseif($_REQUEST["tipo_pregunta"]==4){
		$guarda=setPreguntaAbierta($_REQUEST["tipo_pregunta"],$_REQUEST["desc_pregunta"],$_SESSION['id_actividad_aula']);
		
		if($guarda){
			for($a=0;$a<count($_SESSION["carro"]);$a++){
				if($_SESSION["carro"][$a]!=NULL){
					$guarada_res=setRespuesta2($guarda,$_SESSION["carro"][$a]["opcion"],$_SESSION["carro"][$a]["opcion2"]);
				}
			}
		}else{
			echo "<script>alert('Se presentaron inconvenientes al guardar el elemento...');</script>";
		}


	}elseif($_REQUEST["tipo_pregunta"]==5){
		$guarda=setPreguntaAbierta($_REQUEST["tipo_pregunta"],$_REQUEST["desc_pregunta"],$_SESSION['id_actividad_aula']);
	}
	
	if($guarda){
		echo "<script>alert('Se guardo el elemento satisfactoriamente...');</script>";
	}else{
		echo "<script>alert('Se presentaron inconvenientes al guardar el elemento...');</script>";
	}
}



if($_REQUEST["actualiza_pregunta_aula"]==2){

	$elemento=getPreguntaId($_GET["id_pregunta"]);
	$tipo_p=$elemento['id_tipo_pregunta'];

	$guarda=NULL;
	if($tipo_p==1){

		$guarda=updPreguntaAbierta($_GET["id_pregunta"],$_REQUEST["desc_pregunta"]);

	}elseif($_REQUEST["tipo_pregunta"]==2){

		$guarda=updPreguntaAbierta($_GET["id_pregunta"],$_REQUEST["desc_pregunta"]);

		if($guarda){
			
			$guarada_res1=setRespuesta($guarda,"Verdadero");
			$guarada_res2=setRespuesta($guarda,"Falso");
			if($_REQUEST["respuesta_p"]==1){
				actualizaPreguntaOpcion($guarda,$guarada_res1);
			}elseif($_REQUEST["respuesta_p"]==2){
				actualizaPreguntaOpcion($guarda,$guarada_res2);
			}
		}else{
			echo "<script>alert('Se presentaron inconvenientes al guardar el elemento...');</script>";
		}


	}elseif($_REQUEST["tipo_pregunta"]==3){//opcion multiple
		$guarda=updPreguntaAbierta($_GET["id_pregunta"],$_REQUEST["desc_pregunta"]);
		
		if($guarda){
			for($a=0;$a<count($_SESSION["carro"]);$a++){
				if($_SESSION["carro"][$a]!=NULL){
					$guarada_res=setRespuesta($guarda,$_SESSION["carro"][$a]["opcion"]);
					if($_REQUEST[$a]==1){
						actualizaPreguntaOpcion($guarda,$guarada_res);
					}
				}
			}
		}else{
			echo "<script>alert('Se presentaron inconvenientes al guardar el elemento...');</script>";
		}
				

	}elseif($_REQUEST["tipo_pregunta"]==4){
		$guarda=updPreguntaAbierta($_GET["id_pregunta"],$_REQUEST["desc_pregunta"]);
		
		if($guarda){
			for($a=0;$a<count($_SESSION["carro"]);$a++){
				if($_SESSION["carro"][$a]!=NULL){
					$guarada_res=setRespuesta2($guarda,$_SESSION["carro"][$a]["opcion"],$_SESSION["carro"][$a]["opcion2"]);
				}
			}
		}else{
			echo "<script>alert('Se presentaron inconvenientes al guardar el elemento...');</script>";
		}


	}elseif($_REQUEST["tipo_pregunta"]==5){
		$guarda=updPreguntaAbierta($_GET["id_pregunta"],$_REQUEST["desc_pregunta"]);
	}
	
	if($guarda){
		echo "<script>alert('Se guardo el elemento satisfactoriamente...');</script>";
	}else{
		echo "<script>alert('Se presentaron inconvenientes al guardar el elemento...');</script>";
	}
}

if($_SESSION['id_actividad_aula']!=NULL){
?>
        <table width="700px" cellspacing=0 border="0">
			<tr>
				<td colspan="2" align="center" class="subenlace" valign="top">
				<h2>Grupos A Impartir La Clase.</h2>
                </td>
			</tr>
			<tr>
            	<td>Grupo/Asignatura:</td>
				<td>
                <select name="grupo_asignatura" id="grupo_asignatura" class="champ2">
                	<option value="">Seleccione...</option>
<?
$grupo_asignatura=getAsignaturaGrupoProfesor($_SESSION["user_id"]);
for($g=0;$g<count($grupo_asignatura);$g++){
?>
                    <option value="<?=$grupo_asignatura[$g]['id_grupo_asignatura']?>" ><?=$grupo_asignatura[$g]['nombre_grupo']." -- ".$grupo_asignatura[$g]['nombre_asignatura']?></option>
<?
}
?>
                </select>
                </td>
			</tr>
<?
if($_SESSION['tipo_actividad_aula']==2){
?>
			<tr>
				<td class="texte2">Fecha inicio:</td>
				<td><input class="champ2" style="width:100px; height:15" name="fechaini" id="fechaini" onFocus='Calendar.setup({inputField:"fechaini",ifFormat:"%Y-%m-%d",button:"calen"});'
  readonly="true"/>
  				<input name="vence_grupo_clase" id="vence_grupo_clase" type="hidden" value="2" />
                </td>
			</tr>
<?
}else{
?>
<input name="vence_grupo_clase" id="vence_grupo_clase" type="hidden" value="1" />
<?
}
?>
			<tr>
				<td align="center" colspan="2">
                <input name="actualiza_grupo_clase" id="actualiza_grupo_clase" type="hidden" value="0" />
                <input class="button_send" name="ingreso_grupo_clase" id="ingreso_grupo_clase" type="button" value="ASIGNAR CLASE" onClick="valida_grupo_clase(this.form);"></td>
			</tr>
            <tr>
				<td colspan="2" valign="top"><div id="div_grupo_clase"><? include("listado_grupo_clase.php");?></div></td>
			</tr>


			<tr>
				<td colspan="2" align="center" class="subenlace" valign="top">
				<h2>Elementos De La Clase.</h2>
                </td>
			</tr>
			<tr>
            	<td>Tipo De Elemento:</td>
				<td valign="top">
                <select name="tipo_e" id="tipo_e" onchange="FAjax('./aula/form_elemento.php','div_elemento','','post');" class="champ2">
                	<option value="">Seleccione...</option>
<?
$tipo=getTipoElemento();
for($i=0;$i<count($tipo);$i++){
?>
                    <option value="<?=$tipo[$i]['id_tipo_elemento']?>" ><?=$tipo[$i]['nombre_tipo_elemento']?></option>
<?
}
?>
                </select>
                </td>
			</tr>
            <tr>
				<td colspan="2" valign="top"><div id="div_elemento"></div></td>
			</tr>


			<tr>
				<td align="right" colspan="2" class="subenlace" valign="top"><div id="div_list_elemento">
				<?
                include_once("listado_elementos.php");
				?>
                </div>                
                </td>
			</tr>


			<tr>
				<td align="right" colspan="2" class="subenlace" valign="top"><div id="div_list_pregunta">
				<?
                include_once("listado_preguntas.php");
				?>
                </div>
                </td>
			</tr>


        </table>
<?
}
?>