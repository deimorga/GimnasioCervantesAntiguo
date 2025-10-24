<?
session_start();



////////////////////////////////////////////////////////////////////////////////////////////

if($_REQUEST['actualiza_elemento_web']==1){

	

	include_once ("./funciones/conexion.php");

	include_once ("./funciones/funciones_aula.php");

	$_SESSION['redirect_elemento_web']=1;

	$tipo_e=$_REQUEST["tipo_e"];

	if($tipo_e>=1 && $tipo_e<=3){



		if($_FILES['desc_elemento_2']['name']!=''){

			

			echo "<center><br><br><br><br><h1>Validando el archivo.<br><br>Espere un momento<br>Gacias...</h1></center>";

			$nombre = $_FILES['desc_elemento_2']['name'];

			$tipo = $_FILES['desc_elemento_2']['type'];

			$tamano = $_FILES['desc_elemento_2']['size'];

			//die($nombre."******".$tipo);

			if($tamano>7000001){

			//if($tamano>1){

				echo "<script>alert('El archivo es demaciado grande, no debe superar 7MB...'); window.location.href='principal_admin.php';</script>";

			}else{

				$insert_elemento=setElementoWeb($tipo_e,$_REQUEST["enunciado_elemento"],$_REQUEST["desc_elemento"],$nombre);

				//die("******".$insert_elemento."++++++".$nombre);

				if(is_dir("./aula/elemento_web/".$insert_elemento."/")){

				   //die ('esta!'."../aplicacion/img/".$_SESSION["sitio"]);

				}else{

				   //die ('no esta!');

				   mkdir("./aula/elemento_web/".$insert_elemento."/",0777);

				}

				$directorio="./aula/elemento_web/".$insert_elemento."/";

				$guardado=copy($_FILES['desc_elemento_2']['tmp_name'],$directorio.$nombre);

				if($guardado){

					echo "<script>alert('Se guardo satisfactoriamente...'); window.location.href='principal_admin.php';</script>";

				}else{

					echo "<script>alert('No se guardo el archivo...');window.location.href='principal_admin.php';</script>";

				}			

			}

			

		}else{

			//$directorio=$rowtitulo['urlimagen'];

			echo "<script>alert('Faltan datos de la imagen...');window.location.href='principal_admin.php'</script>";

		}



	}elseif($tipo_e==4){



		$insert_elemento=setElementoWeb($tipo_e,$_REQUEST["enunciado_elemento"],$_REQUEST["desc_elemento_2"],$_REQUEST['desc_elemento']);

		

		if($insert_elemento){

			echo "<script>alert('Se guardo satisfactoriamente...'); window.location.href='principal_admin.php';</script>";

		}else{

			echo "<script>alert('No se guardo el archivo...');window.location.href='principal_admin.php';</script>";

		}			



	}elseif($tipo_e==5){



		$enlace="";

		if(substr($_REQUEST['desc_elemento_2'],0,7)=="http://" || substr($_REQUEST['desc_elemento_2'],0,7)=="HTTP://" || substr($_REQUEST['desc_elemento_2'],0,8)=="HTTPS://" || substr($_REQUEST['desc_elemento_2'],0,8)=="https://"){

		  	$enlace=$_REQUEST['desc_elemento_2'];

	  	}else{

	  	  	$enlace="http://".$_REQUEST['desc_elemento_2'];

	  	}



		$insert_elemento=setElementoWeb($tipo_e,$_REQUEST["enunciado_elemento"],$enlace,$_REQUEST["desc_elemento"]);

		

		if($insert_elemento){

			echo "<script>alert('Se guardo satisfactoriamente...'); window.location.href='principal_admin.php';</script>";

		}else{

			echo "<script>alert('No se guardo el archivo...');window.location.href='principal_admin.php';</script>";

		}			



	}elseif($tipo_e==6){



		$enlace="";

		if(substr($_REQUEST['desc_elemento_2'],0,7)=="http://" || substr($_REQUEST['desc_elemento_2'],0,7)=="HTTP://" || substr($_REQUEST['desc_elemento_2'],0,8)=="HTTPS://" || substr($_REQUEST['desc_elemento_2'],0,8)=="https://"){

		  	$enlace=$_REQUEST['desc_elemento_2'];

	  	}else{

	  	  	$enlace="https://".$_REQUEST['desc_elemento_2'];

	  	}

		

		$resultado = $enlace;



		$insert_elemento=setElementoWeb($tipo_e,$_REQUEST["enunciado_elemento"],$resultado,$_REQUEST["desc_elemento"]);

		

		if($insert_elemento){

			echo "<script>alert('Se guardo satisfactoriamente...'); window.location.href='principal_admin.php';</script>";

		}else{

			echo "<script>alert('No se guardo el archivo...');window.location.href='principal_admin.php';</script>";

		}			



	}

	

}

