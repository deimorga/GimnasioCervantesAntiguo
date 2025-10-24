<?
session_start();

if($_REQUEST['subir_foto']){
		if($_FILES['foto_alumno']['name']!=''){
			echo "<center><br><br><br><br><h1>Validando la imagen.<br><br>Espere un momento<br>Gacias...</h1></center>";
			$nombre = $_FILES['foto_alumno']['name'];
			$tipo = $_FILES['foto_alumno']['type'];
			$tamano = $_FILES['foto_alumno']['size'];
			$extension=explode(".",$nombre);
			if($tamano>2000001){
				echo "<script>alert('La imagen es demaciado grande...');window.location.href='test.html';</script>";
			}else{
			   $imagen = $_FILES['foto_alumno']['tmp_name'];
			   $nombre_imagen_asociada = $_SESSION["alumno_ingreso"].'.jpg';
			   $directorio="./";
			   $guardado=NULL;
				$guardado=copy($_FILES['foto_alumno']['tmp_name'],$directorio.$nombre_imagen_asociada);
				if($guardado){
					echo "<script>alert('Se guardo satisfactoriamente...');window.close();</script>";
				}else{
					echo "<script>alert('No se guardo la imagen...');window.location.href='test.htmp';</script>";
				}			
			}
				
		}
}
?>