<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$alumnos=getAlumnos($_REQUEST['grado_alumno'],$_REQUEST['grupo_alumno'],$_REQUEST['nombre_alumno'], $_REQUEST['id_alumno']);
?>
	<fieldset>
		<legend class="texte_legende2">Filtro por datos del alumno.</legend>
        <table cellpadding=5 cellspacing=0 border="0">
				<td class="texte2">Grado:</td>
				<td><select name="grado_alumno" class="champ2" id="grado_alumno" >
                	<option value="">Seleccione...</option>
<?
$grado=getGrados();
for($i=0;$i<count($grado);$i++){
?>
                    <option value="<?=$grado[$i]['id_grado']?>"><?=$grado[$i]['nombre_grado']?></option>
<?
}
?>
                </select></td>
			</tr>
				<td class="texte2">Grupo:</td>
				<td><select name="grupo_alumno" class="champ2" id="grupo_alumno" >
                	<option value="">Seleccione...</option>
<?
$grupo=getGrupos();
for($i=0;$i<count($grupo);$i++){
?>
                    <option value="<?=$grupo[$i]['id_grupo']?>" ><?=$grupo[$i]['nombre_grupo']?></option>
<?
}
?>
                </select></td>
			</tr>
 			<tr>
				<td class="texte2">Ingrese la identificacion del alumno:</td>
				<td><input type="text" class="champ2" name="id_alumno" id="id_alumno" onkeypress="return numeros(event);" ></td>
            </tr>
 			<tr>
				<td class="texte2">Ingrese el nombre del alumno:</td>
				<td><input type="text" class="champ2" name="nombre_alumno" id="nombre_alumno" ></td>
            </tr>
  		</table>
	</fieldset>
        <table width="100%" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="informe_alumnos" id="informe_alumnos" type="button" value="FILTRAR LISTADO" onClick="FAjax('./administrativo/listado_alumnos.php','area_trabajo','','post');"></td>
			</tr>
        </table>
<?
if($_GET['pago']==1){
	?>
	        <table width="100%" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input class="button_send" name="informe_alumnos" id="informe_alumnos" type="button" value="PAGO POR OTRO CONCEPTO" onClick="FAjax('./administrativo/pago_otros.php','area_trabajo','','post');"></td>
			</tr>
        </table>
		<?
}else{
?>
<h2>Listado de alumnos registrados.</h2>
<div class="table-responsive">
    
<table class="table table-hover table-striped table-bordered">
  <thead>
    <tr>
    <th>Acci&oacute;n</th>
    <th>#</th>
    <th>Identificaci&oacute;n</th>
    <th>Clave</th>
    <th>Nombre</th>
    <th>Grado</th>
    <th>Grupo</th>
    <th>Pension</th>
    </tr>
  </thead>
  <tbody>
<?
for($i=0;$i<count($alumnos);$i++){
?>
  <tr>
    <td align="center">
    		<div id="<?=$alumnos[$i]['identificacion']?>"></div>
            <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Acciones
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="#" onClick="FAjax('./administrativo/nuevo_estudiante.php?identificacion=<?=$alumnos[$i]['identificacion']?>','area_trabajo','','post');">Editar Información</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#" onClick="FAjax('./administrativo/registro_pago.php?identificacion=<?=$alumnos[$i]['identificacion']?>&pago_nuevo=1','area_trabajo','','post');">Registro Pagos</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#<?=$alumnos[$i]['identificacion']?>" onClick="FAjax('./administrativo/list_historial_pagados.php?identificacion=<?=$alumnos[$i]['identificacion']?>&externo=1','<?=$alumnos[$i]['identificacion']?>','','post');">Historial Pagos</a></li>
              </ul>
            </div>
        
    </td>
    <td><?=$i+1?></td>
    <td><?=$alumnos[$i]['identificacion']?></td>
    <td><?=$alumnos[$i]['clave_usuario']?></td>
    <td><?=$alumnos[$i]['nombre_alumno']?></td>
    <td><?=$alumnos[$i]['nombre_grado']?></td>
    <td><?=$alumnos[$i]['nombre_grupo']?></td>
    <td><?=number_format($alumnos[$i]['pension'],0,'.',',')?></td>
  </tr>
<?
}
?>
  </tbody>
</table>
</div>
<?
}
?>