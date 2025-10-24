<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$asignatura=getAsignaturas();

$competencia="";

if($_POST['ingreso_plan_gestor']){
	$grupo_asignatura=getAsignaturaGrupoInforme("","",$_POST['asignatura']);
	for($g=0;$g<count($grupo_asignatura);$g++){
		$inserta=updAsignaturaGrupoFinal($_POST['logro_final_superior'],$_POST['logro_final_alto'],$_POST['logro_final_basico'],$_POST['logro_final_bajo'],$grupo_asignatura[$g]['id_grupo_asignatura']);
		if($inserta){
			echo "OK ".$grupo_asignatura[$g]['nombre_asignatura']." - ".$grupo_asignatura[$g]['nombre_grupo']."<br>";
		}else{
			echo "ERROR ".$grupo_asignatura[$g]['nombre_asignatura']." - ".$grupo_asignatura[$g]['nombre_grupo']."<br>";
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"{HTMLDIR}>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>COLEGIO GIMNASIO CERVANTES</title>
<!--HEAD-->

</head>

<body id="cuerpo">
<form action="logros_todos_final.php" method="post">
<h2>Datos Logro Final.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos del Logro.</legend>
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
  <tr>
    <td>Asignatura</td>
    <td><select name="asignatura" class="champ2" id="asignatura" >
                	<option value="">Seleccione...</option>
<? for($i=0;$i<count($asignatura);$i++){?>
                    <option value="<?=$asignatura[$i]["id_asignatura"]?>" ><?=$asignatura[$i]["nombre_asignatura"]?></option>
<? }?>
                </select> *</td>
  </tr>
			<tr>
				<td class="texte2">Logro desempe&ntilde;o superio<br />(DS 4.8-5.0):</td>
				<td><textarea name="logro_final_superior" class="champ2" id="logro_final_superior"></textarea> *</td>
			</tr>
			<tr>
				<td class="texte2">Logro desempe&ntilde;o alto<br />(DA 4.3-4.7):</td>
				<td><textarea name="logro_final_alto" class="champ2" id="logro_final_alto"></textarea> *</td>
			</tr>
			<tr>
				<td class="texte2">Logro desempe&ntilde;o b&aacute;sico<br />(DBS 3.7-4.2):</td>
				<td><textarea name="logro_final_basico" class="champ2" id="logro_final_basico"></textarea> *</td>
			</tr>
			<tr>
				<td class="texte2">Logro desempe&ntilde;o bajo<br />(DB 1.0-3.6):</td>
				<td><textarea name="logro_final_bajo" class="champ2" id="logro_final_bajo"></textarea> *</td>
			</tr>
		</table>
	</fieldset>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="ingreso_plan_gestor" id="ingreso_plan_gestor" type="submit" value="GUARDAR DATOS"></td>
			</tr>
			<tr>
				<td align="center"><div id="list_familiares"></div></td>
			</tr>
        </table>
</form>
</body>
</html>