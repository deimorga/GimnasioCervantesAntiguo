<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if(isset($_REQUEST['informe_alumnos'])){
	$sum=0;
	if($_REQUEST['1']=="D")$sum=$sum+1;
	if($_REQUEST['2']=="D")$sum=$sum+1;
	if($_REQUEST['3']=="B")$sum=$sum+1;
	if($_REQUEST['4']=="A")$sum=$sum+1;
	if($_REQUEST['5']=="D")$sum=$sum+1;
	if($_REQUEST['6']=="C")$sum=$sum+1;
	if($_REQUEST['7']=="A")$sum=$sum+1;
	if($_REQUEST['8']=="C")$sum=$sum+1;
	if($_REQUEST['9']=="D")$sum=$sum+1;
	if($_REQUEST['10']=="D")$sum=$sum+1;
	if($_REQUEST['11']=="C")$sum=$sum+1;
	if($_REQUEST['12']=="D")$sum=$sum+1;
	if($_REQUEST['13']=="A")$sum=$sum+1;
	if($_REQUEST['14']=="B")$sum=$sum+1;
	if($_REQUEST['15']=="C")$sum=$sum+1;
	if($_REQUEST['16']=="D")$sum=$sum+1;
	if($_REQUEST['17']=="B")$sum=$sum+1;
	if($_REQUEST['18']=="C")$sum=$sum+1;
	
	if($_REQUEST['19']=="C")$sum=$sum+1;
	if($_REQUEST['20']=="D")$sum=$sum+1;
	if($_REQUEST['21']=="D")$sum=$sum+1;
	if($_REQUEST['22']=="D")$sum=$sum+1;
	if($_REQUEST['23']=="A")$sum=$sum+1;
	if($_REQUEST['24']=="C")$sum=$sum+1;
	if($_REQUEST['25']=="A")$sum=$sum+1;
	if($_REQUEST['26']=="B")$sum=$sum+1;
	if($_REQUEST['27']=="A")$sum=$sum+1;
	if($_REQUEST['28']=="D")$sum=$sum+1;
	if($_REQUEST['29']=="D")$sum=$sum+1;
	if($_REQUEST['30']=="B")$sum=$sum+1;
	if($_REQUEST['31']=="D")$sum=$sum+1;
	if($_REQUEST['32']=="B")$sum=$sum+1;
	if($_REQUEST['33']=="A")$sum=$sum+1;
	if($_REQUEST['34']=="B")$sum=$sum+1;
	if($_REQUEST['35']=="B")$sum=$sum+1;
	if($_REQUEST['36']=="A")$sum=$sum+1;
	
	if($_REQUEST['37']=="C")$sum=$sum+1;
	if($_REQUEST['38']=="B")$sum=$sum+1;
	if($_REQUEST['39']=="A")$sum=$sum+1;
	if($_REQUEST['40']=="D")$sum=$sum+1;
	if($_REQUEST['41']=="B")$sum=$sum+1;
	if($_REQUEST['42']=="B")$sum=$sum+1;
	if($_REQUEST['43']=="A")$sum=$sum+1;
	if($_REQUEST['44']=="B")$sum=$sum+1;
	if($_REQUEST['45']=="B")$sum=$sum+1;
	if($_REQUEST['46']=="B")$sum=$sum+1;
	if($_REQUEST['47']=="A")$sum=$sum+1;
	if($_REQUEST['48']=="A")$sum=$sum+1;
	if($_REQUEST['49']=="B")$sum=$sum+1;
	if($_REQUEST['50']=="B")$sum=$sum+1;
	if($_REQUEST['51']=="C")$sum=$sum+1;
	if($_REQUEST['52']=="D")$sum=$sum+1;
	if($_REQUEST['53']=="B")$sum=$sum+1;
	
	$guarda=guardaPruebaSaber($sum,$_REQUEST['id_alumno']);
	if($guarda){
		echo "<script>alert('Su prueba finalizo con un total de ".$sum." respuestas correctas.');</script>";
	}else{
		echo "<script>alert('Su prueba ya fue registrada dentro del sistema.');</script>";
	}
}
?>
        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="descarga" id="descarga" type="button" value="DESCARGAR CUADERNILLO SIMULACRO QUINTO" onClick="window.open('CUADERNILLO_SIMULACRO_QUINTO.pdf');"></td>
			</tr>
        </table>
	<fieldset>
		<legend class="texte_legende2">Filtro por datos del alumno.</legend>
        <table cellpadding=5 cellspacing=0 border="0">
 			<tr>
				<td class="texte2">Ingrese la identificacion del alumno:</td>
				<td><input type="text" class="champ2" name="id_alumno" id="id_alumno" onkeypress="return numeros(event);" ></td>
            </tr>
  		</table>
	</fieldset>



<h2>Listado de alumnos registrados.</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
 
<?
	$cont=0;
	for($i=1;$i<=53;$i++){
	$cont=$cont+1;
	if($i==1){
	?>
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>LENGUAJE </td>
    <td>A</td>
    <td>B</td>
    <td>C</td>
    <td>D</td>
  </tr>
    <?
	}	
	if($i==19){
		$cont=1;
	?>
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>MATEMATICAS </td>
    <td>A</td>
    <td>B</td>
    <td>C</td>
    <td>D</td>
  </tr>
    <?
	}	
	if($i==37){
		$cont=1;
	?>
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>CIENCIAS </td>
    <td>A</td>
    <td>B</td>
    <td>C</td>
    <td>D</td>
  </tr>
    <?
	}	
	?>
  <tr <? if(esPar($i+1)){ echo ' bgcolor="#CCCCCC"';}else{ echo " bgcolor='#FFFF66'";}?>>
    <td>No. Pregunta <?=$cont?></td>
    <td><input name="<?=$i?>" type="radio" value="A"></td>
    <td><input name="<?=$i?>" type="radio" value="B"></td>
    <td><input name="<?=$i?>" type="radio" value="C"></td>
    <td><input name="<?=$i?>" type="radio" value="D"></td>
  </tr>
<? }?>

</table>


        <table width="600px" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="informe_alumnos" id="informe_alumnos" type="button" value="GUARDAR RESULTADOS" onClick="FAjax('./administrativo/respuestas_saber_2.php','contenido_usuario','','post');"></td>
			</tr>
        </table>