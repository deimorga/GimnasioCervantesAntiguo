<?
session_start();
include_once ("../funciones/conexion.php");
include_once ("../funciones/funciones.php");

$alumno=getAlumnosAcudiente($_SESSION['user_id']);
?>
<h1> Familiares registrados.</h1>
<table width="850px" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    
	<h2>Seleccion del alumno</h2>
	<fieldset>
		<legend class="texte_legende">Datos del alumno</legend>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td class="texte">Alumno:</td>
				<td>
                
                <select name="alumno_registrado" class="champ2" id="alumno_registrado" >
                	<option value="">Seleccione...</option>
<?
for($i=0;$i<count($alumno);$i++){
?>
                    <option value="<?=$alumno[$i]['identificacion']?>" ><?=$alumno[$i]['identificacion']." - ".$alumno[$i]['nombre_alumno']?></option>
<?
}
?>
                </select>
                
                </td>
			</tr>
		</table>
	</fieldset>
	<input class="button_send" name="puente_usuario" id="puente_usuario" type="submit" value="ACEPTAR" onclick="return valida_seleccionar_alumno(this.form);">    
    
    </td>
    <td><div id="msj"><p>
    Bienvenido al modulo de control y administración de la organización Estudiantes de la plata – Colombia. Modulo por medio del cual usted podrá realizar todas aquellas actividades para las cuales este habilitado, esperando de usted una actitud de suma responsabilidad y compromiso con la manipulación del mismo, para así mismo facilitar nuestra labor dentro de la organización y luchar todos juntos por el crecimiento y progreso de nuestros estudiantes.
    </p></div></td>
  </tr>
</table>