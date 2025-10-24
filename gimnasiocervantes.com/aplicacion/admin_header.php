<?
session_start();
include_once("../funciones/conexion.php");
include_once("./funciones/funciones_galeria.php");

if(isset($_GET['img_borrar'])){
//echo $_GET['img_borrar'];
unlink($_GET['img_borrar']);
echo "<script>alert('Imagen borrada de la galeria.');</script>"; 
}
?>
		<div id="content">
			<div id="left">
				<div id="welcome">
                
<h2>Control de la galeria fotografica.</h2>

					<div id="form_contact2">
						<strong>Datos de la imagen - Dimension (1024px*370px)</strong><br />
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
								<td colspan="2" align="center"><input class="button_send" name="carga_img_header" type="submit" value="CARGAR IMAGEN"><input type="button" id="desc" name="desc" value="Descargar Programa" onclick="window.open('./aplicacion/vizualizer_photo_reziser_es.rar');" class="button_send" /></td>
							</tr>
							</table>
</div>
<br/>
           
<table align="center" width="90%" border="1" cellspacing="0" cellpadding="0">
  <tr>
            
<?php
$imagenes =  glob("../header_galery/img/lolo/{*.jpg,*.JPG,*.png,*.PNG,*.gif,*.GIF,*.JPEG,*.jpeg}",GLOB_BRACE);
//echo $imagenes.$_SESSION["sitio"];
for($i=0;$i<count($imagenes);$i++){
	//echo substr($imagenes[$i],1);
	if($i%4==0){
	echo "</tr><tr>";
	}
?>
    <td align="center">
    <a href="#" onClick="if(confirm('Seguro de borrar la imagen del Banner?')){FAjax('./aplicacion/admin_header.php?img_borrar=<?=$imagenes[$i]?>','area_trabajo','','post');}else{return false;}" class="link_right">BORRAR >></a><br />
    <img src="<?=substr($imagenes[$i],1)?>" width="170" height="115">
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
