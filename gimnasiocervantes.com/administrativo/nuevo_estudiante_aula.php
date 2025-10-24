<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$id="";
$expedida="";
$nombre="";
$fecha="";
$lugar="";
$sangre="";
$seguro="";
$nombre_eps="";
$procedencia="";
$grado_alumno="";

if($_POST["actualiza"]==1){
	$inserta=setAlumnoAula($_POST['identificacion'],$_POST['expedida'],$_POST['nombre'],$_POST['fecha'],$_POST['lugar'],$_POST['sangre'],$_POST['seguro'],$_POST['nombre_eps'],$_POST['procedencia'],$_POST['grado'],$_POST['pension']);
	$_SESSION["alumno_ingreso"]=$_POST['identificacion'];
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if(isset($_SESSION['esturiante_matriculado'])){
	$id=$_SESSION['esturiante_matriculado'];
	$alumno=getAlumnoId($id);
	if($alumno){
		$expedida=$alumno["lugar_expedicion"];
		$nombre=$alumno["nombre_alumno"];
		$fecha=$alumno["fecha_nacimiento"];
		$lugar=$alumno["lugar_nacimiento"];
		$sangre=$alumno["rh"];
		$seguro=$alumno["nivel_sisben"];
		$nombre_eps=$alumno["eps"];
		$procedencia=$alumno["procedencia"];
		$grado_alumno=$alumno["id_grado"];
		$_SESSION["alumno_ingreso"]=$id;
		$pension=$alumno['pension'];
	}
}
include("../aula/botones_retorno.php");
?>
<h2>Inscripci&oacute;n de alumnos.</h2>

	<fieldset>
		<legend class="texte_legende2">Datos del alumno.</legend>
		
		<div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">Identificacion:</br>
			<input value="<?=$id?>" class="champ2" type="text" name="identificacion" id="identificacion" onkeypress="return numeros(event);" <? if($_SESSION["user_tipo"]==1){?>onblur="FAjax('./administrativo/nuevo_estudiante.php','area_trabajo','','post');"<? }else{ echo 'readonly="readonly"';}?>> *
		</div>
				    
		
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">Expedida:</br>
			<input value="<?=$expedida?>" class="champ2" type="text" name="expedida" id="expedida" /> *
		</div>
				    
		
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">Nombre del alumno:</br><input class="champ2" type="text" name="nombre" id="nombre" value="<?=$nombre?>"> *
		</div>
				    
		
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">Lugar de nacimiento:</br><input class="champ2" type="text" name="lugar" id="lugar" value="<?=$lugar?>"> *
		</div>
		</div>
				    
		<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">Fecha de nacimiento:</br><input class="champ2" style="width:100px; height:15" name="fecha" id="fecha" onFocus='Calendar.setup({inputField:"fecha",ifFormat:"%Y-%m-%d",button:"calen"});'
  readonly="true" value="<?=$fecha?>"/> *
		</div>
				    
		
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">RH:</br><select class="champ2" name="sangre" id="sangre">
                	<option value="">Seleccione...</option>
                    <option value="A" <? if($sangre=="A"){ echo "selected='selected'";}?> >A/positivo</option>
                    <option value="A-" <? if($sangre=="A-"){ echo "selected='selected'";}?> >A/negativo</option>
                    <option value="B" <? if($sangre=="B"){ echo "selected='selected'";}?> >B/positivo</option>
                    <option value="B-" <? if($sangre=="B-"){ echo "selected='selected'";}?> >B/negativo</option>
                    <option value="AB" <? if($sangre=="AB"){ echo "selected='selected'";}?> >AB/positivo</option>
                    <option value="AB-" <? if($sangre=="AB-"){ echo "selected='selected'";}?> >AB/negativo</option>
                    <option value="O" <? if($sangre=="O"){ echo "selected='selected'";}?> >O/positivo</option>
                    <option value="O-" <? if($sangre=="O-"){ echo "selected='selected'";}?> >O/negativo</option>
                </select> *
		</div>
				    
		
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">Seguridad social:</br><select name="seguro" class="champ2" id="seguro" >
                	<option value="">Seleccione...</option>
                    <option value="EPS" <? if($seguro=="EPS"){ echo "selected='selected'";}?> >EPS</option>
                    <option value="SISBEN" <? if($seguro=="SISBEN"){ echo "selected='selected'";}?> >SISBEN</option>
                    <option value="ARS" <? if($seguro=="ARS"){ echo "selected='selected'";}?> >ARS</option>
                </select> *
		</div>
				    
		
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">Nombre:</br><input class="champ2" type="text" name="nombre_eps" id="nombre_eps" value="<?=$nombre_eps?>">
		</div>
		</div>
		    
		<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">PROCEDENCIA(Ultima Institucion):</br><input class="champ2" type="text" name="procedencia" id="procedencia" value="<?=$procedencia?>">
		</div>
				    
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><br><input name="actualiza" id="actualiza" type="hidden" value="0" /><input class="btn-sm btn-primary" name="ingreso_alumno" id="ingreso_alumno" type="button" value="ACTUALIZAR INFORMACION" onclick="valida_guardar_alumno_aula(this.form);">
		</div>
		</div>		    
		<div class="row">
		<div class="col-lg-12"><div id="info"><? if($alumno){ include_once("info_alumno.php");}?></div>
		</div>
		</div>