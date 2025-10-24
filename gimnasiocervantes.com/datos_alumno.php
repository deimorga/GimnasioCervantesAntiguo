<?
session_start();

include_once("./funciones/funciones.php");
include_once("./funciones/conexion.php");

$id="";
$expedida="";
$nombre="";
$fecha="";
$lugar="";
$sangre="";
$seguro="";
$nombre_eps="";
$procedencia="";
$grado_alumno="";
$folio="";

if($_GET["nuevo"]==1){
	$_POST["identificacion"]="";
	$_GET["identificacion"]="";
	$_REQUEST["identificacion"]="";
}

	$id=$_SESSION["alumno_registro"];
	$alumno=getAlumnoIdPin($id);
	if($alumno){
		$expedida=$alumno["lugar_expedicion"];
		$nombre=$alumno["nombre_alumno"];
		$fecha=$alumno["fecha_nacimiento"];
		$lugar=$alumno["lugar_nacimiento"];
		$sangre=$alumno["rh"];
		$seguro=$alumno["nivel_sisben"];
		$nombre_eps=$alumno["eps"];
		$procedencia=$alumno["procedencia"];
		$grado_alumno=$alumno["id_grado_pin"];
}
$grado=getGradoId($grado_alumno);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"{HTMLDIR}>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body id="cuerpo">
<br><br><br><br><br><br><br><br>
<table width="750" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h2>MATRICULA.</h2></td>
    <td align="right">&nbsp;</td>
  </tr>
</table>


<table width="750px" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3">Lugar y fecha: Facatativ&aacute; / <?=date("d-m-Y")?></td>
  </tr>
  <tr>
    <td colspan="3">Nombre Alumno: <?=$nombre?></td>
  </tr>
  <tr>
    <td>C.C/T.I. <?=$id?></td>
    <td>Expedida: <?=$expedida?></td>
    <td>Lugar y fecha de nacimiento: <?=$lugar?>/<?=$fecha?></td>
  </tr>
  <tr>
    <td>RH: <? if($sangre=="A"){ echo "A/positivo";}elseif($sangre=="A-"){ echo "A/negativo";}elseif($sangre=="B"){ echo "B/positivo";}elseif($sangre=="B-"){ echo "B/negativo";}elseif($sangre=="AB"){ echo "AB/positivo";}elseif($sangre=="AB-"){ echo "AB/negativo";}elseif($sangre=="O"){ echo "O/positivo";}elseif($sangre=="O-"){ echo "O/negativo";}?></td>
    <td>EPS <? if($seguro=="EPS"){ echo "X. ";}else{ echo "__";}?>Sisben <? if($seguro=="SISBEN"){ echo "X. ";}else{ echo "__";}?>ARS <? if($seguro=="ARS"){ echo "X.";}else{ echo "__";}?></td>
    <td>Nombre: <?=$nombre_eps?></td>
  </tr>
  <tr>
    <td colspan="3">Grado: <?=$grado['nombre_grado']?></td>
  </tr>
  <tr>
    <td colspan="3">PROCEDENCIA(Ultima Institucion): <?=$procedencia?></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC">FAMILIARES:</td>
  </tr>
<?
$familiares=getFamiliaresAlumno($_SESSION["alumno_ingreso"]);
for($f=0;$f<count($familiares);$f++){
?>
  <tr>
    <td colspan="2">Nombre <?=$familiares[$f]["parentezco"]?>: <?=$familiares[$f]["nombre_acudiente"]?></td>
    <td>Ocupaci&oacute;n: <?=$familiares[$f]["empresa_acudiente"]?></td>
  </tr>
  <tr>
    <td colspan="2">Direcci&oacute;n: <?=$familiares[$f]["direccion_acudiente"]?></td>
    <td>Tel.: <?=$familiares[$f]["tel_1"]?></td>
  </tr>
  <tr>
    <td colspan="2">Celular: <?=$familiares[$f]["tel_2"]?></td>
    <td>E-mail: <?=$familiares[$f]["email_acudiente"]?></td>
  </tr>
<?
}
?>
</table>
<br>
<table width="750px" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>Compromiso: Aceptamos el Proyecto Educativo Institucional PEI. El Manual de Convivencia, el Sistema de Matricula, Pensiones y las normas establecidas en la Ley general de educaci&oacute;n.
    <br>Firmas:<br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_______________________________&nbsp;&nbsp;&nbsp;_______________________________<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alumno.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Padre o Acudiente.
    <br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_______________________________&nbsp;&nbsp;&nbsp;_______________________________<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rector(a).&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Secretario(a).
    </td>
  </tr>
  <tr>
    <td>Observaciones: ________________________________________________________________________________<br>
    _____________________________________________________________________________________________<br>    _____________________________________________________________________________________________<br>    _____________________________________________________________________________________________<br></td>
  </tr>
</table>
<?
updConsecutivo($folio['id_consecutivo'],$folio['consecutivo']+1);
?>
<script>window.print();</script>
</body>