//////////////////////////////////////////////////////

//Update Elemento Web

//////////////////////////////////////////////////////



/*elseif($_REQUEST['actualiza_elemento_aula']==2){

	

	include_once ("./funciones/conexion.php");

	include_once ("./funciones/funciones_aula.php");

	

	$_SESSION['redirect_elemento']=1;

	$id=$_SESSION["id_edita_elemento"];

	$elemento=getElementosId($id);

	$tipo_e=$elemento["id_tipo_elemento"];



if($tipo_e==4){



		$insert_elemento=updElemento($id,$_REQUEST["enunciado_elemento"],$_REQUEST['desc_elemento']);

		

		if($insert_elemento){

			echo "<script>alert('Se guardo satisfactoriamente...'); window.location.href='principal_aulas.php';</script>";

		}else{

			echo "<script>alert('No se guardo el archivo...');window.location.href='principal_aulas.php';</script>";

		}			



	}elseif($tipo_e==5){



		$enlace="";

		if(substr($_REQUEST['desc_elemento'],0,7)=="http://" || substr($_REQUEST['desc_elemento'],0,7)=="HTTP://" || substr($_REQUEST['desc_elemento'],0,8)=="HTTPS://" || substr($_REQUEST['desc_elemento'],0,8)=="https://"){

		  	$enlace=$_REQUEST['desc_elemento'];

	  	}else{

	  	  	$enlace="http://".$_REQUEST['desc_elemento'];

	  	}



		$insert_elemento=updElemento($id,$_REQUEST["enunciado_elemento"],$enlace);

		

		if($insert_elemento){

			echo "<script>alert('Se guardo satisfactoriamente...'); window.location.href='principal_aulas.php';</script>";

		}else{

			echo "<script>alert('No se guardo el archivo...');window.location.href='principal_aulas.php';</script>";

		}			



	}elseif($tipo_e==6){



		$enlace="";

		if(substr($_REQUEST['desc_elemento'],0,7)=="http://" || substr($_REQUEST['desc_elemento'],0,7)=="HTTP://" || substr($_REQUEST['desc_elemento'],0,8)=="HTTPS://" || substr($_REQUEST['desc_elemento'],0,8)=="https://"){

		  	$enlace=$_REQUEST['desc_elemento'];

	  	}else{

	  	  	$enlace="https://".$_REQUEST['desc_elemento'];

	  	}

		

		$resultado = $enlace;//str_replace("watch?v=", "v/", $enlace)



		$insert_elemento=updElemento($id,$_REQUEST["enunciado_elemento"],$resultado);

		

		if($insert_elemento){

			echo "<script>alert('Se guardo satisfactoriamente...'); window.location.href='principal_aulas.php';</script>";

		}else{

			echo "<script>alert('No se guardo el archivo...');window.location.href='principal_aulas.php';</script>";

		}			



	}



}

*/

//////////////////////////////////////////////////////

//Fin Update Elemento Web

//////////////////////////////////////////////////////

else{

	include_once ("./funciones/conexion.php");

	include_once ("./funciones/funciones.php");

}



////////////////////////////////////////////////////////////////////////////////////////////



