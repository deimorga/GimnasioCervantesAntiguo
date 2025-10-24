<?
session_start();

if(isset ($_REQUEST['carga_guia'])){

	include_once ("./funciones/conexion.php");
	include_once ("./funciones/funciones.php");

    if($_FILES['imagen']['name']!=''){
		
		echo "<center><br><br><br><br><h1>Validando el archivo.<br><br>Espere un momento<br>Gacias...</h1></center>";
			$nombre = $_FILES['imagen']['name'];
			$tipo = $_FILES['imagen']['type'];
			$tamano = $_FILES['imagen']['size'];
			$ext=explode(".",$nombre);
			//die($nombre."******".$tipo);
			//print_r(explode(".",$nombre));
			if($tamano>10000001){
				echo "<script>alert('La guia es demaciado grande...');window.location.href='principal_aulas.php';</script>";
			}else{
				$insert_noticia=setCircular2($_REQUEST["tema"],$_REQUEST["dirigida"],$_SESSION["user_id"],$insert_noticia.".".end($ext));
				//die("******".$insert_noticia."++++++".$nombre);
				if(is_dir("./circulares/")){
				   //die ('esta!'."../aplicacion/img/".$_SESSION["sitio"]);
				}else{
				   //die ('no esta!');
				   mkdir("./circulares/",0777);
				}
				   $directorio="./circulares/";
				   //print_r($ext);
				   //echo "<br>".end($ext);
				   //die();
				   $guardado=copy($_FILES['imagen']['tmp_name'],$directorio.$insert_noticia.".".end($ext));
				   //die();
				if($guardado){
					echo "<script>alert('Se guardo satisfactoriamente...');window.location.href='principal_aulas.php';</script>";
				}else{
					echo "<script>alert('No se guardo el archivo...');window.location.href='principal_aulas.php';</script>";
				}			
			}
			
    }else{
        //$directorio=$rowtitulo['urlimagen'];
		echo "<script>alert('Faltan datos de la imagen...');window.location.href='principal_aulas.php'</script>";
    }
}

