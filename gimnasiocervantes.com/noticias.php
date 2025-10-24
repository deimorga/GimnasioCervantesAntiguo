<?
include_once ("funciones/conexion.php");
include_once ("funciones/funciones.php");

$pag=1;
if(isset($_GET['pag'])){
	$pag=$_GET['pag'];
}
$cantidadNoticia=getCantidadNoticias();
$noticia=getNoticias($pag);
$numPaginas=ceil($cantidadNoticia['cantidad']/4);
//echo $numPaginas." - ".$cantidadNoticia['cantidad'];
?>
<div class="row alert alert-info" style='font: oblique bold 120% cursive; width:100%;'>
	<table width="100%">
    	<tr>
        	<td align="left">
        	<h3 style="display:inline; color:#036 !important;"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span> Noticias <small>Comunicados y Actividades.</small></h3>
            </td>
        	<td align="right">
			<?
            for($p=1;$p<=$numPaginas;$p++){
            ?>
                <a href="#contenido_usuario" class="btn-xs btn-info <? if($pag==$p){ echo 'active';}?>" style="color:#FFF;<? if($pag==$p){ echo ' background-color:#FF0;';}?>" name='pag' onclick="FAjax('noticias.php?pag=<?=$p?>', 'contenido_usuario','','post');"><? if($pag==$p){ echo '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';}else{ echo $p;}?></a>
            <?
            }
            ?>
            </td>
        </tr>
	</table>
</div>
<div class="row">    
<?
$num=count($noticia);
for($i=0;$i<$num;$i++){
	$border_panel="";
	if($i % 2 == 0){
		$border_panel="";
	}else{
		$border_panel="";
	}
?>
<div class="col-xs-12">
<div class="panel panel-default" style=" border-radius: 35px 4px 35px 4px; -webkit-box-shadow: 0px 6px 9px 1px rgba(0,0,0,0.48);
-moz-box-shadow: 0px 6px 9px 1px rgba(0,0,0,0.48);
box-shadow: 0px 6px 9px 1px rgba(0,0,0,0.48);">
  <div class="panel-heading" style=" border-radius: 35px 4px 0px 0px;">
    <h3 class="panel-title"><?=$noticia[$i]["titulo"]?></h3>
  </div>
  <div class="panel-body" style="padding-bottom:0 !important; font-size:15px; border-radius: 0px 0px 35px 4px; font-style:italic; size:16px;">
  <div class="row" style="vertical-align:central; margin: 10px 5px 20px 5px;">
  <?
  if(strlen($noticia[$i]["noticia"])==0){
  ?>
<img class="imagen_galery" src="./img/noticias/<?=$noticia[$i]["id_noticia"]?>.jpg"  align="left" hspace="12" style="max-width:100%;"/>
  <?
  }else{
  ?>
<img class="imagen_galery" src="./img/noticias/<?=$noticia[$i]["id_noticia"]?>.jpg"  align="left" hspace="12" style="max-width:30%; max-height:200px;"/>
  <?
  $text=nl2br(cortar_cadena($noticia[$i]["noticia"],200));
  echo $text."...";
  }
  ?>
  </div>
  <div class="row list-group" style="margin-top:5px; margin-bottom:0 !important;">
	<a href="#contenido_usuario" style="border-radius: 0px 0px 35px 4px;" class="list-group-item list-group-item-info" onclick="FAjax('prueba_popup.php?id_noticia=<?=$noticia[$i]["id_noticia"]?>','contenido_usuario_4','','post');">
    VER MAS
    </a>
  </div>
  </div>
</div>
</div>
<?
}
?>              
</div>  
<div class="row" align="center">
<?
for($p=1;$p<=$numPaginas;$p++){
?>
	<a href="#contenido_usuario" class="btn-sm btn-info <? if($pag==$p){ echo 'active';}?>" style="color:#FFF;<? if($pag==$p){ echo ' background-color:#FF0;';}?>" name='pag' onclick="FAjax('noticias.php?pag=<?=$p?>', 'contenido_usuario','','post');"><? if($pag==$p){ echo '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';}else{ echo $p;}?></a>
<?
}
?>
</div>
<?
echo "<script>
FAjax('noticias_padres.php','contenido_usuario_2','','post');
FAjax('ultimas_galerias.php','contenido_usuario_1','','post');
</script>";
?>