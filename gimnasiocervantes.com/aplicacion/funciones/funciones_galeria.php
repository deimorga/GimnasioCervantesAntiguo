<?
/*
 * FUNCIONES GENERALES
 */
function redondear($valor) { 
   $float_redondeado=round($valor * 10) / 10; 
   return $float_redondeado; 
}
function esPar($numero){ 
   $resto = $numero%2; 
   if (($resto==0) && ($numero!=0)) { 
        return true; 
   }else{ 
        return false; 
   } 
}

function completarCeros($entero, $largo){

$entero = (int)$entero;    
$largo = (int)$largo;         
$relleno = '';         

	if (strlen($entero) < $largo) {        
		$relleno = str_repeat('0', ($largo-strlen($entero)));    
	}    
return $relleno.$entero;
}

function contador()
{
 // fichero donde se guardaran las visitas
 $fichero = "visitas.txt";
 
 $fptr = fopen($fichero,"r");
 
 // sumamos una visita
 $num = fread($fptr,filesize($fichero));
 $num++;
 
 $fptr = fopen($fichero,"w+");
 fwrite($fptr,$num);
 
 return $num;
}

function getSQL($sql,$varios=false){
		// Conectarse a y seleccionar una base de datos de MySQL llamada sakila
		// Nombre de host: 127.0.0.1, nombre de usuario: tu_usuario, contraseña: tu_contraseña, bd: sakila
		$mysqli = new mysqli('localhost', 'artmsoft_artm', '1032380913', 'artmsoft_db_gimnasio_cervantes');
		$mysqli->set_charset("utf8");
		// ¡Oh, no! Existe un error 'connect_errno', fallando así el intento de conexión
		if ($mysqli->connect_errno) {
			// La conexión falló. ¿Que vamos a hacer? 
			// Se podría contactar con uno mismo (¿email?), registrar el error, mostrar una bonita página, etc.
			// No se debe revelar información delicada
		
			// Probemos esto:
			echo "Lo sentimos, este sitio web está experimentando problemas.";
		
			// Algo que no se debería de hacer en un sitio público, aunque este ejemplo lo mostrará
			// de todas formas, es imprimir información relacionada con errores de MySQL -- se podría registrar
			echo "Error: Fallo al conectarse a MySQL debido a: \n";
			echo "Errno: " . $mysqli->connect_errno . "\n";
			echo "Error: " . $mysqli->connect_error . "\n";
			
			// Podría ser conveniente mostrar algo interesante, aunque nosotros simplemente saldremos
			exit;
		}
		$query = $mysqli->query($sql);
		if($varios==true){
			if($query){
				while($array=$query->fetch_assoc()){
					$datos[]=$array;
				}
			}else{
				//echo $sql;
			}
		}else{
			if($query){
				$datos=$query->fetch_assoc();
			}else{
			//	echo $sql;
			}
		}
		$mysqli->close();
		return $datos;
	}
	########################################
	function updateSQL($sql){
		// Conectarse a y seleccionar una base de datos de MySQL llamada sakila
		// Nombre de host: 127.0.0.1, nombre de usuario: tu_usuario, contraseña: tu_contraseña, bd: sakila
		$mysqli = new mysqli('localhost', 'artmsoft_artm', '1032380913', 'artmsoft_db_gimnasio_cervantes');
		$mysqli->set_charset("utf8");
		// ¡Oh, no! Existe un error 'connect_errno', fallando así el intento de conexión
		if ($mysqli->connect_errno) {
			// La conexión falló. ¿Que vamos a hacer? 
			// Se podría contactar con uno mismo (¿email?), registrar el error, mostrar una bonita página, etc.
			// No se debe revelar información delicada
		
			// Probemos esto:
			echo "Lo sentimos, este sitio web está experimentando problemas.";
		
			// Algo que no se debería de hacer en un sitio público, aunque este ejemplo lo mostrará
			// de todas formas, es imprimir información relacionada con errores de MySQL -- se podría registrar
			echo "Error: Fallo al conectarse a MySQL debido a: \n";
			echo "Errno: " . $mysqli->connect_errno . "\n";
			echo "Error: " . $mysqli->connect_error . "\n";
			
			// Podría ser conveniente mostrar algo interesante, aunque nosotros simplemente saldremos
			exit;
		}
		$query = $mysqli->query($sql);
				if($query){
					$mysqli->close();
					return 1;
				}else{
					$mysqli->close();
					return 0;	
				}
		}
	########################################
	function updateReturnSQL($sql){
				$query=mysql_query($sql);
				if($query){
					if(mysql_affected_rows($query)>0){
						$row=pg_fetch_assoc($query);												
						return $row;
					}else{
						return false;
						}
				}else{
					return false;	
				}
		}
	#######################################
	function insertSQL($sql){
		// Conectarse a y seleccionar una base de datos de MySQL llamada sakila
		// Nombre de host: 127.0.0.1, nombre de usuario: tu_usuario, contraseña: tu_contraseña, bd: sakila
		$mysqli = new mysqli('localhost', 'artmsoft_artm', '1032380913', 'artmsoft_db_gimnasio_cervantes');
		$mysqli->set_charset("utf8");
		// ¡Oh, no! Existe un error 'connect_errno', fallando así el intento de conexión
		if ($mysqli->connect_errno) {
			// La conexión falló. ¿Que vamos a hacer? 
			// Se podría contactar con uno mismo (¿email?), registrar el error, mostrar una bonita página, etc.
			// No se debe revelar información delicada
		
			// Probemos esto:
			echo "Lo sentimos, este sitio web está experimentando problemas.";
		
			// Algo que no se debería de hacer en un sitio público, aunque este ejemplo lo mostrará
			// de todas formas, es imprimir información relacionada con errores de MySQL -- se podría registrar
			echo "Error: Fallo al conectarse a MySQL debido a: \n";
			echo "Errno: " . $mysqli->connect_errno . "\n";
			echo "Error: " . $mysqli->connect_error . "\n";
			
			// Podría ser conveniente mostrar algo interesante, aunque nosotros simplemente saldremos
			exit;
		}
		$query = $mysqli->query($sql);
				if($query){
					$mysqli->close();
					return 1;					
				  }else{
					$mysqli->close();
					return 0;	
				}
		}
	#######################################
	function insertReturnSQL($sql){
		// Conectarse a y seleccionar una base de datos de MySQL llamada sakila
		// Nombre de host: 127.0.0.1, nombre de usuario: tu_usuario, contraseña: tu_contraseña, bd: sakila
		$mysqli = new mysqli('localhost', 'artmsoft_artm', '1032380913', 'artmsoft_db_gimnasio_cervantes');
		$mysqli->set_charset("utf8");
		// ¡Oh, no! Existe un error 'connect_errno', fallando así el intento de conexión
		if ($mysqli->connect_errno) {
			// La conexión falló. ¿Que vamos a hacer? 
			// Se podría contactar con uno mismo (¿email?), registrar el error, mostrar una bonita página, etc.
			// No se debe revelar información delicada
		
			// Probemos esto:
			echo "Lo sentimos, este sitio web está experimentando problemas.";
		
			// Algo que no se debería de hacer en un sitio público, aunque este ejemplo lo mostrará
			// de todas formas, es imprimir información relacionada con errores de MySQL -- se podría registrar
			echo "Error: Fallo al conectarse a MySQL debido a: \n";
			echo "Errno: " . $mysqli->connect_errno . "\n";
			echo "Error: " . $mysqli->connect_error . "\n";
			
			// Podría ser conveniente mostrar algo interesante, aunque nosotros simplemente saldremos
			exit;
		}
		$query = $mysqli->query($sql);
				//echo $sql;
				if($query){
					$id=$mysqli->insert_id;
					//die("PPPPPPP".$id);
					$mysqli->close();
					return $id;					
				}else{
					$mysqli->close();
					return false;	
				}
		}
	########################################


