<?
session_start();

if($_GET['descargar_carga_academica']==1){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=carga_academica.xls");
	header("Pragma: no-cache");
	header("Expires: 0"); 
	//echo "lololo";
}

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_GET['elimina_asignatura_grupo']==1){
	$elimino=delAsignaturaGrupo($_GET['id_grupo_asignatura']);
	if($elimino){
		echo "<script>alert('Los datos se eliminaron correctamente...');</script>";
	}else{
		echo "<script>alert('Los datos no se eliminaron correctamente...');</script>";
	}	
}

if($_REQUEST['actualiza_masivo']==1){
	$asignaturaPost=getAsignaturaGrupoInforme($_REQUEST['grupo'],$_REQUEST['director'],$_REQUEST['asignatura']);
	for($ap=0;$ap<count($asignaturaPost);$ap++){
		//echo "<br>".$asignaturaPost[$ap]['id_grupo_asignatura']."value".$_POST[$asignaturaPost[$ap]['id_grupo_asignatura']]."IntHora".$asignaturaPost[$ap]['intensidad_horaria'];
		$actualiza=updAsignaturaGrupo($asignaturaPost[$ap]['id_grupo_asignatura'],$_POST["intensidad_".$asignaturaPost[$ap]['id_grupo_asignatura']],$_POST[$asignaturaPost[$ap]['id_grupo_asignatura']]);
	}
}

if($_REQUEST['actualiza_grupo_asignatura']==1){
	$actualiza=updAsignaturaGrupo($_REQUEST['id_grupo_asignatura'],$_REQUEST['intensidad'],$_REQUEST['director']);
	if($actualiza){
		echo "<script>alert('Los datos se actualizaron correctamente...');</script>";
	}else{
		echo "<script>alert('Los datos no se actualizaron correctamente...');</script>";
	}	
}

$asignatura=getAsignaturaGrupoInforme($_REQUEST['grupo'],$_REQUEST['director'],$_REQUEST['asignatura']);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<h2>Listado Carga academica.</h2>
<?
if($_GET['descargar_carga_academica']==1){}else{
?>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Grupo:</td>
				<td><select name="grupo" class="champ2" id="grupo" >
                	<option value="">Seleccione...</option>
<?
$grupo=getGrupos();
for($i=0;$i<count($grupo);$i++){
?>
                    <option value="<?=$grupo[$i]['id_grupo']?>" ><?=$grupo[$i]['nombre_grupo']?></option>
<?
}
?>
                </select></td>
			</tr>
			<tr>
				<td class="texte2">Director de grupo:</td>
				<td><select name="director" class="champ2" id="director" >
                	<option value="">Seleccione...</option>
<? 
$profesor=getProfesores();
for($i=0;$i<count($profesor);$i++){	
?>
                    <option value="<?=$profesor[$i]["id_profesor"]?>"><?=$profesor[$i]["nombre_profesor"]?></option>
<? }?>
                </select>
                </td>
			</tr>
			<tr>
				<td class="texte2">Asignatura:</td>
				<td><select name="asignatura" class="champ2" id="asignatura" >
                	<option value="">Seleccione...</option>
<? 
$asignatura_filtro=getAsignaturas();
for($i=0;$i<count($asignatura_filtro);$i++){	
?>
                    <option value="<?=$asignatura_filtro[$i]["id_asignatura"]?>"><?=$asignatura_filtro[$i]["nombre_asignatura"]?></option>
<? }?>
                </select>
                </td>
			</tr>
		</table>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="informe_alumnos" id="informe_alumnos" type="button" value="FILTRAR LISTADO" onClick="FAjax('./administrativo/list_asignatura_grupo.php','area_trabajo','','post');"></td>
			</tr>
        </table>
<?
}
?>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>Grupo</td>
    <td>Asignatura</td>
    <td>Profesor</td>
    <td>Intensidad horaria</td>

  </tr>
<?
for($i=0;$i<count($asignatura);$i++){
?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td><?=$asignatura[$i]['nombre_grupo']?></td>
    <td><?=$asignatura[$i]['nombre_asignatura']?></td>
    <td>
	<select name="<?=$asignatura[$i]['id_grupo_asignatura']?>" class="champ2" id="<?=$asignatura[$i]['id_grupo_asignatura']?>" >
                	<option value="">Seleccione...</option>
<? 
for($p=0;$p<count($profesor);$p++){	
?>
                    <option value="<?=$profesor[$p]["id_profesor"]?>" <? if($asignatura[$i]['id_profesor']==$profesor[$p]["id_profesor"]){ echo " selected='selected' ";}?>><?=$profesor[$p]["nombre_profesor"]?></option>
<? }?>
    </select>
	</td>
    <td>
	<select name="intensidad_<?=$asignatura[$i]['id_grupo_asignatura']?>" class="champ2" id="intensidad_<?=$asignatura[$i]['id_grupo_asignatura']?>" >
                	<option value="">Seleccione...</option>
<? 
for($ih=0;$ih<10;$ih++){	
?>
                    <option value="<?=$ih?>" <? if($asignatura[$i]['intensidad_horaria']==$ih){ echo " selected='selected' ";}?>><?=$ih?> HORAS</option>
<? }?>
    </select>
	</td>
<!--
enlace eliminar:
if(confirm('Seguro de eliminar el registro?')){ FAjax('./administrativo/list_asignatura_grupo.php?id_grupo_asignatura=<? //$asignatura[$i]['id_grupo_asignatura']?>&elimina_asignatura_grupo=1','area_trabajo','','post');}else{ return false;}-->
  </tr>
<?
}
?>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">
    <input type="button" value="DESCARGAR" class="button_send" onclick="window.open('./administrativo/list_asignatura_grupo.php?descargar_carga_academica=1&grupo=<?=$_REQUEST['grupo']?>&director=<?=$_REQUEST['director']?>&asignatura=<?=$_REQUEST['asignatura']?>');"/>
    
    <input type="button" value="ACTUALIZAR CARGA ACADEMICA" class="button_send" onclick="FAjax('./administrativo/list_asignatura_grupo.php?actualiza_masivo=1','area_trabajo','','post');"/>
    </td>
  </tr>
</table>