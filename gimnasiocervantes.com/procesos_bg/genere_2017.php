<?php

ini_set("memory_limit", "256M");
include("../funciones/conexion.php");
include("../funciones/funciones.php");
//echo $alumno['id_grupo'];
$alumnos_curso = array(143472870	,
1011088909	,
1070386536	,
1070386536	,
1070386536	,
1070386536	,
1070386536	,
1070386536	,
1070386536	,
1016945888	,
1016945888	,
1016945888	,
1016945888	,
1016945888	,
1016945888	,
1016945888	,
1016945888	,
1016945888	,
1031646333	,
1031646333	,
1031646333	,
1031646333	,
1031646333	,
1031646333	,
1031646333	,
1031646333	,
1031646333	,
1070385434	,
1070385434	,
1070385434	,
1070385434	,
1070385434	,
1070385434	,
1070385434	,
1070385434	,
1070385434	,
1070385434	,
1070385434	,
1070385434	,
1070944107	,
1070944107	,
1070944107	,
1000707715	,
1000707715	,
1000707715	,
1000707715	,
1000707715	,
1000707715	,
1000365607	,
1000365607	,
1000365607	,
1000365607	,
1000365607	,
1000365607	,
1000365607	,
1000852125	,
1003510975	,
1003510975	,
1003510975	,
1003510975	,
1003510975	,
1003510975	,
1003510975	,
1003510975	,
1003510975	,
1023083123	,
1069642005	,
1070943854	,
1000286617	,
1193038794	,
1193038794	,
1193038794	,
1193038794	,
1193038794	,
1193038794	,
1193038794	,
1193038794	,
1193038794	,
1193038794	,
1193038794	,
1193038794	,
1193038794	,
1193038794	,
1193038794	,
1193038794	,
99102713547);

