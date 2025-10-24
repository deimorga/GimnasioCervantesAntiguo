<?
session_start();

include_once("../funciones/funciones_aula.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

if($_SESSION['id_actividad_aula']!=NULL){
	//echo "ENTRO!!!";
	$existe_0=getActividadAulaId($_SESSION['id_actividad_aula']);
	if($existe_0){
		$_SESSION['tipo_actividad_aula']=$existe_0['tipo_actividad_aula'];
	}
}
?>
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">

<div class="gridcontainer clearfix">
	<div class="grid_3">
		<div class="fmcircle_out">

        	<a href="#area_trabajo_alumno" onclick="FAjax('./aula/info_clase.php','concepto','','post');">
            <?	if(file_exists("../iconos/info.png")){
			?><img src="./iconos/info.png" width="180" height="165" /><?
			}else{ 
			?><img src="./iconos/default.png" width="180" height="165" /><?
			}
			?>
						<span>INFORMACI&Oacute;N CLASE</span>
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

        	<a href="#area_trabajo_alumno" onclick="FAjax('./aula/listado_elementos.php?btn_edita=1','concepto','','post');">
            <?	if(file_exists("../iconos/1.png")){
			?><img src="./iconos/1.png" width="180" height="165" /><?
			}else{ 
			?><img src="./iconos/default.png" width="180" height="165" /><?
			}
			?>
						<span>ELEMENTOS</span>
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


        	<a href="#area_trabajo_alumno" onclick="FAjax('./aula/listado_preguntas.php?btn_edita=1','concepto','','post');">
            <?	if(file_exists("../iconos/61.png")){
			?><img src="./iconos/61.png" width="180" height="165" /><?
			}else{ 
			?><img src="./iconos/default.png" width="180" height="165" /><?
			}
			?>
						<span>PREGUNTAS</span>
					</div>
				</div>
			</a>
		</div>
	</div>        
</div>        
</div>



<?
if($_SESSION['tipo_actividad_aula']==2 && $_SESSION["user_tipo"]==3){
?>
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">

<div class="gridcontainer clearfix">
	<div class="grid_3">
		<div class="fmcircle_out">


        	<a href="#area_trabajo_alumno" onclick="FAjax('./aula/subir_archivo_taller.php?btn_edita=1','concepto','','post');">
            <?	if(file_exists("../iconos/61.png")){
			?><img src="./iconos/descargar.gif" width="180" height="165" /><?
			}else{ 
			?><img src="./iconos/default.png" width="180" height="165" /><?
			}
			?>
						<span>SUBIR ARCHIVO</span>
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
<?
if($_SESSION['tipo_actividad_aula']==2 && $_SESSION["user_tipo"]==2){
?>

<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">

<div class="gridcontainer clearfix">
	<div class="grid_3">
		<div class="fmcircle_out">

        	<a href="#area_trabajo_alumno" onclick="FAjax('./aula/archivos_taller_cargados.php','concepto','','post');">
            <?	if(file_exists("../iconos/61.png")){
			?><img src="./iconos/descargar.gif" width="180" height="165" /><?
			}else{ 
			?><img src="./iconos/default.png" width="180" height="165" /><?
			}
			?>
						<span>ARCHIVOS CARGADOS</span>
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

<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">

<div class="gridcontainer clearfix">
	<div class="grid_3">
		<div class="fmcircle_out">

      <a href="#area_trabajo_alumno" onclick="FAjax('','cuerpo','','post');">
      <?	if(file_exists("../iconos/23.png")){
			?><img src="./iconos/23.png" width="180" height="165" /><?
			}else{ 
			?><img src="./iconos/default.png" width="180" height="165" /><?
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

