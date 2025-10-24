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

?>