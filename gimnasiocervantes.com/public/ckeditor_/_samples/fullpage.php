<?
session_start();

include_once("../../../funciones/funciones.php");
include_once("../../../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$nombre=NULL;
$descripcion=NULL;
$descripcion_url=NULL;
$nombre_enlace_principal=NULL;
$tipo_contenido_enlace=NULL;
$img_enlace=NULL;
$action="valida_guardar_contenido_enlace";

//entra cuando el formulario viene por post para insersion de un nuevo contenido
if($_POST['actualiza_contenido_enlace']==1){

	//die("Entro!!!".$_POST['descripcion']);
	if($_POST['tipo_contenido_enlace']==1){
		$inserta=setContenidoEnlace($_POST['nombre'],$_POST['descripcion_url'], $_SESSION['id_enlace_principal'],$_POST['tipo_contenido_enlace'], $_POST['img']);
		if($inserta){
			echo "<script>alert('Los datos se guardaron correctamente...');</script>";
		}else{
			echo "<script>alert('No se guardaron correctamente los datos...');</script>";
		}
	}elseif($_POST['tipo_contenido_enlace']==2){
		/////////////////////////////////////////////////////////////////////////
		
			if($_FILES['descripcion_archivo']['name']!=''){
				echo "<center><br><br><br><br><h1>Validando la imagen.<br><br>Espere un momento<br>Gacias...</h1></center>";
					$nombre = $_FILES['descripcion_archivo']['name'];
					$tipo = $_FILES['descripcion_archivo']['type'];
					$tamano = $_FILES['descripcion_archivo']['size'];
					//die("**************".$tamano);
					if($tamano>6000001){
						echo "<script>alert('El archivo es demaciado grande...');window.location.href='principal_admin.php';</script>";
					}else{
						if(is_dir("../../../aplicacion/doc/".$_SESSION['id_enlace_principal'])){
						   //die ('esta!'."../aplicacion/img/".$_SESSION["sitio"]);
						}else{
						   //die ('no esta!');
						   mkdir("../../../aplicacion/doc/".$_SESSION['id_enlace_principal']."/",0777);
						}
		
						$imagen = $_FILES['descripcion_archivo']['tmp_name'];
						$nombre_imagen_asociada = $_SESSION['id_enlace_principal'].$nombre;
						$directorio="../../../aplicacion/doc/".$_SESSION['id_enlace_principal']."/";
						$guardado=copy($_FILES['descripcion_archivo']['tmp_name'],$directorio.$nombre);
						//$guardado=redimensionar_imagen($imagen, $nombre_imagen_asociada,$directorio);
		
						if($guardado){
							$inserta=setContenidoEnlace($_POST['nombre'],$nombre, $_SESSION['id_enlace_principal'],$_POST['tipo_contenido_enlace'], $_POST['img']);
							if($inserta){
								echo "<script>alert('Los datos se guardaron correctamente...');</script>";
							}else{
								echo "<script>alert('No se guardaron correctamente los datos...');</script>";
							}
						}else{
							echo "<script>alert('No se guardo la imagen...');window.location.href='principal_admin.php';</script>";
						}			

					}
			}else{
				echo "<script>alert('Faltan datos de la imagen...');</script>";
			}

		/////////////////////////////////////////////////////////////////////////

	}elseif($_POST['tipo_contenido_enlace']==3){
		$inserta=setContenidoEnlace($_POST['nombre'],$_POST['descripcion'], $_SESSION['id_enlace_principal'],$_POST['tipo_contenido_enlace'], $_POST['img']);
		if($inserta){
			echo "<script>alert('Los datos se guardaron correctamente...');</script>";
		}else{
			echo "<script>alert('No se guardaron correctamente los datos...');</script>";
		}
	}elseif($_POST['tipo_contenido_enlace']==4){
		
		$enlace_guardar=NULL;
		if(substr($_POST['descripcion_url'],0,7)=="http://" || substr($_POST['descripcion_url'],0,7)=="HTTP://" || substr($_POST['descripcion_url'],0,8)=="HTTPS://" || substr($_POST['descripcion_url'],0,8)=="https://"){

		  	$enlace_guardar=$_POST['descripcion_url'];

	  	}else{

	  	  	$enlace_guardar="http://".$_POST['descripcion_url'];

	  	}
		
		$inserta=setContenidoEnlace($_POST['nombre'],$enlace_guardar, $_SESSION['id_enlace_principal'],$_POST['tipo_contenido_enlace'], $_POST['img']);
		if($inserta){
			echo "<script>alert('Los datos se guardaron correctamente...');</script>";
		}else{
			echo "<script>alert('No se guardaron correctamente los datos...');</script>";
		}
	}
}

//ingresa cuando el formulario viene por post para actualizar un contenido
if($_POST['actualiza_contenido_enlace']==2){

	//die($_SESSION['id_contenido_enlace']."Entro a edicion con id:".$_POST['id']);
	//die("Entro!!!".$_POST['descripcion']);
	if($_POST['tipo_contenido_enlace']==1){
		$inserta=updContenidoEnlace($_POST['nombre'],$_POST['descripcion_url'],$_SESSION['id_contenido_enlace'], $_POST['img']);
		if($inserta){
			echo "<script>alert('Los datos se guardaron correctamente...');</script>";
		}else{
			echo "<script>alert('No se guardaron correctamente los datos...');</script>";
		}
	}elseif($_POST['tipo_contenido_enlace']==2){
		/////////////////////////////////////////////////////////////////////////
		
			if($_FILES['descripcion_archivo']['name']!=''){
				echo "<center><br><br><br><br><h1>Validando la imagen.<br><br>Espere un momento<br>Gacias...</h1></center>";
					$nombre = $_FILES['descripcion_archivo']['name'];
					$tipo = $_FILES['descripcion_archivo']['type'];
					$tamano = $_FILES['descripcion_archivo']['size'];
					//die("**************".$tamano);
					if($tamano>6000001){
						echo "<script>alert('El archivo es demaciado grande...');window.location.href='principal_admin.php';</script>";
					}else{
						if(is_dir("../../../aplicacion/doc/".$_SESSION['id_enlace_principal'])){
						   //die ('esta!'."../aplicacion/img/".$_SESSION["sitio"]);
						}else{
						   //die ('no esta!');
						   mkdir("../../../aplicacion/doc/".$_SESSION['id_enlace_principal']."/",0777);
						}
		
						$imagen = $_FILES['descripcion_archivo']['tmp_name'];
						$nombre_imagen_asociada = $_SESSION['id_enlace_principal'].$nombre;
						$directorio="../../../aplicacion/doc/".$_SESSION['id_enlace_principal']."/";
						$guardado=copy($_FILES['descripcion_archivo']['tmp_name'],$directorio.$nombre);
						//$guardado=redimensionar_imagen($imagen, $nombre_imagen_asociada,$directorio);
		
						if($guardado){
							$inserta=updContenidoEnlace($_POST['nombre'],$nombre,$_SESSION['id_contenido_enlace'], $_POST['img']);
							if($inserta){
								echo "<script>alert('Los datos se guardaron correctamente...');</script>";
							}else{
								echo "<script>alert('No se guardaron correctamente los datos...');</script>";
							}
						}else{
							echo "<script>alert('No se guardo la imagen...');window.location.href='principal_admin.php';</script>";
						}			

					}
			}else{
				echo "<script>alert('Faltan datos de la imagen...');</script>";
			}

		/////////////////////////////////////////////////////////////////////////

	}elseif($_POST['tipo_contenido_enlace']==3){
		//die("Entro andres...".$_POST['descripcion']);
		$inserta=updContenidoEnlace($_POST['nombre'],$_POST['descripcion'],$_SESSION['id_contenido_enlace'], $_POST['img']);
		if($inserta){
			echo "<script>alert('Los datos se guardaron correctamente...');</script>";
		}else{
			echo "<script>alert('No se guardaron correctamente los datos...');</script>";
		}
	}elseif($_POST['tipo_contenido_enlace']==4){
		
		$enlace_guardar=NULL;
		if(substr($_POST['descripcion_url'],0,7)=="http://" || substr($_POST['descripcion_url'],0,7)=="HTTP://" || substr($_POST['descripcion_url'],0,8)=="HTTPS://" || substr($_POST['descripcion_url'],0,8)=="https://"){

		  	$enlace_guardar=$_POST['descripcion_url'];

	  	}else{

	  	  	$enlace_guardar="http://".$_POST['descripcion_url'];

	  	}
		
		$inserta=updContenidoEnlace($_POST['nombre'],$enlace_guardar,$_SESSION['id_contenido_enlace'], $_POST['img']);
		if($inserta){
			echo "<script>alert('Los datos se guardaron correctamente...');</script>";
		}else{
			echo "<script>alert('No se guardaron correctamente los datos...');</script>";
		}
	}
}

//ingresa cuando la accion es la edicion de un contenido para consilta de la informacion del mismo
if(isset($_SESSION['id_contenido_enlace']) && $_SESSION['id_contenido_enlace']!=NULL){
	//die("entro por session...".$_SESSION['id_contenido_enlace']);
	$id_contenido_enlace=$_SESSION['id_contenido_enlace'];
	$existe=getContenidoEnlaceId($id_contenido_enlace);
	$action="valida_actualiza_contenido_enlace";
	if($existe){
		$nombre=$existe['nombre_contenido_enlace'];
		$tipo_contenido_enlace=$existe['id_tipo_contenido_enlace'];
		$img_enlace=$existe['icono'];
		if($tipo_contenido_enlace==1){//desarrollo propio
			$descripcion_url=$existe['html_code'];
		}elseif($tipo_contenido_enlace==2){//archivo
			//no hace nada al ser archivo
		}elseif($tipo_contenido_enlace==3){//diseño web
			$descripcion=$existe['html_code'];
		}elseif($tipo_contenido_enlace==4){//otra pag
			$descripcion_url=$existe['html_code'];
		}
	}
}

//die($_SESSION["user_id"]."Entra!!!".$_SESSION['id_enlace_principal']);
if($_SESSION['id_enlace_principal']!=NULL){

	$id_enlace_principal=$_SESSION['id_enlace_principal'];
	$existe_enlace_principal=getEnlacePrincipalId($id_enlace_principal);
	
	if($existe_enlace_principal){
		//die("Entra!!!");
		$nombre_enlace_principal=$existe_enlace_principal['nombre_enlace_principal'];
		$descripcion_enlace_principal=$existe_enlace_principal['descripcion_enlace_principal'];
	}
}
//die("sdfsdfvsd");
?>
<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="content-type" />
	<script type="text/javascript" src="../ckeditor.js"></script>
	<script type="text/javascript" src="sample.js"></script>
	<link href="sample.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function mostrar(id){
	//alert("Entro!!!");
	if(id==1){
	document.getElementById(4).style.display = 'block';
	document.getElementById(3).style.display = 'none';
	document.getElementById(2).style.display = 'none';
	}
	if(id==2){
	document.getElementById(2).style.display = 'block';
	document.getElementById(3).style.display = 'none';
	document.getElementById(4).style.display = 'none';
	}
	if(id==3){
	document.getElementById(3).style.display = 'block';
	document.getElementById(2).style.display = 'none';
	document.getElementById(4).style.display = 'none';
	}
	if(id==4){
	document.getElementById(4).style.display = 'block';
	document.getElementById(3).style.display = 'none';
	document.getElementById(2).style.display = 'none';
	}
}

