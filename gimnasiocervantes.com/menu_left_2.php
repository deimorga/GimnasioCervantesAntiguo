<?
session_start();

include_once("./funciones/funciones.php");
include_once("./funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$modulos=getModulosUsuario($_SESSION["user_id"]);
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
			for($i=0;$i<count($modulos);$i++){
			?>
            	<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?=$modulos[$i]['nombre_permiso']?>
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
					<?
                    $enlaces=getEnlacesModulo($modulos[$i]['id_modulo']);
                    for($j=0;$j<count($enlaces);$j++){
                    ?>
					<li><a href="#area_trabajo" onClick="FAjax('<?=$enlaces[$j]["ruta_enlace"]?>','area_trabajo','','post');FAjax('menu_left_2.php', 'menu_left_2','','post');" title="<?=$enlaces[$j]["nombre_enlace"]?>"><?=$enlaces[$j]["nombre_enlace"]?></a></li>
                    	<li role="presentation" class="divider"></li>
					<?
					}
					?>
                	</ul>
              	</li>
					<?
			}
            ?>

        	</ul>
        </div>
    	<!-- /.navbar-collapse -->
	</div>
    <!-- /.container -->
</nav>