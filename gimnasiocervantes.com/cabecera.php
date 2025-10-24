<div class="row" align="center" style="margin-top:55px;">

    <div class="col-lg-12" style="background-color:#151515;">
        <table width="100%"><tr><td width="110px">&nbsp;Himno del colegio&nbsp;</td><td><audio controls style="width: 100%; height:20px;">
            <source src="./audio/sonido.mp3" type="audio/mpeg" />
                <a href="./audio/sonido.mp3">HIMNO</a>
        </audio></td></tr></table>
    </div>
    <div class="col-lg-12" style="background-color:#151515;">
        <marquee>
            <i style="font-size:24px;"><b>COLEGIO GIMNASIO CERVANTES </b><small>"Parte Integral de la Formaci&oacute;n y Desarrollo de Aptitudes y Valores"</small></i>
        </marquee>
    </div>
    <div class="col-lg-12 bgline1">
        <img src="images/spacer.gif" alt="" width="1" height="4" />
    </div>
    <div class="col-lg-12">
    <div  align="center" style="max-width:90%;">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
    
            <!-- Wrapper for slides -->
            <div class="carousel-inner"  style="background-color:#999; -webkit-box-shadow: 0px 6px 9px 1px rgba(0,0,0,0.48);
-moz-box-shadow: 0px 6px 9px 1px rgba(0,0,0,0.48);
box-shadow: 0px 6px 9px 1px rgba(0,0,0,0.48);
-webkit-border-bottom-right-radius: 45px;
-webkit-border-bottom-left-radius: 45px;
-moz-border-radius-bottomright: 45px;
-moz-border-radius-bottomleft: 45px;
border-bottom-right-radius: 45px;
border-bottom-left-radius: 45px;">
    
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
                        <img src="<?=$directory."/".$archivo?>" alt="Los Angeles" style="width:100%; max-height:450px;">
                      </div>
                    <?
                    }else{
                    ?>
                      <div class="item">
                        <img src="<?=$directory."/".$archivo?>" alt="Los Angeles" style="width:100%; max-height:450px;">
                      </div>
                    <?
                    }
                }
            }
            $dirint->close();
            ?>
    
    
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Next</span>
            </a>
    
          <ol class="carousel-indicators">
            <?
            for($j=0;$j<$cont;$j++){
                if($j==0){
                ?>
                <li data-target="#myCarousel" data-slide-to="<?=$j?>" class="active"></li>
                <?
                }else{
                ?>
                <li data-target="#myCarousel" data-slide-to="<?=$j?>"></li>
                <?
                }
            }
            ?>
          </ol>
    		</div>
        </div>
    </div>
    </div>
</div>

