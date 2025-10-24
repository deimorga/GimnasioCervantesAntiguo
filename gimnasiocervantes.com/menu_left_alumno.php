<?
session_start();

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$enlaces=getEnlacesModulo(9);
for($j=0;$j<count($enlaces);$j++){
?>
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">

<div class="gridcontainer clearfix">
	<div class="grid_3">
		<div class="fmcircle_out">
			<a href="#area_trabajo_alumno" onclick="FAjax('<?=$enlaces[$j]['url_enlace']?>','area_trabajo_alumno','','post');">
				<div class="fmcircle_border">
				    
					<div class="fmcircle_in fmcircle_blue">
		<?	if(file_exists("./iconos/".$enlaces[$j]['id_enlace'].".png")){
		?><img src="./iconos/<?=$enlaces[$j]['id_enlace']?>.png" width="180" height="165" /><?
		}else{ 
		?><img src="./iconos/default.png" width="180" height="165" /><?
		}
		?>
						<span><?=$enlaces[$j]['nombre_enlace']?></span>
					</div>
				</div>
			</a>
		</div>
	</div>        
</div>        
</div>
<?
}
?>