<style>
div#content {
	padding:0.3em 0.3em 3em 0.3em; /* bottom padding for footer */
	color: #333;
	text-align:justify;
	width: 602px;
	min-height:350px;
}

#content h1 {
	text-align:center;
	font-family:"Arial Black", Gadget, sans-serif;
	font-size:14px;
	font-style:italic;
}

#content p {
	font-size:14px;
}


</style>
<?
include ("funciones/conexion.php");
include ("funciones/funciones.php");

$galeria=getProyectos();
//print_r($galeria);
?>
<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content" style="color:#666;">
         <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 id="tituloModal">PROYECTOS EDUCATIVOS...</h3>
            <small>Presione (ESC) para Cerrar Ventana.</small>
     	 </div>
         <div class="modal-body">
            <p id="textModal">
<?
if(count($galeria)==0){
echo "<center>NO HAY PROYECTOS CARGADOS EN LA PLATAFORMA...</center>";
}else{
for($i=0;$i<count($galeria);$i++){
$imagenes = glob("./aplicacion/img_proy/".$galeria[$i]["id_proyecto"]."/{*.jpg,*.png,*.gif,*.jpeg}",GLOB_BRACE);
?>
<h3> <?=$galeria[$i]["proyecto"]?></h3>
<table width="650" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="180px"><a href="#" onclick="FAjax('aplicacion/ver_proyecto.php?id=<?=$galeria[$i]["id_proyecto"]?>','contenido_usuario','','post');" class="link_right"><img id="<?=$imagenes[0]?>" style="box-shadow:0px 0px 15px 5px #09F; margin:15px;" src="<?=$imagenes[0]?>" width="180" height="120" alt="<?=$galeria[$i]["proyecto"]?>" title="<?=$galeria[$i]["proyecto"]?>" /></a></td>
    <td valign="top"><?=substr($galeria[$i]["descripcion_proyecto"],0,300)?>...<br />
    <?
    if(strlen($galeria[$i]["enlace_blogg"])>1){
	?>
    <a href="#" onclick="window.open('<?=$galeria[$i]["enlace_blogg"]?>');"><img src="img/blog.png" width="50" height="50" /></a>
    <?
	}
	?>
    <a href="#" onclick="FAjax('aplicacion/ver_proyecto.php?id=<?=$galeria[$i]["id_proyecto"]?>','contenido_usuario','','post');" ><img src="img/vermas.png" width="120" height="50" /></a>
    </td>
  </tr>
</table>
<?
}
}
?>                    
                    
</div>
</div>


     	 </div>
         <div class="modal-footer">
        	<button type="button" data-dismiss="modal" class="btn btn-info">Cerrar</button>
     	 </div>
      </div>
   </div>
</div>
<?
if(true){
	echo '
<script>
FAjax("disparar_popup.php","contenido_popup","","post");
</script>';
}
?>