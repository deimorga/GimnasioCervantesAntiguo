<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if(isset($_REQUEST['informe_alumnos'])){
	$sum=0;
	if($_REQUEST['1']=="C")$sum=$sum+1;
	if($_REQUEST['2']=="C")$sum=$sum+1;
	if($_REQUEST['3']=="C")$sum=$sum+1;
	if($_REQUEST['4']=="B")$sum=$sum+1;
	if($_REQUEST['5']=="D")$sum=$sum+1;
	if($_REQUEST['6']=="D")$sum=$sum+1;
	if($_REQUEST['7']=="D")$sum=$sum+1;
	if($_REQUEST['8']=="C")$sum=$sum+1;
	if($_REQUEST['9']=="B")$sum=$sum+1;
	if($_REQUEST['10']=="C")$sum=$sum+1;
	if($_REQUEST['11']=="A")$sum=$sum+1;
	if($_REQUEST['12']=="D")$sum=$sum+1;
	if($_REQUEST['13']=="A")$sum=$sum+1;
	if($_REQUEST['14']=="B")$sum=$sum+1;
	if($_REQUEST['15']=="B")$sum=$sum+1;
	if($_REQUEST['16']=="B")$sum=$sum+1;
	if($_REQUEST['17']=="D")$sum=$sum+1;
	if($_REQUEST['18']=="A")$sum=$sum+1;
	
	if($_REQUEST['19']=="A")$sum=$sum+1;
	if($_REQUEST['20']=="C")$sum=$sum+1;
	if($_REQUEST['21']=="A")$sum=$sum+1;
	if($_REQUEST['22']=="D")$sum=$sum+1;
	if($_REQUEST['23']=="B")$sum=$sum+1;
	if($_REQUEST['24']=="C")$sum=$sum+1;
	if($_REQUEST['25']=="A")$sum=$sum+1;
	if($_REQUEST['26']=="C")$sum=$sum+1;
	if($_REQUEST['27']=="A")$sum=$sum+1;
	if($_REQUEST['28']=="C")$sum=$sum+1;
	if($_REQUEST['29']=="B")$sum=$sum+1;
	if($_REQUEST['30']=="C")$sum=$sum+1;
	if($_REQUEST['31']=="A")$sum=$sum+1;
	if($_REQUEST['32']=="C")$sum=$sum+1;
	if($_REQUEST['33']=="B")$sum=$sum+1;
	if($_REQUEST['34']=="D")$sum=$sum+1;
	if($_REQUEST['35']=="B")$sum=$sum+1;
	if($_REQUEST['36']=="D")$sum=$sum+1;
	
	if($_REQUEST['37']=="D")$sum=$sum+1;
	if($_REQUEST['38']=="C")$sum=$sum+1;
	if($_REQUEST['39']=="A")$sum=$sum+1;
	if($_REQUEST['40']=="C")$sum=$sum+1;
	if($_REQUEST['41']=="B")$sum=$sum+1;
	if($_REQUEST['42']=="B")$sum=$sum+1;
	if($_REQUEST['43']=="D")$sum=$sum+1;
	if($_REQUEST['44']=="C")$sum=$sum+1;
	if($_REQUEST['45']=="A")$sum=$sum+1;
	if($_REQUEST['46']=="B")$sum=$sum+1;

	if($_REQUEST['47']=="A")$sum=$sum+1;
	if($_REQUEST['48']=="C")$sum=$sum+1;
	if($_REQUEST['49']=="A")$sum=$sum+1;
	if($_REQUEST['50']=="A")$sum=$sum+1;
	if($_REQUEST['51']=="B")$sum=$sum+1;
	if($_REQUEST['52']=="B")$sum=$sum+1;
	if($_REQUEST['53']=="A")$sum=$sum+1;
	if($_REQUEST['54']=="B")$sum=$sum+1;
	if($_REQUEST['55']=="B")$sum=$sum+1;
	if($_REQUEST['56']=="D")$sum=$sum+1;
	if($_REQUEST['57']=="D")$sum=$sum+1;
	if($_REQUEST['58']=="A")$sum=$sum+1;
	if($_REQUEST['59']=="B")$sum=$sum+1;
	if($_REQUEST['60']=="B")$sum=$sum+1;
	if($_REQUEST['61']=="C")$sum=$sum+1;
	if($_REQUEST['62']=="C")$sum=$sum+1;
	
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
				<td align="center"><input class="button_send" name="descarga" id="descarga" type="button" value="DESCARGAR CUADERNILLO SIMULACRO NOVENO" onClick="window.open('CUADERNILLO_SIMULACRO_NOVENO.pdf');"></td>
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
	for($i=1;$i<=62;$i++){
	$cont=$cont+1;
	if($i==1){
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
	if($i==19){
		$cont=1;
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
	if($i==37){
		$cont=1;
	?>
  <tr bgcolor="#0066FF" style="color:#FFF;">
    <td>FINANCIERA </td>
    <td>A</td>
    <td>B</td>
    <td>C</td>
    <td>D</td>
  </tr>
    <?
	}	
	if($i==47){
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
				<td align="center"><input class="button_send" name="informe_alumnos" id="informe_alumnos" type="button" value="GUARDAR RESULTADOS" onClick="FAjax('./administrativo/respuestas_saber_3.php','contenido_usuario','','post');"></td>
			</tr>
        </table>