if(isset ($_REQUEST['carga_img'])){



	$_SESSION['sitio_proy']=NULL;

	$_SESSION['sitio_header']=NULL;

    if($_FILES['imagen']['name']!=''){



		echo "<center><br><br><br><br><h1>Validando la imagen.<br><br>Espere un momento<br>Gacias...</h1></center>";

			$nombre = $_FILES['imagen']['name'];

			$tipo = $_FILES['imagen']['type'];

			$tamano = $_FILES['imagen']['size'];

			//die("**************".$tamano);

			if($tamano>2000001){

				echo "<script>alert('La imagen es demaciado grande...');window.location.href='principal_admin.php';</script>";

			}else{

				if(is_dir("./aplicacion/img/".$_SESSION["sitio"])){

				   //die ('esta!'."../aplicacion/img/".$_SESSION["sitio"]);

				}else{

				   //die ('no esta!');

				   mkdir("./aplicacion/img/".$_SESSION["sitio"]."/",0777);

				}

				

				$imagen = $_FILES['imagen']['tmp_name'];

				$nombre_imagen_asociada = $_SESSION["sitio"].$nombre;

				$directorio="./aplicacion/img/".$_SESSION["sitio"]."/";

				$guardado=redimensionar_imagen($imagen, $nombre_imagen_asociada,$directorio);

				if($guardado){

					echo "<script>alert('Se guardo satisfactoriamente...');window.location.href='principal_admin.php';</script>";

				}else{

					echo "<script>alert('No se guardo la imagen...');window.location.href='principal_admin.php';</script>";

				}			

			}

	

			

    }else{

		echo "<script>alert('Faltan datos de la imagen...');</script>";

    }

}



////////////////////////////////////////////////////////////////////////////////////////////



if(isset ($_REQUEST['carga_img_header'])){



	$_SESSION['sitio']=NULL;

	$_SESSION['sitio_proy']=NULL;

    if($_FILES['imagen']['name']!=''){



		echo "<center><br><br><br><br><h1>Validando la imagen.<br><br>Espere un momento<br>Gacias...</h1></center>";

			$nombre = $_FILES['imagen']['name'];

			$tipo = $_FILES['imagen']['type'];

			$tamano = $_FILES['imagen']['size'];

			//die("**************".$tamano);

			if($tamano>3000001){

				echo "<script>alert('La imagen es demaciado grande...');window.location.href='principal_admin.php';</script>";

			}else{

				if(is_dir("./header_galery/img/lolo")){

				   //die ('esta!'."../aplicacion/img/".$_SESSION["sitio"]);

				}else{

				   //die ('no esta!');

				   mkdir("./header_galery/img/lolo/",0777);

				}

				

				$imagen = $_FILES['imagen']['tmp_name'];

				$nombre_imagen_asociada = "temp".$nombre;

				$directorio="./header_galery/img/lolo/";

				$guardado=redimensionar_imagen_medidas($imagen, $nombre_imagen_asociada,$directorio, 1024, 370);

				if($guardado){

					$_SESSION['sitio_header']=1;

					echo "<script>alert('Se guardo satisfactoriamente...');window.location.href='principal_admin.php';</script>";

				}else{

					$_SESSION['sitio_header']=1;

					echo "<script>alert('No se guardo la imagen...');window.location.href='principal_admin.php';</script>";

				}			

			}

	

			

    }else{

		$_SESSION['sitio_header']=1;

		echo "<script>alert('Faltan datos de la imagen...');</script>";

    }

}



////////////////////////////////////////////////////////////////////////////////////////

if(isset ($_REQUEST['carga_img_proy'])){

	

	$_SESSION['sitio']=NULL;

	$_SESSION['sitio_header']=NULL;

    if($_FILES['imagen']['name']!=''){



		echo "<center><br><br><br><br><h1>Validando la imagen.<br><br>Espere un momento<br>Gacias...</h1></center>";

			$nombre = $_FILES['imagen']['name'];

			$tipo = $_FILES['imagen']['type'];

			$tamano = $_FILES['imagen']['size'];

			//die("**************".$tamano);

			if($tamano>2000001){

				echo "<script>alert('La imagen es demaciado grande...');window.location.href='principal_admin.php';</script>";

			}else{

				if(is_dir("./aplicacion/img_proy/".$_SESSION["sitio_proy"])){

				   //die ('esta!'."../aplicacion/img/".$_SESSION["sitio"]);

				}else{

				   //die ('no esta!');

				   mkdir("./aplicacion/img_proy/".$_SESSION["sitio_proy"]."/",0777);

				}

				

				$imagen = $_FILES['imagen']['tmp_name'];

				$nombre_imagen_asociada = $_SESSION["sitio_proy"].$nombre;

				$directorio="./aplicacion/img_proy/".$_SESSION["sitio_proy"]."/";

				$guardado=redimensionar_imagen($imagen, $nombre_imagen_asociada,$directorio);

				if($guardado){

					echo "<script>alert('Se guardo satisfactoriamente...');window.location.href='principal_admin.php';</script>";

				}else{

					echo "<script>alert('No se guardo la imagen...');window.location.href='principal_admin.php';</script>";

				}			

			}

	

			

    }else{

		echo "<script>alert('Faltan datos de la imagen...');</script>";

    }

}



