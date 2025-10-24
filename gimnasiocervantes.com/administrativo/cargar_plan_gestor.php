<?
session_start();

include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

if($_GET['id_plan_gestor']){
	$_SESSION['plan_gestor']=$_GET['id_plan_gestor'];
}

if($_FILES['archivo']['name']!=''){
	?>
	<h1>Leer Archivo Excel</h1>
	<?php
	require_once ('../PHPExcel/Classes/PHPExcel.php');

	$nombre = $_FILES['archivo']['name'];
	$tipo = $_FILES['archivo']['type'];
	$tamano = $_FILES['archivo']['size'];
	$ext=explode(".",$nombre);

	if(is_dir("../documentos/matrices/")){

	//die ('esta!'."../documentos/matrices/".$_SESSION['plan_gestor']);

	}else{

	//die ('no esta!');

	mkdir("../documentos/matrices/",0777);

	}

	$directorio="../documentos/matrices/";
	//die($_FILES['archivo']['name']);
	$guardado=move_uploaded_file($_FILES['archivo']['tmp_name'],$directorio.$_SESSION['plan_gestor']."_".date('Ymdhis').".".end($ext));

	//die();
	$archivo = $directorio.$_SESSION['plan_gestor']."_".date('Ymdhis').".".end($ext);//$_FILES['archivo'];
	$inputFileType = PHPExcel_IOFactory::identify($archivo);
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	$objPHPExcel = $objReader->load($archivo);
	$sheet = $objPHPExcel->getSheet(0); 
	$highestRow = $sheet->getHighestRow(); 
	$highestColumn = $sheet->getHighestColumn();
	
					$tableA="";
					$tableB="";
					$tableC="";
					$tableD="";
					$tableE="";
					$tableF="";
					$tableG="";
	
	//die("Cols: ".$highestColumn);
	for ($row = 1; $row <= $highestRow; $row++){
		if($row==1){
			$columnaA=strtoupper(str_replace(" ","",str_replace(".","",trim($sheet->getCell("A".$row)->getValue()))));
			switch ($columnaA) {
				case "COMPONENTS(COMPONENTES)":
					$tableA="actividad";
					break;
				case "COMPETENCES(COMPETENCIAS)":
					$tableA="competencia";
					break;
				case "LEARNINGS(APRENDIZAJES)":
					$tableA="logro";
					break;
				case "EVIDENCEOFLEARNING(EVIDENCIASDEAPRENDIZAJE)":
					$tableA="indicador_logro";
					break;
				case "EJES(AXES)":
					$tableA="estandar";
					break;
				case "CONTENTS(CONTENIDO)":
					$tableA="contenido";
					break;
				case "HABILIDADES(ABILITIES)":
					$tableA="recurso";
					break;
			}
			
			$columnaB=strtoupper(str_replace(" ","",str_replace(".","",trim($sheet->getCell("B".$row)->getValue()))));
			switch ($columnaB) {
				case "COMPONENTS(COMPONENTES)":
					$tableB="actividad";
					break;
				case "COMPETENCES(COMPETENCIAS)":
					$tableB="competencia";
					break;
				case "LEARNINGS(APRENDIZAJES)":
					$tableB="logro";
					break;
				case "EVIDENCEOFLEARNING(EVIDENCIASDEAPRENDIZAJE)":
					$tableB="indicador_logro";
					break;
				case "EJES(AXES)":
					$tableB="estandar";
					break;
				case "CONTENTS(CONTENIDO)":
					$tableB="contenido";
					break;
				case "HABILIDADES(ABILITIES)":
					$tableB="recurso";
					break;
			}

			$columnaC=strtoupper(str_replace(" ","",str_replace(".","",trim($sheet->getCell("C".$row)->getValue()))));
			switch ($columnaC) {
				case "COMPONENTS(COMPONENTES)":
					$tableC="actividad";
					break;
				case "COMPETENCES(COMPETENCIAS)":
					$tableC="competencia";
					break;
				case "LEARNINGS(APRENDIZAJES)":
					$tableC="logro";
					break;
				case "EVIDENCEOFLEARNING(EVIDENCIASDEAPRENDIZAJE)":
					$tableC="indicador_logro";
					break;
				case "EJES(AXES)":
					$tableC="estandar";
					break;
				case "CONTENTS(CONTENIDO)":
					$tableC="contenido";
					break;
				case "HABILIDADES(ABILITIES)":
					$tableC="recurso";
					break;
			}

			$columnaD=strtoupper(str_replace(" ","",str_replace(".","",trim($sheet->getCell("D".$row)->getValue()))));
			switch ($columnaD) {
				case "COMPONENTS(COMPONENTES)":
					$tableD="actividad";
					break;
				case "COMPETENCES(COMPETENCIAS)":
					$tableD="competencia";
					break;
				case "LEARNINGS(APRENDIZAJES)":
					$tableD="logro";
					break;
				case "EVIDENCEOFLEARNING(EVIDENCIASDEAPRENDIZAJE)":
					$tableD="indicador_logro";
					break;
				case "EJES(AXES)":
					$tableD="estandar";
					break;
				case "CONTENTS(CONTENIDO)":
					$tableD="contenido";
					break;
				case "HABILIDADES(ABILITIES)":
					$tableD="recurso";
					break;
			}

			$columnaE=strtoupper(str_replace(" ","",str_replace(".","",trim($sheet->getCell("E".$row)->getValue()))));
			switch ($columnaE) {
				case "COMPONENTS(COMPONENTES)":
					$tableE="actividad";
					break;
				case "COMPETENCES(COMPETENCIAS)":
					$tableE="competencia";
					break;
				case "LEARNINGS(APRENDIZAJES)":
					$tableE="logro";
					break;
				case "EVIDENCEOFLEARNING(EVIDENCIASDEAPRENDIZAJE)":
					$tableE="indicador_logro";
					break;
				case "EJES(AXES)":
					$tableE="estandar";
					break;
				case "CONTENTS(CONTENIDO)":
					$tableE="contenido";
					break;
				case "HABILIDADES(ABILITIES)":
					$tableE="recurso";
					break;
			}

			$columnaF=strtoupper(str_replace(" ","",str_replace(".","",trim($sheet->getCell("F".$row)->getValue()))));
			switch ($columnaF) {
				case "COMPONENTS(COMPONENTES)":
					$tableF="actividad";
					break;
				case "COMPETENCES(COMPETENCIAS)":
					$tableF="competencia";
					break;
				case "LEARNINGS(APRENDIZAJES)":
					$tableF="logro";
					break;
				case "EVIDENCEOFLEARNING(EVIDENCIASDEAPRENDIZAJE)":
					$tableF="indicador_logro";
					break;
				case "EJES(AXES)":
					$tableF="estandar";
					break;
				case "CONTENTS(CONTENIDO)":
					$tableF="contenido";
					break;
				case "HABILIDADES(ABILITIES)":
					$tableF="recurso";
					break;
			}

			$columnaG=strtoupper(str_replace(" ","",str_replace(".","",trim($sheet->getCell("G".$row)->getValue()))));
			switch ($columnaG) {
				case "COMPONENTS(COMPONENTES)":
					$tableG="actividad";
					break;
				case "COMPETENCES(COMPETENCIAS)":
					$tableG="competencia";
					break;
				case "LEARNINGS(APRENDIZAJES)":
					$tableG="logro";
					break;
				case "EVIDENCEOFLEARNING(EVIDENCIASDEAPRENDIZAJE)":
					$tableG="indicador_logro";
					break;
				case "EJES(AXES)":
					$tableG="estandar";
					break;
				case "CONTENTS(CONTENIDO)":
					$tableG="contenido";
					break;
				case "HABILIDADES(ABILITIES)":
					$tableG="recurso";
					break;
			}
			//echo "A:".$tableA."B:".$tableB."C:".$tableC."D:".$tableD."E:".$tableE."F:".$tableF."G:".$tableG;
			//die();

		}else{

			$valA=trim($sheet->getCell("A".$row)->getValue());
			if(strlen($valA)>0 && $tableA!=""){
				$inserta=insertaPlanGestor("tbl_".$tableA, $tableA, $valA, $_SESSION['plan_gestor']);
			}

			$valB=trim($sheet->getCell("B".$row)->getValue());
			if(strlen($valB)>0 && $tableB!=""){
				$inserta=insertaPlanGestor("tbl_".$tableB, $tableB, $valB, $_SESSION['plan_gestor']);
			}

			$valC=trim($sheet->getCell("C".$row)->getValue());
			if(strlen($valC)>0 && $tableC!=""){
				$inserta=insertaPlanGestor("tbl_".$tableC, $tableC, $valC, $_SESSION['plan_gestor']);
			}

			$valD=trim($sheet->getCell("D".$row)->getValue());
			if(strlen($valD)>0 && $tableD!=""){
				$inserta=insertaPlanGestor("tbl_".$tableD, $tableD, $valD, $_SESSION['plan_gestor']);
			}

			$valE=trim($sheet->getCell("E".$row)->getValue());
			if(strlen($valE)>0 && $tableE!=""){
				$inserta=insertaPlanGestor("tbl_".$tableE, $tableE, $valE, $_SESSION['plan_gestor']);
			}

			$valF=trim($sheet->getCell("F".$row)->getValue());
			if(strlen($valF)>0 && $tableF!=""){
				$inserta=insertaPlanGestor("tbl_".$tableF, $tableF, $valF, $_SESSION['plan_gestor']);
			}

			$valG=trim($sheet->getCell("G".$row)->getValue());
			if(strlen($valG)>0 && $tableG!=""){
				$inserta=insertaPlanGestor("tbl_".$tableG, $tableG, $valG, $_SESSION['plan_gestor']);
			}

		}
	}
	echo "<br>El archivo fue procesado, retorna a la ventana anterior y actualiza la matriz para validar que la informacion este correcta.";
}else{
	echo "No haz seleccionado aun ningún archivo para ser procesado...";
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<form action="cargar_plan_gestor.php" method="post" enctype="multipart/form-data">
	<input type="file" name="archivo" id="archivo"></input>
	<input type="submit" value="Subir archivo"></input>
</form>



<input type="button" id="cerrar" onClick="window.close();" value="CERRAR VENTANA">
