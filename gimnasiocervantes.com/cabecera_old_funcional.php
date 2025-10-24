<div style="margin-top:95px;">
<table width="100%">
    <tr>
        <td>
            <audio controls>
            	<source src="./audio/sonido.mp3" type="audio/mpeg" />
            	<a href="./audio/sonido.mp3">HIMNO</a>
            </audio>
        </td>
        <td >
            <marquee>
                  <h3>COLEGIO GIMNASIO CERVANTES <small>"Parte Integral de la Formaci&oacute;n y Desarrollo de Aptitudes y Valores"</small></h3>
                  
            </marquee>
        </td>
    </tr>    
</table>
</div>
    
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner">

	<?php
	$directory="./header_galery/img/lolo";
 	$dirint = dir($directory);
	$cont=0;
	while (($archivo = $dirint->read()) !== false){
		if (preg_match("/gif/", $archivo) || preg_match("/jpg/", $archivo) || preg_match("/png/", $archivo)){
		$cont=$cont+1;
		//echo "Cont".$cont;
			if($cont==1){
			//die($directory."/".$archivo);
			?>
              <div class="item active">
                <img src="<?=$directory."/".$archivo?>" alt="Los Angeles" style="width:100%; max-height:520px;">
              </div>
			<?
			}else{
			?>
              <div class="item">
                <img src="<?=$directory."/".$archivo?>" alt="Los Angeles" style="width:100%; max-height:520px;">
              </div>
			<?
			}
		}
	}
	$dirint->close();
	?>

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
