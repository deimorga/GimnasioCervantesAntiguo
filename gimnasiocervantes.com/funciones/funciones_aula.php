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
	function deleteSQL($sql){
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


     function redimensionar_imagen($imagen, $nombre_imagen_asociada, $directorio)
     {
       //indicamos el directorio donde se van a colgar las imágenes
       //$directorio = ‘imagenes/’ ;
       //establecemos los límites de ancho y alto
       $nuevo_ancho = 550 ;
       $nuevo_alto = 425 ;
 
       //Recojo información de la imágen
       $info_imagen = getimagesize($imagen);
       $alto = $info_imagen[1];
       $ancho = $info_imagen[0];
       $tipo_imagen = $info_imagen[2];
	   
	   
 
       //Determino las nuevas medidas en función de los límites
       if($ancho > $nuevo_ancho OR $alto > $nuevo_alto)
       {
         if(($alto - $nuevo_alto) > ($ancho - $nuevo_ancho))
         {
           $nuevo_ancho = round($ancho * $nuevo_alto / $alto,0) ;    
         }
         else
         {
           $nuevo_alto = round($alto * $nuevo_ancho / $ancho,0);  
         }
       }
       else //si la imagen es más pequeña que los límites la dejo igual.
       {
         $nuevo_alto = $alto;
         $nuevo_ancho = $ancho;
       }
 
       // dependiendo del tipo de imagen tengo que usar diferentes funciones
       switch ($tipo_imagen) {
         case 1: //si es gif …
           $imagen_nueva = imagecreate($nuevo_ancho, $nuevo_alto);
           $imagen_vieja = imagecreatefromgif($imagen);
           //cambio de tamaño…
           imagecopyresampled($imagen_nueva, $imagen_vieja, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
           if (!imagegif($imagen_nueva, $directorio . $nombre_imagen_asociada)) return false;
         break;
 
         case 2: //si es jpeg …
           $imagen_nueva = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
           $imagen_vieja = imagecreatefromjpeg($imagen);
           //cambio de tamaño…
           imagecopyresampled($imagen_nueva, $imagen_vieja, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
           if (!imagejpeg($imagen_nueva, $directorio . $nombre_imagen_asociada)) return false;
         break;
 
         case 3: //si es png …
           $imagen_nueva = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
           $imagen_vieja = imagecreatefrompng($imagen);
           //cambio de tamaño…
           imagecopyresampled($imagen_nueva, $imagen_vieja, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
           if (!imagepng($imagen_nueva, $directorio . $nombre_imagen_asociada)) return false;
 
         break;
       }
       return true; //si todo ha ido bien devuelve true
 
     }

######################################################
######              Actividad Aula              ######
######################################################
	
	function setActividadAula($tema, $objetivos, $instrucciones, $profesor, $tipo){
		
		$fecha=date ( 'Y-m-d' ,strtotime ( '-5 hour' , strtotime ( date("Y-m-d H:i:s") ) ) );
		$sql="insert into tbl_actividad_aula (tema_actividad_aula, objetivos_actividad_aula, indicaciones_actividad_aula, id_profesor, fecha_actividad_aula, tipo_actividad_aula) values ('$tema', '$objetivos', '$instrucciones', $profesor, '$fecha', $tipo)";
		//echo $sql;
		return insertReturnSQL($sql);
	}
	
	function updActividadAula($id_actividad_aula, $tema, $objetivos, $instrucciones){
		$sql="update tbl_actividad_aula set tema_actividad_aula='$tema', objetivos_actividad_aula='$objetivos', indicaciones_actividad_aula='$instrucciones' where id_actividad_aula=$id_actividad_aula";
		return updateSQL($sql);		
	}
	
	function getActividadAulaId($id){
		$sql="select * from tbl_actividad_aula where id_actividad_aula=$id";
		//echo $sql;
		return getSQL($sql);
	}

	function getActividadAulaProfesor($id, $tipo){
		$anio=date("Y");
		$sql="select * from tbl_actividad_aula where id_profesor=$id and tipo_actividad_aula=$tipo and date_format(fecha_actividad_aula,'%Y')='$anio' order by id_actividad_aula desc";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function getActividadAulaAlumno($id, $tipo){
		$sql="SELECT d.*, e.nombre_asignatura FROM tbl_alumno a, tbl_grupo_asignatura b, tbl_actividad_aula_grupo_asignatura c, tbl_actividad_aula d, tbl_asignatura e
WHERE a.id_grupo=b.id_grupo AND b.id_grupo_asignatura=c.id_grupo_asignatura and b.id_asignatura=e.id_asignatura AND c.id_actividad_aula=d.id_actividad_aula 
AND a.identificacion=$id and d.tipo_actividad_aula=$tipo ORDER BY d.fecha_actividad_aula DESC";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function delActividadAula($id){
		$sql="delete from tbl_actividad_aula where id_actividad_aula=$id";
		return deleteSQL($sql);
	}
	
######################################################
######         ELEMENTOS ACTIVIDAD AULA         ######
######################################################

	function getTipoElemento(){
		$sql="select * from tbl_tipo_elemento";
		return getSQL($sql,true);	
	}
	
	function getTipoElemento1(){
		$sql="select * from tbl_tipo_elemento where web=1";
		return getSQL($sql,true);	
	}
	
	function getTipoPregunta(){
		$sql="select * from tbl_tipo_pregunta";
		return getSQL($sql,true);	
	}
	
	function setElemento($tipo_e,$id_actividad,$enunciado,$desc){
		$sql="insert into tbl_elemento (id_tipo_elemento, id_actividad_aula, titulo_elemento, descripcion_elemento) values ($tipo_e,$id_actividad,'$enunciado','$desc')";
		return insertSQL($sql);
	}
	
	function setElementoWeb($tipo_e,$enunciado,$desc_2,$desc){
		$sql="insert into tbl_elemento (id_tipo_elemento, id_actividad_aula, titulo_elemento, descripcion_web, descripcion_elemento) values ($tipo_e,0,'$enunciado','$desc_2','$desc')";
		return insertReturnSQL($sql);
	}
	
	function delElemento($id){
		$sql="delete from tbl_elemento where id_elemento=$id";
		return deleteSQL($sql);
	}

	function updElemento($id,$enunciado,$desc){
		$sql="update tbl_elemento set titulo_elemento='$enunciado', descripcion_elemento='$desc' where id_elemento=$id";
		return insertSQL($sql);
	}
	
	function getCantidadElementos(){
		$sql="select count(a.id_elemento) as cantidad from tbl_elemento a, tbl_tipo_elemento b where a.id_actividad_aula=0 and a.id_tipo_elemento=b.id_tipo_elemento";
		//die($sql);
		return getSQL($sql);
	}

	function getElementosWeb($pag){
		$fin=($pag*4);
		$ini=$fin-4;
		$sql="select a.*,b.nombre_tipo_elemento from tbl_elemento a, tbl_tipo_elemento b where a.id_actividad_aula=0 and a.id_tipo_elemento=b.id_tipo_elemento order by a.id_elemento desc LIMIT $ini, 4";
		return getSQL($sql,true);
	}

	function getElementosActividad($id_actividad_aula){
		$sql="select a.*,b.nombre_tipo_elemento from tbl_elemento a, tbl_tipo_elemento b where a.id_actividad_aula=$id_actividad_aula and a.id_tipo_elemento=b.id_tipo_elemento order by a.id_actividad_aula asc";
		return getSQL($sql,true);
	}

	function getElementosId($id_elemento){
		$sql="select a.*,b.nombre_tipo_elemento from tbl_elemento a, tbl_tipo_elemento b where a.id_elemento=$id_elemento and a.id_tipo_elemento=b.id_tipo_elemento";
		return getSQL($sql);
	}

	function getPreguntasActividad($id){
		$sql="select a.*,b.nombre_tipo_pregunta from tbl_pregunta a, tbl_tipo_pregunta b where a.id_actividad_aula=$id and a.id_tipo_pregunta=b.id_tipo_pregunta order by a.id_pregunta asc";
		return getSQL($sql,true);
	}

	function getPreguntaId($id){
		$sql="select a.*,b.nombre_tipo_pregunta from tbl_pregunta a, tbl_tipo_pregunta b where a.id_pregunta=$id and a.id_tipo_pregunta=b.id_tipo_pregunta order by a.id_pregunta asc";
		return getSQL($sql);
	}

	function setPreguntaAbierta($tipo,$desc,$id){
		$sql="insert into tbl_pregunta (id_tipo_pregunta, enunciado_pregunta, id_actividad_aula) values ($tipo,'$desc', $id)";
		//die($sql);
		return insertReturnSQL($sql);
	}
	
	function updPreguntaAbierta($id,$desc){
		$sql="update tbl_pregunta set enunciado_pregunta='$desc where id_pregunta=$id";
		return updateSQL($sql);
	}
	
	function actualizaPreguntaOpcion($id_p,$id_r){
		$sql="update tbl_pregunta set id_respuesta=$id_r where id_pregunta=$id_p";
		return updateSQL($sql);
	}

	function delPregunta($id){
		$sql="delete from tbl_pregunta where id_pregunta=$id";
		return deleteSQL($sql);
	}

	function setRespuesta($id,$res){
		$sql="insert into tbl_respuesta (id_pregunta, respuesta_1) values ($id, '$res')";
		return insertReturnSQL($sql);
	}
	
	function setRespuesta2($id,$res,$res2){
		$sql="insert into tbl_respuesta (id_pregunta, respuesta_1, respuesta_2) values ($id, '$res', '$res2')";
		return insertSQL($sql);
	}
	
	function getRespuestaId($id){
		$sql="select * from tbl_respuesta where id_respuesta=$id";
		return getSQL($sql);
	}
	
	function getRespuestaPregunta($id){
		$sql="select a.*,b.* from tbl_pregunta a, tbl_respuesta b where b.id_pregunta=$id and a.id_pregunta=b.id_pregunta order by RAND()";
		return getSQL($sql,true);
	}
	
	function getRespuestaCorrecta($id){
		$sql="select a.*,b.* from tbl_pregunta a, tbl_respuesta b where b.id_pregunta=$id and a.id_respuesta=b.id_respuesta";
		return getSQL($sql);
	}

function getAsignaturaGrupoProfesor($profesor){
	$sql="select a.*, b.*, c.* from tbl_grupo_asignatura a, tbl_asignatura b, tbl_grupo c where a.id_profesor=$profesor and a.id_asignatura=b.id_asignatura and a.id_grupo=c.id_grupo order by a.id_grupo asc";
	return getSQL($sql,true);	
}

function getAsignaturaGrupoActividad($id){
	$sql="select b.nombre_asignatura, c.nombre_grupo, 
	d.id_actividad_aula_grupo_asignatura 
	from tbl_grupo_asignatura a, tbl_asignatura b, 
	tbl_grupo c, tbl_actividad_aula_grupo_asignatura d 
	where 
	a.id_asignatura=b.id_asignatura and a.id_grupo=c.id_grupo 
	and d.id_grupo_asignatura=a.id_grupo_asignatura and d.id_actividad_aula=$id
	order by a.id_grupo asc";
	return getSQL($sql,true);	
}

function setAsignaturaGrupoActividad($id_grupo_asignatura, $id_actividad_aula, $fecha){
	$sql_consulta="select * from tbl_actividad_aula_grupo_asignatura where id_grupo_asignatura=$id_grupo_asignatura and id_actividad_aula=$id_actividad_aula";
	$existe=getSQL($sql_consulta);
	if($existe){
		return true;
	}else{
		$sql="insert into tbl_actividad_aula_grupo_asignatura (id_grupo_asignatura, id_actividad_aula, vence_actividad_aula) values ($id_grupo_asignatura, $id_actividad_aula, '$fecha')";
		//die ($sql);
		return insertSQL($sql);
	}
}

function delGrupoClase($id){
		$sql="delete from tbl_actividad_aula_grupo_asignatura where id_actividad_aula_grupo_asignatura=$id";
		return deleteSQL($sql);
}

function getElementosActividadAula($id_actividad_aula){
	$sql="select a.*, b.nombre_alumno from tbl_elemento_alumno_actividad_aula a, tbl_alumno b where a.id_actividad_aula=$id_actividad_aula and a.id_alumno=b.identificacion order by b.nombre_alumno, a.id_elemento_alumno_actividad_aula asc";
	return getSQL($sql,true);
}

function getElementoAlumnoActividadAula($id_actividad_aula,$esturiante_matriculado){
	$sql="select * from tbl_elemento_alumno_actividad_aula where id_actividad_aula=$id_actividad_aula and id_alumno=$esturiante_matriculado order by id_elemento_alumno_actividad_aula asc";
	return getSQL($sql,true);
}

function delElementoAlumnoActividadAula($id_actividad_aula){
	$sql="delete from tbl_elemento_alumno_actividad_aula where id_elemento_alumno_actividad_aula=$id_actividad_aula";
	//die($sql);
	return deleteSQL($sql);
}
?>