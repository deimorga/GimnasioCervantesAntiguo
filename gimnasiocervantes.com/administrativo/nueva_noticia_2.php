<?
session_start();

unset($_SESSION['id_enlace_principal']);
unset($_SESSION['id_contenido_enlace']);
if(isset($_POST['id_enlace_principal']) || isset($_GET['id_enlace_principal'])){
	$_SESSION['id_enlace_principal']=$_GET['id_enlace_principal'];
	//die("Entro!!!");
	if($_GET['edita_contenido']==1){
		$_SESSION['id_contenido_enlace']=$_GET['id_contenido_enlace'];
		//die("Entro Editar...".$_SESSION['id_contenido_enlace']);
	}
?>
<iframe src="./public/ckeditor/_samples/fullpage.php" frameborder="0" width="100%" height="1000" ></iframe>
<?
}else{
	echo "No se cargo la información del Menú...";	
}
?>