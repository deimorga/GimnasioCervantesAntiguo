<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_REQUEST['voto_nuevo']==1){
	$_SESSION['alumno_voto']=$_REQUEST['identificacion'];
}

if(isset($_REQUEST['candidato_voto'])){
	$insert_voto=setVotoCandidato($_SESSION['alumno_voto'],$_REQUEST['candidato_voto']);
	if($insert_voto){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('Los datos no se guardaron correctamente...');</script>";
	}
}
?>


<h2>Registro de la votaci&oacute;n del estudiante <?=$_SESSION['alumno_voto']?>.</h2>


	<table border="1" cellspacing="0" cellpadding="0" width="633">
      <tr>
<?
$voto_alumno=getVotoAlumnoId($_SESSION['alumno_voto']);
$concepto=getCandidato();
for($i=0;$i<count($concepto);$i++){
?>
        <td width="208" valign="top"><p align="center"><strong>Partido Político:</strong></p>
          <p align="center"><img src="./web_cam/jpegcam/htdocs/logo_<?=$concepto[$i]['identificacion']?>.jpg" alt="" width="93" height="63" /><strong> </strong><br />
            <strong><?=$concepto[$i]['partido']?></strong></p>
          <p><strong>&nbsp;</strong></p>
          <p align="center"><strong><?=$concepto[$i]['nombre_alumno']?></strong><br />
            <strong><img src="./web_cam/jpegcam/htdocs/<?=$concepto[$i]['identificacion']?>.jpg" alt="" width="183" height="193" /></strong><strong> </strong><br />
            <strong><?=$concepto[$i]['tarjeton']?></strong>
            <strong><input type="radio" name="candidato_voto" class="champ2" id="candidato_voto" require="true" value="<?=$concepto[$i]['identificacion']?>" <? if($voto_alumno["voto"]==$concepto[$i]['identificacion']){ echo " checked ";}?>/></strong></p></td>
                    
<?
}
?>
        <td width="217" valign="top"><p align="center" style="font-size:36px;">
          <strong>VOTO</strong><br />
          <strong>EN BLANCO</strong><br />
          <input type="radio" name="candidato_voto" class="champ2" id="candidato_voto" require="true" value="0" <? if($voto_alumno["voto"]==0){ echo " checked ";}?>/></p></td>
      </tr>
    </table>
<table width="600px" cellpadding=5 cellspacing=0 border="0">
	<tr>
				<td align="center"><input class="button_send" name="ingreso_voto" id="ingreso_voto" type="button" value="ADICIONAR VOTO" onClick="FAjax('./administrativo/votacion.php','area_trabajo','','post');"><!--&nbsp;&nbsp;<input type="button" value="REGISTRAR PAGO PENSION" onclick="FAjax('./administrativo/pago_pension.php','concepto','','post');" class="button_send" />--></td>
			</tr>
        </table>