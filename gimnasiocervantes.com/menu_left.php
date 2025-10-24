<?
session_start();

include_once("./funciones/funciones.php");
include_once("./funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$modulos=getModulosUsuario($_SESSION["user_id"]);
?>
<div align="left" style="height:100%; margin-left:0px; margin-top:0px;">

<table>
	<tr>
    	<td><img src="img/mapa.png" width="45" height="45" style="display:inline;" /></td>
    	<td><div id="google_translate_element"></div></td>
    </tr>
</table>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <div class="list-group">


	<button type="button" class="list-group-item" style="width:100%; text-align:left; border-bottom:double #333333 !important;" onclick="window.location.href='./principal_aulas.php';">Ingreso Aulas Virtuales</button>



<?
for($i=0;$i<count($modulos);$i++){
?>
	<button type="button" class="list-group-item" style="width:100%; text-align:left; border-bottom:double #333333 !important;" onclick="FAjax('sub_menu_categoria.php?id_modulo_menu=<?=$modulos[$i]['id_modulo']?>','sub_categoria_<?=$modulos[$i]['id_modulo']?>','','post');"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span> <?=$modulos[$i]['nombre_permiso']?></button>
      <div id="sub_categoria_<?=$modulos[$i]['id_modulo']?>"></div>
<?
}
?>    </div>

</div>