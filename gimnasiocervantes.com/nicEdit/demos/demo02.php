<?
include_once ("../../funciones/conexion.php");
include_once ("../../funciones/funciones.php");

if(isset ($_FILES['imagen']) && isset($_REQUEST["nombre"]) && isset($_POST["area"])){

    if($_FILES['imagen']['name']!=''){
		
			$nombre = $_FILES['imagen']['name'];
			$tipo = $_FILES['imagen']['type'];
			$tamano = $_FILES['imagen']['size'];
			if($tamano>7000001){
				echo "<script>alert('La imagen es demaciado grande...');window.location.href='principal_admin.php';</script>";
			}else{
				$insert_noticia=setNoticia($_REQUEST["nombre"],$_POST["area"],1);
				
				if($insert_noticia){
				   $imagen = $_FILES['imagen']['tmp_name'];
				   $nombre_imagen_asociada = $insert_noticia.".jpg";
				   $directorio="../../img/noticias/";
				   $guardado=redimensionar_imagen($imagen, $nombre_imagen_asociada,$directorio);
					echo "<script>alert('Se guardo satisfactoriamente...');</script>";
				}else{
					echo "<script>alert('No se guardo la imagen...');</script>";
				}			
			}
			
    }else{
        //$directorio=$rowtitulo['urlimagen'];
		echo "<script>alert('Faltan datos de la imagen...');'</script>";
    }
}
?>
<html>
<head>
	<title>Demo 1 : Convert All Textareas</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="../../public/ckeditor/_samples/sample.css" />
</head>
<body>

<div id="menu"></div>

<div id="sample">
<form action="demo01.php" enctype="multipart/form-data" method="post">
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Centro de Registro de Noticias...</div>
  <div class="panel-body">
  	TITULO/NOMBRE:<br>
	<textarea name="nombre" id="nombre" style="width: 100%; height: 50px; background-color:#FFF;"></textarea>  
IMAGEN:<br>
<input type="file" name="imagen" id="imagen"><br>
DESCRIPCION:<br>
<textarea name="area" id="area" style="width: 100%; height: 420px;">
</textarea>
<input type="submit" name="ingres_noticia" id="ingresa_noticia" value="Enviar">
</form>
  </div>

    <script src="../../public/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="../../public/ckeditor/_samples/sample.js" type="text/javascript"></script>
    <script type="text/javascript">
        //<![CDATA[
        $(document).ready(function () {
            alert("prueba");
            CKEDITOR.replace(document.getElementById('area'),{ fullPage: true});
        });

</script>
</body>
</html>