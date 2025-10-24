<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$grado=getGrados();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div id="filtro">
    
<h2>Filtro de Grados para inscriopcion de alumnos</h2>
	<fieldset>
		<legend class="texte_legende">Seleccion de Grado</legend>
        <table cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td class="texte">Grado:</td>
				<td>
                
                <select name="grado" class="champ2" id="grado" >
                	<option value="">Seleccione...</option>
<?
for($i=0;$i<count($grado);$i++){
?>
                    <option value="<?=$grado[$i]['id_grado']?>" ><?=$grado[$i]['nombre_grado']?></option>
<?
}
?>
                </select>
                
                </td>
			</tr>
		</table>
	</fieldset>
    <input name="filtra_grado" id="filtra_grado" type="hidden" value="0">
	<input class="button_send" name="puente_usuario" id="puente_usuario" type="button" value="ACEPTAR" onclick="valida_seleccionar_grado(this.form);">    
    
	</div>
    </td>
  </tr>
  <tr>
    <td><div id="gestion"><?
    if($_SESSION['grupo_asignatura']!="" && $_SESSION['periodo_academico']!=""){
		include('gestionar_plan.php');
	}
	?></div></td>
  </tr>
</table>

