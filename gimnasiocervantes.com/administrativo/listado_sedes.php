<?
include_once ("../funciones/conexion.php");
include_once ("../funciones/funciones.php");

if($_GET['borrar']){
	//die("Entro!!!");
	$campo=$_REQUEST['borrar'];
	$borro=delSede($campo);
	if($borro){
		echo "<script>alert('Se borro la Sede');</script>";
	}else{
		echo "<script>alert('No se borro la Sede');</script>";
	}
//echo $campo."*****".$valor;
}

$evento=getSedes();
//print_r($hotel);
?>
<table class="table table-hover table-striped table-bordered">
  <thead>
    <th>Acci&oacute;n</th>
    <th>Nombres</th>
    <th>Direccion</th>
    <th>Descripcion</th>
    <th>Lat</th>
    <th>Lng</th>
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
                <li><a href="#" onClick="FAjax('./administrativo/nueva_sede.php?id_sede=<?=$evento[$i]['id_sede']?>','area_trabajo','','post');">Editar Información</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#" onClick="if(confirm('Esta seguro de borrar el registro?')){ FAjax('./administrativo/listado_sedes.php?borrar=<?=$evento[$i]['id_sede']?>','list_sedes','','post');}else{ return false;}">Borrar Sede</a></li>
              </ul>
            </div>
	</td>  
    <td><?=$evento[$i]['id_sede']."-".$evento[$i]['nombre']?></td>
    <td><?=$evento[$i]['direccion']?></td>
    <td><?=$evento[$i]['descripcion']?></td>
    <td><?=$evento[$i]['lat']?></td>
    <td><?=$evento[$i]['lng']?></td>
  </tr>

<?
}
?>                    
  </tbody>
</table>