######################################################
######                galeria                   ######
######################################################
function getGalerias($tipo=1){
	
$sql="select * from tbl_galeria where tipo_galeria=$tipo order by id_galeria desc";
//echo $sql;
return getSQL($sql,true);
	
}

function getGaleriaId($id){
	
$sql="select * from tbl_galeria where id_galeria=".$id;

return getSQL($sql);
	
}

function setGaleria($nombre,$desc){
	$sql="insert into tbl_galeria (galeria, descripcion_galeria) values ('$nombre', '$desc')";
	//echo $sql;
	return insertReturnSQL($sql);
}

function updGaleria($nombre,$desc,$id){
	$sql="update tbl_galeria set galeria='$nombre', descripcion_galeria='$desc' where id_galeria=$id";
	//echo $sql;
	return updateSQL($sql);
}

function setGaleriaVideo($nombre,$desc,$enlace){
	if(substr($enlace,0,7)=="http://" || substr($enlace,0,7)=="HTTP://" || substr($enlace,0,8)=="HTTPS://" || substr($enlace,0,8)=="https://"){
  	}else{
  	  	$enlace="http://".$enlace;
  	}

	$sql="insert into tbl_galeria (galeria, descripcion_galeria,enlace_galeria,tipo_galeria) values ('$nombre', '$desc','$enlace', 2)";
	//echo $sql;
	return insertSQL($sql);
}

######################################################
######                Proyecto                  ######
######################################################
function getProyectos(){
	
$sql="select * from tbl_proyecto order by id_proyecto desc";
//echo $sql;
return getSQL($sql,true);
	
}

function getproyectoId($id){
	
$sql="select * from tbl_proyecto where id_proyecto=".$id;

return getSQL($sql);
	
}

function setProyecto($nombre,$desc){
	$sql="insert into tbl_proyecto (proyecto, descripcion_proyecto) values ('$nombre', '$desc')";
	//echo $sql;
	return insertReturnSQL($sql);
}

function updProyecto($titulo,$descripcion,$id){
	$sql="update tbl_proyecto set proyecto='$titulo', descripcion_proyecto='$descripcion' where id_proyecto=$id";
	//echo $sql;
	return updateSQL($sql);
}

?>