for ($a = 0; $a < count($alumnos_curso); $a++) {
    $anio = 2017;
    $alumno = getAlumnoBoletinId($alumnos_curso[$a]);
    $asignaturas = getAsignaturasGrupo($alumno['id_grupo'], 1);
//print_r($asignaturas);
    for ($i = 0; $i < count($asignaturas); $i++) {
        $suma = 0;
        $cont = 0;
        $prom = 0;
        $p1 = getCalificacionAsignatura($asignaturas[$i]['id_asignatura'], $alumno['identificacion'], 1);
        $p2 = getCalificacionAsignatura($asignaturas[$i]['id_asignatura'], $alumno['identificacion'], 2);
        $p3 = getCalificacionAsignatura($asignaturas[$i]['id_asignatura'], $alumno['identificacion'], 3);
        $p4 = getCalificacionAsignatura($asignaturas[$i]['id_asignatura'], $alumno['identificacion'], 4);
        if ($p1) {
            $notaSumar = $p1['calificacion_asignatura'];
            if ($notaSumar <= 3.7) {
                $existe_no_recupera = getNoRecupera($alumno['identificacion'], $asignaturas[$i]['id_asignatura'], $alumno['id_grupo']);
                if ($existe_no_recupera) {
                    
                } else {
                    $notaSumar = 3.7;
                    $actualiza = setCalificacionAsignatura2($asignaturas[$i]['id_asignatura'], $notaSumar, $alumno['identificacion'], 1);
                    if (!$actualiza) {
                        echo "<br>ERROR: No se actualizo " . $asignaturas[$i]['id_asignatura'] . " | 3.7 | " . $alumno['identificacion'] . " | 1 |<br>";
                    }
                }
            }
            $suma = $suma + $notaSumar;
            $cont = $cont + 1;
        }
        if ($p2) {
            $notaSumar = $p2['calificacion_asignatura'];
            if ($notaSumar <= 3.7) {
                $existe_no_recupera = getNoRecupera($alumno['identificacion'], $asignaturas[$i]['id_asignatura'], $alumno['id_grupo']);
                if ($existe_no_recupera) {
                    
                } else {
                    $notaSumar = 3.7;
                    $actualiza = setCalificacionAsignatura2($asignaturas[$i]['id_asignatura'], $notaSumar, $alumno['identificacion'], 2);
                    if (!$actualiza) {
                        echo "<br>ERROR: No se actualizo " . $asignaturas[$i]['id_asignatura'] . " | 3.7 | " . $alumno['identificacion'] . " | 2 |<br>";
                    }
                }
            }
            $suma = $suma + $notaSumar;
            $cont = $cont + 1;
        }
        if ($p3) {
            $notaSumar = $p3['calificacion_asignatura'];
            $existe_no_recupera = getNoRecupera($alumno['identificacion'], $asignaturas[$i]['id_asignatura'], $alumno['id_grupo']);
            if ($existe_no_recupera) {
                //para descontar definitiva por no recuperar del a単o 2017
                $pg = getPlanGestor2($alumno['id_grupo'], $asignaturas[$i]['id_asignatura'], 3);
                $dato = seleccionaLogrosPlanGestor("logro", $pg['id_plan_gestor']);
                $cantLogros = count($dato);


        		$definitiva=0;
        		$definitiva_100=0;
        		$contador=0;
        		$sum=0;
        		for($l=0;$l<count($dato);$l++){

                    $nota_logro=getCalificacionLogro($dato[$l]['id_logro'], $alumno['identificacion']);
        			//$actualiza=setCalificacionLogro($dato[$i]['id_logro'],$_REQUEST[$dato[$i]['id_logro']."-".$alumnos[$a]['identificacion']], $alumnos[$a]['identificacion']);
        			//if($actualiza){
        				$contador=$contador+1;
        				$sum=$sum+$nota_logro['calificacion_logro'];
        			//}
        		}
        		
        		$sum=$sum+2.5;
        		$contador=$contador+1;
        		$definitiva=$sum/$contador;
        		//echo "suma: ".$suma." definitiva: ".$definitiva;

    			$definitiva_100=redondear($definitiva);

        		$actualiza_definitiva=setCalificacionAsignatura2($asignaturas[$i]['id_asignatura'], $definitiva_100, $alumno['identificacion'],3);
        		if($actualiza_definitiva){
        			echo $a.": NO RECUPERA - Se actualizo el registro de notas de ".$alumnos[$a]['identificacion']." con una definitiva de ".$definitiva_100."<br>";
        		}else{
        			echo "ERROR: Inconvenientes en el registro de notas de ".$alumnos[$a]['identificacion']."<br>";
        		}



            } else {
                if ($notaSumar <= 3.7) {
                    $notaSumar = 3.7;
                    $actualiza = setCalificacionAsignatura2($asignaturas[$i]['id_asignatura'], $notaSumar, $alumno['identificacion'], 3);
                    if (!$actualiza) {
                        echo "<br>ERROR: No se actualizo " . $asignaturas[$i]['id_asignatura'] . " , 3.7 , " . $alumno['identificacion'] . " , 3 <br>";
                    }
                }
            }
            $suma = $suma + $notaSumar;
            $cont = $cont + 1;
        }
        if ($suma != 0 && $cont != 0) {
            $prom = $suma / $cont;
        }
        $definitiva = redondear($prom);

        //valida q no exista ya nota y este calificado los 4 periodos//
        $calificacion_alumno = getCalificacionAsignaturaFinal($asignaturas[$i]['id_asignatura'], $alumno['identificacion'], $anio);

        //if($cont==4){
        //if (!$calificacion_alumno) {
            $actualiza_definitiva = setCalificacionAsignaturaFinal($asignaturas[$i]['id_asignatura'], $definitiva, $alumno['identificacion'], $anio);
            if ($actualiza_definitiva) {
                echo $a . ": Se actualizo el registro de notas de " . $alumno['identificacion'] . " con una definitiva de " . $definitiva . "<br>";
            } else {
                echo "ERROR: Inconvenientes en el registro de notas de " . $alumno['identificacion'] . "<br>";
            }
        //} else {
        //    echo "El alumno " . $alumno['identificacion'] . " ya registra notas...<br>";
        //}
        //}else{
        //	echo "El alumno ".$alumno['identificacion']." no tiene todas sus notas...<br>";
        //}
    }
}
?>