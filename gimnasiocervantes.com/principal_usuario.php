<?
session_start();
include_once ("./funciones/conexion.php");
include_once ("./funciones/funciones.php");

$usuario=getAlumnoId($_SESSION['esturiante_matriculado']);
if($usuario){
	$_SESSION['grupo_estudiante']=$usuario['id_grupo'];
}


/////////////////////////////////////////////////////////////
if(isset ($_REQUEST['ingreso_archivo_taller'])){

	include_once ("./funciones/conexion.php");
	include_once ("./funciones/funciones.php");

    if($_FILES['archivo_taller']['name']!=''){
		
		echo "<center><br><br><br><br><h1>Validando el archivo.<br><br>Espere un momento<br>Gacias...</h1></center>";
			$nombre = $_FILES['archivo_taller']['name'];
			$tipo = $_FILES['archivo_taller']['type'];
			$tamano = $_FILES['archivo_taller']['size'];
			$ext=explode(".",$nombre);
			//die($nombre."******".$tipo);
			//print_r(explode(".",$nombre));
			if($tamano>7000001){
				echo "<script>alert('El archivo es demaciado grande...');window.location.href='principal_usuario.php';</script>";
			}else{
				//die($ext[1]);
				$insert_noticia=setElementoAlumnoActividadAula($_SESSION['id_actividad_aula'],$_SESSION['esturiante_matriculado'],$_REQUEST['comentario_archivo'],$ext[1]);
				//die("******".$insert_noticia."++++++".$nombre);
				if(is_dir("./aula/archivos_taller/")){
				   //die ('esta!'."../aplicacion/img/".$_SESSION["sitio"]);
				}else{
				   //die ('no esta!');
				   mkdir("./aula/archivos_taller/",0777);
				}
				   $directorio="./aula/archivos_taller/";
				   //print_r($ext);
				   //echo "<br>".end($ext);
				   //die();
				   $guardado=copy($_FILES['archivo_taller']['tmp_name'],$directorio.$insert_noticia.".".end($ext));
				   //die();
				if($guardado){
					$_SESSION['redirect_archivo']=1;
					echo "<script>alert('Se guardo satisfactoriamente...');window.location.href='principal_usuario.php';</script>";
				}else{
					echo "<script>alert('No se guardo el archivo...');window.location.href='principal_usuario.php';</script>";
				}			
			}
			
    }else{
        //$directorio=$rowtitulo['urlimagen'];
		echo "<script>alert('Faltan datos de la imagen...');window.location.href='principal_usuario.php'</script>";
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


<title>COLEGIO GIMNASIO CERVANTES</title>

<script type="text/javascript" src="./js/ajax.js"></script>
<script type="text/javascript" src="./js/funciones.js"></script>

<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/calendar-es.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>

<!--HEAD-->

</head>

<body background="images/bg_area_trabajo.jpg">
<form id="form" name="form" method="post" enctype="multipart/form-data">
<div class="main container">
    <div class="row well">
	<div id="area_trabajo_alumno">
    	<? include("menu_left_alumno.php");?>
    </div>
    </div>
</div>
<?
	if($_SESSION['redirect_archivo']==1){
		echo "<script>FAjax('./aula/impartir_clase.php?redirect=1','area_trabajo_alumno','','post');</script>";
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
