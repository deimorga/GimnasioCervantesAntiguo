<?
session_start();
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$desempenios_alumnos_curso=getDesempenioPerdidoGrupo($_SESSION['asignatura'],$_SESSION['grupo']);
$contador=count($desempenios_alumnos_curso);
//print_r($alumnos_curso);
if($contador==0){
	echo "No hay desempe&ntilde;os pendientes para este grupo...";
}

if($_POST["actualiza_perdidos_grupo"]==1){
	for($i=0;$i<count($desempenios_alumnos_curso);$i++){
		if($_POST['superado_'.$i]==1){
			//echo "entro!!!";
			actualizaDesempenioPerdido($desempenios_alumnos_curso[$i]["id_desempenio_perdido"]);
		}
	}
	echo "<script>FAjax('./profesor/list_perdidos_grupo.php','area_trabajo','','post');</script>";
}
?>
<table border="1" width="650px" cellspacing="0" cellpadding="0">
<?
for($a=0;$a<count($desempenios_alumnos_curso);$a++){
	if($desempenios_alumnos_curso[$a]['identificacion']!=$desempenios_alumnos_curso[$a-1]['identificacion']){
	  ?>  
	  <tr bgcolor="#0099FF">
		<td>Desempe&ntilde;os Pendientes <?=$desempenios_alumnos_curso[$a]['nombre_alumno']?>:
        </td>
        <td>Superado</td>
	  </tr>
    <?
	}
    ?>
      <tr <? if(esPar($a+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFF'";}?>>
        <td><?
			echo '&nbsp;'.$desempenios_alumnos_curso[$a]['id_logro'].'&nbsp;&nbsp;-&nbsp;'.$desempenios_alumnos_curso[$a]['logro'];
		?>
        </td>
        <td><select name="superado_<?=$a?>">
          <option value="0" <? if($desempenios_alumnos_curso[$a]['superado']==0){ echo "selected='selected'";}?> >No</option>
          <option value="1" <? if($desempenios_alumnos_curso[$a]['superado']==1){ echo "selected='selected'";}?>>Si</option>
        </select></td>
      </tr>
      <?
}
?>
</table>
		<table width="670px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input type="hidden" name="actualiza_perdidos_grupo" value="0" /><input class="button_send" name="guardar_cambios" id="guardar_cambios" type="button" value="GUARDAR CAMBIOS" onClick="valida_derdidos_grupo(this.form);"></td>
			</tr>
        </table>
