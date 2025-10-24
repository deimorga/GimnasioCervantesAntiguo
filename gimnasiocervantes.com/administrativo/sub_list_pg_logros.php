<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$enlaces=seleccionaPlanGestor("tbl_logro", $_GET['id_pg']);
$count_enlaces=count($enlaces);
//die("Entro!!!".$_GET['id_pg']);
if($_SESSION["vistazo_list_pg_".$_GET['id_pg']]==1){
	$_SESSION["vistazo_list_pg_".$_GET['id_pg']]=0;
}else{
	if($count_enlaces==0){
		$_SESSION["vistazo_list_pg_".$_GET['id_pg']]=1;
		?>
		  <li class="list-group-item">
		  <small>
			&nbsp;No hay logros registrados...
		  </small>
		  </li>
		<?
	}else{
		$_SESSION["vistazo_list_pg_".$_GET['id_pg']]=1;
		?>
		<h3>Logros registrados:</h3>
		<?
		for($k=0;$k<$count_enlaces;$k++){
		?>
            <strong style="font-size:14px">
			<?
            for($k=0;$k<count($enlaces);$k++){
			?>	
            <div style="border-bottom:1px groove; width:100%">
				* <?=$enlaces[$k]['logro']?>
			</div>
			<?
			}
			?>
            </strong>

		<?
		}
	}
}
?>