if(isset ($_REQUEST['carga_img_noticia'])){



    if($_FILES['imagen']['name']!=''){

		

		echo "<center><br><br><br><br><h1>Validando la imagen.<br><br>Espere un momento<br>Gacias...</h1></center>";

			$nombre = $_FILES['imagen']['name'];

			$tipo = $_FILES['imagen']['type'];

			$tamano = $_FILES['imagen']['size'];

			if($tamano>2000001){

				echo "<script>alert('La imagen es demaciado grande...');window.location.href='principal_admin.php';</script>";

			}else{

				$insert_noticia=setNoticia($_REQUEST["nombre"],$_REQUEST["descripcion"],$_REQUEST["posicion"]);

				//die("******".$insert_noticia."++++++".$nombre);

				   $imagen = $_FILES['imagen']['tmp_name'];

				   $nombre_imagen_asociada = $insert_noticia.".jpg";

				   $directorio="./img/noticias/";

				   $guardado=redimensionar_imagen($imagen, $nombre_imagen_asociada,$directorio);

				if($guardado){

					echo "<script>alert('Se guardo satisfactoriamente...');window.location.href='principal_admin.php';</script>";

				}else{

					echo "<script>alert('No se guardo la imagen...');window.location.href='principal_admin.php';</script>";

				}			

			}

			

    }else{

        //$directorio=$rowtitulo['urlimagen'];

		echo "<script>alert('Faltan datos de la imagen...');window.location.href='principal_admin.php'</script>";

    }

}



if(isset ($_REQUEST['carga_circular'])){



    if($_FILES['imagen']['name']!=''){

		

		echo "<center><br><br><br><br><h1>Validando el archivo.<br><br>Espere un momento<br>Gacias...</h1></center>";

			$nombre = $_FILES['imagen']['name'];

			$tipo = $_FILES['imagen']['type'];

			$tamano = $_FILES['imagen']['size'];

			//die($nombre."******".$tipo);

			if($tamano>3000001){

				echo "<script>alert('La circular es demaciado grande...');window.location.href='principal_admin.php';</script>";

			}else{

				$insert_noticia=setCircular($_REQUEST["tema"],$_REQUEST["dirigida"],$_REQUEST["emisor"],$nombre);

				//die("******".$insert_noticia."++++++".$nombre);

				if(is_dir("./circulares/")){

				   //die ('esta!'."../aplicacion/img/".$_SESSION["sitio"]);

				}else{

				   //die ('no esta!');

				   mkdir("./circulares/",0777);

				}

				   $directorio="./circulares/";

				   $guardado=copy($_FILES['imagen']['tmp_name'],$directorio.$nombre);

				if($guardado){

					echo "<script>alert('Se guardo satisfactoriamente...');window.location.href='principal_admin.php';</script>";

				}else{

					echo "<script>alert('No se guardo el archivo...');window.location.href='principal_admin.php';</script>";

				}			

			}

			

    }else{

        //$directorio=$rowtitulo['urlimagen'];

		echo "<script>alert('Faltan datos de la imagen...');window.location.href='principal_admin.php'</script>";

    }

}



