<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$asignatura=getAsignaturas();
//$grupo=getGrupos();
$periodo=getPeriodos();

if($_POST['enviar']){
	$planes=getPlanesGestores("","",$_POST['asignatura'],$_POST['periodo']);
	//print_r($planes);
	for($p=0;$p<count($planes);$p++){
		$inserta=insertaPlanGestor("tbl_logro","logro",$_POST['descripcion_logro'],$planes[$p]['id_plan_gestor']);
		if($inserta){
			echo "OK: ".$planes[$p]['id_plan_gestor']."<br>";
		}else{
			echo "ERROR: ".$planes[$p]['id_plan_gestor']."<br>";
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
<form action="logros_todos.php" method="post">
<h2>Guardar losgros a Planes Gestor.</h2>
<table width="650px" border="0" cellspacing="15" cellpadding="0">
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
    <td>Asignaturao Plan Gestor diligenciado</td>
    <td><select name="asignatura" class="champ2" id="asignatura" >
                	<option value="">Seleccione...</option>
<? for($i=0;$i<count($asignatura);$i++){?>
                    <option value="<?=$asignatura[$i]["id_asignatura"]?>" ><?=$asignatura[$i]["nombre_asignatura"]?></option>
<? }?>
                </select> *</td>
  </tr>
  <tr>
	<td class="texte2">Descripcion:</td>
	<td><textarea class="champ3" name="descripcion_logro" id="descripcion_logro"></textarea> *</td>
  </tr>
  <tr>
  	<td colspan="2"><input name="enviar" class="button_send" type="submit" value="Guardar"></td>
  </tr>
</table>
</form>
</body>
</html>