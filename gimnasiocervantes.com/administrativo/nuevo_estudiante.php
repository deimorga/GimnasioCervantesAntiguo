<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$_SESSION["alumno_ingreso"]="";
$id="";
$tipo_id="";
$expedida="";
$nombre="";
$fecha="";
$lugar="";
$sangre="";
$seguro="";
$nombre_eps="";
$procedencia="";
$grado_alumno="";

if($_GET["nuevo"]==1){
	$_POST["identificacion"]="";
	$_GET["identificacion"]="";
	$_REQUEST["identificacion"]="";
}

if($_POST["actualiza"]==1){
	$inserta=setAlumno($_POST['identificacion'],$_POST['expedida'],$_POST['nombre'],$_POST['fecha'],$_POST['lugar'],$_POST['sangre'],$_POST['seguro'],$_POST['nombre_eps'],$_POST['procedencia'],$_POST['grado'],$_POST['pension'],$_POST['tipo_id']);
	$_SESSION["alumno_ingreso"]=$_POST['identificacion'];
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

if(isset($_POST["identificacion"]) || isset($_GET["identificacion"])){
	$id=$_REQUEST["identificacion"];
	$alumno=getAlumnoId($id);
	if($alumno){
		$tipo_id=$alumno["tipo_id"];
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

if($_GET["alumno_aula"]==1){
	$id=$_SESSION['esturiante_matriculado'];
	$alumno=getAlumnoId($id);
	if($alumno){
		$tipo_id=$alumno["tipo_id"];
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
$grado=getGrados();
?>
<h2>Inscripci&oacute;n de alumnos.</h2>

 		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			Identificacion:
			<input value="<?=$id?>" class="form-control" type="text" name="identificacion" id="identificacion" onkeypress="return numeros(event);" <? if($_SESSION["user_tipo"]==1){?>onblur="FAjax('./administrativo/nuevo_estudiante.php','area_trabajo','','post');"<? }else{ echo 'readonly="readonly"';}?>>*
        </div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			Tipo Identificacion:
            <select name="tipo_id" class="form-control" id="tipo_id" >
                	<option value="">Seleccione...</option>
                    <option value="RC" <? if($tipo_id=="RC"){ echo "selected='selected'";}?> >Registro Civil</option>
                    <option value="TI" <? if($tipo_id=="TI"){ echo "selected='selected'";}?> >Tarjeta De Identidad</option>
                    <option value="CC" <? if($tipo_id=="CC"){ echo "selected='selected'";}?> >Cédula De Ciudadanía</option>
                </select>*
        </div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			Expedida:
            <input value="<?=$expedida?>" class="form-control" type="text" name="expedida" id="expedida" />*
        </div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			Nombre del alumno:
            <input class="form-control" type="text" name="nombre" id="nombre" value="<?=$nombre?>">*
        </div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			Lugar de nacimiento:
            <input class="form-control" type="text" name="lugar" id="lugar" value="<?=$lugar?>">*
        </div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			Fecha de nacimiento:
            <input class="form-control" style="width:100px; height:15" name="fecha" id="fecha" onFocus='Calendar.setup({inputField:"fecha",ifFormat:"%Y-%m-%d",button:"calen"});'
  readonly="true" value="<?=$fecha?>"/>*
        </div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			RH:
            <select class="form-control" name="sangre" id="sangre">
                	<option value="">Seleccione...</option>
                    <option value="A" <? if($sangre=="A"){ echo "selected='selected'";}?> >A/positivo</option>
                    <option value="A-" <? if($sangre=="A-"){ echo "selected='selected'";}?> >A/negativo</option>
                    <option value="B" <? if($sangre=="B"){ echo "selected='selected'";}?> >B/positivo</option>
                    <option value="B-" <? if($sangre=="B-"){ echo "selected='selected'";}?> >B/negativo</option>
                    <option value="AB" <? if($sangre=="AB"){ echo "selected='selected'";}?> >AB/positivo</option>
                    <option value="AB-" <? if($sangre=="AB-"){ echo "selected='selected'";}?> >AB/negativo</option>
                    <option value="O" <? if($sangre=="O"){ echo "selected='selected'";}?> >O/positivo</option>
                    <option value="O-" <? if($sangre=="O-"){ echo "selected='selected'";}?> >O/negativo</option>
                </select>*
        </div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			Seguridad social:
            <select name="seguro" class="form-control" id="seguro" >
                	<option value="">Seleccione...</option>
                    <option value="EPS" <? if($seguro=="EPS"){ echo "selected='selected'";}?> >EPS</option>
                    <option value="SISBEN" <? if($seguro=="SISBEN"){ echo "selected='selected'";}?> >SISBEN</option>
                    <option value="ARS" <? if($seguro=="ARS"){ echo "selected='selected'";}?> >ARS</option>
                </select>*
        </div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			Nombre:
            <input class="form-control" type="text" name="nombre_eps" id="nombre_eps" value="<?=$nombre_eps?>" />
        </div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			PROCEDENCIA(Ultima Institucion):
            <input class="form-control" type="text" name="procedencia" id="procedencia" value="<?=$procedencia?>">
        </div>
            <?
            if($_SESSION["user_tipo"]==1){
			?>
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			Grado al que se matricula:
            <select name="grado" class="form-control" id="grado" >
                	<option value="">Seleccione...</option>
<? for($i=0;$i<count($grado);$i++){?>
                    <option value="<?=$grado[$i]["id_grado"]?>" <? if($grado_alumno==$grado[$i]["id_grado"]){ echo "selected='selected'";}?> ><?=$grado[$i]["nombre_grado"]?></option>
<? }?>
                </select>*
        </div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			Valor Pension:
            <input value="<?=$pension?>" class="form-control" type="text" name="pension" id="pension" onkeypress="return numeros(event);" >*
		</div>
            <?
			}
			?>
        <table width="100%" cellpadding=5 cellspacing=0 border="0">
			<tr>
				<td align="center"><input name="actualiza" id="actualiza" type="hidden" value="0" /><input class="btn-sm btn-primary" name="ingreso_alumno" id="ingreso_alumno" type="button" value="ACTUALIZAR INFORMACION" onclick="valida_guardar_alumno(this.form);"></td>
			</tr>
			<tr>
				<td align="center"><div id="info"><? if($alumno){ include_once("info_alumno.php");}?></div></td>
			</tr>
        </table>