if(isset ($_REQUEST['carga_guia'])){



    if($_FILES['imagen']['name']!=''){

		

		echo "<center><br><br><br><br><h1>Validando el archivo.<br><br>Espere un momento<br>Gacias...</h1></center>";

			$nombre = $_FILES['imagen']['name'];

			$tipo = $_FILES['imagen']['type'];

			$tamano = $_FILES['imagen']['size'];

			$ext=explode(".",$nombre);

			//die($nombre."******".$tipo);

			//print_r(explode(".",$nombre));

			if($tamano>7000001){

				echo "<script>alert('La guia es demaciado grande...');window.location.href='principal_admin.php';</script>";

			}else{

				$insert_noticia=setCircular2($_REQUEST["tema"],$_REQUEST["dirigida"],$_SESSION["user_id"],$insert_noticia.".".$ext[1]);

				//die("******".$insert_noticia."++++++".$nombre);

				if(is_dir("./circulares/")){

				   //die ('esta!'."../aplicacion/img/".$_SESSION["sitio"]);

				}else{

				   //die ('no esta!');

				   mkdir("./circulares/",0777);

				}

				   $directorio="./circulares/";

				   $guardado=copy($_FILES['imagen']['tmp_name'],$directorio.$insert_noticia.".".$ext[1]);

				   //die();

				if($guardado){

					echo "<script>alert('Se guardo satisfactoriamente...');window.location.href='principal_admin.php';</script>";

				}else{

					echo "<script>alert('No se guardo el archivo...');window.location.href='principal_admin.php';</script>";

				}			

			}

			

    }else{

        //$directorio=$rowtitulo['urlimagen'];

		echo "<script>alert('Faltan datos de la imagen...');window.location.href='principal_admin.php'</script>";

    }

}



if($_REQUEST['actualiza_ejercicio']==1){

	

	if($_FILES['imagen']['name']!=''){

			

		echo "<center><br><br><br><br><h1>Validando la imagen.<br><br>Espere un momento<br>Gacias...</h1></center>";

		$nombre = $_FILES['imagen']['name'];

		$tipo = $_FILES['imagen']['type'];

		$tamano = $_FILES['imagen']['size'];

		//die("***************".$tamano); 

		

		if($tamano>4200000){

			echo "<script>alert('El archivo es demaciado grande...');window.location.href='principal_admin.php';</script>";

		}else{

			if(is_dir("./img/ejercicio/")){

			   //die ('esta!'."../aplicacion/img/".$_SESSION["sitio"]);

			}else{

			   //die ('no esta!');

			   mkdir("./img/ejercicio/",0777);

			}

			$imagen = $_FILES['imagen']['tmp_name'];

			$directorio="./img/ejercicio/";

			$guardado=copy($_FILES['imagen']['tmp_name'],$directorio.$nombre);

			//die("***".$nombre);

			if($guardado){

				$guarda_ejercicio=setEjercicioArchivo($_POST['nombre_ej'], $_POST['descripcion_ej'],$_SESSION['id_plan'],$nombre,$_POST['enlace']);

				if($guarda_ejercicio){

					echo "<script>alert('Los datos se guardaron correctamente...');window.location.href='principal_admin.php?sesion_plan=1';</script>";

				}else{

					echo "<script>alert('No se guardaron correctamente los datos...');window.location.href='principal_admin.php';</script>";

				}

			}else{

				echo "<script>alert('No se guardo el archivo...');window.location.href='principal_admin.php';</script>";

			}			

		}

				

	}else{

		$guarda_ejercicio=setEjercicio($_POST['nombre_ej'], $_POST['descripcion_ej'],$_SESSION['id_plan'],$_POST['enlace']);

		if($guarda_ejercicio){

			echo "<script>alert('Los datos se guardaron correctamente...');window.location.href='principal_admin.php?sesion_plan=1';</script>";

		}else{

			echo "<script>alert('No se guardaron correctamente los datos...');window.location.href='principal_admin.php';</script>";

		}

	}

}



/////////////////////////////////////////////////////////////



