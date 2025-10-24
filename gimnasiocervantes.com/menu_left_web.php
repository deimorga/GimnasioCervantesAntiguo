<?
session_start();

include_once('./funciones/conexion.php');
include_once('./funciones/funciones.php');
?>
<div class="panel panel-primary">
	<div class="panel-heading" align="center"><h5>Enlaces y Accesos Rápidos</h5></div>
    <div class="panel-body">

<?
$contenidos=getContenidosEnlaceIcono();
$num_contenidos=count($contenidos);
if($num_contenidos==0){
	//no se pinta nada pues no tiene gestionados contenidos
	echo "No hay accesos directos...";
}else{
	//se pintan los accesos directos con los respectivos iconos registrados
	?>
	<?
	for($c=0;$c<$num_contenidos;$c++){
		if($contenidos[$c]['id_tipo_contenido_enlace']==1){
			$explode_enlace=explode("|",$contenidos[$c]['html_code']);
		?>
		<div class="col-xs-4 col-sm-2 col-md-2 col-lg-1">
        	<a href="#<?=$explode_enlace[1]?>" onclick="FAjax('<?=$explode_enlace[0]?>','<?=$explode_enlace[1]?>','','post');" data-toggle="tooltip" data-placement="top" title="<?=$contenidos[$c]['nombre_enlace_principal']?>">
            	<img src="./iconos_png_web/<?=$contenidos[$c]['icono']?>" width="100px" height="100px"/>
        	</a>
      	</div>  
		<?
		}elseif($contenidos[$c]['id_tipo_contenido_enlace']==3){
		?>
		<div class="col-xs-4 col-sm-2 col-md-2 col-lg-1">
        	<a href="#contenido_usuario_4" onclick="FAjax('./ver_contenido_enlace.php?id_contenido_enlace=<?=$contenidos[$c]['id_contenido_enlace']?>','contenido_usuario_4','','post');" data-toggle="tooltip" data-placement="top" title="<?=$contenidos[$c]['nombre_enlace_principal']?>">
            	<img src="./iconos_png_web/<?=$contenidos[$c]['icono']?>" width="100px" height="100px"/>
        	</a>
      	</div>  
		<?
		}elseif($contenidos[$c]['id_tipo_contenido_enlace']==2){
		?>
		<div class="col-xs-4 col-sm-2 col-md-2 col-lg-1">
        	<a href="#contenido_usuario_4" onclick="window.open('./aplicacion/doc/<?=$contenidos[$c]['id_enlace_principal']?>/<?=$contenidos[$c]['html_code']?>');" data-toggle="tooltip" data-placement="top" title="<?=$contenidos[$c]['nombre_enlace_principal']?>">
            	<img src="./iconos_png_web/<?=$contenidos[$c]['icono']?>" width="100px" height="100px"/>
        	</a>
      	</div>  
		<?
		}else{
		?>
		<div class="col-xs-4 col-sm-2 col-md-2 col-lg-1">
        	<a href="#contenido_usuario_4" onclick="window.open('<?=$contenidos[$c]['html_code']?>');" data-toggle="tooltip" data-placement="top" title="<?=$contenidos[$c]['nombre_enlace_principal']?>">
            	<img src="./iconos_png_web/<?=$contenidos[$c]['icono']?>" width="100px" height="100px"/>
        	</a>
      	</div>  
		<?
		}
	}
	?>
       	</ul>
   	</li>
<?
}
?>
</div>