<?
include ("../funciones/conexion.php");
include ("../funciones/funciones.php");

$contactos=getContactos();
//print_r($hotel);
?>
		<div id="content">
			<div id="left">
				<div id="welcome">
                	<h2>Listado de contactos del cliente.</h2>
<table class="table table-hover table-striped table-bordered">
  <thead>
    <tr>
    <th>Cliente</th>
    <th>Asunto</th>
    <th>Fecha</th>
    <th>&nbsp;</th>
  </tr>
  </thead>
  <tbody>
<?
for($i=0;$i<count($contactos);$i++){
?>
  <tr>
    <td><?=$contactos[$i]["nombre"]?></td>
    <td><?=$contactos[$i]["objeto"]?></td>
    <td><?=$contactos[$i]["fecha"]?></td>
    <td><a href="#" onclick="FAjax('./administrativo/ver_contacto.php?id=<?=$contactos[$i]["id_contacto"]?>','area_trabajo','','post');" class="link_right"> TRAMITAR >></a></td>
  </tr>
<?
}
?>
</tbody>                    
</table>
                    
				</div>
			</div>
            
            
            
            
            
            
			
			<div class="clear"></div>
		</div>