if(isset ($_REQUEST['carga_formato'])){



    if($_FILES['imagen_formato']['name']!=''){

		

		echo "<center><br><br><br><br><h1>Validando el archivo.<br><br>Espere un momento<br>Gacias...</h1></center>";

			$nombre = $_FILES['imagen_formato']['name'];

			$tipo = $_FILES['imagen_formato']['type'];

			$tamano = $_FILES['imagen_formato']['size'];

			//die($nombre."******".$tipo);

			if($tamano>3000001){

				echo "<script>alert('La circular es demaciado grande...');window.location.href='principal_admin.php';</script>";

			}else{

				$insert_noticia=setFormato($_REQUEST["tema"],$nombre);

				//die("******".$insert_noticia."++++++".$nombre);

				if(is_dir("./circulares/")){

				   //die ('esta!'."../aplicacion/img/".$_SESSION["sitio"]);

				}else{

				   //die ('no esta!');

				   mkdir("./circulares/",0777);

				}

				   $directorio="./circulares/";

				   $guardado=copy($_FILES['imagen_formato']['tmp_name'],$directorio.$nombre);

				if($guardado){

					echo "<script>alert('Se guardo satisfactoriamente...');window.location.href='principal_admin.php';</script>";

				}else{

					echo "<script>alert('No se guardo el archivo...');window.location.href='principal_admin.php';</script>";

				}			

			}

			

    }else{

        //$directorio=$rowtitulo['urlimagen'];

		echo "<script>alert('Faltan datos de la imagen...');window.location.href='principal_admin.php'</script>";

    }

}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"{HTMLDIR}>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet">
    <!--CHARSET--> 
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="SHORTCUT ICON" href="images/icono.ico">
	<link href="./style_galeria.css" rel="stylesheet" type="text/css" />
    <link href="./calendar/calendar-blue.css" rel="stylesheet" type="text/css">
    <!--CSS-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="./vendor/index.css" />



<title>COLEGIO GIMNASIO CERVANTES</title>

<script type="text/javascript" src="./js/ajax.js"></script>
<script type="text/javascript" src="./js/funciones.js"></script>

<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/calendar-es.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>

    <script src="./public/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="./public/ckeditor/_samples/sample.js" type="text/javascript"></script>
    
    <script src="./vendor/amcharts/core.js"></script>
    <script src="./vendor/amcharts/charts.js"></script>
    <script src="./vendor/amcharts/themes/animated.js"></script>


<!--HEAD-->



</head>



<body id="cuerpo" background="images/bg_area_trabajo.jpg">

<form id="form" name="form" method="post" enctype="multipart/form-data">
<div class="container-fluid">
	<div class="row">
    	<div class="col-sm-4 col-lg-3 lateral clearfix visible-sm-block visible-md-block visible-lg-block">
    	    <div id="menu_left"><? include("menu_left.php");?></div>
        </div>
        <div class="col-xs-12 clearfix visible-xs-block">
            <div id="menu_left_2"><? include('menu_left_2.php');?></div>
        </div>
    	<div class="col-sm-8" id="cuerpo_pag">
       		<div id="area_trabajo"></div>
    	</div>
    </div>
    <div class="row">
    	<div id="contenido_popup"></div>
    </div>
    <div class="row">
        <div id="contenido_usuario_4"></div>
    </div>
	<div class="row">
    	<div class="col-lg-12 col-md-12">
    	    <div id="footer"><? include("pie.php");?></div>
        </div>
    </div>
</div>




<?

if($_GET['sesion_plan']==1){

	echo "<script>FAjax('./profesor/gestionar_plan_entrenamiento.php','area_trabajo','','post');</script>";

}

if($_SESSION['sitio']!=NULL){

	echo "<script>FAjax('./aplicacion/admin_galeria.php','area_trabajo','','post');</script>";

}

if($_SESSION['sitio_header']!=NULL){

	echo "<script>FAjax('./aplicacion/admin_header.php','area_trabajo','','post');</script>";

}

if($_SESSION['sitio_proy']!=NULL){

	echo "<script>FAjax('./aplicacion/admin_proyecto.php','area_trabajo','','post');</script>";

}

if($_SESSION['redirect_elemento_web']==1){

	echo "<script>FAjax('./aula/info_elemento_web.php','area_trabajo','','post');</script>";

}

?>

</form>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.js"></script>
<script type="text/javascript" src="./js/lightbox.js"></script>
-->
<!-- jQuery -->
<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/lightbox.js"></script>

<!-- Contact Form JavaScript -->
<script src="js/jqBootstrapValidation.js"></script>

<!-- Theme JavaScript -->
<script src="js/clean-blog.min.js"></script>
<script>
    $(function () {
	$('[data-toggle="tooltip"]').tooltip()
	})
</script>
</body>

</html>

