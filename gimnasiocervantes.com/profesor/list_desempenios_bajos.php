<?php
if($_REQUEST['descargar_desempenios_perdidos']==1){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=archivo.xls");
	header("Pragma: no-cache");
	header("Expires: 0"); 
	//echo "lololo";
}
ini_set("memory_limit","256M");
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$alumnos_curso=getAlumnosGrupo($_REQUEST['grupo']);
//print_r($alumnos_curso);
?>
<table border="1" width="650px" cellspacing="0" cellpadding="0">
<?
for($a=0;$a<count($alumnos_curso);$a++){
  $perdidos=getDesempenio_perdido2($alumnos_curso[$a]['identificacion']);
  if($perdidos){
	  ?>  
	  <tr>
		<td bgcolor="#0099FF">Desempe&ntilde;os Pendientes <?=$alumnos_curso[$a]['nombre_alumno']?>:
        </td>
	  </tr>
	  <?
  		for($p=0;$p<count($perdidos);$p++){
		
			if($perdidos[$p]['id_asignatura']!=$perdidos[$p-1]['id_asignatura']){
	  ?>
      <tr bgcolor="#FFFF33">
    	<td><?
			echo '<br>'.$perdidos[$p]['nombre_asignatura'];
	  ?>
      	</td>
      </tr>
	  <?
			}
	  ?>
      <tr <? if(esPar($p+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFF'";}?>>
        <td><?
			echo '&nbsp;'.$perdidos[$p]['id_logro'].'&nbsp;&nbsp;-&nbsp;'.$perdidos[$p]['logro'];
		}
		?>
        </td>
      </tr>
      <?
  }
}
?>
</table>
<?
if($_REQUEST['descargar_desempenios_bajos']==1){
	echo "<script>window.close();</script>";
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><input type="button" value="DESCARGAR" class="button_send" onclick="window.open('./pdf/list_desempenios_bajos.php?grupo=<?=$_REQUEST['grupo']?>');"/></td>
  </tr>
</table>