<?
session_start();
include_once("../funciones/conexion.php");
include_once("./funciones/funciones_galeria.php");

if($_GET['nvo']==1){
	$_SESSION["sitio"]=$_GET['id'];
}elseif($_GET['nvo']==2){
	$galeria=setGaleria($_REQUEST['asunto'],$_REQUEST['contenido']);
	$_SESSION["sitio"]=$galeria;
}elseif($_GET['nvo']==3){
	updGaleria($_REQUEST['asunto'],$_REQUEST['contenido'],$_SESSION["sitio"]);
	echo "<script>alert('Información Actualizada.');</script>"; 
}

if(isset($_GET['img_borrar'])){
//echo $_GET['img_borrar'];
unlink($_GET['img_borrar']);
echo "<script>alert('Imagen borrada de la galeria.');</script>"; 
}
$infoGaleria=getGaleriaId($_SESSION["sitio"]);
?>

<h2>Informacion de Galeria.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos de la galeria.</legend>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td class="texte2">Titulo:</td>
				<td><input type="text" class="champ2" name="asunto" value="<?=$infoGaleria['galeria']?>" id="asunto"/></td>
			</tr>
			<tr>
				<td class="texte2">Descripcion:</td>
				<td><textarea class="champ2" name="contenido" id="contenido" cols="35" rows="10"><?=$infoGaleria['descripcion_galeria']?></textarea></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="button" id="enviar_galeria" name="enviar_galeria" value="Actualizar Información" onclick="FAjax('./aplicacion/admin_galeria.php?nvo=3','area_trabajo','','post');" class="button_send" /></td>
			</tr>
		</table>
	</fieldset>







		<div id="content">
			<div id="left">
				<div id="welcome">
                
<h2>Control de la galeria fotografica.</h2>

					<div id="form_contact2">
						<strong>Datos de la imagen - Dimension (550px*425px)</strong><br />
						<br />
							<fieldset>
								<legend class="texte_legende">CARGA DE IMAGENES
								</legend><table cellpadding=5 cellspacing=0 border="0">
								<tr>
									<td class="texte">Imagen :</td>
									<td><input class="champ" type="file" name="imagen" id="imagen"></td>
								</tr>
								</table>
							</fieldset>
							<br>
							<table width="380" border="0" cellpadding=0 cellspacing=0>
							<tr>
								<td colspan="2" align="center"><input class="button_send" name="carga_img" type="submit" value="CARGAR IMAGEN"><input type="button" id="desc" name="desc" value="Descargar Programa" onclick="window.open('./aplicacion/vizualizer_photo_reziser_es.rar');" class="button_send" /></td>
							</tr>
							</table>
</div>
<br/>
           
<table align="center" width="90%" border="1" cellspacing="0" cellpadding="0">
  <tr>
            
<?php
$imagenes =  glob("../aplicacion/img/".$_SESSION["sitio"]."/{*.jpg,*.JPG,*.png,*.PNG,*.gif,*.GIF,*.JPEG,*.jpeg}",GLOB_BRACE);
//echo $imagenes.$_SESSION["sitio"];
for($i=0;$i<count($imagenes);$i++){
	//echo substr($imagenes[$i],1);
	if($i%4==0){
	echo "</tr><tr>";
	}
?>
    <td align="center">
    <a href="#" onClick="if(confirm('Seguro de borrar la imagen de la galeria?')){FAjax('./aplicacion/admin_galeria.php?img_borrar=<?=$imagenes[$i]?>','area_trabajo','','post');}else{return false;}" class="link_right">BORRAR >></a><br />
    <img src="<?=substr($imagenes[$i],1)?>" width="170" height="145">
    </td>
<?
}
?>
  </tr>
</table>
            
				</div>
			</div>
            
            
			
			<div class="clear"></div>
		</div>
