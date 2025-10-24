<?
session_start();
include("./funciones/funciones_aula.php");
include("./funciones/conexion.php");

$pag=1;
if(isset($_GET['pag'])){
	$pag=$_GET['pag'];
}
$cantidadElemento=getCantidadElementos();
$plan=getElementosWeb($pag);
$numPaginas=ceil($cantidadElemento['cantidad']/4);

?>
<div class="alert alert-success" style='font: oblique bold 120% cursive;'>
  <h4><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Enlaces De Interes <small>Reflexiones, Lecturas y Articulos.</small></h4>
</div>
<div class="row" align="center">
<?
if($numPaginas>1){
for($p=1;$p<=$numPaginas;$p++){
?>
	<a href="#contenido_usuario_2" class="btn-xs btn-success <? if($pag==$p){ echo 'active';}?>" style="color:#FFF;" name='pag' onclick="FAjax('noticias_padres.php?pag=<?=$p?>', 'contenido_usuario_2','','post');"><? if($pag==$p){ echo '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';}else{ echo $p;}?></a>
<?
}
}
?>
</div>
<br />
<div class="row">
<?
if(count($plan)<1){
}else{
for($i=0;$i<count($plan);$i++){
$class="danger";
if($i % 2==0){
	$class="info";
}
?>
<div class="list-group">
  <a href="#contenido_usuario_2" class="list-group-item list-group-item-<?=$class?>" style="border-radius:12px;" onClick="FAjax('./aula/ver_elemento_web.php?id_elemento=<?=$plan[$i]['id_elemento']?>','contenido_usuario_4','','post');">
  <table width="100%" border="0">
  	<tr>
    	<td width="39"><img src="iconos/link.png" width="39" height="39" /></td>
    	<td style="border-bottom:0.5mm solid #220044;"><h5 style="color:#C30; font-style:italic;"><?=$plan[$i]['titulo_elemento']?></h5></td>
    </tr>
  </table>
        
        
        <p><?=substr($plan[$i]['descripcion_elemento'],0,100)?></p>
  </a>
</div>
<?
}
}
?>
</div>
<div class="row" align="center">
<?
if($numPaginas>1){
for($p=1;$p<=$numPaginas;$p++){
?>
	<a href="#contenido_usuario_2" class="btn-xs btn-success <? if($pag==$p){ echo 'active';}?>" style="color:#FFF;" name='pag' onclick="FAjax('noticias_padres.php?pag=<?=$p?>', 'contenido_usuario_2','','post');"><? if($pag==$p){ echo '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';}else{ echo $p;}?></a>
<?
}
}
?>
</div>
