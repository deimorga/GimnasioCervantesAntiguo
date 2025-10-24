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
		$query=mysql_query($sql);
		if($varios==true){
			if($query){
				while($array=mysql_fetch_assoc($query)){
					$datos[]=$array;
				}
			}else{
				//echo $sql;
			}
		}else{
			if($query){
				$datos=mysql_fetch_assoc($query);
			}else{
			//	echo $sql;
			}
		}
		return $datos;
	}
	########################################
	function updateSQL($sql){
				$query=mysql_query($sql);
				if($query){
					return 1;
				}else{
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
				$query=mysql_query($sql);
				if($query){
					return 1;					
				  }else{
					return 0;	
				}
		}
	#######################################
	function insertReturnSQL($sql){
				$query=mysql_query($sql);
				//echo $sql;
				if($query){
					$id=mysql_insert_id();
					//die("PPPPPPP".$id);
					return $id;					
				}else{
					return false;	
				}
		}
	########################################
	function deleteSQL($sql){
			$query=mysql_query($sql);
			if($query){				
					return 1;				
			}else{
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
######               proyectos                  ######
######################################################
function getProyectos(){
	
$sql="select * from tbl_proyecto order by id_proyecto desc";
//echo $sql;
return getSQL($sql,true);
	
}

function getProyectoId($id){
	
$sql="select * from tbl_proyecto where id_proyecto=".$id;

return getSQL($sql);
	
}



######################################################
######                USUARIO                   ######
######################################################

	function validaUsuario($id,$clave){
		$sql="select * from tbl_usuario where identificacion_usuario='$id' and clave_usuario='$clave'";
		return getSQL($sql);
	}
	
	function getUsuarios(){
		
	$sql="select a.*, b.* from tbl_usuario a, tbl_tipo_usuario b where a.id_tipo_usuario=1 and a.id_tipo_usuario=b.id_tipo_usuario";
	//echo $sql;
	return getSQL($sql,true);
		
	}
	
	function getUsuariosAdmin(){
		
	$sql="select a.*, b.* from tbl_usuario a, tbl_tipo_usuario b where a.id_tipo_usuario<3 and a.id_tipo_usuario=b.id_tipo_usuario order by a.nombre_usuario asc";
	//echo $sql;
	return getSQL($sql,true);
		
	}
	
	function getUsuarioId($id){
		
	$sql="select * from tbl_usuario where identificacion_usuario=$id";
	//echo $sql;
	return getSQL($sql);
		
	}
	
	function setUsuario($identificacion,$clave,$id_tipo,$nombre=""){
		$existe=getUsuarioId($identificacion);
		if($existe){
			return false;
		}else{
			$sql="insert into tbl_usuario (identificacion_usuario,clave_usuario,id_tipo_usuario,nombre_usuario) values ($identificacion,'$clave',$id_tipo,'$nombre')";
			//echo $sql;
			return insertSQL($sql);
		}
	}
	
	function delUsuario($id){
		$sql="delete from tbl_usuario where identificacion_usuario='$id'";
		//echo $sql;
		return deleteSQL($sql);
	}
	
	function updUsuario($identificacion,$nombre){
			$sql="update tbl_usuario set nombre_usuario='$nombre' where identificacion_usuario='$identificacion'";
			//echo $sql;
			return updateSQL($sql);
	}
	
	function setClaveUsuario($usuario,$clave0,$clave1){
		$ingresa=validaUsuario($usuario,$clave0);
		if($ingresa){
			$sql="update tbl_usuario set clave_usuario='$clave1' where identificacion_usuario='$usuario'";
			return updateSQL($sql);
		}else{
			return false;
		}
	}
	
######################################################
######              ALUMNO PIN                  ######
######################################################

	function getAlumnosPin(){
		$sql="SELECT a.identificacion, a.nombre_alumno, a.pin, b.nombre_grado FROM tbl_alumno a, tbl_grado b WHERE a.id_grado_pin=b.id_grado AND a.pin IS NOT NULL ORDER BY a.id_grado_pin ASC";
		return getSQL($sql,true);	
		
	}
	
	function setAlumnoPin($identificacion, $expedida, $nombre, $fecha, $lugar, $sangre, $seguro, $nombre_eps, $procedencia){
	
		$existe=getAlumnoIdPin($identificacion);
		
		if($existe){
			$sql="update tbl_alumno set
	lugar_expedicion='$expedida', nombre_alumno='$nombre', fecha_nacimiento='$fecha', lugar_nacimiento='$lugar', rh='$sangre', nivel_sisben='$seguro', eps='$nombre_eps', procedencia='$procedencia'
	where identificacion=$identificacion";
	//echo $sql;
			return updateSQL($sql);
		}else{
			$sql="insert into tbl_alumno 
	(identificacion, lugar_expedicion, nombre_alumno, fecha_nacimiento, lugar_nacimiento, rh, nivel_sisben, eps, procedencia)
	values
	($identificacion, '$expedida', '$nombre', '$fecha', '$lugar', '$sangre', '$seguro', '$nombre_eps', '$procedencia')";
			setUsuario($identificacion,$identificacion,3, $nombre);
			return insertSQL($sql);
		}
	}

	function getPin($id, $pin){
		$sql="select identificacion, pin from tbl_alumno where identificacion=$id and pin='$pin'";
		return getSQL($sql);
	}
	function setPin($id,$nombre,$grado){
		$registro=NULL;
		$existe=getAlumnoIdPin($id);
		$pin=completarCeros($id,14)."2015".completarCeros($grado,2);
		if($existe){
			$sql="update tbl_alumno set
	id_grado_pin=$grado, pin='$pin' where identificacion=$id";
			//echo $sql;
			$registro=updateSQL($sql);
		}else{
			$sql="insert into tbl_alumno 
	(identificacion, nombre_alumno, id_grado_pin, pin)
	values
	($id, '$nombre', $grado, '$pin')";
			setUsuario($id,$id,3, $nombre);
			//echo $sql;
			$registro=insertSQL($sql);
		}
		echo $registro;
		if($registro!=NULL){
			return $pin;
		}else{
			return 0;
		}
			
	}

	function getAlumnoIdPin($id){
		
	$sql="select * from tbl_alumno where identificacion=$id";
	//echo $sql;
	return getSQL($sql);
		
	}
	
######################################################
######                ALUMNO                    ######
######################################################
	
	function getAlumnosColegio(){
		$sql="select * from tbl_alumno order by id_grupo, nombre_alumno asc";
		return getSQL($sql, true); 
	}
	
	function getAlumnos($grado, $grupo, $nombre, $id){
	$sql="select a.*, b.*, c.* from tbl_alumno a, tbl_grado b, tbl_grupo c where a.identificacion like '%$id%' and a.nombre_alumno like '%$nombre%'";
	if(strlen($grado)>0){
		$sql.=" and a.id_grado=$grado";
	}
	if(strlen($grupo)>0){
		$sql.=" and a.id_grupo=$grupo";
	}
	$sql.=" and a.id_grado=b.id_grado and a.id_grupo=c.id_grupo order by a.id_grupo, a.nombre_alumno asc";
	//echo $sql;
	return getSQL($sql,true);
		
	}

	function getAlumnosReimpresion(){
	$sql="select a.*, b.*, c.* from tbl_alumno a, tbl_grado b, tbl_grupo c where a.identificacion in(1069645191,
1069644651,
1070954907,
1069643823,
1016948623,
1019983957,
1070384969,
1034397333,
99082007080,
1000621732,
1003565761,
1034401831,
1003511104,
1069642045,
1003567178,
1023162804,
1019989426,
1003534360,
1000621732,
98010762367,
1070953525,
1007702218,
1072643001,
1109920884,
1000686068
)";
	$sql.=" and a.id_grado=b.id_grado and a.id_grupo=c.id_grupo order by a.id_grupo, a.nombre_alumno asc";
	//echo $sql;
	return getSQL($sql,true);
		
	}

	function getAlumnosGrupo($grupo){
		
	$sql="select a.*, b.* from tbl_alumno a, tbl_grupo b where a.id_grupo=$grupo and a.id_grupo=b.id_grupo order by a.nombre_alumno asc";
	//echo $sql;
	return getSQL($sql,true);
		
	}

	function getAlumnosGrupoCertificado($grupo,$anio){
		
	$sql="select a.*, b.*, c.* from tbl_alumno a, tbl_grado b, tbl_alumno_anio c where c.id_grado=$grupo and c.anio_lectivo=$anio and c.id_grado=b.id_grado and a.identificacion=c.identificacion order by a.nombre_alumno asc";
	//echo $sql;
	return getSQL($sql,true);
		
	}

	function getAlumnosGrado($grupo){
		
	$sql="select a.*, b.* from tbl_alumno a, tbl_grado b where a.id_grado='$grupo' and a.id_grado=b.id_grado order by a.nombre_alumno asc";
	//echo $sql;
	return getSQL($sql,true);
		
	}

	function getAlumnoId($id){
		
	$sql="select a.*, b.* from tbl_alumno a, tbl_grado b where identificacion=$id and a.id_grado=b.id_grado";
	//echo $sql;
	return getSQL($sql);
		
	}
	
	function getAlumnoBoletinId($id){
		
	$sql="select a.*, b.*, c.* from tbl_alumno a, tbl_grado b, tbl_grupo c where a.identificacion=$id and a.id_grado=b.id_grado and a.id_grupo=c.id_grupo";
	//echo $sql;
	return getSQL($sql);
		
	}
	function getAlumnoCertificadoId($id,$anio){
		
	$sql="select a.identificacion, a.nombre_alumno, a.lugar_expedicion, b.*, c.* from tbl_alumno a, tbl_grado b, tbl_alumno_anio c where c.identificacion=$id and c.anio_lectivo=$anio AND c.identificacion=a.identificacion and c.id_grado=b.id_grado";
	//echo $sql;
	return getSQL($sql);
		
	}
	
	function setAlumno($identificacion, $expedida, $nombre, $fecha, $lugar, $sangre, $seguro, $nombre_eps, $procedencia, $grado,$pension){
	
		$existe=getAlumnoId($identificacion);
		
		if($existe){
			$sql="update tbl_alumno set
	lugar_expedicion='$expedida', nombre_alumno='$nombre', fecha_nacimiento='$fecha', lugar_nacimiento='$lugar', rh='$sangre', nivel_sisben='$seguro', eps='$nombre_eps', procedencia='$procedencia', id_grado=$grado, pension=$pension
	where identificacion=$identificacion";
	//echo $sql;
			return updateSQL($sql);
		}else{
			$sql="insert into tbl_alumno 
	(identificacion, lugar_expedicion, nombre_alumno, fecha_nacimiento, lugar_nacimiento, rh, nivel_sisben, eps, procedencia, id_grado, pension)
	values
	($identificacion, '$expedida', '$nombre', '$fecha', '$lugar', '$sangre', '$seguro', '$nombre_eps', '$procedencia', $grado, $pension)";
			setUsuario($identificacion,$identificacion,3, $nombre);
			return insertSQL($sql);
		}
	}

	function updAlumnoGrupo($id,$grupo){
		$sql="update tbl_alumno set id_grupo=$grupo where identificacion=$id";
		return updateSQL($sql);
	}
	
	function delAlumno($id){
		$sql="delete from tbl_alumno where identificacion='$id'";
		return deleteSQL($sql);
	}
	
	function updValorPension($valor,$id){
		$sql="update tbl_alumno set pension=$valor where identificacion=$id";
		return updateSQL($sql);
	}
	
	function getAlumnosMatriculados($anio){
		$sql="SELECT a.identificacion, a.nombre_alumno, b.nombre_grado 
FROM tbl_alumno a, tbl_grado b, tbl_concepto_pago_alumno c 
WHERE a.identificacion=c.id_alumno AND a.id_grado=b.id_grado AND c.id_concepto_pago=8 ORDER BY a.id_grado, a.nombre_alumno ASC";
		return getSQL($sql,true);
	}

######################################################
######                Familia                   ######
######################################################

	function getFamiliarId($id){
		$sql="select * from tbl_acudiente where identificacion_acudiente=$id";
		return getSQL($sql);
	}
	
	function getAlumnoAcudiente($identificacion,$identificacion_familiar){
		$sql="select * from tbl_alumno_acudiente where 
		identificacion_alumno=$identificacion and identificacion_acudiente=$identificacion_familiar";
		return getSQL($sql);
	}

	function getAlumnosAcudiente($identificacion_familiar){
		$sql="select a.*, b.* from tbl_alumno_acudiente a, tbl_alumno b where 
		a.identificacion_acudiente=$identificacion_familiar and a.identificacion_alumno=b.identificacion";
		//echo $sql;
		return getSQL($sql,true);
	}

	function getFamiliaresAlumno($id){
		
	$sql="select a.*, b.* from tbl_acudiente a, tbl_alumno_acudiente b where b.identificacion_alumno=$id and b.identificacion_acudiente=a.identificacion_acudiente";
	//echo $sql;
	return getSQL($sql, true);
		
	}
	
	function getTelefonos($id){
		
	$sql="select a.tel_1, a.tel_2 from tbl_acudiente a, tbl_alumno_acudiente b where b.identificacion_alumno=$id and b.identificacion_acudiente=a.identificacion_acudiente";
	//echo $sql;
	return getSQL($sql, true);
		
	}
	
	function setFamiliar($identificacion,$identificacion_familiar,$nombre_familiar,$parentesco_familiar,$ocupacion_familiar,$direccion_familiar,$telefono_familiar,$celular_familiar,$correo_familiar){
	
		$existe=getFamiliarId($identificacion_familiar);
		$guardo=0;
		
		//print_r($existe);
		if($existe){
			$sql="update tbl_acudiente set
			nombre_acudiente='$nombre_familiar', parentezco='$parentesco_familiar', empresa_acudiente='$ocupacion_familiar', 
			direccion_acudiente='$direccion_familiar', tel_1='$telefono_familiar', tel_2='$celular_familiar', email_acudiente='$correo_familiar' where identificacion_acudiente=$identificacion_familiar";
			//echo $sql;
			$guardo=updateSQL($sql);
		}else{
			$sql="insert into tbl_acudiente 
	(identificacion_acudiente, nombre_acudiente, parentezco, empresa_acudiente, direccion_acudiente, tel_1, tel_2, email_acudiente)
	values
	($identificacion_familiar, '$nombre_familiar', '$parentesco_familiar', 
	'$ocupacion_familiar', '$direccion_familiar', '$telefono_familiar', '$celular_familiar', '$correo_familiar')";
			setUsuario($identificacion_familiar,$identificacion_familiar,4,"",$nombre_familiar);
			//echo $sql;
			$guardo=insertSQL($sql);
		}
		
		if($guardo==1){
			$existe_parentesco=getAlumnoAcudiente($identificacion,$identificacion_familiar);
			if($existe_parentesco){
				return true;
			}else{
				$sql_parentesco="insert into tbl_alumno_acudiente 
				(identificacion_alumno, identificacion_acudiente)
				values
				($identificacion,$identificacion_familiar)";
				return insertSQL($sql_parentesco);
			}
		}else{
			return false;
		}
	}

	function delFamiliarAlumno($id,$id_alumno){
		$sql="delete from tbl_alumno_acudiente where identificacion_acudiente='$id' and identificacion_alumno=$id_alumno";
		return deleteSQL($sql);
	}
	
######################################################
######                MODULOS                   ######
######################################################
	
	function getModulos(){
		$sql="select * from tbl_modulo order by nombre_permiso asc";
		return getSQL($sql,true);
	}
	
	function getModulosUsuario($id){
		$sql="select * from tbl_usuario_modulo where id_usuario='$id' order by id_modulo asc";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function setModuloUsuario($id,$modulo){
		$sql="insert into tbl_usuario_modulo (id_usuario, id_modulo) values ($id, $modulo)";
		//echo $sql;
		return insertSQL($sql);
	}
	
	function delModuloUsuario($id){
		$sql="delete from tbl_usuario_modulo where id_usuario='$id'";
		return deleteSQL($sql);
	}
	
######################################################
######                ENLACES                   ######
######################################################
	
	function getEnlacesModulo($id){
		$sql="select * from tbl_enlace where id_modulo='$id'";
		return getSQL($sql,true);
	}

######################################################
######            NOTICIAS/CIRCULAR             ######
######################################################

	function getNoticias(){
		$sql="select * from tbl_noticia order by id_noticia desc";
		return getSQL($sql,true);
	}

	function setNoticia($nombre,$descripcion,$posicion){
		$sql="insert into tbl_noticia (titulo,noticia,posicion) values ('$nombre','$descripcion',$posicion)";
		return insertReturnSQL($sql);
	}
	
	function delNoticia($id){
		$sql="delete from tbl_noticia where id_noticia=$id";
		return deleteSQL($sql);
	}

	function getCirculares(){
		$sql="select * from tbl_circular where tipo=0 order by id_circular desc";
		return getSQL($sql,true);
	}

	function getCirculares2(){
		$sql="select * from tbl_circular where tipo=1 order by id_circular desc";
		return getSQL($sql,true);
	}

	function getCircularesId($id){
		$sql="select a.*, b.* from tbl_circular a, tbl_grupo b where a.tipo=1 and a.emisor='$id' and a.dirigida=b.id_grupo order by a.id_circular desc";
		
		//echo $sql;
		return getSQL($sql,true);
	}

	function getCircularesTodas(){
		$sql="select a.*, b.* from tbl_circular a, tbl_grupo b where a.tipo=1 and a.dirigida=b.id_grupo order by b.id_grupo asc, a.id_circular desc";
		
		//echo $sql;
		return getSQL($sql,true);
	}

	function setCircular($tema,$dirigida,$emisor,$archivo){
		$fecha = date ( 'Y-m-d' ,strtotime ( '-5 hour' , strtotime ( date("Y-m-d H:i:s") ) ) );
		$sql="insert into tbl_circular (tema, dirigida, emisor, archivo, fecha_circular) values ('$tema','$dirigida','$emisor','$archivo','$fecha')";
		return insertReturnSQL($sql);
	}
	
	function setCircular2($tema,$dirigida,$emisor,$archivo){
		$fecha = date ( 'Y-m-d' ,strtotime ( '-5 hour' , strtotime ( date("Y-m-d H:i:s") ) ) );
		$sql="insert into tbl_circular (tema, dirigida, emisor, archivo, fecha_circular, tipo) values ('$tema','$dirigida','$emisor','$archivo','$fecha', 1)";
		return insertReturnSQL($sql);
	}
	
	function delCircular($id){
		$sql="delete from tbl_circular where id_circular=$id";
		return deleteSQL($sql);
	}

######################################################
######               CONTACTOS                  ######
######################################################

function getContactos(){
	
$sql="select * from tbl_contacto where estado=0 order by fecha asc";
//echo $sql;
return getSQL($sql,true);
	
}

function getContactoId($id){
	
$sql="select * from tbl_contacto where id_contacto=$id";
//echo $sql;
return getSQL($sql);
	
}

function setContacto($nombre,$telefono,$correo,$objeto,$msj){
	
	$fecha = date ( 'Y-m-d' ,strtotime ( '-5 hour' , strtotime ( date("Y-m-d H:i:s") ) ) );
	$sql="insert into tbl_contacto (nombre,telefono,correo,objeto,mensaje,fecha) values ('$nombre','$telefono','$correo','$objeto','$msj','$fecha')";
	return insertSQL($sql);
}

function updContacto($id){
	$sql="update tbl_contacto set estado=1 where id_contacto=$id";
	return updateSQL($sql);
}

######################################################
######                 GRADOS                   ######
######################################################

function getGrados(){
	
$sql="select * from tbl_grado order by id_grado asc";
//echo $sql;
return getSQL($sql,true);
	
}

function getGradoGrupoId($id){
	
$sql="select a.*, b.* from tbl_grado a, tbl_grupo b where a.id_grado=b.id_grado and b.id_grupo=$id";
//echo $sql;
return getSQL($sql);
	
}

function getGradoId($id){
	
$sql="select * from tbl_grado where id_grado=$id";
//echo $sql;
return getSQL($sql);
	
}

######################################################
######                 GRUPO                    ######
######################################################

function getGrupos(){
	
$sql="select a.*, b.*, c.* from tbl_grupo a, tbl_grado b, tbl_profesor c where a.id_grado=b.id_grado and a.id_profesor=c.id_profesor order by b.id_grado, a.id_grupo asc";
//echo $sql;
return getSQL($sql,true);
}

function getGruposDC($id){
	
$sql="select a.*, c.* from tbl_grupo a, tbl_profesor c where a.id_profesor=c.id_profesor and a.id_profesor=$id order by a.id_grupo asc";
//echo $sql;
return getSQL($sql,true);
}

function getGruposGrado($id){
	
$sql="select * from tbl_grupo where id_grado=$id order by id_grupo asc";
//echo $sql;
return getSQL($sql,true);
}

function getGruposProfesor($id){
	
$sql="select * from tbl_grupo where id_profesor=$id order by id_grupo asc";
//echo $sql;
return getSQL($sql,true);
}

function getGrupoId($id){
	
$sql="select * from tbl_grupo where id_grupo=$id";
//echo $sql;
return getSQL($sql);
	
}

function setGrupo($nombre,$grado,$director){
	
	$sql="insert into tbl_grupo 
	(nombre_grupo, id_grado, id_profesor)
	values
	('$nombre', $grado, $director)";
	return insertSQL($sql);
}

function updGrupo($nombre,$grado,$director, $id){
	$sql="update tbl_grupo set nombre_grupo='$nombre', id_grado=$grado, id_profesor=$director where id_grupo=$id";
	return updateSQL($sql);
}

function delGrupo($id){
	
$sql="delete from tbl_grupo where id_grupo=$id";
//echo $sql;
return deleteSQL($sql);
	
}

######################################################
######                  AREA                    ######
######################################################

function getAreas(){
	
$sql="select * from tbl_area order by nombre_area asc";
//echo $sql;
return getSQL($sql,true);
	
}

######################################################
######                PERIODO                   ######
######################################################

function getPeriodos(){
	
$sql="select * from tbl_periodo_academico where activo=1 order by id_periodo_academico asc";
//echo $sql;
return getSQL($sql,true);
	
}

function getPeriodos2(){
	
$sql="select * from tbl_periodo_academico order by id_periodo_academico asc";
//echo $sql;
return getSQL($sql,true);
	
}

function getPeriodoActivo($id){
	
$sql="select * from tbl_periodo_academico where activo=0 and id_periodo_academico=$id";
//echo $sql;
return getSQL($sql);
	
}

######################################################
######               ASIGNATURA                 ######
######################################################

function getAsignaturas(){
	
$sql="select a.*, b.* from tbl_asignatura a, tbl_area b where a.id_area=b.id_area order by id_asignatura asc";
//echo $sql;
return getSQL($sql,true);
	
}

function getAsignaturaId($id){
	
$sql="select a.*, b.* from tbl_asignatura a, tbl_area b where a.id_asignatura=$id and a.id_area=b.id_area";
//echo $sql;
return getSQL($sql);
	
}

function setAsignatura($nombre,$area){
	
	$sql="insert into tbl_asignatura 
	(nombre_asignatura, id_area)
	values
	('$nombre', $area)";
	return insertSQL($sql);
}

function updAsignatura($nombre,$area, $id){
	$sql="update tbl_asignatura set nombre_asignatura='$nombre', id_area=$area where id_asignatura=$id";
	return updateSQL($sql);
}

function delAsignatura($id){
	
$sql="delete from tbl_asignatura where id_asignatura=$id";
//echo $sql;
return deleteSQL($sql);
	
}

######################################################
######                PROFESOR                  ######
######################################################

function getProfesores(){
	
$sql="select a.*, b.* from tbl_profesor a, tbl_usuario b where a.id_profesor=b.identificacion_usuario order by a.nombre_profesor asc";
//echo $sql;
return getSQL($sql,true);
	
}

function getProfesorId($id){
	
$sql="select * from tbl_profesor where id_profesor=$id";
//echo $sql;
return getSQL($sql);
	
}

function setProfesor($id, $nombre, $tel1, $tel2, $direccion, $email){
	
	$existe=getProfesorId($id);
	if($existe){
	return updProfesor($id, $nombre, $tel1, $tel2, $direccion, $email);
	}else{
	setUsuario($id,$id,2,$nombre);
	setModuloUsuario($id,5);	
	$sql="insert into tbl_profesor 
	(id_profesor, nombre_profesor, tel_1, tel_2, direccion_profesor, email_profesor)
	values
	($id, '$nombre', '$tel1', '$tel2', '$direccion', '$email')";
	return insertSQL($sql);
	}
}

function updProfesor($id, $nombre, $tel1, $tel2, $direccion, $email){
	$sql="update tbl_profesor set nombre_profesor='$nombre', tel_1='$tel1', tel_2='$tel2', direccion_profesor='$direccion', email_profesor='$email' where id_profesor=$id";
	return updateSQL($sql);
}

function delProfesor($id){
	
$sql="delete from tbl_profesor where id_profesor=$id";
//echo $sql;
return deleteSQL($sql);
	
}

######################################################
######       REGISTRO ASIGNATURA/GRUPO          ######
######################################################

function getAsignaturasGrupoFinal($id){
	
$sql="select a.*, b.*, c.*, d.* from tbl_grupo_asignatura a, tbl_area b, tbl_grupo c, tbl_asignatura d where a.id_grupo=$id and a.id_grupo=c.id_grupo and a.id_asignatura=d.id_asignatura and d.id_area=b.id_area order by d.id_area, a.id_asignatura asc";
//die($sql);
return getSQL($sql, true);
	
}

function getAsignaturasGrupo($id, $periodo){
	
$sql="select a.*, b.*, c.*, d.*, e.* from tbl_grupo_asignatura a, tbl_area b, tbl_grupo c, tbl_asignatura d, tbl_plan_gestor e where a.id_grupo=$id and e.id_periodo_academico=$periodo and a.id_grupo=c.id_grupo and a.id_asignatura=d.id_asignatura and d.id_area=b.id_area and a.id_grupo_asignatura=e.id_grupo_asignatura order by d.id_area, a.id_asignatura asc";
//die($sql);
return getSQL($sql, true);
	
}

function getAsignaturaGrupo($grupo, $asignatura){
	$sql="select * from tbl_grupo_asignatura where id_grupo=$grupo and id_asignatura=$asignatura";
	return getSQL($sql);	
}

function getAsignaturaGrupoInforme($grupo, $director, $asignatura){
	$sql="select a.*, b.*, c.*, d.* from tbl_grupo_asignatura a, tbl_grupo b, tbl_asignatura c, tbl_profesor d where a.id_grupo=b.id_grupo and a.id_asignatura=c.id_asignatura and a.id_profesor=d.id_profesor ";
	if(strlen($grupo)>0){
		$sql.=" and a.id_grupo=$grupo ";
	}
	if(strlen($asignatura)>0){
		$sql.=" and a.id_asignatura=$asignatura ";
	}
	if(strlen($director)>0){
		$sql.=" and a.id_profesor=$director ";
	}

	$sql.=" order by d.id_profesor, b.id_grupo asc";
	return getSQL($sql, true);	
}

function getAsignaturaGrupoId($grupo_asignatura){
	$sql="select a.*, b.*, c.*, d.* from tbl_grupo_asignatura a, tbl_grupo b, tbl_asignatura c, tbl_profesor d where a.id_grupo_asignatura=$grupo_asignatura and a.id_grupo=b.id_grupo and a.id_asignatura=c.id_asignatura and a.id_profesor=d.id_profesor";
	return getSQL($sql);	
}

function getAsignaturaGrupoProfesor($profesor){
	$sql="select a.*, b.*, c.* from tbl_grupo_asignatura a, tbl_asignatura b, tbl_grupo c where a.id_profesor=$profesor and a.id_asignatura=b.id_asignatura and a.id_grupo=c.id_grupo order by a.id_grupo asc";
	return getSQL($sql,true);	
}

function setAsignaturaGrupo($grupo, $asignatura, $hora, $profesor){
	$existe=getAsignaturaGrupo($grupo, $asignatura);
	if($existe){
		return false;
	}else{
		$sql="insert into tbl_grupo_asignatura 
		(id_grupo, id_asignatura, intensidad_horaria, id_profesor)
		values
		($grupo, $asignatura, '$hora', $profesor)";
		return insertSQL($sql);
	}
}

function updAsignaturaGrupo($id, $hora, $profesor){
	$sql="UPDATE tbl_grupo_asignatura SET intensidad_horaria = $hora, id_profesor = $profesor WHERE id_grupo_asignatura = $id";
	return updateSQL($sql);
}

function updAsignaturaGrupoFinal($desc1,$desc2,$desc3,$desc4,$id){
	$sql="UPDATE tbl_grupo_asignatura SET logro_final_superior = '$desc1', logro_final_alto = '$desc2', logro_final_basico = '$desc3', logro_final_bajo = '$desc4' WHERE id_grupo_asignatura = $id";
	return updateSQL($sql);
}

	function delAsignaturaGrupo($id){
		$sql="delete from tbl_grupo_asignatura where id_grupo_asignatura=$id";
		return deleteSQL($sql);
	}

######################################################
######                PLAN GESTOR               ######
######################################################

function getPlanesGestores($grupo, $profesor, $asignatura, $periodo){
	$sql="select a.*, b.*, c.*, d.*, e.* from tbl_grupo_asignatura a, tbl_plan_gestor b, tbl_asignatura c, tbl_profesor d, tbl_grupo e where a.id_grupo_asignatura=b.id_grupo_asignatura and a.id_asignatura=c.id_asignatura and a.id_profesor=d.id_profesor and a.id_grupo=e.id_grupo ";
	if(strlen($grupo)>0){
		$sql.=" and a.id_grupo=$grupo ";
	}
	if(strlen($profesor)>0){
		$sql.=" and a.id_profesor=$profesor ";
	}
	if(strlen($asignatura)>0){
		$sql.=" and a.id_asignatura=$asignatura ";
	}
	if(strlen($periodo)>0){
		$sql.=" and b.id_periodo_academico=$periodo ";
	}
	$sql.=" order by a.id_grupo asc ";
	//echo $sql;
	return getSQL($sql,true);	
}

function getPlanGestor($grupo_asignatura, $periodo){
	$sql="select * from tbl_plan_gestor where id_grupo_asignatura=$grupo_asignatura and id_periodo_academico=$periodo";
	return getSQL($sql);	
}

function getPlanesTipo($periodo){
	$sql="SELECT a.*, b.*, c.* FROM tbl_plan_gestor a, tbl_grupo_asignatura b, tbl_asignatura c WHERE a.id_periodo_academico=$periodo AND a.id_grupo_asignatura=b.id_grupo_asignatura AND b.id_asignatura=c.id_asignatura AND c.tipo_asignatura=1";
	return getSQL($sql,true);
}

function setLogroTipo($id,$valor){
	$existe=getLogroEvaluacion($id,1);
	if($existe){
		return false;	
	}else{
	$sql="insert into tbl_logro (id_plan_gestor,logro,evaluacion) values ($id,'$valor',1)";
	return insertSQL($sql);
	}
}

function getPlanGestorGrupo($grupo){
	$sql="select a.*, b.*, c.* from tbl_grupo_asignatura a, tbl_plan_gestor b, tbl_asignatura c where a.id_grupo=$grupo and a.id_grupo_asignatura=b.id_grupo_asignatura and a.id_asignatura=c.id_asignatura order by a.id_asignatura asc";
	return getSQL($sql,true);	
}

function getPlanGestorId($id){
	$sql="select a.*, b.*, c.*, d.*, e.* from tbl_plan_gestor a, tbl_grupo_asignatura b, tbl_grupo c, tbl_asignatura d, tbl_profesor e where a.id_plan_gestor=$id and a.id_grupo_asignatura=b.id_grupo_asignatura and b.id_grupo=c.id_grupo and b.id_asignatura=d.id_asignatura and b.id_profesor=e.id_profesor";
	return getSQL($sql);	
}

function setPlanGestor($grupo_asignatura, $periodo){
	$sql="insert into tbl_plan_gestor (id_grupo_asignatura, id_periodo_academico)
		values
		($grupo_asignatura, $periodo)";
	return insertReturnSQL($sql);
}

function updPlanGestor($unidad, $competencia, $id){
	$sql="update tbl_plan_gestor set nombre_unidad='$unidad', competencia_institucional='$competencia' where id_plan_gestor=$id";
	//echo $sql;
	return updateSQL($sql);
}

function insertaPlanGestor($tabla, $campo, $valor, $id){
	$sql="insert into ".$tabla." (".$campo.", id_plan_gestor) values('$valor', $id)";
	//echo $sql;
	return insertSQL($sql);
}

function insertaLogroPlanGestor($tabla, $campo, $valor, $id, $tipo){
	$sql="insert into ".$tabla." (".$campo.", id_plan_gestor, evaluacion) values('$valor', $id, $tipo)";
	echo $sql;
	return insertSQL($sql);
}

function actualizaPlanGestor($tabla, $valor, $id){
	$sql="update tbl_".$tabla." set ".$tabla."='$valor' where id_".$tabla."=$id";
	//echo $sql;
	return updateSQL($sql);
}

function seleccionaPlanGestor($tabla, $id){
	$sql="select * from ".$tabla." where id_plan_gestor=$id";
	//echo $sql;
	return getSQL($sql, true);
}

function seleccionaLogrosPlanGestor($tabla, $id){
	$sql="select * from tbl_".$tabla." where id_plan_gestor=$id order by id_".$tabla." asc";
	//echo $sql;
	return getSQL($sql, true);
}

function seleccionaLogrosPlanGestor1($id, $evaluacion){
	$sql="select * from tbl_logro where id_plan_gestor=$id and evaluacion=$evaluacion order by id_logro asc";
	//echo $sql;
	return getSQL($sql, true);
}

function seleccionaPlanGestorId($tabla, $campo, $id){
	$sql="select * from ".$tabla." where ".$campo."=$id";
	//echo $sql;
	return getSQL($sql);
}

function delPlanGestor($tabla, $campo, $id){
	if($tabla=="tbl_logro"){
		$calificaciones=getCalificacionesLogro($id);
		if($calificaciones){
			return false;
		}
	}
	$sql="delete from ".$tabla." where ".$campo."=$id";
	//echo $sql;
	return deleteSQL($sql);
}

function delPlanGestor2($tabla, $campo, $id){
	$sql="delete from ".$tabla." where id_plan_gestor=$id";
	//echo $sql;
	return deleteSQL($sql);
}

######################################################
######            CALIFICACION LOGRO            ######
######################################################

	function getCalificacionesLogro($logro){
		$sql="select * from tbl_calificacion_logro where id_logro=$logro";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function getCalificacionLogro($logro, $alumno){
		$sql="select * from tbl_calificacion_logro where id_logro=$logro and id_alumno=$alumno";
		//echo $sql;
		return getSQL($sql);
	}
	
	function setCalificacionLogro($logro, $calificacion, $alumno){
		$desempeno="";
		if($calificacion<1){
			$desempeno="N/A";
		}elseif($calificacion>=1 && $calificacion<3.7){
			$desempeno="DB";
		}elseif($calificacion>=3.7 && $calificacion<4.3){
			$desempeno="DBS";
		}elseif($calificacion>=4.3 && $calificacion<4.8){
			$desempeno="DA";
		}elseif($calificacion>=4.8 && $calificacion<=5){
			$desempeno="DS";
		}

		$existe=getCalificacionLogro($logro, $alumno);
		if($existe){
			$sql_update="update tbl_calificacion_logro set calificacion_logro='$calificacion', desempenio_logro='$desempeno' where id_logro=$logro and id_alumno=$alumno";
			//echo $sql_update;
			return updateSQL($sql_update);
		}else{
			$sql="insert into tbl_calificacion_logro (id_alumno, id_logro, calificacion_logro, desempenio_logro)
			values
			($alumno, $logro, '$calificacion', '$desempeno')";
			//echo $sql;
			return insertSQL($sql);
		}
	}
	
	function getLogroEvaluacion($id, $evaluacion){
		$sql="select * from tbl_logro where id_plan_gestor=$id and evaluacion=$evaluacion order by id_logro desc";
		return getSQL($sql);
	}

######################################################
######        CALIFICACION ASIGNATURA           ######
######################################################

	function getCalificacionAsignaturaFinal($asignatura, $alumno,$anio){
		$sql="select * from tbl_calificacion_asignatura_final where id_asignatura=$asignatura and id_alumno=$alumno and anio_lectivo=$anio";
		//echo $sql;
		return getSQL($sql);
	}
	
	function getCalificacionAsignatura($asignatura, $alumno,$periodo){
		$sql="select * from tbl_calificacion_asignatura where id_asignatura=$asignatura and id_alumno=$alumno and id_periodo=$periodo";
		//echo $sql;
		return getSQL($sql);
	}
	
	function setCalificacionAsignaturaFinal($asignatura, $calificacion, $alumno, $anio){
		$desempeno="";
		if($calificacion<1){
			$desempeno="N/A";
		}elseif($calificacion>=1 && $calificacion<3.7){
			$desempeno="DB";
		}elseif($calificacion>=3.7 && $calificacion<4.3){
			$desempeno="DBS";
		}elseif($calificacion>=4.3 && $calificacion<4.8){
			$desempeno="DA";
		}elseif($calificacion>=4.8 && $calificacion<=5){
			$desempeno="DS";
		}
		
		$existe=getCalificacionAsignaturaFinal($asignatura, $alumno,$anio);
		if($existe){
			$sql_update="update tbl_calificacion_asignatura_final set calificacion_asignatura_final='$calificacion', desempenio_asignatura_final='$desempeno' where id_asignatura=$asignatura and id_alumno=$alumno and anio_lectivo=$anio";
			//echo $sql_update;
			return updateSQL($sql_update);
		}else{
			$sql="insert into tbl_calificacion_asignatura_final (id_alumno, id_asignatura, calificacion_asignatura_final, desempenio_asignatura_final, anio_lectivo)
			values
			($alumno, $asignatura, '$calificacion', '$desempeno', $anio)";
			//echo $sql;
			return insertSQL($sql);
		}
	}

	function setCalificacionAsignatura($asignatura, $calificacion, $alumno, $justificadas, $injustificadas,$periodo){
		$desempeno="";
		if($calificacion<1){
			$desempeno="N/A";
		}elseif($calificacion>=1 && $calificacion<3.7){
			$desempeno="DB";
		}elseif($calificacion>=3.7 && $calificacion<4.3){
			$desempeno="DBS";
		}elseif($calificacion>=4.3 && $calificacion<4.8){
			$desempeno="DA";
		}elseif($calificacion>=4.8 && $calificacion<=5){
			$desempeno="DS";
		}
		
		$existe=getCalificacionAsignatura($asignatura, $alumno,$periodo);
		if($existe){
			$sql_update="update tbl_calificacion_asignatura set calificacion_asignatura='$calificacion', horas_injustificadas=$injustificadas, horas_justificadas=$justificadas, desempenio_asignatura='$desempeno' where id_asignatura=$asignatura and id_alumno=$alumno and id_periodo=$periodo";
			//echo $sql_update;
			return updateSQL($sql_update);
		}else{
			$sql="insert into tbl_calificacion_asignatura (id_alumno, id_asignatura, calificacion_asignatura, horas_injustificadas, horas_justificadas, desempenio_asignatura, id_periodo)
			values
			($alumno, $asignatura, '$calificacion', $injustificadas, $justificadas, '$desempeno', $periodo)";
			//echo $sql;
			return insertSQL($sql);
		}
	}

	function setCalificacionAsignatura2($asignatura, $calificacion, $alumno,$periodo){
		$desempeno="";
		if($calificacion<1){
			$desempeno="N/A";
		}elseif($calificacion>=1 && $calificacion<3.7){
			$desempeno="DB";
		}elseif($calificacion>=3.7 && $calificacion<4.3){
			$desempeno="DBS";
		}elseif($calificacion>=4.3 && $calificacion<4.8){
			$desempeno="DA";
		}elseif($calificacion>=4.8 && $calificacion<=5){
			$desempeno="DS";
		}
		
		$existe=getCalificacionAsignatura($asignatura, $alumno,$periodo);
		if($existe){
			$sql_update="update tbl_calificacion_asignatura set calificacion_asignatura='$calificacion', desempenio_asignatura='$desempeno' where id_asignatura=$asignatura and id_alumno=$alumno and id_periodo=$periodo";
			//echo $sql_update;
			return updateSQL($sql_update);
		}else{
			$sql="insert into tbl_calificacion_asignatura (id_alumno, id_asignatura, calificacion_asignatura, desempenio_asignatura, id_periodo)
			values
			($alumno, $asignatura, '$calificacion', '$desempeno', $periodo)";
			//echo $sql;
			return insertSQL($sql);
		}
	}

	function getPuntajeAlumno($alumno,$periodo,$anio){
		$sql="select * from tbl_puntaje_alumno where id_alumno=$alumno and id_periodo=$periodo and anio_lectivo=$anio";
		return getSQL($sql);
	}

	function setPuntajeAlumno($alumno,$puntaje_alumno,$periodo,$anio){
		$exixte=getPuntajeAlumno($alumno,$periodo,$anio);
		if($exixte){
			$sql="update tbl_puntaje_alumno set puntaje_total=$puntaje_alumno where id_puntaje_alumno=".$exixte['id_puntaje_alumno'];
			return updateSQL($sql);
		}else{
			$sql="insert into tbl_puntaje_alumno (id_alumno, puntaje_total, id_periodo, anio_lectivo) values ($alumno,$puntaje_alumno,$periodo,$anio)";
			return insertSQL($sql);
		}
	}
	
	function getAlumnosGrupoPuesto($grupo,$periodo,$anio){
		
	$sql="select a.identificacion, a.id_grupo, b.id_grupo, c.* from tbl_alumno a, tbl_grupo b, tbl_puntaje_alumno c where a.id_grupo=$grupo and a.id_grupo=b.id_grupo and a.identificacion=c.id_alumno and c.id_periodo=$periodo and c.anio_lectivo=$anio order by c.puntaje_total desc";
	echo $sql;
	return getSQL($sql,true);
		
	}

	function getAlumnosGrupoPuesto2($grupo,$periodo,$anio){
		
	$sql="select a.identificacion, a.nombre_alumno, a.id_grupo, b.id_grupo, c.* from tbl_alumno a, tbl_grupo b, tbl_puntaje_alumno c where a.id_grupo=$grupo and a.id_grupo=b.id_grupo and a.identificacion=c.id_alumno and c.id_periodo=$periodo and c.anio_lectivo=$anio order by c.puntaje_total desc limit 5";
	//echo $sql;
	return getSQL($sql,true);
		
	}

	function updAlumnoPuesto($alumnos_puesto,$puesto,$anio,$periodo){
		$sql="update tbl_puntaje_alumno set puesto_alumno=$puesto where id_puntaje_alumno=$alumnos_puesto and anio_lectivo=$anio and id_periodo=$periodo";
		//die($sql);
		return updateSQL($sql);
	}
	
	function getDesempenio_perdido($alumno){
		$sql="select a.*, b.* from tbl_desempenio_perdido a, tbl_asignatura b where a.id_alumno=$alumno and a.id_asignatura=b.id_asignatura and a.superado=0 order by a.id_asignatura asc";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function getDesempenio_perdido2($alumno){
		$sql="select a.*, b.*, c.* from tbl_desempenio_perdido a, tbl_asignatura b, tbl_logro c where a.id_alumno=$alumno and a.id_asignatura=b.id_asignatura and a.id_logro=c.id_logro and a.superado=0 order by a.id_asignatura asc";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function actualizaDesempenioPerdido($id){
		$sql="update tbl_desempenio_perdido set superado=1 where id_desempenio_perdido=$id";
		//echo $sql;
		return updateSQL($sql);
	}
	
	function getDesempenioPerdidoGrupo($asignatura, $grupo){
		$sql="select a.*, b.*, c.*, d.* from tbl_desempenio_perdido a, tbl_asignatura b, tbl_logro c, tbl_alumno d where a.id_asignatura=$asignatura and d.id_grupo=$grupo and a.superado=0 and a.id_asignatura=b.id_asignatura and a.id_logro=c.id_logro and a.id_alumno=d.identificacion order by d.nombre_alumno asc";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function setDesempenioBasico($alumno,$asignatura,$logro){
		$sql_select="select * from tbl_desempenio_perdido where id_alumno=$alumno and id_logro=$logro";
		$existe=getSQL($sql_select);
		if($existe){
			return true;
		}else{
			$sql="insert into tbl_desempenio_perdido (id_alumno,id_asignatura,id_logro) values ($alumno,$asignatura,$logro)";
			return insertSQL($sql);
		}
	}

######################################################
######            LOGRO CASO ESPECIAL           ######
######################################################

	function getAlumnosCasoEspecial(){
		$sql="select a.*, b.*, c.*, d.* from tbl_alumno_logro_caso_especial a, tbl_alumno b, tbl_logro_caso_especial c, tbl_grupo d where a.id_alumno=b.identificacion and a.id_logro_caso_especial=c.id_logro_caso_especial and b.id_grupo=d.id_grupo group by b.id_grupo, b.identificacion asc";
		return getSQL($sql,true);
	}
	
	function getLogrosCasoEspecialId($id){
		$sql="select a.*, b.*, c.* from tbl_alumno_logro_caso_especial a, tbl_alumno b, tbl_logro_caso_especial c where a.id_alumno=$id and a.id_alumno=b.identificacion and a.id_logro_caso_especial=c.id_logro_caso_especial order by c.tipo_logro_caso_especial, c.logro_caso_especial asc";
		//die($sql);
		return getSQL($sql,true);
	}
	
	function getLogrosCasoEspecialId2($id){
		$sql="select a.*, b.*, c.* from tbl_alumno_logro_caso_especial a, tbl_alumno b, tbl_logro_caso_especial c where a.id_alumno=$id and a.id_alumno=b.identificacion and a.id_logro_caso_especial=c.id_logro_caso_especial and c.tipo_logro_caso_especial=3 order by c.tipo_logro_caso_especial, c.logro_caso_especial asc";
		//die($sql);
		return getSQL($sql,true);
	}
	
	function getRecomendacionesCasoEspecialId($id){
		$sql="select a.*, b.*, c.* from tbl_alumno_recomendacion_caso_especial a, tbl_alumno b, tbl_recomendacion_caso_especial c where a.id_alumno=$id and a.id_alumno=b.identificacion and a.id_recomendacion_caso_especial=c.id_recomendacion_caso_especial order by c.recomendacion_caso_especial asc";
		//die($sql);
		return getSQL($sql,true);
	}
	
	function getLogrosCasoEspecial(){
		$sql="select * from tbl_logro_caso_especial order by tipo_logro_caso_especial, logro_caso_especial asc";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function setAlumnoCasoEspecial($alumno, $id_logro_caso_especial){
		$sql="insert into tbl_alumno_logro_caso_especial (id_alumno, id_logro_caso_especial) values ($alumno, $id_logro_caso_especial)";
		return insertSQL($sql);
	}

	function setAlumnoCasoEspecialPersonal($alumno, $dificultad){
		$sql="insert into tbl_logro_caso_especial (logro_caso_especial) values ('$dificultad')";
		$guarda=insertReturnSQL($sql);
		if($guarda){
			return setAlumnoCasoEspecial($alumno,$guarda);
		}else{
			return false;
		}
	}

	function setAlumnoRecomendacionCasoEspecial($alumno, $recomendacion){
		$sql="insert into tbl_recomendacion_caso_especial (recomendacion_caso_especial) values ('$recomendacion')";
		$guarda=insertReturnSQL($sql);
		if($guarda){
			$sql="insert into tbl_alumno_recomendacion_caso_especial (id_alumno, id_recomendacion_caso_especial) values ($alumno, $guarda)";
			return insertSQL($sql);
		}else{
			return false;
		}
	}

	function delAlumnoCasoEspecial($alumno){
		$sql="delete from tbl_alumno_logro_caso_especial where id_alumno=$alumno";
		//echo $sql;
		return deleteSQL($sql);
	}
	
	function delAlumnoCasoEspecialPersonal($id, $alumno){
		$sql="delete from tbl_alumno_logro_caso_especial where id_alumno=$alumno and id_logro_caso_especial=$id";
		//echo $sql;
		$elimina=deleteSQL($sql);
		if($elimina){
			$sql="delete from tbl_logro_caso_especial where id_logro_caso_especial=$id";
			return deleteSQL($sql);
		}else{
			return false;
		}
	}
	
	function delAlumnoRecomendacionCasoEspecial($id, $alumno){
		$sql="delete from tbl_alumno_recomendacion_caso_especial where id_alumno=$alumno and id_recomendacion_caso_especial=$id";
		//echo $sql;
		$elimina=deleteSQL($sql);
		if($elimina){
			$sql="delete from tbl_recomendacion_caso_especial where id_recomendacion_caso_especial=$id";
			return deleteSQL($sql);
		}else{
			return false;
		}
	}
	
/*	function setCalificacionLogro($logro, $calificacion, $alumno){
		$desempeno="";
		if($calificacion<1){
			$desempeno="N/A";
		}elseif($calificacion>=1 && $calificacion<3.7){
			$desempeno="DB";
		}elseif($calificacion>=3.7 && $calificacion<4.3){
			$desempeno="DBS";
		}elseif($calificacion>=4.3 && $calificacion<4.8){
			$desempeno="DA";
		}elseif($calificacion>=4.8 && $calificacion<=5){
			$desempeno="DS";
		}

		$existe=getCalificacionLogro($logro, $alumno);
		if($existe){
			$sql_update="update tbl_calificacion_logro set calificacion_logro='$calificacion', desempenio_logro='$desempeno' where id_logro=$logro and id_alumno=$alumno";
			//echo $sql_update;
			return updateSQL($sql_update);
		}else{
			$sql="insert into tbl_calificacion_logro (id_alumno, id_logro, calificacion_logro, desempenio_logro)
			values
			($alumno, $logro, '$calificacion', '$desempeno')";
			//echo $sql;
			return insertSQL($sql);
		}
	}
*/
######################################################
######            PLAN ENTRENAMIENTO            ######
######################################################
	
	function getPlanesEntrenamiento(){
		$sql="select * from tbl_plan_entrenamiento";
		return getSQL($sql,true);
	}
	
	function getPlanEntrenamientoId($id){
		$sql="select a.*, b.*, d.* from tbl_plan_entrenamiento a, tbl_grupo_asignatura b, tbl_grupo c, tbl_asignatura d where a.id_plan_entrenamiento=$id and a.id_grupo_asignatura=b.id_grupo_asignatura and b.id_grupo=c.id_grupo and b.id_asignatura=d.id_asignatura";
		//echo $sql;
		return getSQL($sql);
	}
	
	function getPlanEntrenamientoFecha($fecha){
		$sql="select * from tbl_plan_entrenamiento where fecha_plan='$fecha'";
		//echo $sql;
		return getSQL($sql);
	}
	
	function getPlanesEntrenamientoGrupo($grupo){
		$sql="select * from tbl_plan_entrenamiento where id_grupo_asignatura=$grupo order by fecha_plan desc";
		return getSQL($sql,true);
	}
	
	function getPlanesEntrenamientoGrupoAlumno($grupo){
		$sql="select a.*, b.*, c.*, d.* from tbl_plan_entrenamiento a, tbl_grupo_asignatura b, tbl_grupo c, tbl_asignatura d where b.id_grupo=$grupo and a.id_grupo_asignatura=b.id_grupo_asignatura and b.id_asignatura=d.id_asignatura and b.id_grupo=c.id_grupo order by a.fecha_plan desc";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function setPlanAlumno($alumno, $id){
		$sql="insert into tbl_plan_alumno 
	(id_plan, id_alumno)
	values
	($id, $alumno)";
		return insertSQL($sql);
	}

	function setPlanEntrenamiento($id_grupo, $fecha_plan, $tiempo, $elementos, $objetivo, $observaciones){

			$sql="insert into tbl_plan_entrenamiento (id_grupo_asignatura, fecha_plan, tiempo, elementos, objetivo, observaciones)
				values
				($id_grupo, '$fecha_plan', '$tiempo', '$elementos', '$objetivo', '$observaciones')";
				//echo $sql;
			return insertReturnSQL($sql);
	}
	
	function updPlanEntrenamiento($id_plan, $fecha_plan, $tiempo, $elementos, $objetivo, $observaciones){
		$sql="update tbl_plan_entrenamiento set fecha_plan='$fecha_plan', tiempo='$tiempo', elementos='$elementos', objetivo='$objetivo', observaciones='$observaciones' where id_plan_entrenamiento=$id_plan";
		return updateSQL($sql);		
	}
	
	function delPlanEntrenamiento($id){
		$sql="delete from tbl_plan_entrenamiento where id_plan_entrenamiento=$id";
		$elimina=deleteSQL($sql);
		if($elimina){
			$sql_elimina="delete from tbl_ejercicio where id_plan_entrenamiento=$id";
			return deleteSQL($sql_elimina);
		}else{
			return false;
		}
	}

######################################################
######       EJERCICIOS PLAN ENTRENAMIENTO      ######
######################################################

	function getEjerciciosPlan($id){
		$sql="select * from tbl_ejercicio where id_plan_entrenamiento=$id order by id_ejercicio asc";
		return getSQL($sql,true);
	}
	
	function setEjercicio($nombre_ejercicio, $descripcion_ejercicio, $id_plan_entrenamiento, $enlace){
		$sql="insert into tbl_ejercicio 
	(nombre_ejercicio, descripcion_ejercicio, id_plan_entrenamiento, enlace)
	values
	('$nombre_ejercicio', '$descripcion_ejercicio', $id_plan_entrenamiento, '$enlace')";
		//echo $sql;
		return insertReturnSQL($sql);
	}
	
	function setEjercicioArchivo($nombre_ejercicio, $descripcion_ejercicio, $id_plan_entrenamiento, $archivo, $enlace){
		$sql="insert into tbl_ejercicio 
	(nombre_ejercicio, descripcion_ejercicio, id_plan_entrenamiento, archivo, enlace)
	values
	('$nombre_ejercicio', '$descripcion_ejercicio', $id_plan_entrenamiento, '$archivo', '$enlace')";
		//echo $sql;
		return insertReturnSQL($sql);
	}
	
	function updEjercicio($id, $nombre_ejercicio, $descripcion_ejercicio){
		$sql="update tbl_ejercicio set nombre_ejercicio='$nombre_ejercicio', descripcion_ejercicio='$descripcion_ejercicio' where id_ejercicio=$id";
		return updateSQL($sql);
	}
	
	function delEjercicio($id){
		$sql="delete from tbl_ejercicio where id_ejercicio=$id";
		return deleteSQL($sql);
	}
	
######################################################
######                 Conceptos                ######
######################################################

	function getConceptosPago(){
		
		$sql="select * from tbl_concepto_pago where tipo_concepto!=1 order by nombre_concepto_pago asc";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function getConceptosPago2(){
		
		$sql="select * from tbl_concepto_pago order by nombre_concepto_pago asc";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function getConceptoMatricula(){
		
		$sql="select * from tbl_concepto_pago where tipo_concepto=1 order by nombre_concepto_pago asc";
		//echo $sql;
		return getSQL($sql);
	}
	
	function getConceptoMatricula2(){
		
		$sql="select * from tbl_concepto_pago where tipo_concepto=2 order by nombre_concepto_pago asc";
		//echo $sql;
		return getSQL($sql);
	}
	
	function getConceptoId($id_concepto_pago){
		
		$sql="select * from tbl_concepto_pago where id_concepto_pago=$id_concepto_pago";
		//echo $sql;
		return getSQL($sql);
	}
	
	function setConceptoPago($nombre_concepto,$valor_concepto){
	
		$sql="insert into tbl_concepto_pago 
	(nombre_concepto_pago, valor_concepto_pago)
	values
	('$nombre_concepto',$valor_concepto)";
		return insertSQL($sql);
	}
 	
	function updConceptoPago($nombre_concepto, $valor_concepto, $id_concepto_pago){
	
		$sql="update tbl_concepto_pago set nombre_concepto_pago='$nombre_concepto', valor_concepto_pago=$valor_concepto where id_concepto_pago=$id_concepto_pago";
		//echo $sql;
		return updateSQL($sql);
	}
	
	function delConceptoPago($id_concepto_pago){
		
		$sql="delete from tbl_concepto_pago where id_concepto_pago=$id_concepto_pago";
		return deleteSQL($sql);	
	}

	function getConceptosPagados($fechaini,$fechafin,$id,$nombre="",$concepto,$factura, $grupo){
		
		if(strlen($fechaini)<10){
			$fechaini="0000-00-00";
		}
		if(strlen($fechafin)<10){
			$fechafin=date("Y-m-d");
		}
		
	
		$sql="select a.*, b.nombre_concepto_pago, b.tipo_concepto, c.id_factura, c.fecha_pago, c.valor_pago, d.identificacion, d.nombre_alumno, e.nombre_grado from tbl_concepto_pago_alumno a, tbl_concepto_pago b, tbl_factura c, tbl_alumno d, tbl_grado e where a.estado_concepto_pago=1 and c.tipo_pago=1 and a.id_concepto_pago=b.id_concepto_pago and a.factura=c.id_factura and a.id_alumno=d.identificacion and d.id_grado=e.id_grado and c.fecha_pago between '$fechaini' and '$fechafin' and a.id_alumno like '%$id%' and d.nombre_alumno like '%$nombre%' and a.factura like '%$factura%' ";
		if($concepto>0){
		$sql.=" and a.id_concepto_pago=$concepto ";
		}
		$sql.=" and d.id_grupo like '%$grupo%' and c.estado=1 order by a.factura asc";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function getConceptosOtros($fechaini,$fechafin,$id,$nombre="",$concepto,$factura, $grupo){
		
		if(strlen($fechaini)<10){
			$fechaini="0000-00-00";
		}
		if(strlen($fechafin)<10){
			$fechafin=date("Y-m-d");
		}
		
	
		$sql="select a.*, b.* from tbl_pago_otros a, tbl_factura b where b.tipo_pago=3 and a.id_factura=b.id_factura and b.fecha_pago between '$fechaini' and '$fechafin' and b.estado=1 order by a.id_factura asc";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function getConceptosConsignados($fechaini,$fechafin,$id,$nombre="",$concepto,$factura, $grupo){
		
		if(strlen($fechaini)<10){
			$fechaini="0000-00-00";
		}
		if(strlen($fechafin)<10){
			$fechafin=date("Y-m-d");
		}
		
	
		$sql="select a.*, b.nombre_concepto_pago, b.tipo_concepto, c.id_factura, c.fecha_pago, c.valor_pago, d.identificacion, d.nombre_alumno, e.nombre_grado from tbl_concepto_pago_alumno a, tbl_concepto_pago b, tbl_factura c, tbl_alumno d, tbl_grado e where a.estado_concepto_pago=1 and c.tipo_pago=2 and a.id_concepto_pago=b.id_concepto_pago and a.factura=c.id_factura and a.id_alumno=d.identificacion and d.id_grado=e.id_grado and c.fecha_pago between '$fechaini' and '$fechafin' and a.id_alumno like '%$id%' and d.nombre_alumno like '%$nombre%' and a.factura like '%$factura%' ";
		if($concepto>0){
		$sql.=" and a.id_concepto_pago=$concepto ";
		}
		$sql.=" and d.id_grupo like '%$grupo%' and c.estado=1 order by a.factura asc";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function getConceptosPagadosInforme($fechaini,$fechafin,$id,$nombre="",$concepto,$factura, $grupo){
		
		if(strlen($fechaini)<10){
			$fechaini="0000-00-00";
		}
		if(strlen($fechafin)<10){
			$fechafin=date("Y-m-d");
		}
		
	
		$sql="select a.*, b.*, c.*, d.* from tbl_concepto_pago_alumno a, tbl_concepto_pago b, tbl_factura c, tbl_alumno d where a.estado_concepto_pago=1 and b.tipo_concepto!=6 and a.id_concepto_pago=b.id_concepto_pago and a.factura=c.id_factura and a.id_alumno=d.identificacion and c.fecha_pago between '$fechaini' and '$fechafin' and a.id_alumno like '%$id%' and d.nombre_alumno like '%$nombre%' and a.factura like '%$factura%' and a.id_concepto_pago like '%$concepto%' and d.id_grupo like '%$grupo%' c.estado=1 order by a.factura asc";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function getConceptosAlumnoPendientes($alumno_pago){
	
		$sql="select a.*, b.* from tbl_concepto_pago_alumno a, tbl_concepto_pago b where a.id_alumno=$alumno_pago and a.estado_concepto_pago=0 and a.id_concepto_pago=b.id_concepto_pago";
		
		return getSQL($sql,true);
	}
	
	function getConceptosAlumnoPendientesPago(){
	
		$sql="select a.*, b.*, c.*, d.* from tbl_concepto_pago_alumno a, tbl_concepto_pago b, tbl_alumno c, tbl_grupo d where a.estado_concepto_pago=0 and a.id_concepto_pago=b.id_concepto_pago and a.id_alumno=c.id_alumno and c.id_grupo=d.id_grupo order by d.id_grupo asc";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function getConceptosAlumnoPagados($alumno_pago){
	
		$sql="select a.*, b.*, c.* from tbl_concepto_pago_alumno a, tbl_concepto_pago b, tbl_factura c where a.id_alumno=$alumno_pago and a.estado_concepto_pago=1 and a.id_concepto_pago=b.id_concepto_pago and a.factura=c.id_factura and c.estado=1 order by a.factura desc";
		//echo $sql;
		return getSQL($sql,true);
	}
	
	function setConceptoPagoAlumno($alumno_pago,$concepto_pago,$valor){
	
		$fecha = date ( 'Y-m-d' ,strtotime ( '-5 hour' , strtotime ( date("Y-m-d H:i:s") ) ) );
		$sql="insert into tbl_concepto_pago_alumno 
	(id_alumno, id_concepto_pago, fecha_facturado, valor_pagar)
	values
	($alumno_pago, $concepto_pago, '$fecha', $valor)";
	//echo $sql;
		return insertSQL($sql);
	}
	
	function setPension($alumno_pago,$valor,$periodo,$id_concepto){
	
		$fecha = date ( 'Y-m-d' ,strtotime ( '-5 hour' , strtotime ( date("Y-m-d H:i:s") ) ) );
		$sql="insert into tbl_concepto_pago_alumno 
	(id_alumno, id_concepto_pago, fecha_facturado, valor_pagar, periodo_facturado)
	values
	($alumno_pago, $id_concepto, '$fecha', $valor, '$periodo')";
	//echo $sql;
		return insertSQL($sql);
	}
	
	function setConsignacionAlumno($alumno_pago,$concepto_pago,$valor,$fecha_consignacion,$descripcion){
		$fecha = date ( 'Y-m-d' ,strtotime ( '-5 hour' , strtotime ( date("Y-m-d H:i:s") ) ) );
		$sql="insert into tbl_concepto_pago_alumno 
	(id_alumno, id_concepto_pago, fecha_facturado, valor_pagar, fecha_consignacion, descripcion_consignacion)
	values
	($alumno_pago, $concepto_pago, '$fecha', $valor, '$fecha_consignacion', '$descripcion')";
	//echo $sql;
		return insertSQL($sql);
	}
	
	function updConceptoPagoAlumno($id_concepto_pago_alumno,$id_factura,$valor_cancelado,$descuento,$saldo,$id_concepto_pago,$alumno){
		
		$diferencia=$saldo-($valor_cancelado+$descuento);
		//echo "saldo:".$saldo." diferencia:".$diferencia;
		if($diferencia<=0){
			//pago total
		}else{
			//queda_saldo
			setConceptoPagoAlumno($alumno, $id_concepto_pago, $diferencia);
		}
		
		$sql="update tbl_concepto_pago_alumno set estado_concepto_pago=1, factura=$id_factura, valor_cancelado=$valor_cancelado, descuento=$descuento where id_concepto_pago_alumno=$id_concepto_pago_alumno";
		//echo $sql;	
		return updateSQL($sql);
	}
	
	function setConceptoPagoPension($id_concepto_pago_alumno,$id_factura,$valor_cancelado,$descuento,$saldo,$id_concepto_pago,$alumno,$periodo){
		//echo "****************".$periodo;
		$diferencia=$saldo-($valor_cancelado+$descuento);
		//echo "saldo:".$saldo." diferencia:".$diferencia;
		if($diferencia<=0){
			//pago total
		}else{
			//queda_saldo
			setPension($alumno,$diferencia,$periodo,$id_concepto_pago);
		}
		
		$sql="update tbl_concepto_pago_alumno set estado_concepto_pago=1, factura=$id_factura, valor_cancelado=$valor_cancelado, descuento=$descuento where id_concepto_pago_alumno=$id_concepto_pago_alumno";
		//echo $sql;	
		return updateSQL($sql);
	}
	
	function delConceptoPagoAlumno($id_concepto_pago_alumno){
		
		$sql="delete from tbl_concepto_pago_alumno where id_concepto_pago_alumno=$id_concepto_pago_alumno";
		return deleteSQL($sql);	
	}
	
	function getPagoOtrosId($id){
		$sql="select a.*, b.* from tbl_pago_otros a, tbl_factura b where a.id_factura=b.id_factura and a.id_factura=$id";
		//echo $sql;
		return getSQL($sql);
	}
	
	function setPagoOtros($id_pago,$nombre_pago,$concepto_pago,$valor_pago,$observaciones_pago,$user_id){
		$sql="INSERT INTO tbl_pago_otros 
	(identificacion,	nombre, concepto, valor, obsevacines, usuario)
	VALUES
($id_pago,'$nombre_pago','$concepto_pago',$valor_pago,'$observaciones_pago',$user_id)";
//echo $sql;
		return insertReturnSQL($sql);
	}
	
	function updPagoOtros($id,$fact){
		$sql="update tbl_pago_otros set id_factura=$fact where id_pago_otros=$id";
		return updateSQL($sql);	
	}
######################################################
######                 Gasto                    ######
######################################################
	
	function setGasto($nombre_gasto,$valor_gasto,$observaciones_gasto,$user_id){
	
		$fecha = date ( 'Y-m-d' ,strtotime ( '-5 hour' , strtotime ( date("Y-m-d H:i:s") ) ) );
		$sql="insert into tbl_gasto 
	(nombre_gasto, valor_gasto, fecha_gasto, descripcion_gasto, id_usuario)
	values
	('$nombre_gasto',$valor_gasto,'$fecha','$observaciones_gasto',$user_id)";
		return insertSQL($sql);
	}

	function getGastos($fechaini,$fechafin){
		
		$sql="select * from tbl_gasto where fecha_gasto between '$fechaini' and '$fechafin'";
		return getSQL($sql,true);
	}
	
	function delGasto($id){
		$sql="delete from tbl_gasto where id_gasto=$id";
		return deleteSQL($sql); 
	}
######################################################
######                Factura                   ######
######################################################
	
	function setFactura($user_id,$alumno_pago,$tipo){
		
		$fecha = date ( 'Y-m-d' ,strtotime ( '-5 hour' , strtotime ( date("Y-m-d H:i:s") ) ) );
		$sql="insert into tbl_factura (fecha_pago, id_usuario, id_alumno, tipo_pago)values('$fecha', $user_id, $alumno_pago, $tipo)";
		//die($sql);
		return insertReturnSQL($sql);
	}
	
	function updTotalFactura($id, $valor){
		$sql="update tbl_factura set valor_pago=$valor where id_factura=$id";
		return updateSQL($sql);	
	}

	function getDatosFactura($id){
		
		$sql="select a.*, b.*, c.* from tbl_factura a, tbl_concepto_pago_alumno b, tbl_concepto_pago c where a.id_factura=b.factura and b.id_concepto_pago=c.id_concepto_pago and a.id_factura=$id";
		//die($sql);
		return getSQL($sql,true);
	}
	
	function updEstadoFactura($id, $estado){
		$sql="update tbl_factura set estado=$estado where id_factura=$id";
		//echo $sql;
		return updateSQL($sql);	
	}
	
######################################################
######                Comunicado                ######
######################################################
	
	function getComunicados($id){
		$sql="select * from tbl_comunicado where id_usuario=$id";
		return getSQL($sql,true);
	}
	
 	function getComunicadosAlumno($alumno){
		$sql="select a.*, b.* from tbl_comunicado_alumno a, tbl_comunicado b where a.id_alumno=$alumno and a.id_comunicado=b.id_comunicado";
		//echo $sql;
		return getSQL($sql,true);
	}

 	function getComunicadosAdmin($alumno){
		$sql="select a.*, b.* from tbl_comunicado_admin a, tbl_comunicado b where a.id_admin=$alumno and a.id_comunicado=b.id_comunicado";
		//echo $sql;
		return getSQL($sql,true);
	}

	function getComunicadoId($id){
		$sql="select * from tbl_comunicado where id_comunicado=$id";
		return getSQL($sql);
	}
	
	function setComunicado($asunto,$contenido,$id){
		$fecha = date ( 'Y-m-d' ,strtotime ( '-5 hour' , strtotime ( date("Y-m-d H:i:s") ) ) );
		$sql="insert into tbl_comunicado 
	(asunto, comunicado, fecha, id_usuario)
	values
	('$asunto', '$contenido', '$fecha', $id)";
		return insertReturnSQL($sql);
	}
	
	function setComunicadoAlumno($alumno, $id){
		$sql="insert into tbl_comunicado_alumno 
	(id_comunicado, id_alumno)
	values
	($id, $alumno)";
	//echo $sql;
		return insertSQL($sql);
	}

	function setComunicadoAdmin($alumno, $id){
		$sql="insert into tbl_comunicado_admin 
	(id_comunicado, id_admin)
	values
	($id, $alumno)";
		return insertSQL($sql);
	}

	function delComunicado($id){
		$sql="delete from tbl_comunicado where id_comunicado=$id";
		$elimina=deleteSQL($sql);
		if($elimina){
			$sql_alumnos="delete from tbl_comunicado_alumno where id_comunicado=$id";
			return deleteSQL($sql_alumnos);
		}else{
			return false;
		}
	}
	
######################################################
######              Recomendaciones             ######
######################################################

function getRecomendaciones(){
	$sql="select * from tbl_recomendacion where tipo_recomendacion=1 order by id_recomendacion asc";
	return getSQL($sql,true);
}

function getRecomendacionesAlumno($id, $id_plan){
	$sql="select a.*, b.* from tbl_recomendacion_alumno a, tbl_recomendacion b where a.id_alumno=$id and a.id_plan_gestor=$id_plan and a.id_recomendacion=b.id_recomendacion order by a.id_recomendacion asc";
	//echo $sql;
	return getSQL($sql,true);
}

function setRecomendacionAlumno($recomendacion, $alumno, $plan){
	$sql="insert into tbl_recomendacion_alumno (id_recomendacion, id_alumno, id_plan_gestor) values ($recomendacion, $alumno, $plan)";
	//echo $sql;
	return insertSQL($sql);
}

function setRecomendacion($recomendacion){
	$sql="insert into tbl_recomendacion (recomendacion, tipo_recomendacion) values ('$recomendacion', 2)";
	//echo $sql;
	return insertReturnSQL($sql);
}

function getEstadoEnlace($id){
	$sql="select * from tbl_estado_enlace where id_estado_enlace=$id";
	return getSQL($sql);
}

######################################################
######                 Promocion                ######
######################################################

function setPromocionAlumno($alumno,$promocion,$anio,$grado){

	$existe=getPromocionAlumno($alumno,$anio);
	if($existe){
		$sql="update tbl_promocion_alumno set promocion_alumno=$promocion where id_alumno=$alumno and anio_lectivo=$anio";
//		echo $sql;
		return updateSQL($sql);
	}else{
		$sql="insert into tbl_promocion_alumno (id_alumno, promocion_alumno, anio_lectivo, id_grado) values ($alumno,$promocion,$anio,$grado)";
//		echo $sql;
		return insertSQL($sql);
	}	
}

function getPromocionAlumno($alumno,$anio){

	$sql="Select * from tbl_promocion_alumno where id_alumno=$alumno and anio_lectivo=$anio";
//		echo $sql;
	return getSQL($sql);
}

////////////////////////////////////////////////

	function getConsecutivo($id){
		
		$sql="select * from tbl_consecutivo where id_consecutivo=$id";
		//echo $sql;
		return getSQL($sql);
	}
	
	function updConsecutivo($id, $consecutivo){
	
		$sql="update tbl_consecutivo set consecutivo=$consecutivo where id_consecutivo=$id";
		//echo $sql;
		return updateSQL($sql);
	}
?>