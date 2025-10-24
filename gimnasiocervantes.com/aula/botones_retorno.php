<?
session_start();
$action="";
if($_SESSION["user_tipo"]==2){
	$action="./principal_aulas.php";
}else{
	$action="./principal_usuario.php";
}
?>
<div class="row">
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">

<div class="gridcontainer clearfix">
	<div class="grid_3">
		<div class="fmcircle_out">
			<a href="#area_trabajo_alumno" onclick="FAjax('<?=$accion?>','cuerpo','','post');">
				<div class="fmcircle_border">
				    
					<div class="fmcircle_in fmcircle_blue">
		<?	if(file_exists("../iconos/23.png")){
		?><img src="../iconos/23.png" width="180" height="165" /><?
		}else{ 
		?><img src="../iconos/default.png" width="180" height="165" /><?
		}
		?>
						<span>Menu Principal</span>
					</div>
				</div>
			</a>
		</div>
	</div>        
</div>        
</div>


<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">

<div class="gridcontainer clearfix">
	<div class="grid_3">
		<div class="fmcircle_out">
			<a href="#area_trabajo_alumno" onclick="FAjax('./cerrar_session.php','cuerpo','','post');">
				<div class="fmcircle_border">
				    
					<div class="fmcircle_in fmcircle_blue">
		<?	if(file_exists("../iconos/46.png")){
		?><img src="../iconos/46.png" width="180" height="165" /><?
		}else{ 
		?><img src="../iconos/default.png" width="180" height="165" /><?
		}
		?>
						<span>Cerrar Sesion</span>
					</div>
				</div>
			</a>
		</div>
	</div>        
</div>        
</div>        
</div>