/////////////////////////////////////////////////////////////
if(isset ($_REQUEST['carga_evaluacion'])){

	include_once ("./funciones/conexion.php");
	include_once ("./funciones/funciones.php");

    if($_FILES['imagen_evaluacion']['name']!=''){
		
		echo "<center><br><br><br><br><h1>Validando el archivo.<br><br>Espere un momento<br>Gacias...</h1></center>";
			$nombre = $_FILES['imagen_evaluacion']['name'];
			$tipo = $_FILES['imagen_evaluacion']['type'];
			$tamano = $_FILES['imagen_evaluacion']['size'];
			$ext=explode(".",$nombre);
			//die($nombre."******".$tipo);
			//print_r(explode(".",$nombre));
			if($tamano>7000001){
				echo "<script>alert('El archivo es demaciado grande...');window.location.href='principal_aulas.php';</script>";
			}else{
				$insert_noticia=setEvaluacion($_REQUEST["fecha"],$_REQUEST["grupo"],$_REQUEST["asignatura"],$_SESSION["user_id"],$insert_noticia.".".end($ext));
				//die("******".$insert_noticia."++++++".$nombre);
				if(is_dir("./circulares/")){
				   //die ('esta!'."../aplicacion/img/".$_SESSION["sitio"]);
				}else{
				   //die ('no esta!');
				   mkdir("./circulares/",0777);
				}
				   $directorio="./circulares/";
				   //print_r($ext);
				   //echo "<br>".end($ext);
				   //die();
				   $guardado=copy($_FILES['imagen_evaluacion']['tmp_name'],$directorio.$insert_noticia.".".end($ext));
				   //die();
				if($guardado){
					echo "<script>alert('Se guardo satisfactoriamente...');window.location.href='principal_aulas.php';</script>";
				}else{
					echo "<script>alert('No se guardo el archivo...');window.location.href='principal_aulas.php';</script>";
				}			
			}
			
    }else{
        //$directorio=$rowtitulo['urlimagen'];
		echo "<script>alert('Faltan datos de la imagen...');window.location.href='principal_aulas.php'</script>";
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

<body id="cuerpo" background="images/bg_area_trabajo.jpg">
<form id="form" name="form" method="post" enctype="multipart/form-data">
<div class="main container">
    <div class="row well">

<div id="area_trabajo_alumno">

<?
if($_REQUEST['actualiza_pregunta_aula']==1){
	
	include_once ("./funciones/conexion.php");
	include_once ("./funciones/funciones_aula.php");

	$_SESSION['redirect_elemento']=1;
		$guarda=setPreguntaAbierta($_REQUEST["tipo_pregunta"],$_REQUEST["desc_pregunta"],$_SESSION['id_actividad_aula']);
		
		if($guarda){
			for($a=1;$a<=10;$a++){
				if($_REQUEST["op_a_".$a]!=NULL && $_FILES["op_b_".$a]['name']!=''){
/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
			echo "<center><br><br><br><br><h1>Validando el archivo.<br><br>Espere un momento<br>Gacias...</h1></center>";
			$nombre = $_FILES["op_b_".$a]['name'];
			$tipo = $_FILES["op_b_".$a]['type'];
			$tamano = $_FILES["op_b_".$a]['size'];
			//die($nombre."******".$tipo);
			if($tamano>7000001){
			//if($tamano>1){
				echo "<script>alert('El archivo es demaciado grande, no debe superar 7MB...'); window.location.href='principal_aulas.php';</script>";
			}else{
				$guarada_res=setRespuesta2($guarda,$_REQUEST["op_a_".$a],$nombre);
				//die("******".$insert_noticia."++++++".$nombre);
				if(is_dir("./aula/pregunta/".$_SESSION['id_actividad_aula']."/")){
				   //die ('esta!'."../aplicacion/img/".$_SESSION["sitio"]);
				}else{
				   //die ('no esta!');
				   mkdir("./aula/pregunta/".$_SESSION['id_actividad_aula']."/",0777);
				}
				$directorio="./aula/pregunta/".$_SESSION['id_actividad_aula']."/";
				$guardado=copy($_FILES["op_b_".$a]['tmp_name'],$directorio.$nombre);
				if($guardado){
					echo "<script>alert('Se guardo satisfactoriamente...'); window.location.href='principal_aulas.php';</script>";
				}else{
					echo "<script>alert('No se guardo el archivo...');window.location.href='principal_aulas.php';</script>";
				}			
			}
/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
				}
			}
		}else{
			echo "<script>alert('Se presentaron inconvenientes al guardar la pregunta...');</script>";
		}
}
if($_REQUEST['actualiza_elemento_aula']==1){
	
	include_once ("./funciones/conexion.php");
	include_once ("./funciones/funciones_aula.php");
	
	$_SESSION['redirect_elemento']=1;
	$tipo_e=$_REQUEST["tipo_e"];
	if($tipo_e>=1 && $tipo_e<=3){

		if($_FILES['desc_elemento']['name']!=''){
			
			echo "<center><br><br><br><br><h1>Validando el archivo.<br><br>Espere un momento<br>Gacias...</h1></center>";
			$nombre = $_FILES['desc_elemento']['name'];
			$tipo = $_FILES['desc_elemento']['type'];
			$tamano = $_FILES['desc_elemento']['size'];
			//die($nombre."******".$tipo);
			if($tamano>7000001){
			//if($tamano>1){
				echo "<script>alert('El archivo es demaciado grande, no debe superar 7MB...'); window.location.href='principal_aulas.php';</script>";
			}else{
				$insert_elemento=setElemento($tipo_e,$_SESSION['id_actividad_aula'],$_REQUEST["enunciado_elemento"],$_FILES['desc_elemento']['name']);
				//die("******".$insert_noticia."++++++".$nombre);
				if(is_dir("./aula/elemento/".$_SESSION['id_actividad_aula']."/")){
				   //die ('esta!'."../aplicacion/img/".$_SESSION["sitio"]);
				}else{
				   //die ('no esta!');
				   mkdir("./aula/elemento/".$_SESSION['id_actividad_aula']."/",0777);
				}
				$directorio="./aula/elemento/".$_SESSION['id_actividad_aula']."/";
				$guardado=copy($_FILES['desc_elemento']['tmp_name'],$directorio.$nombre);
				if($guardado){
					echo "<script>alert('Se guardo satisfactoriamente...'); window.location.href='principal_aulas.php';</script>";
				}else{
					echo "<script>alert('No se guardo el archivo...');window.location.href='principal_aulas.php';</script>";
				}			
			}
			
		}else{
			//$directorio=$rowtitulo['urlimagen'];
			echo "<script>alert('Faltan datos de la imagen...');window.location.href='principal_aulas.php'</script>";
		}

	}elseif($tipo_e==4){

		$insert_elemento=setElemento($tipo_e,$_SESSION['id_actividad_aula'],$_REQUEST["enunciado_elemento"],$_REQUEST['desc_elemento']);
		
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

		$insert_elemento=setElemento($tipo_e,$_SESSION['id_actividad_aula'],$_REQUEST["enunciado_elemento"],$enlace);
		
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
		
		$resultado = $enlace;

		$insert_elemento=setElemento($tipo_e,$_SESSION['id_actividad_aula'],$_REQUEST["enunciado_elemento"],$resultado);
		
		if($insert_elemento){
			echo "<script>alert('Se guardo satisfactoriamente...'); window.location.href='principal_aulas.php';</script>";
		}else{
			echo "<script>alert('No se guardo el archivo...');window.location.href='principal_aulas.php';</script>";
		}			

	}
	
}elseif($_REQUEST['actualiza_elemento_aula']==2){
	
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

}else{
	if($_SESSION['redirect_elemento']==1){
		echo "<script>FAjax('./aula/gestionar_clase.php','area_trabajo_alumno','','post');</script>";
	}
	include("menu_left_aulas.php");
}
?>
    </div>
</div>
</div>
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