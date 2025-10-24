<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_POST['edita_usuario']==1){

	$usuario=$_POST['id_usuario'];
	$nombre=$_POST['nombre_usuario'];

	$guarda_concepto=updUsuario($usuario,$nombre);
	if($guarda_concepto){
		delModuloUsuario($_POST['id_usuario']);
		$modulos=getModulos();
		for($i=0;$i<count($modulos);$i++){
			if($_POST['registro_'.$i]==1){
				setModuloUsuario($usuario, $modulos[$i]['id_modulo']);
			}
		}
		echo "<script>alert('Los datos se actualizaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se actualizaron correctamente los datos...');</script>";
	}
}

if($_POST['actualiza_usuario']==1){

	$usuario=$_POST['id_usuario'];
	$nombre=$_POST['nombre_usuario'];

	$guarda_usuario=setUsuario($usuario,$usuario,1,$nombre);
	if($guarda_usuario){
		$modulos=getModulos();
		for($i=0;$i<count($modulos);$i++){
			if($_POST['registro_'.$i]==1){
				setModuloUsuario($usuario, $modulos[$i]['id_modulo']);
			}
		}
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos o el usuario ya existe...');</script>";
	}
}

?>
<table width="100%" cellspacing=0 border="0">
  <tr>
    <td><div id="concepto"><? include_once("form_usuario.php");?></div></td>
  </tr>
  <tr>
	<td align="right" class="subenlace" valign="top"><input class="button_send2" name="listado_usuario" id="listado_usuario" type="button" value="LISTADO DE USUARIOS" onclick="FAjax('./administrativo/list_usuarios.php','list_concepto','','post');"></td>
  </tr>
  <tr>
    <td valign="top"><div id="list_concepto"></div></td>
  </tr>
</table>

