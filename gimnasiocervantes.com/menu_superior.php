<?
session_start();

include_once('./funciones/conexion.php');
include_once('./funciones/funciones.php');

?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" style="min-height:55px; padding-right:5%;">
	<div class="container-fluid">
    	<!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
        	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
        </div>

		<!--Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        	<ul class="nav navbar-nav navbar-right">

			<?
			$enlaces=getEnlacesPrincipal();
			$num_enlaces=count($enlaces);
			for($e=0;$e<$num_enlaces;$e++){
				$contenidos=getContenidosEnlace($enlaces[$e]['id_enlace_principal']);
				$num_contenidos=count($contenidos);
				if($num_contenidos==0){
					//no se pinta nada pues no tiene gestionados contenidos
				}elseif($num_contenidos==1){
					//se pinta el nombre del enlace al tener un solo contenido
                    if($contenidos[0]['id_tipo_contenido_enlace']==1){
						$explode_enlace=explode("|",$contenidos[0]['html_code']);
					?>
                <li><a href="#<?=$explode_enlace[1]?>" onClick="FAjax('<?=$explode_enlace[0]?>','<?=$explode_enlace[1]?>','','post');FAjax('menu_superior.php', 'menu_superior','','post');" title="<?=$contenidos[0]['nombre_enlace_principal']?>"><?=$contenidos[0]['nombre_contenido_enlace']?></a></li>
    				<?
					}elseif($contenidos[0]['id_tipo_contenido_enlace']==3){
					?>
                <li><a href="#contenido_usuario_4" onClick="FAjax('./ver_contenido_enlace.php?id_contenido_enlace=<?=$contenidos[0]['id_contenido_enlace']?>','contenido_usuario_4','','post');FAjax('menu_superior.php', 'menu_superior','','post');" title="<?=$contenidos[0]['nombre_enlace_principal']?>"><?=$contenidos[0]['nombre_contenido_enlace']?></a></li>
    				<?
					}else{
					?>
                <li><a href="#contenido_usuario_4" onClick="window.open('./aplicacion/doc/<?=$contenidos[0]['id_enlace_principal']?>/<?=$contenidos[0]['html_code']?>');FAjax('menu_superior.php', 'menu_superior','','post');" title="<?=$contenidos[0]['nombre_enlace_principal']?>"><?=$contenidos[0]['nombre_contenido_enlace']?></a></li>
    				<?
					}
				}else{
					//se pinta con dropDown al tener varios contenidos configurados
					?>
            	<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?=$enlaces[$e]['nombre_enlace_principal']?>
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <?
					for($c=0;$c<$num_contenidos;$c++){
						if($contenidos[$c]['id_tipo_contenido_enlace']==1){
						$explode_enlace=explode("|",$contenidos[$c]['html_code']);
					?>
					<li><a href="#<?=$explode_enlace[1]?>" onClick="FAjax('<?=$explode_enlace[0]?>','<?=$explode_enlace[1]?>','','post');FAjax('menu_superior.php', 'menu_superior','','post');" title="<?=$contenidos[$c]['nombre_enlace_principal']?>"><?=$contenidos[$c]['nombre_contenido_enlace']?></a></li>
						<?
						}elseif($contenidos[$c]['id_tipo_contenido_enlace']==3){
						?>
					<li><a href="#contenido_usuario_4" onClick="FAjax('./ver_contenido_enlace.php?id_contenido_enlace=<?=$contenidos[$c]['id_contenido_enlace']?>','contenido_usuario_4','','post');FAjax('menu_superior.php', 'menu_superior','','post');" title="<?=$contenidos[$c]['nombre_enlace_principal']?>"><?=$contenidos[$c]['nombre_contenido_enlace']?></a></li>
						<?
						}elseif($contenidos[$c]['id_tipo_contenido_enlace']==2){
						?>
					<li><a href="#contenido_usuario_4" onClick="window.open('./aplicacion/doc/<?=$contenidos[$c]['id_enlace_principal']?>/<?=$contenidos[$c]['html_code']?>');FAjax('menu_superior.php', 'menu_superior','','post');" title="<?=$contenidos[$c]['nombre_enlace_principal']?>"><?=$contenidos[$c]['nombre_contenido_enlace']?></a></li>
						<?
						}else{
						?>
					<li><a href="#contenido_usuario_4" onClick="window.open('<?=$contenidos[$c]['html_code']?>');FAjax('menu_superior.php', 'menu_superior','','post');" title="<?=$contenidos[$c]['nombre_enlace_principal']?>"><?=$contenidos[$c]['nombre_contenido_enlace']?></a></li>
						<?
						}
					?>
                    	<li role="presentation" class="divider"></li>
					<?
					}
					?>
                	</ul>
              	</li>
					<?
				}
			}
            ?>

        	</ul>
        </div>
    	<!-- /.navbar-collapse -->
	</div>
    <!-- /.container -->
</nav>