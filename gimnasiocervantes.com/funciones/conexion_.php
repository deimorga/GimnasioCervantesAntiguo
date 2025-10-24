<?
session_start();//inicio sessiones

$usuario=$_SESSION["nombre_variable_usuario"];//debo indicar el nombre de la variable de sesion q contiene el usuario logueado

$conexion = mysql_connect("ip_o_servidor_de_la_db", "Usuario_de_la_db", "clave_usuario_db") or  die("1. error en la conexion");
mysql_select_db("Nombre_de_la_db", $conexion);

	function insertSQL($sql){
				$query=mysql_query($sql);
				if($query){
					return 1;					
				  }else{
					return 0;	
				}
		}
	function ingresoRegistro($id,$tipo){
		$fecha=date("Y-m-d");
		$hora=date("H:m");
		$sql="insert into tbl_registro (id_usuario,fecha,hora,tipo) values ('$id','$fecha','$hora',$tipo)";
		return insertSQL($sql);
	} 
	
	$insert=NULL;
	if($_REQUEST["opcion"]==1){
		$insert=ingresoRegistro($usuario,1);
	}elseif($_REQUEST["opcion"]==2){
		$insert=ingresoRegistro($usuario,2);
	}elseif($_REQUEST["opcion"]==3){
		$insert=ingresoRegistro($usuario,3);
	}elseif($_REQUEST["opcion"]==4){
		$insert=ingresoRegistro($usuario,4);
	}else{
		//debe seleccionar alguna opcion	
	}
?>
<form action="" method="post">
<select name="opcion">
  <option value="1">Ingreso a turno</option>
  <option value="2">Salida almuerzo</option>
  <option value="3">Regreso almuerzo</option>
  <option value="4">Salida de turno</option>
</select>
</form>