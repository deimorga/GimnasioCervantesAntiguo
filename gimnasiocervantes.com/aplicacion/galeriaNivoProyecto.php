<?
session_start();
?>
<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Galeria Fotografica.</title>
        <link rel="stylesheet" href="css/default.css" type="text/css" media="screen" />
        <style>
            #galeria {
                margin:0 auto 0 auto;
                width:550px;
                height:425px;
                -webkit-box-shadow: 0px 1px 5px 0px #4a4a4a;
                -moz-box-shadow: 0px 1px 5px 0px #4a4a4a;
                box-shadow: 0px 1px 5px 0px #4a4a4a;
            }
    
        </style>
        <script type="text/javascript" src="funciones/jquery-1.6.1.min.js"></script>
        <script type="text/javascript" src="funciones/jquery.nivo.slider.pack.js"></script>
        <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider();
        });
        </script>
    </head>
	<body>
		<div id="galeria">
          	<div id="slider" class="nivoSlider">
				<?php
					$directory="../aplicacion/img_proy/".$_SESSION['id_proyecto'];
 						$dirint = dir($directory);
							while (($archivo = $dirint->read()) !== false)
							{
								if (eregi("gif", $archivo) || eregi("jpg", $archivo) || eregi("png", $archivo)){
									echo '<img src="'.$directory."/".$archivo.'">'."\n";
								}
							}
							$dirint->close();
				?>
			</div>
		</div>
	</body>
</html>