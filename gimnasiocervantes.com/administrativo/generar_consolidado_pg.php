<?
include_once("../funciones/funciones.php");
include_once("../funciones/conexion.php");

$gupo_asignatura=getAsignaturaGrupoInforme("","","");
echo count($gupo_asignatura);
for($i=0;$i<count($gupo_asignatura);$i++){
	$existe=getPlanGestor($gupo_asignatura[$i]['id_grupo_asignatura'],4);
	if($existe){
		echo "<br>OK: ".$gupo_asignatura[$i]['id_grupo_asignatura'];
	}else{
		$insert=setPlanGestor($gupo_asignatura[$i]['id_grupo_asignatura'],4);
		echo "<br>Insersion nueva>>>>".$insert;
	}	
}
?>