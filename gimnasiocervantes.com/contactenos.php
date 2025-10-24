<?
include_once ("./funciones/conexion.php");
include_once ("./funciones/funciones.php");

if(isset($_REQUEST['enviar']) && strlen($_REQUEST['nombre'])>5){
	$contacto=setContacto($_REQUEST['nombre'],$_REQUEST['telefono'],$_REQUEST['correo'],$_REQUEST['objeto'],$_REQUEST['msj']);
	if($contacto){
		echo "<script>alert('Insersion satisfactoria.');</script>";	
	}else{
		echo "<script>alert('No se registraron sus datos.');</script>";	
	}
}
?>

<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content" style="color:#666;">
    		<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="tituloModal">Informaci&oacute;n de Contacto.</h3>
                <small>Presione (ESC) para Cerrar Ventana.</small>
			</div>
            <div class="modal-body">
                <div id="info">
                    <p id="textModal">
                    <strong>Nombre de la empresa</strong><br />
                    Colegio "Gimnasio Cervantes".<br/> <br/> 
                    <strong>Telefax</strong>: 1-8430744<br/>
                    <strong>Correo</strong>: colegiogimnasiocervantes@hotmail.com<br />
                    <strong>Responsable</strong>: Libia In&eacute;s Beltr&aacute;n<br />
                    <h5>Datos de Contacto</h5>
                    <div class="col-xs-12">
                        Nombre :
                        <input class="form-control" type="text" placeholder="Tu nombre..." name="nombre" id="nombre">
                    </div>
                    <div class="col-xs-12">
                        Telefono :
                        <input class="form-control" type="text" placeholder="Tu telefono..." name="telefono"  id="telefono" >
                    </div>
                    <div class="col-xs-12">
                        Correo :
                        <input class="form-control" placeholder="Tu correo electronico..." type="text" name="correo"  id="correo" >
                    </div>
                                            
                    <div class="col-xs-12">
                        Objeto :
                        <input class="form-control" placeholder="Motivo del contacto..." type="text" name="objeto" id="objeto">
                    </div>
                    <div class="col-xs-12">
                        Mensaje :
                        <textarea class="form-control" placeholder="Escribe el mensaje de contacto..." name="msj" id="msj"></textarea>
                    </div>
                    <div class="col-xs-12">
                
	                    <input class="btn btn-success" type="button" value="Enviar" onclick="valida_contact(this.form);" name="enviar">                
                    </p>
                </div>
        	</div>
            <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-info">Cerrar</button>
            </div>
    	</div>
	</div>
</div>
<?
if(true){
	echo '
<script>
FAjax("disparar_popup.php","contenido_popup","","post");
</script>';
}
?>