<?
include_once ("../funciones/conexion.php");
include_once ("../funciones/funciones.php");

if($_GET['borrar']){
	//die("Entro!!!");
	$campo=$_REQUEST['borrar'];
	$borro=delEnlacePrincipal($campo);
	if($borro){
		echo "<script>alert('Se borro la Enlace');</script>";
	}else{
		echo "<script>alert('No se borro la Enlace');</script>";
	}
//echo $campo."*****".$valor;
}

if($_GET['borrar_contenido']){
	//die("Entro!!!");
	$campo=$_REQUEST['borrar_contenido'];
	$borro=delContenidoEnlace($campo);
	if($borro){
		echo "<script>alert('Se borro la Contenido');</script>";
	}else{
		echo "<script>alert('No se borro la Contenido');</script>";
	}
//echo $campo."*****".$valor;
}
$strIn="0,1";
$evento=getEnlacesPrincipal($strIn);
//print_r($hotel);
?>
<table class="table table-hover table-striped table-bordered">
  <thead>
    <th>Acci&oacute;n</th>
    <th>Nombres</th>
    <th>Descripcion</th>
    <th>Tablas de Contenidos</th>
  </thead>
  <tbody>
<?
for($i=0;$i<count($evento);$i++){
?>

  <tr>
  	<td>
            <div class="dropdown">
              <button class="btn-xs btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Acciones
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

                <li><a href="#" onClick="FAjax('./administrativo/nueva_noticia_2.php?id_enlace_principal=<?=$evento[$i]['id_enlace_principal']?>','area_trabajo','','post');">Gestionar Contenidos</a></li>

                <li role="separator" class="divider"></li>

                <li><a href="#" onClick="FAjax('./administrativo/nuevo_enlace.php?id_enlace_principal=<?=$evento[$i]['id_enlace_principal']?>','area_trabajo','','post');">Editar Información</a></li>

                <li role="separator" class="divider"></li>

                <li><a href="#" onClick="if(confirm('Esta seguro de borrar el registro?')){ FAjax('./administrativo/listado_enlaces.php?borrar=<?=$evento[$i]['id_enlace_principal']?>','list_enlace_principal','','post');}else{ return false;}">Borrar Enlace</a></li>

              </ul>
            </div>
	</td>  
    <td><?=$evento[$i]['nombre_enlace_principal']?></td>
    <td><?=$evento[$i]['descripcion_enlace_principal']?></td>
    <td>
	<?
	$contenidos=getContenidosEnlace($evento[$i]['id_enlace_principal']);
	$num_contenidos=count($contenidos);
	if($num_contenidos>0){
	/////////////////////////////////////////////////////////////////////////////////////////////
	?>
    <table class="table table-hover table-striped table-bordered">
      <thead>
        <th>Acci&oacute;n</th>
        <th>Nombres</th>
        <th>Tipo Contenido</th>
        <th>Acceso Directo</th>
      </thead>
      <tbody>
    <?
    for($j=0;$j<$num_contenidos;$j++){
    ?>
    
      <tr>
        <td>
                <div class="dropdown">
                  <button class="btn-xs btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Acciones
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    
                    <li><a href="#" onClick="FAjax('./administrativo/nueva_noticia_2.php?id_enlace_principal=<?=$contenidos[$j]['id_contenido_enlace']?>&edita_contenido=1&id_contenido_enlace=<?=$contenidos[$j]['id_contenido_enlace']?>','area_trabajo','','post');">Editar Contenido</a></li>
    
                    <li role="separator" class="divider"></li>
    				<?
                    if($contenidos[$j]['id_tipo_contenido_enlace']==1){
					?>
                    <li><a href="#" onClick="FAjax('<?=$contenidos[$j]['html_code']?>','area_trabajo','','post');">Ver Contenido</a></li>
    				<?
					}elseif($contenidos[$j]['id_tipo_contenido_enlace']==3){
					?>
                    <li><a href="#" onClick="FAjax('./ver_contenido_enlace.php?id_contenido_enlace=<?=$contenidos[$j]['id_contenido_enlace']?>','area_trabajo','','post');">Ver Contenido</a></li>
    				<?
					}else{
					?>
                    <li><a href="#" onClick="window.open('./aplicacion/doc/<?=$evento[$i]['id_enlace_principal']?>/<?=$contenidos[$j]['html_code']?>');">Ver Contenido</a></li>
    				<?
					}
					?>
                    <li role="separator" class="divider"></li>
    
                    <li><a href="#" onClick="if(confirm('Esta seguro de borrar el registro?')){ FAjax('./administrativo/listado_enlaces.php?borrar_contenido=<?=$contenidos[$j]['id_contenido_enlace']?>','list_enlace_principal','','post');}else{ return false;}">Borrar Contenido</a></li>
    
                  </ul>
                </div>
        </td>  
        <td><?=$contenidos[$j]['nombre_contenido_enlace']?></td>
        <td><?=$contenidos[$j]['nombre']?></td>
        <td><? if(strlen($contenidos[$j]['icono'])>0){ ?><img src="./iconos_png_web/<?=$contenidos[$j]['icono']?>" width="70px" height="70px"/><? }else{ echo "No Aplica.";}?></td>
      </tr>
    
    <?
    }
    ?>                    
      </tbody>
    </table>
	<?
	/////////////////////////////////////////////////////////////////////////////////////////////
	}else{
		echo "No hay contenidos registrados.";
	}
    ?>
    </td>
  </tr>

<?
}
?>                    
  </tbody>
</table>
