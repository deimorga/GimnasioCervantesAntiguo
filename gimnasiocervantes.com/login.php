<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" style="color:#666;">
         <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 id="tituloModal">Ingreso Seguro.</h3>
            <small>Presione (ESC) para Cerrar Ventana.</small>
     	 </div>
         <div class="modal-body">
            <p id="textModal">
                <div id="info">
<p>Bienvenido al modulo de control y administración del Colegio Gimnasio Cervantes – Facatativ&aacute;. Modulo por medio del cual usted podr&aacute; realizar todas aquellas consultas y funciones para las cuales este habilitado, esperando de usted una actitud de suma responsabilidad y compromiso con la manipulación del mismo, para as&iacute; mismo facilitar nuestra labor dentro de la organización y luchar todos juntos por el crecimiento y progreso de nuestros estudiantes.</p>
	<h5>Datos de usuario</h5>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td style="color:#333;">Identificacion :</td>
				<td><input class="champ" type="text" name="identificacion" id="identificacion"></td>
			</tr>
			<tr>
				<td style="color:#333;">Clave :</td>
				<td><input class="champ" type="password" name="clave" id="clave"></td>
			</tr>
		</table>
	<input class="button_send" name="ingreso" id="ingreso" type="button" value="INGRESAR" onclick="FAjax('./index.php','contenido_usuario','','post');">    
                </div>
            </p>
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