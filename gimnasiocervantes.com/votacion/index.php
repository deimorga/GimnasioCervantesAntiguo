<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if(isset($_REQUEST['candidato_voto']) && isset($_REQUEST['alumno_voto'])){
	if($_REQUEST['alumno_voto']==""){
		echo "<script>alert('Debe digitar una identificacion valida...');window.location.href='./index.php';</script>";
	}
	//echo "ENTRO!!!";
	$alumno=getAlumnoId($_REQUEST['alumno_voto']);
	if(!$alumno){
		echo "<script>alert('La Identificacion digitada no fue encontrada...');window.location.href='./index.php';</script>";
	}else{
		if($alumno['voto']!=1){
			echo "<script>alert('El Alumno ya registra un voto...');window.location.href='./index.php';</script>";
		}else{
			$insert_voto=setVotoCandidato($_REQUEST['alumno_voto'],$_REQUEST['candidato_voto']);
			if($insert_voto){
				echo "<script>alert('Los datos se guardaron correctamente...');window.location.href='./index.php';</script>";
			}else{
				echo "<script>alert('Los datos no se guardaron correctamente...');window.location.href='./index.php';</script>";
			}
		}
	}
}
?>

<form name="form_votacion" action="index.php" method="post">

<h2>Registro de la votaci&oacute;n del estudiante.</h2>
<p>Identificacion del Alumno: <input type="text" name="alumno_voto" id="alumno_voto" /></p>

	<table border="1" cellspacing="0" cellpadding="0" width="633">
      <tr>
<?
$voto_alumno=getVotoAlumnoId($_SESSION['alumno_voto']);
$concepto=getCandidato();
for($i=0;$i<count($concepto);$i++){
?>
        <td width="208" valign="top"><p align="center"><strong>Partido Político:</strong></p>
          <p align="center">
            <strong><?=$concepto[$i]['partido']?></strong></p>
          <p><strong>&nbsp;</strong></p>
          <p align="center"><strong><?=$concepto[$i]['nombre_alumno']?></strong><br />
            <strong><img src="../web_cam/jpegcam/htdocs/<?=$concepto[$i]['identificacion']?>.jpg" alt="" width="183" height="193" /></strong><strong> </strong><br />
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
				<td align="center"><input class="button_send" name="ingreso_voto" id="ingreso_voto" type="submit" value="ADICIONAR VOTO"><!--&nbsp;&nbsp;<input type="button" value="REGISTRAR PAGO PENSION" onclick="FAjax('./administrativo/pago_pension.php','concepto','','post');" class="button_send" />--></td>
			</tr>
        </table>
</form>