<?php
include("../funciones/conexion.php");
include("../funciones/funciones.php");

$periodo=getPeriodos();

$campo="En su proceso de evaluación del 30% genera aprendizaje significativo observándose dominio en los conceptos, habilidades para desarrollar talleres y trabajos asignados, realizando actividades de apoyo (guías) para cumplir con los desempeños exigidos en el periodo y obtener logros esperados.";
if($_POST['enviar']){
	$planes=getPlanesTipo($_POST['periodo']);
	for($i=0;$i<count($planes);$i++){
		$insert=setLogroTipo($planes[$i]['id_plan_gestor'],$_POST['descripcion_logro']);
		if($insert){
			echo "OK: ".$planes[$i]['id_plan_gestor']." - ".$planes[$i]['nombre_asignatura']."<br>";
		}else{
			echo "Posiblemente ya existe, verifique: ".$planes[$i]['id_plan_gestor']." - ".$planes[$i]['nombre_asignatura']."<br>";
		
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
<form action="logro_30.php" method="post">
        <table cellpadding=5 cellspacing=0 border="0" style="color:#F00;">
  <tr>
    <td>Periodo</td>
    <td><select name="periodo" class="champ2" id="periodo" >
                	<option value="">Seleccione...</option>
<?
for($i=0;$i<count($periodo);$i++){
?>
                    <option value="<?=$periodo[$i]['id_periodo_academico']?>" ><?=$periodo[$i]['nombre_periodo_academico']?></option>
<?
}
?>
                </select></td>
  </tr>
			<tr>
				<td class="texte2">Descripcion:</td>
				<td><textarea class="champ3" name="descripcion_logro" id="descripcion_logro"><?=$campo?></textarea> *</td>
			</tr>
            <tr><td colspan="2"><input type="submit" name="enviar" value="Guardar" /></td></tr>
		</table>
</form>
</body>
</html>