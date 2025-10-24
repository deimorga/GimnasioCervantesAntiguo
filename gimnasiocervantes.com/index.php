<?
session_start();
if($_POST["ingreso"]){
	include ("funciones/conexion.php");
	include ("funciones/funciones.php");

	$id=$_POST["identificacion"];
	$clave=$_POST["clave"];
	$ingresa=validaUsuario($id,$clave);

	if($ingresa){
		$_SESSION["user_id"]=$id;
		$_SESSION["user_tipo"]=$ingresa["id_tipo_usuario"];
		setMonitoreoUser($id,"INGRESO");
		if($_SESSION["user_tipo"]==1 || $_SESSION["user_tipo"]==2){
			echo "<script>window.location.href='principal_admin.php';</script>";
		}elseif($_SESSION["user_tipo"]==3){
			$_SESSION['esturiante_matriculado']=$id;
			echo "<script>window.location.href='principal_usuario.php';</script>";
		}elseif($_SESSION["user_tipo"]==4){
			echo "<script>FAjax('./usuario/puente_usuario.php','contenido_usuario','','post');</script>";
		}
	}else{
		echo "<script>alert('Usuario o clave incorrectas...');window.location.href='index.php';</script>";	
	}
}else{

if($_POST['puente_usuario']){
	$_SESSION['esturiante_matriculado']=$_POST['alumno_registrado'];
	echo "<script>window.location.href='principal_usuario.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
<!--HEAD-->

<script type="text/javascript" src="./js/ajax.js"></script>
<script type="text/javascript" src="./js/funciones.js"></script>

<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/calendar-es.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
</head>

<body id="cuerpo">
<form id="form" name="form" method="post">
<div class="intro-header">
    <div class="row">
	    <div id="menu_superior"><? include("./menu_superior.php");?></div>
    </div>
    <div class="row" align="center">
            <!--cabecera-->
        	<? include("./cabecera.php");?>
            <!--Fin cabecera-->
    </div>
</div>

<div>
    <!--Contenido-->
    <? include("./contenido.php");?>
    <!--Fin Contenido-->
</div>
<div>
    <!--Contenido-->
    <? include("./instalaciones.php");?>
    <!--Fin Contenido-->
</div>
<div class="bgline1"><img src="images/spacer.gif" alt="" width="1" height="4" />
</div>
<div id="footer"><? include("pie.php");?></div>    
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
<?
}
?>