<?
include_once("./funciones/funciones.php");
include_once("./funciones/conexion.php");
?>
<div class="row" align="center" style="margin:0; background-color:#666; color:#FFF;">
	<h2>Como Ubicarnos...</h2>
</div>
<div class="row" style="margin-bottom:0;">
	<div class="col-md-12">
          <div id="mapa" style="width:100%;height:400px;"></div><br>
          <script type="text/javascript">
		  function initMap(){
			<?php
			$data = getSedes();
			//print_r($data);
			if(count($data)>0){
			?>
            var bcn = new google.maps.LatLng(<?=$data[0]['lat']?>,<?=$data[0]['lng']?>);
			<?
			}else{
			?>
            var bcn = new google.maps.LatLng(4.81584,-74.3542);
			<?
			}
			?>
            var mapOptions = {
                center: bcn,
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
              };
            map = new google.maps.Map(document.getElementById('mapa'), mapOptions);
            <?php
            for ($i=0;$i < count($data);$i++) {
				//die("LATITUD: ".$data[$i]['lat']);
				$num=$i+1;
            ?>
              var marker<?=$num;?> = new google.maps.Marker({
                position: new google.maps.LatLng(<?php echo $data[$i]['lat']; ?>, <?php echo $data[$i]['lng']; ?>),
                map: map,
                title: <?php echo "'".$data[$i]['nombre']."'"; ?>,
              });
 
              var contentString = "<h4 style='color:#333;'><span class='glyphicon glyphicon-asterisk' aria-hidden='true'></span>&#160;<?php echo "".$data[$i]['nombre'].""; ?></h4><p style='color:#333;'><span class='glyphicon glyphicon-screenshot' aria-hidden='true'></span>&#160;<b>Dirección</b><br> <?php echo "".$data[$i]['direccion'].""; ?></p><p style='color:#333;'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>&#160;<b>Descripción</b><br><?php echo "".$data[$i]['descripcion'].""; ?></p>"
 
              var infowindow<?=$num;?> = new google.maps.InfoWindow({
                content: contentString
              });
 
              google.maps.event.addListener(marker<?=$num;?>, 'click', function() {
                infowindow<?=$num;?>.open(map,marker<?=$num;?>);
              });
            <?php
            }
            ?>
		  	}
            </script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDB-Sjy9UZzkegWeQH5wNA4KlGW0zTgyxI&callback=initMap"></script>
        </div>
      </div>