function valida_guardar_contenido_enlace(f){

	if(f.nombre.value.length <1){
		alert("Debes ingresar el titulo del contenido.");
		f.nombre.focus();
		return false;
	}

	if(f.tipo_contenido_enlace.value.length <1){
		alert("Debes seleccionar el tipo de contenido.");
		f.tipo_contenido_enlace.focus();
		return false;
	}
	
	if(f.tipo_contenido_enlace.value == 1 || f.tipo_contenido_enlace.value == 4){
		if(f.descripcion_url.value.length <1){
			alert("Debes ingresar una URL valida.");
			f.descripcion_url.focus();
			return false;
		}
	}else if(f.tipo_contenido_enlace.value == 2){
		if(f.descripcion_archivo.value.length <1){
			alert("Debes ingresar una ARCHIVO valido.");
			f.descripcion_archivo.focus();
			return false;
		}
	}
	/*
	else if(f.tipo_contenido_enlace.value == 3){
		alert(">>>"+f.descripcion.value);
		if(f.descripcion.value.length <1){
			alert("Debes ingresar un CONTENIDO valido.");
			f.descripcion.focus();
			return false;
		}
	}
	*/
	f.actualiza_contenido_enlace.value=1;
	
	return true;
}

function valida_actualiza_contenido_enlace(f){

	if(f.nombre.value.length <1){
		alert("Debes ingresar el titulo del contenido.");
		f.nombre.focus();
		return false;
	}

	if(f.tipo_contenido_enlace.value.length <1){
		alert("Debes seleccionar el tipo de contenido.");
		f.tipo_contenido_enlace.focus();
		return false;
	}
	
	if(f.tipo_contenido_enlace.value == 1 || f.tipo_contenido_enlace.value == 4){
		if(f.descripcion_url.value.length <1){
			alert("Debes ingresar una URL valida.");
			f.descripcion_url.focus();
			return false;
		}
	}else if(f.tipo_contenido_enlace.value == 2){
		if(f.descripcion_archivo.value.length <1){
			alert("Debes ingresar una ARCHIVO valido.");
			f.descripcion_archivo.focus();
			return false;
		}
	}
	/*
	else if(f.tipo_contenido_enlace.value == 3){
		alert(">>>"+f.descripcion.value);
		if(f.descripcion.value.length <1){
			alert("Debes ingresar un CONTENIDO valido.");
			f.descripcion.focus();
			return false;
		}
	}
	*/
	f.actualiza_contenido_enlace.value=2;
	
	return true;
}
</script>
</head>
<body>
	<form action="fullpage.php" enctype="multipart/form-data" method="post">
	<fieldset>
		<legend class="texte_legende2">Informacion de contenido bajo el Menú - <?=$nombre_enlace_principal?>.</legend>
        <div class="row">
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            	Titulo
				<input class="form-control" type="text" name="nombre" id="nombre" value="<?=$nombre?>">
			</div>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            	Tipo de Contenido
				<select class="form-control" name="tipo_contenido_enlace" id="tipo_contenido_enlace">
                	<option value="">Seleccione uno...</option>
                    <?
					$option=getTiposContenidoEnlace();
					for($i=0;$i<count($option);$i++){
                    ?>
                	<option value="<?=$option[$i]['id_tipo_contenido_enlace']?>" onClick="mostrar(<?=$option[$i]['id_tipo_contenido_enlace']?>);" <? if($tipo_contenido_enlace==$option[$i]['id_tipo_contenido_enlace']){ echo " selected ";}?>><?=$option[$i]['nombre']?></option>
                    <?
					}
					?>
                </select>
			</div>
			<div class="col-lg-9 col-md-8 col-sm-6 col-xs-12" id="2" style="display:none;">
				Archivo a cargar
                <input class="form-control" type="file" name="descripcion_archivo" id="descripcion_archivo">
			</div>
			<div class="col-lg-9 col-md-8 col-sm-6 col-xs-12" id="3" <? if($descripcion==NULL){ echo ' style="display:none;" ';}?>>
				Contenido
                <textarea class="form-control" name="descripcion" id="descripcion"><?=$descripcion?></textarea>
			</div>
			<div class="col-lg-9 col-md-8 col-sm-6 col-xs-12" id="4" <? if($descripcion_url==NULL){ echo ' style="display:none;" ';}?>>
				URL de la otra pagina
                <input class="form-control" type="text" name="descripcion_url" id="descripcion_url" value="<?=$descripcion_url?>" />
			</div>
		</div>
	</fieldset>
            
	<fieldset>
		<legend class="texte_legende2">Configurar contenido como acceso directo.</legend>
        <div class="row">
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            	Selecciona uno de los icono predefinidos si quieres que este contenido aparezca en la seccion de accesos directos, de no quererlo en esta seccion deja seleccionado el primero "NO APLICA ENLACE DIRECTO"...<br>
				<div style='border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black; display:inline;'>
                	<img src='../../../images/no_aplica.png' width='90' height='90'>
                    <input type='radio' name='img' id='img' value='' checked>
                </div>
<?
///////////////////////////////////////////////////
$dir_temp="../../../iconos_png_web/";
$directorio = opendir($dir_temp); //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
    if (is_dir($archivo)){//verificamos si es o no un directorio
        //echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
    }else{
		?>
        <table style='border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black; display:inline;'>
          <tr>
            <td>
              <img src='<?=$dir_temp.$archivo?>' width='90' height='90'>
              <input type='radio' name='img' id='img' value='<?=$archivo?>' <? if($img_enlace==$archivo){ echo "checked";}?>>
            </td>
          </tr>
        </table>
        <?
    }
}
?>            
			</div>
		</div>
	</fieldset>
            
            
        <table width="100%" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center">
                <input name="actualiza_contenido_enlace" id="actualiza_contenido_enlace" type="hidden" value="0">
                <input name="ingreso_enlace" id="ingreso_enlace" type="submit" value="GUARDAR DATOS" onClick="return <?=$action?>(this.form);">
                </td>
			</tr>
        </table>
			<script type="text/javascript">
			//<![CDATA[

				CKEDITOR.replace( 'descripcion',
					{
						fullPage : true
					});
				CKEDITOR.config.height = 450;

			//]]>
			</script>
	</form>
</body>
</html>
