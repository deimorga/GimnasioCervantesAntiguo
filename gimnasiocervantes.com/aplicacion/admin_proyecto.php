<?
session_start();
include_once("../funciones/conexion.php");
include_once("./funciones/funciones_galeria.php");

if($_GET['nvo']==1){
	$_SESSION["sitio_proy"]=$_GET['id'];
}elseif($_GET['nvo']==2){
	$galeria=setProyecto($_REQUEST['asunto'],$_REQUEST['contenido']);
	$_SESSION["sitio_proy"]=$galeria;
}elseif($_GET['nvo']==3){
	$actualiza=updProyecto($_REQUEST['titulo'],$_REQUEST['descripcion'],$_SESSION["sitio_proy"]);
}
$info=getproyectoId($_SESSION["sitio_proy"]);

if(isset($_GET['img_borrar'])){
//echo $_GET['img_borrar'];
unlink($_GET['img_borrar']);
echo "<script>alert('Imagen borrada de la galeria.');</script>"; 
}
?>
		<div id="content">
			<div id="left">
				<div id="welcome">
                
<h2>Control de la galeria del proyecto.</h2>

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
								<tr>
									<td class="texte" colspan="2"><input class="button_send" name="carga_img_proy" type="submit" value="CARGAR IMAGEN"><input type="button" id="desc" name="desc" value="Descargar Programa" onclick="window.open('./aplicacion/vizualizer_photo_reziser_es.rar');" class="button_send" /></td>
								</tr>
								</table>
							</fieldset>
<?php /*?>						<br />
							<fieldset>
								<legend class="texte_legende">Informaci&oacute;n del Proyecto
								</legend><table cellpadding=5 cellspacing=0 border="0">
								<tr>
									<td class="texte">Titulo:</td>
									<td><input class="champ" type="text" name="titulo" id="titulo" value="<?=$info['proyecto']?>"></td>
								</tr>
								<tr>
									<td class="texte">Titulo:</td>
									<td><textarea class="champ" name="descripcion" id="descripcion"><?=$info['descripcion_proyecto']?></textarea></td>
								</tr>
								<tr>
									<td class="texte" colspan="2"><input type="button" id="actualizar_proy" name="actualizar_proy" value="Actializar Informaci&oacute;n" onclick="FAjax('./aplicacion/admin_proyecto.php?nvo=3','area_trabajo','','post');" class="button_send" /></td>
								</tr>
								</table>
							</fieldset>
<?php */?></div>
<br/>
           
<table align="center" width="90%" border="1" cellspacing="0" cellpadding="0">
  <tr>
            
<?php
$imagenes =  glob("../aplicacion/img_proy/".$_SESSION["sitio_proy"]."/{*.jpg,*.JPG,*.png,*.PNG,*.gif,*.GIF,*.JPEG,*.jpeg}",GLOB_BRACE);
//echo $imagenes.$_SESSION["sitio"];
for($i=0;$i<count($imagenes);$i++){
	//echo substr($imagenes[$i],1);
	if($i%4==0){
	echo "</tr><tr>";
	}
?>
    <td align="center">
    <a href="#" onClick="if(confirm('Seguro de borrar la imagen de la galeria?')){FAjax('./aplicacion/admin_proyecto.php?img_borrar=<?=$imagenes[$i]?>','area_trabajo','','post');}else{return false;}" class="link_right">BORRAR >></a><br />
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
