<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$grupo="";
$grado="";
$director="";

$grupo_asignatura=getAsignaturaGrupoId($_GET['id_grupo_asignatura']);
$profesor=getProfesores();
?>
<h2>Asignar profesor y asignatura.<input type="hidden" value="<?=$_GET['id_grupo_asignatura']?>" name="id_grupo_asignatura"></h2>

	<fieldset>
		<legend class="texte_legende2">Datos de Grupo/Asignatura.</legend>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
			<tr>
				<td class="texte2">Grupo:</td>
				<td><?=$grupo_asignatura["nombre_grupo"]?></td>
			</tr>
			<tr>
				<td class="texte2">Asignatura:</td>
				<td><?=$grupo_asignatura["nombre_asignatura"]?></td>
			</tr>
			<tr>
				<td class="texte2">Intensidad horaria:</td>
				<td><select name="intensidad" id="intensidad" class="champ2">
               	  <option value="">Seleccione...</option>
<? for($a=1;$a<11;$a++){?>
               	  <option value="<?=$a?>" <? if($grupo_asignatura["intensidad_horaria"]==$a){ echo "selected='selected'";}?>><?=$a?> horas</option>
<? }?>
                </select> *</td>
			</tr>
			<tr>
				<td class="texte2">Profesor:</td>
				<td><select name="director" class="champ2" id="director" >
               	  <option value="">Seleccione...</option>
<? for($i=0;$i<count($profesor);$i++){?>
                    <option value="<?=$profesor[$i]["id_profesor"]?>" <? if($grupo_asignatura["id_profesor"]==$profesor[$i]["id_profesor"]){ echo "selected='selected'";}?> ><?=$profesor[$i]["nombre_profesor"]?></option>
<? }?>
                </select> *
                </td>
			</tr>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza_grupo_asignatura" id="actualiza_grupo_asignatura" type="hidden" value="0"><input class="button_send" name="edita_grupo_asignatura" id="edita_grupo_asignatura" type="button" value="GUARDAR DATOS" onClick="valida_edita_grupo_asignatura(this.form);"></td>
			</tr>
			<tr>
				<td align="center"><div id="list_familiares"></div></td>
			</tr>
        </table>
