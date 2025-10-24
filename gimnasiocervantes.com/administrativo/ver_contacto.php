<?
//session_start();
include_once ("../funciones/conexion.php");
include_once ("../funciones/funciones.php");

if($_REQUEST['tramitado']){
	$tramitado=updContacto($_REQUEST['id_contacto']);
	if($tramitado){
		echo "<script>alert('Solicitud tramitada.');FAjax('./administrativo/listado_contactos.php','area_trabajo','','post');</script>";	
	}else{
		echo "<script>alert('Queda pendiente.');FAjax('./administrativo/listado_contactos.php','area_trabajo','','post');</script>";	
	}
}

$contacto=getContactoId($_REQUEST['id']);
?>
<div id="content">
  <div id="left">
			  <div id="welcome">
					<h2> Datos del contacto hecho por el cliente.</h2>

					<div id="form_contact">
						<strong>Datos de usuario</strong><br />
						<br />
							<fieldset>
								<legend class="texte_legende">DATOS
								</legend><table cellpadding=5 cellspacing=0 border="0">
								<tr>
									<td class="texte">Nombre :</td>
									<td><?=$contacto['nombre']?></td>
								</tr>
								<tr>
									<td class="texte">Telefono :</td>
									<td><?=$contacto['telefono']?></td>
								</tr>
								<tr>
									<td class="texte">Correo :</td>
									<td><?=$contacto['correo']?></td>
								</tr>
								</table>
							</fieldset>
						<br />
							<fieldset>
								<legend class="texte_legende">CONTACTO
								</legend><table cellpadding=5 cellspacing=0 border="0">
								<tr>
									<td class="texte">Objeto :</td>
									<td><?=$contacto['objeto']?></td>
								</tr>
								<tr>
									<td class="texte">Fecha :</td>
									<td><?=$contacto['fecha']?></td>
								</tr>
								<tr>
									<td class="texte">Mensaje :</td>
									<td><?=$contacto['mensaje']?></td>
								</tr>
								</table>
							</fieldset>
							<br>
							
							<table width="380" border="0" cellpadding=0 cellspacing=0>
							<tr>
								<td colspan="2" align="center"><input type="hidden" name="id_contacto" value="<?=$_REQUEST['id']?>">
                                <input class="button_send" name="pendiente" type="button" onClick="FAjax('./administrativo/listado_contactos.php','area_trabajo','','post');" value="PENDIENTE">&nbsp;&nbsp;&nbsp;<input class="button_send" name="tramitado" type="button" value="TRAMITADO" onClick="FAjax('./administrativo/ver_contacto.php','area_trabajo','','post');"></td>
							</tr>
							</table>
				</div>
					
</div>
</div>
<div class="clear"></div>
</div>