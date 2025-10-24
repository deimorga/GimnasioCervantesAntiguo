<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_SESSION["user_id"]=="" || $_SESSION["user_id"]==NULL){
	echo "<script>window.location.href='cerrar_session.php'</script>";
}

$candidatura="";
$partido="";
$tarjeton="";

if($_POST['actualiza_candidatura']==1){

	$inserta=setCandidato($_SESSION["alumno_ingreso"],$_POST['candidatura'],$_POST['partido'],$_POST['tarjeton']);
	if($inserta){
		echo "<script>alert('Los datos se guardaron correctamente...');</script>";
	}else{
		echo "<script>alert('No se guardaron correctamente los datos...');</script>";
	}
}

$alumno=getAlumnoId($_SESSION["alumno_ingreso"]);
if($alumno){
$candidatura=$alumno['candidatura'];
$partido=$alumno['partido'];
$tarjeton=$alumno['tarjeton'];
}
?>
<h2>Datos de Candidatura.</h2>

        <div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			    Candidatura:</br><select name="candidatura" class="form-control" id="candidatura" >
                	<option value="0">No</option>
                    <option value="1" <? if($candidatura==1){ echo "selected='selected'";}?> >Si</option>
                </select> *
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			    Cod. Tarjeton<br /><input class="form-control" type="text" name="tarjeton" id="tarjeton" value="<?=$tarjeton?>"> *
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			    Partido Político/Lema:</br><textarea class="form-control" name="partido" id="partido"><?=$partido?></textarea>
			</div>
		</div>
        <div class="row">

			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			    <input name="actualiza_candidatura" id="actualiza_familiar" type="hidden" value="0"><input class="btn-sm btn-primary" name="ingreso_familiar" id="ingreso_familiar" type="button" value="GUARDAR DATOS" onClick="valida_gardar_candidatura(this.form);">
			</div>
		</div>