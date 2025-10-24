<?php
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$periodo=getPeriodos();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"{HTMLDIR}>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>COLEGIO GIMNASIO CERVANTES</title>
<!--HEAD-->

</head>

<body id="cuerpo">
<form action="puntaje.php" method="post">
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
  <tr>
    <td width="200px">Periodo</td>
    <td><select name="periodo" class="champ2" id="periodo" >
                	<option value="">Seleccione...</option>
                    <option value="1" >Primero</option>
                    <option value="2" >Segundo</option>
                    <option value="3" >Tercero</option>
                    <option value="4" >Cuarto</option>
                </select></td>
  </tr>
			<tr>
				<td class="texte2">Año:</td>
				<td><select name="anio" class="champ2" id="anio" >
                	<option value="">Seleccione...</option>
<?
$anio=date("Y");
?>
                    <option value="<?=$anio?>" ><?=$anio?></option>
                </select></td>
			</tr>
			<tr>
				<td class="texte2">Grupo Inicio:</td>
				<td><select name="ini" class="champ2" id="ini" >
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
				<td class="texte2">Grupo Fin:</td>
				<td><select name="fin" class="champ2" id="fin" >
                	<option value="">Seleccione...</option>
<?
for($j=0;$j<count($grupo);$j++){
?>
                    <option value="<?=$grupo[$j]['id_grupo']?>" ><?=$grupo[$j]['nombre_grupo']?></option>
<?
}
?>
                </select></td>
			</tr>
			<tr>
				<td class="texte2" colspan="2" align="center"><input type="submit" value="Enviar" /></td>
			</tr>
		</table>
</form>
</body>
</html>