function ubica(){
		//alert('lolo');
		FAjax('./administrativo/info_alumno.php','info','','post');
	}
function numeros(e) 
	{//Inicio De La Función
		tecla = (document.all) ? e.keyCode : e.which;
		if (tecla<= 13 ||  tecla >= 48 && tecla <= 57) return true;
		patron = /\d/;
		te = String.fromCharCode(tecla);
		return patron.test(te); 
	}

function numeros2(e) 
	{//Inicio De La Función
		tecla = (document.all) ? e.keyCode : e.which;
		//alert(tecla);
		if (tecla<= 13 ||  tecla == 46 || tecla >= 48 && tecla <= 57) return true;
		patron = /\d/;
		te = String.fromCharCode(tecla);
		return patron.test(te); 
	}

	function mostrar(){
		document.getElementById("header").style.display='block';
		document.getElementById("menu").style.display='block';
		document.getElementById("banner").style.display='block';
		document.getElementById("footer").style.display='block';
		document.getElementById("botones").style.display='block';
		//document.getElementById("boton").style.display='block';
		
	}
///////////////////////////////
function ocultar(){
		document.getElementById("header").style.display='none';
		document.getElementById("menu").style.display='none';
		document.getElementById("banner").style.display='none';
		document.getElementById("footer").style.display='none';
		document.getElementById("botones").style.display='none';
		//document.getElementById("boton").style.display='none';

	}
///////////////////////////////
function page_print(){
		//alert("Favor configurar hoja tamaño oficio para la impresion");
		if(confirm('Recuerde que reciclando papel, ayuda a la preservacion del medio ambiente.\nDesea imprimir este reporte?')){
			ocultar();
			window.print();
			setTimeout("mostrar()",200);
		}else{
			return false;
		}
	}

function reemplazarSeleccion(control, texto){ // v2011-12-21
    var inicio, seleccion;

    if("selectionStart" in control){ // W3C
        // Guardamos la posición inicial del cursor
        inicio = control.selectionStart;

        // Reemplazamos todo el contenido
        control.value = control.value.substr(0, control.selectionStart) +
            texto +	control.value.substr(control.selectionEnd, control.value.length);

        // Movemos el cursor a la posición final
        control.selectionStart = inicio + texto.length;
        control.selectionEnd = inicio + texto.length;
        
        control.focus();

    }else if(document.selection){ // IE
        control.focus();

        // Obtenemos la selección y la reemplazamos por el nuevo texto
        seleccion = document.selection.createRange();
        seleccion.text = texto;

        seleccion.select();

    }else{
        // No sabemos dónde está el cursor: insertamos el texto al final
        control.value += texto;
    }
}



/*
 * FUNCIONES VALIDA FORMULARIOS R
 */
 
function suma_saldo(a,b,c){
	var num1=new Number();
	var num2=new Number();
	var num3=new Number();
	
	num1=a.value;
	num2=b.value;
	num3=num2-num1;
	
	//alert(num1+' - '+num2+" = "+num3);
	if(num3<0){
		alert('El valor del descuento no puede ser mayor al saldo...');
		a.value=0;
		return false;
	}else{
		b.value=num3;
	}
}

function comprueba_nota(e){
	var num1=new Number();
	
	num1=e.value;
	
	//alert(num1+' - '+num2+" = "+num3);
	if(num1>5){
		alert('El valor de la nota no puede ser mayor a 5...');
		e.value="";
	}else{
		return true;
	}
}

function valida_guarda_notas(f){
	FAjax('./load.php','load','','post');
	f.guardar_calificacion.value="Espere unos instantes...";
	f.guardar_calificacion.disabled=true;
	FAjax('./profesor/nota_plan_gestor.php','area_trabajo','','post'); 
}

function valida_guarda_notas_planilla(f){
	FAjax('./load.php','load','','post');
	f.guardar_calificacion.value="Espere unos instantes...";
	f.guardar_calificacion.disabled=true;
	FAjax('./profesor/nota_plan_gestor_planilla.php','area_trabajo','','post'); 
}

function valida_guarda_notas_final(f){
	FAjax('./load.php','load','','post');
	f.guardar_calificacion.value="Espere unos instantes...";
	f.guardar_calificacion.disabled=true;
	FAjax('./profesor/nota_plan_gestor_final.php','area_trabajo','','post'); 
}

function valida_derdidos_grupo(f){
	f.guardar_cambios.value="Espere unos instantes...";
	f.guardar_cambios.disabled=true;
	f.actualiza_perdidos_grupo.value=1;
	FAjax('./profesor/list_perdidos_grupo.php','area_trabajo','','post'); 
}

function valida_guardar_alumno(f){
	if(f.identificacion.value.length <= 5){
	  alert('Debe ingresar una identificacion valida\nMin. 6 digitos...');
	  f.identificacion.focus();
      return false;
	}

	if(f.expedida.value.length < 3){
	  alert('Debe ingresar lugar de expedicion valido.\nMin. 3 caracteres...');
	  f.expedida.focus();
      return false;
	}
	
	if(f.nombre.value.length < 5){
	  alert('Debe ingresar un nombre valido.\nMin. 5 caracteres...');
	  f.nombre.focus();
      return false;
	}

	if(f.lugar.value.length < 4){
	  alert('Debe ingresar un lugar de nacimiento valido\nMin. 4 caracteres...');
	  f.lugar.focus();
      return false;
	}

	if(f.fecha.value.length < 10){
	  alert('Debe ingresar una fecha valida...');
	  f.fecha.focus();
      return false;
	}

	if(f.sangre.value.length < 1){
	  alert('Debe seleccionar un tipo de sangre valido...');
	  f.sangre.focus();
      return false;
	}

	if(f.seguro.value.length < 1){
	  alert('Debe seleccionar el tipo de seguridad social...');
	  f.seguro.focus();
      return false;
	}

	if(f.grado.value.length < 1){
	  alert('Debe seleccionar el grado al que se matricula...');
	  f.grado.focus();
      return false;
	}
	
	f.actualiza.value=1;
	FAjax('./administrativo/nuevo_estudiante.php','area_trabajo','','post');
	
}
	 
function valida_guardar_alumno_aula(f){
	if(f.identificacion.value.length <= 5){
	  alert('Debe ingresar una identificacion valida\nMin. 6 digitos...');
	  f.identificacion.focus();
      return false;
	}

	if(f.expedida.value.length < 3){
	  alert('Debe ingresar lugar de expedicion valido.\nMin. 3 caracteres...');
	  f.expedida.focus();
      return false;
	}
	
	if(f.nombre.value.length < 5){
	  alert('Debe ingresar un nombre valido.\nMin. 5 caracteres...');
	  f.nombre.focus();
      return false;
	}

	if(f.lugar.value.length < 4){
	  alert('Debe ingresar un lugar de nacimiento valido\nMin. 4 caracteres...');
	  f.lugar.focus();
      return false;
	}

	if(f.fecha.value.length < 10){
	  alert('Debe ingresar una fecha valida...');
	  f.fecha.focus();
      return false;
	}

	if(f.sangre.value.length < 1){
	  alert('Debe seleccionar un tipo de sangre valido...');
	  f.sangre.focus();
      return false;
	}

	if(f.seguro.value.length < 1){
	  alert('Debe seleccionar el tipo de seguridad social...');
	  f.seguro.focus();
      return false;
	}

	f.actualiza.value=1;
	FAjax('./administrativo/nuevo_estudiante_aula.php','area_trabajo_alumno','','post');
	
}
	 
function valida_gardar_familiar(f){
	
	if(f.identificacion_familiar.value.length <= 5){
	  alert('Debe ingresar una identificacion valida\nMin. 6 digitos...');
	  f.identificacion_familiar.focus();
      return false;
	}

	if(f.nombre_familiar.value.length < 5){
	  alert('Debe ingresar un nombre valido.\nMin. 5 caracteres...');
	  f.nombre_familiar.focus();
      return false;
	}

	if(f.ocupacion_familiar.value.length < 3){
	  alert('Debe ingresar una ocupacion valida\nMin. 3 caracteres...');
	  f.ocupacion_familiar.focus();
      return false;
	}

	if(f.parentesco_familiar.value.length < 3){
	  alert('Debe ingresar un parentesco valido\nMin. 3 caracteres...');
	  f.parentesco_familiar.focus();
      return false;
	}

	if(f.direccion_familiar.value.length < 7){
	  alert('Debe ingresar una direccion valida\nMin. 7 caracteres...');
	  f.direccion_familiar.focus();
      return false;
	}
/*
	if(f.telefono_familiar.value.length < 7){
	  alert('Debe ingresar un telefono valido\nMin. 7 caracteres...');
	  f.telefono_familiar.focus();
      return false;
	}

	if(f.celular_familiar.value.length < 7){
	  alert('Debe ingresar un celular valido\nMin. 7 caracteres...');
	  f.celular_familiar.focus();
      return false;
	}

	if(f.correo_familiar.value.length < 8 || f.correo_familiar.value.split("@").length!=2){
	  alert('Debe ingresar una direccion de correo valida...');
	  f.correo_familiar.focus();
      return false;
	}
*/	
	f.actualiza_familiar.value=1;
	FAjax('./administrativo/nvo_familiar.php','familia','','post');
	
}

function valida_gardar_candidatura(f){
	
	if(f.candidatura.value.length < 1){
	  alert('Debe Seleccionar si es candidato...');
	  f.candidatura.focus();
      return false;
	}

	if(f.partido.value.length < 5){
	  alert('Debe ingresar un Partido y Lema valido.\nMin. 5 caracteres...');
	  f.partido.focus();
      return false;
	}

	if(f.tarjeton.value.length < 1){
	  alert('Debe ingresar un Tarjeton valida\nMin. 1 caracteres...');
	  f.tarjeton.focus();
      return false;
	}

	f.actualiza_candidatura.value=1;
	FAjax('./administrativo/nvo_candidato.php','candidatura','','post');
	
}

function valida_guardar_grupo(f){
	
	if(f.grupo.value.length < 1){
	  alert('Debe ingresar un grupo valido...');
	  f.grupo.focus();
      return false;
	}

	if(f.grado.value.length < 1){
	  alert('Debe seleccionar el grado...');
	  f.grado.focus();
      return false;
	}

	if(f.director.value.length < 1){
	  alert('Debe seleccionar el director de grupo...');
	  f.director.focus();
      return false;
	}

	f.actualiza_grupo.value=1;
	FAjax('./administrativo/nuevo_grupo.php','area_trabajo','','post');
	
}
	 
function valida_guardar_sede(f){
	
	if(f.nombre.value.length < 1){
	  alert('Debe ingresar un nombre valido...');
	  f.nombre.focus();
      return false;
	}

	if(f.direccion.value.length < 1){
	  alert('Debe ingresar una direccion valida...');
	  f.direccion.focus();
      return false;
	}

	if(f.descripcion.value.length < 1){
	  alert('Debe ingresar una descripcion valida...');
	  f.descripcion.focus();
      return false;
	}

	if(f.lat.value.length < 1){
	  alert('Debe ingresar una latitud valida...');
	  f.lat.focus();
      return false;
	}

	if(f.lng.value.length < 1){
	  alert('Debe ingresar una longitud valida...');
	  f.lng.focus();
      return false;
	}

	f.actualiza_sede.value=1;
	FAjax('./administrativo/nueva_sede.php','area_trabajo','','post');
	
}
	 
function valida_actualiza_sede(f){
	
	if(f.nombre.value.length < 1){
	  alert('Debe ingresar un nombre valido...');
	  f.nombre.focus();
      return false;
	}

	if(f.direccion.value.length < 1){
	  alert('Debe ingresar una direccion valida...');
	  f.direccion.focus();
      return false;
	}

	if(f.descripcion.value.length < 1){
	  alert('Debe ingresar una descripcion valida...');
	  f.descripcion.focus();
      return false;
	}

	if(f.lat.value.length < 1){
	  alert('Debe ingresar una latitud valida...');
	  f.lat.focus();
      return false;
	}

	if(f.lng.value.length < 1){
	  alert('Debe ingresar una longitud valida...');
	  f.lng.focus();
      return false;
	}

	f.actualiza_sede.value=2;
	FAjax('./administrativo/nueva_sede.php','area_trabajo','','post');
	
}
	 
function valida_guardar_enlace(f){
	
	if(f.nombre.value.length < 1){
	  alert('Debe ingresar un nombre valido...');
	  f.nombre.focus();
      return false;
	}

	if(f.descripcion.value.length < 1){
	  alert('Debe ingresar una descripcion valida...');
	  f.descripcion.focus();
      return false;
	}

	f.actualiza_enlace.value=1;
	FAjax('./administrativo/nuevo_enlace.php','area_trabajo','','post');
	
}
	 
function valida_actualiza_enlace(f){
	
	if(f.nombre.value.length < 1){
	  alert('Debe ingresar un nombre valido...');
	  f.nombre.focus();
      return false;
	}

	if(f.descripcion.value.length < 1){
	  alert('Debe ingresar una descripcion valida...');
	  f.descripcion.focus();
      return false;
	}

	f.actualiza_enlace.value=2;
	FAjax('./administrativo/nuevo_enlace.php','area_trabajo','','post');
	
}
	 
function valida_guardar_profesor(f){
	
	if(f.identificacion_profesor.value.length < 6){
	  alert('Debe indicar la Identificacion del profesor. \nMin. 2 caracteres...');
	  f.identificacion_profesor.focus();
      return false;
	}

	if(f.nombre_profesor.value.length < 4){
	  alert('Debe ingresar el nombre del profesor.\nMin. 4 caracteres...');
	  f.nombre_profesor.focus();
      return false;
	}

	if(f.telefono_profesor.value.length < 7){
	  alert('Debe un telefono de contacto. \nMin. 7 caracteres...');
	  f.telefono_profesor.focus();
      return false;
	}

	if(f.correo_profesor.value.length < 8 || f.correo_profesor.value.split("@").length!=2){
	  alert('Debe ingresar una direccion de correo valida...');
	  f.correo_profesor.focus();
      return false;
	}

	f.actualiza_profesor.value=1;
	FAjax('./administrativo/nuevo_profesor.php','area_trabajo','','post');
	
}
	 
function valida_guardar_asignatura(f){
	
	if(f.asignatura.value.length < 2){
	  alert('Debe ingresar un nombre valido.\nMin. 2 caracteres...');
	  f.asignatura.focus();
      return false;
	}

	if(f.area.value.length < 1){
	  alert('Debe seleccionar un area valido...');
	  f.area.focus();
      return false;
	}

	f.actualiza_asignatura.value=1;
	FAjax('./administrativo/nueva_asignatura.php','area_trabajo','','post');
	
}
	 
function valida_guardar_grupo_asignatura(f){
	
	if(f.grupo.value.length < 1){
	  alert('Debe seleccionar un grupo...');
	  f.grupo.focus();
      return false;
	}

	if(f.asignatura.value.length < 1){
	  alert('Debe seleccionar un asignatura...');
	  f.asignatura.focus();
      return false;
	}

	if(f.intensidad.value.length < 1){
	  alert('Debe seleccionar la intensidad horaria...');
	  f.intensidad.focus();
      return false;
	}

	if(f.director.value.length < 1){
	  alert('Debe seleccionar profesor...');
	  f.director.focus();
      return false;
	}

	f.actualiza_grupo_asignatura.value=1;
	FAjax('./administrativo/asignatura_grupo.php','area_trabajo','','post');
	
}
	 
function valida_edita_grupo_asignatura(f){
	
	if(f.intensidad.value.length < 1){
	  alert('Debe seleccionar la intensidad horaria...');
	  f.intensidad.focus();
      return false;
	}

	if(f.director.value.length < 1){
	  alert('Debe seleccionar profesor...');
	  f.director.focus();
      return false;
	}

	f.actualiza_grupo_asignatura.value=1;
	FAjax('./administrativo/list_asignatura_grupo.php','area_trabajo','','post');
	
}
	 
function valida_seleccionar_periodo(f){
	if(f.periodo_academico.value.length < 1){
	  alert('Debe seleccionar un periodo academico...');
	  f.periodo_academico.focus();
      return false;
	}
	
	f.filtra_periodo.value=1;

	FAjax('./profesor/filtro_plan_gestor.php','area_trabajo','','post');
}

function valida_seleccionar_periodo_planilla(f){
	if(f.periodo_academico.value.length < 1){
	  alert('Debe seleccionar un periodo academico...');
	  f.periodo_academico.focus();
      return false;
	}
	
	f.filtra_periodo_planilla.value=1;

	FAjax('./profesor/filtro_planilla.php','area_trabajo','','post');
}

function valida_seleccionar_periodo_calificaciones(f){
	if(f.periodo_academico.value.length < 1){
	  alert('Debe seleccionar un periodo academico...');
	  f.periodo_academico.focus();
      return false;
	}
	
	f.filtra_periodo.value=1;

	FAjax('./profesor/filtro_calificar_plan_gestor.php','area_trabajo','','post');
}

function valida_seleccionar_periodo_recomendaciones(f){
	if(f.periodo_academico.value.length < 1){
	  alert('Debe seleccionar un periodo academico...');
	  f.periodo_academico.focus();
      return false;
	}
	
	f.filtra_periodo.value=2;

	FAjax('./profesor/filtro_calificar_plan_gestor.php','area_trabajo','','post');
}

function valida_seleccionar_periodo_consolidado(f){
	if(f.periodo_academico.value.length < 1){
	  alert('Debe seleccionar un periodo academico...');
	  f.periodo_academico.focus();
      return false;
	}
	
	f.filtra_periodo.value=3;

	FAjax('./profesor/filtro_calificar_plan_gestor.php','area_trabajo','','post');
}

function valida_seleccionar_grado(f){
	if(f.grado.value.length < 1){
	  alert('Debe seleccionar un grado...');
	  f.grado.focus();
      return false;
	}
	
	f.filtra_grado.value=1;

	FAjax('./administrativo/listado_alumnos_registro.php','area_trabajo','','post');
}

function valida_guardar_final(f){
	
	if(f.logro_final_superior.value.length < 5){
	  alert('Debe ingresar un logro valido.\nMin. 5 caracteres...');
	  f.logro_final_superior.focus();
      return false;
	}

	if(f.logro_final_alto.value.length < 5){
	  alert('Debe ingresar un logro valido.\nMin. 5 caracteres...');
	  f.logro_final_alto.focus();
      return false;
	}

	if(f.logro_final_basico.value.length < 5){
	  alert('Debe ingresar un logro valido.\nMin. 5 caracteres...');
	  f.logro_final_basico.focus();
      return false;
	}

	if(f.logro_final_bajo.value.length < 5){
	  alert('Debe ingresar un logro valido.\nMin. 5 caracteres...');
	  f.logro_final_bajo.focus();
      return false;
	}

	f.actualiza_final.value=1;
	FAjax('./profesor/gestionar_final.php','area_trabajo','','post');
	
}
	 
function valida_guardar_plan_gestor(f){
	
	if(f.nombre_unidad.value.length < 5){
	  alert('Debe ingresar un nombre de unidad.\nMin. 5 caracteres...');
	  f.nombre_unidad.focus();
      return false;
	}

	/*
	if(f.competencia.value.length < 5){
	  alert('Debe ingresar una competencia valida.\nMin. 5 caracteres...');
	  f.competencia.focus();
      return false;
	}
	*/

	f.actualiza_plan_gestor.value=1;
	FAjax('./profesor/info_plan_gestor.php','info','','post');
	
}
	 
function valida_guardar_estandar(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion.focus();
      return false;
	}


	f.actualiza_estandar.value=1;
	FAjax('./profesor/estandar.php','estandar','','post');
	
}
	 
function valida_edita_estandar(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion.focus();
      return false;
	}


	f.actualiza_edita_estandar.value=1;
	FAjax('./profesor/estandar.php','estandar','','post');
	
}
	 
function valida_guardar_competencia(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_competencia.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_competencia.focus();
      return false;
	}


	f.actualiza_competencia.value=1;
	FAjax('./profesor/competencia.php','competencia_div','','post');
	
}
	 
function valida_edita_competencia(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_competencia.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_competencia.focus();
      return false;
	}


	f.actualiza_edita_competencia.value=1;
	FAjax('./profesor/competencia.php','competencia_div','','post');
	
}
	 
function valida_guardar_contenido(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_contenido.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_contenido.focus();
      return false;
	}


	f.actualiza_contenido.value=1;
	FAjax('./profesor/contenido.php','contenido_div','','post');
	
}
	 
function valida_edita_contenido(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_contenido.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_contenido.focus();
      return false;
	}


	f.actualiza_edita_contenido.value=1;
	FAjax('./profesor/contenido.php','contenido_div','','post');
	
}
	 
function valida_guardar_logro(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_logro.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_logro.focus();
      return false;
	}

	if(f.porcentaje_logro.value <= 0 || f.porcentaje_logro.value > 100){
	  alert('Debe ingresar un porcentaje valid0.\nEntre un rango de 1 a 100...');
	  f.porcentaje_logro.focus();
      return false;
	}

	f.actualiza_logro.value=1;
	FAjax('./profesor/logro.php','logro_div','','post');
	
}
	 
function valida_edita_logro(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_logro.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_logro.focus();
      return false;
	}

	if(f.porcentaje_logro.value <= 0 || f.porcentaje_logro.value > 100){
	  alert('Debe ingresar un porcentaje valid0.\nEntre un rango de 1 a 100...');
	  f.porcentaje_logro.focus();
      return false;
	}

	f.actualiza_edita_logro.value=1;
	FAjax('./profesor/logro.php','logro_div','','post');
	
}
	 
function valida_guardar_logro_planilla(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_logro.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_logro.focus();
      return false;
	}


	f.actualiza_logro_planilla.value=1;
	FAjax('./profesor/logro_planilla.php','logro_div','','post');
	
}
	 
function valida_edita_logro_planilla(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_logro.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_logro.focus();
      return false;
	}


	f.actualiza_edita_logro_planilla.value=1;
	FAjax('./profesor/logro_planilla.php','logro_div','','post');
	
}
	 
function valida_guardar_indicador(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_indicador.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_indicador.focus();
      return false;
	}


	f.actualiza_indicador.value=1;
	FAjax('./profesor/indicador.php','indicador_div','','post');
	
}
	 
function valida_edita_indicador(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_indicador.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_indicador.focus();
      return false;
	}


	f.actualiza_edita_indicador.value=1;
	FAjax('./profesor/indicador.php','indicador_div','','post');
	
}
	 
function valida_guardar_recurso(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_recurso.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_recurso.focus();
      return false;
	}


	f.actualiza_recurso.value=1;
	FAjax('./profesor/recurso.php','recurso_div','','post');
	
}
	 
function valida_edita_recurso(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_recurso.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_recurso.focus();
      return false;
	}


	f.actualiza_edita_recurso.value=1;
	FAjax('./profesor/recurso.php','recurso_div','','post');
	
}
	 
function valida_guardar_metodologia(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_metodologia.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_metodologia.focus();
      return false;
	}


	f.actualiza_metodologia.value=1;
	FAjax('./profesor/metodologia.php','metodologia_div','','post');
	
}
	 
function valida_edita_metodologia(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_metodologia.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_metodologia.focus();
      return false;
	}


	f.actualiza_edita_metodologia.value=1;
	FAjax('./profesor/metodologia.php','metodologia_div','','post');
	
}
	 
function valida_guardar_actividad(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_actividad.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_actividad.focus();
      return false;
	}


	f.actualiza_actividad.value=1;
	FAjax('./profesor/actividad.php','actividad_div','','post');
	
}
	 
function valida_edita_actividad(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_actividad.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_actividad.focus();
      return false;
	}


	f.actualiza_edita_actividad.value=1;
	FAjax('./profesor/actividad.php','actividad_div','','post');
	
}
	 
function valida_guardar_dificultad(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_dificultad.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_dificultad.focus();
      return false;
	}


	f.actualiza_dificultad.value=1;
	FAjax('./profesor/dificultad.php','dificultad_div','','post');
	
}
	 
function valida_edita_dificultad(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_dificultad.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_dificultad.focus();
      return false;
	}


	f.actualiza_edita_dificultad.value=1;
	FAjax('./profesor/dificultad.php','dificultad_div','','post');
	
}
	 
function valida_guardar_biblografia(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_biblografia.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_biblografia.focus();
      return false;
	}


	f.actualiza_biblografia.value=1;
	FAjax('./profesor/biblografia.php','biblografia_div','','post');
	
}
	 
function valida_edita_biblografia(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_biblografia.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_biblografia.focus();
      return false;
	}


	f.actualiza_edita_biblografia.value=1;
	FAjax('./profesor/biblografia.php','biblografia_div','','post');
	
}

function selecciona_todo(f){
	for(i=0;i<f.length;i++) {
		if(f.elements[i].type=="checkbox") { 
			f.elements[i].click();
		}
	} 
	return false;	
}

function valida_guardar_recomendaciones_grupo(f){
	 
	if(f.descripcion_recomendacion.value.length<3){
		alert('Debe ingresar una recomendacion valida...');
		f.descripcion_recomendacion.focus();
		return false;
	}
	
	var i=0;var ck=0;
	for(i=0;i<f.length;i++) {
		if(f.elements[i].type=="checkbox") { 
			if(f.elements[i].checked){
				 ck++;
				 f.elements[i].value=1;
			}else{
				f.elements[i].value=0;
			}
		}
	} 
	
	if(ck==0){ 
		alert("Seleccione al menos  un alumno por favor...");  
		return false;
	}
	
	FAjax('./load.php','load','','post');
	f.ingreso_recomendacion.value="Espere unos instantes...";
	f.ingreso_recomendacion.disabled=true;
	f.volver.disabled=true;
	f.actualiza_recomendacion_grupo.value=1;
	//return false;
	FAjax('./profesor/recomendaciones_grupo.php','area_trabajo','','post');

}

function valida_guardar_recomendacion(f){
	
	//alert("popopopo"+f.observaciones.value);
if(f.descripcion_recomendacion.value.length >=1 && f.recomendacion_general.value.length >=1){
	alert('Debe ingresar solo una recomendacion...');
	return false;
}else{
	if(f.descripcion_recomendacion.value.length < 5){
	}else{
		f.actualiza_recomendacion.value=1;
	}

	if(f.recomendacion_general.value.length < 1){
	}else{
		f.actualiza_recomendacion.value=2;
	}
}
	
	if(f.actualiza_recomendacion.value==0){
		alert('Debe ingresar alguna recomendacion...');
		return false;
	}

	FAjax('./profesor/recomendacion.php','area_trabajo','','post');
	
}
	 
function valida_guardar_caso_especial(f){
	 
	var i=0;var ck=0;
	for(i=0;i<f.length;i++) {
		if(f.elements[i].type=="checkbox") { 
			if(f.elements[i].checked){
				 ck++;
				 f.elements[i].value=1;
			}else{
				f.elements[i].value=0;
			}
		}
	} 
	
	if(ck==0){ 
		alert("Seleccione al menos  un alumno por favor...");  
		return false;
	}
	
	f.actualiza_caso_especial.value=1;

	FAjax('./profesor/caso_especial.php','area_trabajo','','post');

}

function valida_guardar_caso_especial_2(f){
	
	if(f.caso_especial_personal.value.length < 1){
	  alert('Debe ingresar una dificultad...');
	  f.caso_especial_personal.focus();
      return false;
	}

	f.actualiza_caso_especial.value=2;

	FAjax('./profesor/caso_especial.php','area_trabajo','','post');

}

function valida_guardar_caso_especial_recomendacion(f){
	
	if(f.caso_especial_recomendacion.value.length < 1){
	  alert('Debe ingresar un comentario institucional...');
	  f.caso_especial_recomendacion.focus();
      return false;
	}

	f.actualiza_caso_especial.value=3;

	FAjax('./profesor/caso_especial.php','area_trabajo','','post');

}

function valida_guardar_matricula(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.tarifa_alumno.value.length < 1){
	  alert('Debe seleccionar la tarifa...');
	  f.tarifa_alumno.focus();
      return false;
	}

	if(f.estado_alumno.value.length < 1){
	  alert('Debe seleccionar el estado...');
	  f.estado_alumno.focus();
      return false;
	}

	f.actualiza_matricula.value=1;
	FAjax('./administrativo/matricula_alumno.php','matricula','','post');
	
}
	 
function valida_guardar_clave(f){
	
	if(f.clave0.value.length < 2){
	  alert('Debe ingresar la clave actual.\nMin. 2 caracteres...');
	  f.clave0.focus();
      return false;
	}

	if(f.clave1.value.length < 2){
	  alert('Debe ingresar las claves nuevas.\nMin. 2 caracteres...');
	  f.clave1.focus();
      return false;
	}

	if(f.clave2.value.length < 2){
	  alert('Debe reingresar la clave nueva.\nMin. 2 caracteres...');
	  f.clave2.focus();
      return false;
	}

	if(f.clave1.value!=f.clave2.value){
		alert('Las claves no coinciden...');
	  	f.clave1.focus();
		return false;
	}

	f.actualiza_clave.value=1;
	FAjax('./administrativo/cambio_clave.php','area_trabajo','','post');
	
}

function valida_seleccionar_alumno(f){
	if(f.alumno_registrado.value.length < 1){
	  alert('Debe seleccionar un alumno...');
	  f.alumno_registrado.focus();
      return false;
	}

	return true;
}

function valida_filtro_pago(f){
	if(f.id_alumno.value.length < 6){
	  alert('Debe ingresar una identificacion valida\nMin. 6 digitos...');
	  f.id_alumno.focus();
      return false;
	}
	
	f.filtra_alumno.value=1;

	FAjax('./administrativo/filtro_registro_pago.php','area_trabajo','','post');
}

function valida_guardar_concepto(f){
	
	f.ingreso_concepto.disabled=true;
	f.ingreso_concepto.value="Espere...";
	
	if(f.concepto_pago.value.length < 1){
	  alert('Debe seleccionar algun concepto de pago...');
	  f.concepto_pago.focus();
      f.ingreso_concepto.disabled=true;
	  f.ingreso_concepto.value="ADICIONAR CONCEPTO";
	
      return false;
	}

	f.actualiza_pago.value=1;
	FAjax('./administrativo/registro_pago.php','area_trabajo','','post');
}

function valida_guardar_pension(f){
	if(f.anio_pago.value.length < 1){
	  alert('Debe seleccionar algun año de pago...');
	  f.anio_pago.focus();
      return false;
	}

	if(f.mes_pago.value.length < 1){
	  alert('Debe seleccionar algun mes de pago...');
	  f.mes_pago.focus();
      return false;
	}

	if(f.valor_pago.value.length < 2){
	  alert('Debe ingresar una sifra valida\nMin. 2 digitos...');
	  f.valor_pago.focus();
      return false;
	}
	
	f.actualiza_pension.value=1;
	FAjax('./administrativo/recibo_pension.php','area_trabajo','','post');
}

function valida_form_pago(f){ 
	f.boton_pago.disabled=true;
	f.boton_pago.value="Espere...";
  var i=0;var ck=0;
   for(i=0;i<f.length;i++) {
     if(f.elements[i].type=="checkbox") { 
         if(f.elements[i].checked){
			 ck++;
		 }else{
		 f.elements[i].value=0;
		 }
     }
    } 

if(ck==0){ 
	alert("Seleccione al menos  una factura por favor...");  
	f.boton_pago.disabled=false;
	f.boton_pago.value="REALIZAR PAGO";
	return false;
}
//alert("ok: "+f.tipo_pago.value);
	if(f.tipo_pago.value.length < 1){
	  alert('Debe seleccionar el tipo de pago...');
	  f.tipo_pago.focus();
	  f.boton_pago.disabled=false;
	  f.boton_pago.value="REALIZAR PAGO";
      return false;
	}
	
	//cc=confirm("Si este seguro de Eliminar los registro seleccionados\nhaga cilck en Aceptar")
    //if(cc){;} else{ return false ;}
   FAjax('./administrativo/recibo_pago.php','area_trabajo','','post');
}

function valida_cancela_factura(f){
	if(f.id_factura.value.length < 3){
	  alert('Debe ingresar una factura valida\nMin. 4 digitos...');
	  f.id_factura.focus();
      return false;
	}
	
	f.filtra_cancelacion.value=1;

	FAjax('./administrativo/cancelar_factura.php','area_trabajo','','post');
}

function valida_combina_planes(f){
	
	if(f.periodo.value.length < 1){
	  alert('Debe seleccionar algun periodo...');
	  f.periodo.focus();
      return false;
	}

	if(f.asignatura.value.length < 1){
	  alert('Debe seleccionar alguna asignatura...');
	  f.asignatura.focus();
      return false;
	}

	if(f.grupo1.value.length < 1){
	  alert('Debe seleccionar algun grupo...');
	  f.grupo1.focus();
      return false;
	}

	if(f.asignatura2.value.length < 1){
	  alert('Debe seleccionar alguna asignatura...');
	  f.asignatura2.focus();
      return false;
	}

	if(f.grupo2.value.length < 1){
	  alert('Debe seleccionar algun grupo...');
	  f.grupo2.focus();
      return false;
	}

  var i=0;var ck=0;
   for(i=0;i<f.length;i++) {
     if(f.elements[i].type=="checkbox") { 
         if(f.elements[i].checked){
			 ck++;
		 }else{
		 f.elements[i].value=0;
		 }
     }
    } 

if(ck==0){ 
	alert("Seleccione al menos un componente por favor...");  
	return false;
}
	f.actualiza_combina.value=1;
	FAjax('./administrativo/combinar_pg.php','area_trabajo','','post');
}

function valida_guardar_gasto(f){
	if(f.nombre_gasto.value.length < 3){
	  alert('Debe ingresar el nombre del gasto\nMin 3 caracteres...');
	  f.nombre_gasto.focus();
      return false;
	}

	if(f.valor_gasto.value.length < 2){
	  alert('Debe ingresar el valor del gasto\nMin 2 cifras...');
	  f.valor_gasto.focus();
      return false;
	}

	if(f.tipo_gasto.value.length < 1){
	  alert('Debe ingresar el tipo de gasto...');
	  f.tipo_gasto.focus();
      return false;
	}

	if(f.recursos_pago.value.length < 1){
	  alert('Debe ingresar el origen de los recursos para pago del gasto...');
	  f.recursos_pago.focus();
      return false;
	}

	/*if(f.observaciones_gasto.value.length < 3){
	  alert('Debe ingresar las observaciones del gasto\nMin 3 caracteres...');
	  f.observaciones_gasto.focus();
      return false;
	}*/

	f.actualiza_gasto.value=1;
	FAjax('./administrativo/registro_gasto.php','area_trabajo','','post');
}

function valida_guardar_otros(f){
	if(f.id_pago.value.length < 3){
	  alert('Debe ingresar el documento\nMin 3 caracteres...');
	  f.id_pago.focus();
      return false;
	}

	if(f.nombre_pago.value.length < 3){
	  alert('Debe ingresar el nombre\nMin 3 caracteres...');
	  f.nombre_pago.focus();
      return false;
	}

	if(f.concepto_pago.value.length < 3){
	  alert('Debe ingresar el nombre del concepto\nMin 3 caracteres...');
	  f.concepto_pago.focus();
      return false;
	}

	if(f.valor_pago.value.length < 2){
	  alert('Debe ingresar el valor del pago\nMin 2 cifras...');
	  f.valor_pago.focus();
      return false;
	}

	/*if(f.observaciones_gasto.value.length < 3){
	  alert('Debe ingresar las observaciones del gasto\nMin 3 caracteres...');
	  f.observaciones_gasto.focus();
      return false;
	}*/

	f.actualiza_concepto.value=1;
	FAjax('./administrativo/recibo_pago_otros.php','area_trabajo','','post');
}

function valida_informe_pagos(f){
/*	if(f.fechaini.value.length < 9){
	  alert('Debe seleccionar la fecha de inicio del informe...');
	  f.fechaini.focus();
      return false;
	}

	if(f.fechafin.value.length < 9){
	  alert('Debe seleccionar la fecha de finalizacion del informe...');
	  f.fechafin.focus();
      return false;
	}
*/
	FAjax('./administrativo/listado_pagos_admin.php','listado_admin','','post');
}

function valida_informe_pagos_fact(f){
/*	if(f.fechaini.value.length < 9){
	  alert('Debe seleccionar la fecha de inicio del informe...');
	  f.fechaini.focus();
      return false;
	}

	if(f.fechafin.value.length < 9){
	  alert('Debe seleccionar la fecha de finalizacion del informe...');
	  f.fechafin.focus();
      return false;
	}
*/
	FAjax('./administrativo/listado_pagos_admin_fact.php','listado_admin','','post');
}

function valida_informe_pagos_planilla(f){
	if(f.grupo.value.length < 1){
	  alert('Debe seleccionar grupo del informe...');
	  f.grupo.focus();
      return false;
	}

	if(f.anio.value.length < 1){
	  alert('Debe seleccionar año del informe...');
	  f.anio.focus();
      return false;
	}

	FAjax('./administrativo/listado_pagos_planilla.php','listado_admin','','post');
}

function valida_pagos_vs_gastos(f){
	if(f.fechaini.value.length < 9){
	  alert('Debe seleccionar la fecha de inicio del informe...');
	  f.fechaini.focus();
      return false;
	}

	if(f.fechafin.value.length < 9){
	  alert('Debe seleccionar la fecha de finalizacion del informe...');
	  f.fechafin.focus();
      return false;
	}

	FAjax('./administrativo/listado_pagos_vs_gastos.php','pagos_vs_gastos','','post');
}

function valida_informe_gastos(f){
	if(f.fechaini.value.length < 9){
	  alert('Debe seleccionar la fecha de inicio del informe...');
	  f.fechaini.focus();
      return false;
	}

	if(f.fechafin.value.length < 9){
	  alert('Debe seleccionar la fecha de finalizacion del informe...');
	  f.fechafin.focus();
      return false;
	}

	var i=0;var ck=0;
   	for(i=0;i<f.length;i++) {
    	if(f.elements[i].type=="checkbox") { 
         	if(f.elements[i].checked){
			 	ck++;
				f.elements[i].value=1;
		 	}else{
		 		f.elements[i].value=0;
		 	}
     	}
    } 

	if(ck==0){ 
		alert("Seleccione al menos uno por favor...");  
		f.recursos_pago.focus();
		return false;
	}
	
	FAjax('./administrativo/listado_gastos_admin.php','listado_admin','','post');
}

function valida_nuevo_concepto(f){
	if(f.nombre_concepto.value.length < 3){
	  alert('Debe ingresar un nombre valido\nMin. 3 caracteres...');
	  f.nombre_concepto.focus();
      return false;
	}

	if(f.valor_concepto.value.length < 2){
	  alert('Debe ingresar el valor del concepto\nMin 2 cifras...');
	  f.valor_concepto.focus();
      return false;
	}

	f.actualiza_concepto.value=1;
	FAjax('./administrativo/gestion_concepto.php','area_trabajo','','post');
}

function valida_edita_concepto(f){
	if(f.nombre_concepto.value.length < 3){
	  alert('Debe ingresar un nombre valido\nMin. 3 caracteres...');
	  f.nombre_concepto.focus();
      return false;
	}

	if(f.valor_concepto.value.length < 2){
	  alert('Debe ingresar el valor del concepto\nMin 2 cifras...');
	  f.valor_concepto.focus();
      return false;
	}

	f.edita_concepto.value=1;
	FAjax('./administrativo/gestion_concepto.php','area_trabajo','','post');
}

function valida_nuevo_usuario(f){
	var cont=0;
	if(f.id_usuario.value.length < 6){
	  alert('Debe ingresar un documento valido\nMin. 6 caracteres...');
	  f.id_usuario.focus();
      return false;
	}
	
	var i=0;var ck=0;
   	for(i=0;i<f.length;i++) {
    	if(f.elements[i].type=="checkbox") { 
         	if(f.elements[i].checked){
			 	ck++;
				f.elements[i].value=1;
		 	}else{
		 		f.elements[i].value=0;
		 	}
     	}
    } 

	if(ck==0){ 
		alert("Seleccione al menos un modulo por favor...");  
		return false;
	}
	
	f.actualiza_usuario.value=1;
	FAjax('./administrativo/gestion_usuario.php','area_trabajo','','post');
}

function valida_edita_usuario(f){
	var cont=0;
	if(f.id_usuario.value.length < 6){
	  alert('Debe ingresar un documento valido\nMin. 6 caracteres...');
	  f.id_usuario.focus();
      return false;
	}
	
	var i=0;var ck=0;
   	for(i=0;i<f.length;i++) {
    	if(f.elements[i].type=="checkbox") { 
         	if(f.elements[i].checked){
			 	ck++;
				f.elements[i].value=1;
		 	}else{
		 		f.elements[i].value=0;
		 	}
     	}
    } 

	if(ck==0){ 
		alert("Seleccione al menos un modulo por favor...");  
		return false;
	}
	
	f.edita_usuario.value=1;
	FAjax('./administrativo/gestion_usuario.php','area_trabajo','','post');
}

function valida_nuevo_profesor(f){
	if(f.id_profesor.value.length < 6){
	  alert('Debe ingresar un documento valido\nMin. 6 caracteres...');
	  f.nombre_profesor.focus();
      return false;
	}

	if(f.nombre_profesor.value.length < 3){
	  alert('Debe ingresar un nombre valido\nMin. 3 caracteres...');
	  f.nombre_profesor.focus();
      return false;
	}

	if(f.telefono.value.length < 7){
	  alert('Debe ingresar un telefono valido\nMin. 7 caracteres...');
	  f.telefono.focus();
      return false;
	}

	if(f.direccion.value.length < 3){
	  alert('Debe ingresar una direccion valida\nMin. 3 caracteres...');
	  f.direccion.focus();
      return false;
	}

	if(f.correo.value.length < 8 || f.correo.value.split("@").length!=2){
	  alert('Debe ingresar una direccion de correo valida...');
	  f.correo.focus();
      return false;
	}

	if(f.grupo.value.length < 1){
	  alert('Debe asignar un grupo o categoria...');
	  f.grupo.focus();
      return false;
	}

	f.actualiza_profesor.value=1;
	FAjax('./administrativo/gestion_profesor.php','area_trabajo','','post');
}

function valida_edita_profesor(f){
	if(f.id_profesor.value.length < 6){
	  alert('Debe ingresar un documento valido\nMin. 6 caracteres...');
	  f.id_profesor.focus();
      return false;
	}

	if(f.nombre_profesor.value.length < 3){
	  alert('Debe ingresar un nombre valido\nMin. 3 caracteres...');
	  f.nombre_profesor.focus();
      return false;
	}

	if(f.telefono.value.length < 7){
	  alert('Debe ingresar un telefono valido\nMin. 7 caracteres...');
	  f.telefono.focus();
      return false;
	}

	if(f.direccion.value.length < 3){
	  alert('Debe ingresar una direccion valida\nMin. 3 caracteres...');
	  f.direccion.focus();
      return false;
	}

	if(f.correo.value.length < 8 || f.correo.value.split("@").length!=2){
	  alert('Debe ingresar una direccion de correo valida...');
	  f.correo.focus();
      return false;
	}

	if(f.grupo.value.length < 1){
	  alert('Debe asignar un grupo o categoria...');
	  f.grupo.focus();
      return false;
	}

	f.edita_profesor.value=1;
	FAjax('./administrativo/gestion_profesor.php','area_trabajo','','post');
}

function valida_nuevo_tarifa(f){
	if(f.nombre_tarifa.value.length < 3){
	  alert('Debe ingresar un nombre valido\nMin. 3 caracteres...');
	  f.nombre_tarifa.focus();
      return false;
	}

	if(f.valor_tarifa.value.length < 3){
	  alert('Debe ingresar una tarifa valida\nMin. 3 cifras...');
	  f.valor_tarifa.focus();
      return false;
	}

	if(f.valor_matricula.value.length < 3){
	  alert('Debe ingresar un valor de matricula valido\nMin. 3 cifras...');
	  f.valor_matricula.focus();
      return false;
	}

	f.actualiza_tarifa.value=1;
	FAjax('./administrativo/gestion_tarifa.php','area_trabajo','','post');
}

function valida_edita_tarifa(f){
	if(f.nombre_tarifa.value.length < 3){
	  alert('Debe ingresar un nombre valido\nMin. 3 caracteres...');
	  f.nombre_tarifa.focus();
      return false;
	}

	if(f.valor_tarifa.value.length < 3){
	  alert('Debe ingresar una tarifa valida\nMin. 3 cifras...');
	  f.valor_tarifa.focus();
      return false;
	}

	if(f.valor_matricula.value.length < 3){
	  alert('Debe ingresar un valor de matricula valido\nMin. 3 cifras...');
	  f.valor_matricula.focus();
      return false;
	}

	f.edita_tarifa.value=1;
	FAjax('./administrativo/gestion_tarifa.php','area_trabajo','','post');
}

function valida_guia(f){
	if(f.tema.value.length < 1){
	  alert('Debe ingresar tema de la circular...');
	  f.tema.focus();
      return false;
	}

	if(f.dirigida.value.length < 1){
	  alert('Debe ingresar a quien va dirigida la circular...');
	  f.dirigida.focus();
      return false;
	}
	return true;
}

function valida_nuevo_circular(f){
	if(f.remitido.value.length < 5){
	  alert('Debe ingresar a quien va dirigida la circular\nMin. 5 caracteres...');
	  f.remitido.focus();
      return false;
	}

	if(f.remitente.value.length < 3){
	  alert('Debe ingresar un remitente valido\nMin. 3 caracteres...');
	  f.remitente.focus();
      return false;
	}

	if(f.cargo_remitente.value.length < 3){
	  alert('Debe ingresar un cargo valido\nMin. 3 caracteres...');
	  f.cargo_remitente.focus();
      return false;
	}

	if(f.contenido.value.length < 30){
	  alert('Debe ingresar un contenido valido\nMin. 30 caracteres...');
	  f.contenido.focus();
      return false;
	}

	var i=0;var ck=0;
   	for(i=0;i<f.length;i++) {
    	if(f.elements[i].type=="checkbox") { 
         	if(f.elements[i].checked){
			 	ck++;
		 	}else{
		 		f.elements[i].value=0;
		 	}
     	}
    } 

	if(ck==0){ 
		alert("Seleccione al menos una categoria por favor...");  
		return false;
	}
	
	f.actualiza_circular.value=1;
	FAjax('./administrativo/gestion_circulares.php','area_trabajo','','post');
}

function valida_nuevo_comunicado(f){
	if(f.asunto.value.length < 5){
	  alert('Debe ingresar un asunto para el comunicado\nMin. 5 caracteres...');
	  f.asunto.focus();
      return false;
	}

	if(f.contenido.value.length < 10){
	  alert('Debe ingresar un contenido valido\nMin. 10 caracteres...');
	  f.contenido.focus();
      return false;
	}

  	var i=0;var ck=0;
   	for(i=0;i<f.length;i++) {
    	if(f.elements[i].type=="checkbox") { 
        	if(f.elements[i].checked){
				f.elements[i].value=1;
				ck++;
		 	}else{
		 	f.elements[i].value=0;
		 	}
     	}
    } 

	if(ck==0){ 
		alert("Seleccione al menos un alumno por favor...");  
		return false;
	}
	f.actualiza_comunicado.value=1;
	FAjax('./aula/gestion_comunicado.php','area_trabajo_alumno','','post');
}

function valida_nuevo_comunicado_admin(f){
	if(f.asunto.value.length < 5){
	  alert('Debe ingresar un asunto para el comunicado\nMin. 5 caracteres...');
	  f.asunto.focus();
      return false;
	}

	if(f.contenido.value.length < 10){
	  alert('Debe ingresar un contenido valido\nMin. 10 caracteres...');
	  f.contenido.focus();
      return false;
	}

  	var i=0;var ck=0;
   	for(i=0;i<f.length;i++) {
    	if(f.elements[i].type=="checkbox") { 
        	if(f.elements[i].checked){
				ck++;
		 	}else{
		 	f.elements[i].value=0;
		 	}
     	}
    } 

	if(ck==0){ 
		alert("Seleccione al menos un alumno por favor...");  
		return false;
	}
	f.actualiza_comunicado.value=1;
	FAjax('./administrativo/gestion_comunicado_admin.php','area_trabajo','','post');
}

function valida_nuevo_plan(f){
	if(f.fecha.value.length < 5){
	  alert('Debe ingresar una fecha valida...');
	  f.fecha.focus();
      return false;
	}

	if(f.tiempo.value.length < 3){
	  alert('Debe ingresar un tiempo valido\nMin. 3 caracteres...');
	  f.tiempo.focus();
      return false;
	}

	if(f.elementos.value.length < 3){
	  alert('Debe ingresar unos elementos validos\nMin. 3 caracteres...');
	  f.elementos.focus();
      return false;
	}

	if(f.objetivo.value.length < 3){
	  alert('Debe ingresar unos objetivos validos\nMin. 3 caracteres...');
	  f.objetivo.focus();
      return false;
	}

	f.actualiza_plan.value=1;
	FAjax('./profesor/form_plan_entrenamiento.php','concepto','','post');
}

function valida_nuevo_ejercicio(f){
	
	f.ingreso_ejercicio.value="Espere unos instantes...";
	f.ingreso_ejercicio.disabled=true;
	
	if(f.nombre_ej.value.length < 3){
	  alert('Debe ingresar un nombre valido\nMin. 3 caracteres...');
	  f.nombre_ej.focus();
      return false;
	}

	if(f.descripcion_ej.value.length < 3){
	  alert('Debe ingresar una descripcion valida\nMin. 3 caracteres...');
	  f.descripcion_ej.focus();
      return false;
	}

	f.actualiza_ejercicio.value=1;
	return true;
}

function valida_contact(f){
	
	if(f.nombre.value.length < 8){
	  alert('Debe ingresar un nombre valido.\nMin. 8 caracteres...');
	  f.nombre.focus();
      return false;
	}

	if(f.telefono.value.length < 7){
	  alert('Debe ingresar un telefono valido\nMin. 7 caracteres...');
	  f.telefono.focus();
      return false;
	}

	if(f.correo.value.length < 8 || f.correo.value.split("@").length!=2){
	  alert('Debe ingresar una direccion de correo valida...');
	  f.correo.focus();
      return false;
	}

	if(f.objeto.value.length < 7){
	  alert('Debe ingresar un asunto valido\nMin. 7 caracteres...');
	  f.objeto.focus();
      return false;
	}

	if(f.msj.value.length < 7){
	  alert('Debe ingresar un mensaje valido\nMin. 7 caracteres...');
	  f.msj.focus();
      return false;
	}

	FAjax('./contactenos.php','contenido_usuario','','post');
	
}
	 
	 
	         var celda_ant;
 
        celda_ant="";
 
      function ilumina(celda){
          if (celda_ant=="")
            {
                celda_ant = celda;
            }
          celda_ant.style.backgroundColor="#FFFFFF";
          celda_ant.style.color="#666666";
            celda.style.backgroundColor="#666666";
            celda.style.color="#FFFFFF";
            celda_ant = celda;
        }

	function abrirVentana(id) 
	{ 
		//'http://localhost/BituimaAtractiva/aplicacion/galeriaNivo3.php?id='+id
		window.open('http://www.bituimaatractiva.com.co/aplicacion/galeriaNivo3.php?id='+id,'','titlebars=0, toolbar=0, scrollbars=0, location=0, statusbar=0, menubar=0, resizable=0, width=600, height=500');
 }

	function abrirVentanaVideo(id) 
	{ 
		//'http://localhost/BituimaAtractiva/aplicacion/video.php?id='+id
		window.open('http://www.bituimaatractiva.com.co/aplicacion/video.php?id='+id,'','titlebars=0, toolbar=0, scrollbars=0, location=0, statusbar=0, menubar=0, resizable=0, width=600, height=500');
 }
 
 
function valida_noticia(f){
	
	/*
	alert(f.nombre.value);
	if(f.nombre.value.length < 8){
	  alert('Debe ingresar un titulo valido.\nMin. 8 caracteres...');
	  f.nombre.focus();
      return false;
	}

	if(f.descripcion.value.length < 10){
	  alert('Debe ingresar una noticia valida.');
	  f.descripcion.focus();
      return false;
	}
	*/
	return true;
	
}

function valida_material(f){
	
	if(f.tema.value.length < 8){
	  alert('Debe ingresar un titulo valido.\nMin. 8 caracteres...');
	  f.tema.focus();
      return false;
	}

	if(f.dirigida.value.length < 5){
	  alert('Debe ingresar a quien va dirigida.');
	  f.dirigida.focus();
      return false;
	}

	if(f.emisor.value.length < 5){
	  alert('Debe ingresar quien emite el comunicado.');
	  f.emisor.focus();
      return false;
	}
	return true;
	
}

function valida_formatos(f){
	if(f.grupo.value.length < 1){
	  alert('Debe seleccionar un grupo valido...');
	  f.grupo.focus();
      return false;
	}
	window.open('./profesor/impresion_formato.php?grupo='+f.grupo.value);
}

function valida_formatos_1(f){
	if(f.grupo.value.length < 1){
	  alert('Debe seleccionar un grupo valido...');
	  f.grupo.focus();
      return false;
	}
	window.open('./profesor/impresion_formato_excel.php?grupo='+f.grupo.value);
}

function valida_pin(f){
	if(f.id.value.length <= 5){
	  alert('Debe ingresar una identificacion valida\nMin. 6 digitos...');
	  f.id.focus();
      return false;
	}

	if(f.nombre.value.length < 5){
	  alert('Debe ingresar un nombre valido.\nMin. 5 caracteres...');
	  f.nombre.focus();
      return false;
	}

	if(f.grado.value.length < 1){
	  alert('Debe seleccionar el grado al que se matricula...');
	  f.grado.focus();
      return false;
	}
	
	f.actualiza_pin.value=1;
	FAjax('./administrativo/nvo_pin.php','area_trabajo','','post');
	
}
	 
function valida_guardar_registro(f){
	if(f.expedida.value.length < 3){
	  alert('Debe ingresar lugar de expedicion valido.\nMin. 3 caracteres...');
	  f.expedida.focus();
      return false;
	}
	
	if(f.nombre.value.length < 5){
	  alert('Debe ingresar un nombre valido.\nMin. 5 caracteres...');
	  f.nombre.focus();
      return false;
	}

	if(f.lugar.value.length < 4){
	  alert('Debe ingresar un lugar de nacimiento valido\nMin. 4 caracteres...');
	  f.lugar.focus();
      return false;
	}

	if(f.fecha.value.length < 10){
	  alert('Debe ingresar una fecha valida...');
	  f.fecha.focus();
      return false;
	}

	if(f.sangre.value.length < 1){
	  alert('Debe seleccionar un tipo de sangre valido...');
	  f.sangre.focus();
      return false;
	}

	if(f.seguro.value.length < 1){
	  alert('Debe seleccionar el tipo de seguridad social...');
	  f.seguro.focus();
      return false;
	}

	f.actualiza.value=1;
	FAjax('./registro_alumno.php','contenido_usuario','','post');
	
}
	 
function valida_gardar_registro(f){
	
	if(f.identificacion_familiar.value.length <= 5){
	  alert('Debe ingresar una identificacion valida\nMin. 6 digitos...');
	  f.identificacion_familiar.focus();
      return false;
	}

	if(f.nombre_familiar.value.length < 5){
	  alert('Debe ingresar un nombre valido.\nMin. 5 caracteres...');
	  f.nombre_familiar.focus();
      return false;
	}

	if(f.ocupacion_familiar.value.length < 3){
	  alert('Debe ingresar una ocupacion valida\nMin. 3 caracteres...');
	  f.ocupacion_familiar.focus();
      return false;
	}

	if(f.parentesco_familiar.value.length < 3){
	  alert('Debe ingresar un parentesco valido\nMin. 3 caracteres...');
	  f.parentesco_familiar.focus();
      return false;
	}

	if(f.direccion_familiar.value.length < 7){
	  alert('Debe ingresar una direccion valida\nMin. 7 caracteres...');
	  f.direccion_familiar.focus();
      return false;
	}
/*
	if(f.telefono_familiar.value.length < 7){
	  alert('Debe ingresar un telefono valido\nMin. 7 caracteres...');
	  f.telefono_familiar.focus();
      return false;
	}

	if(f.celular_familiar.value.length < 7){
	  alert('Debe ingresar un celular valido\nMin. 7 caracteres...');
	  f.celular_familiar.focus();
      return false;
	}

	if(f.correo_familiar.value.length < 8 || f.correo_familiar.value.split("@").length!=2){
	  alert('Debe ingresar una direccion de correo valida...');
	  f.correo_familiar.focus();
      return false;
	}
*/	
	f.actualiza_familiar.value=1;
	FAjax('./nvo_familiar.php','familia','','post');
	
}

//////////////////////////////////////////////////////////////////////////////////
///////////////////////////////AULA VIRTUAL///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////

function valida_guia_aula(f){
	
	if(f.tema.value.length < 3){
	  alert('Debe ingresar un tema valido\nMin. 3 caracteres...');
	  f.tema.focus();
      return false;
	}

	f.actualiza_guia_aula.value=1;
	FAjax('./aula/form_guia.php','concepto','','post');
	
}

function valida_actividad_aula(f){
	
	if(f.tema.value.length < 3){
	  alert('Debe ingresar un tema valido\nMin. 3 caracteres...');
	  f.tema.focus();
      return false;
	}

	if(f.objetivos.value.length < 3){
	  alert('Debe ingresar unos objetivos validos\nMin. 3 caracteres...');
	  f.objetivos.focus();
      return false;
	}

	f.actualiza_actividad_aula.value=1;
	FAjax('./aula/form_actividad.php','concepto','','post');
	
}

function valida_elemento_aula(f){
	
	if(f.enunciado_elemento.value.length < 3){
	  alert('Debe ingresar un enunciado valido\nMin. 3 caracteres...');
	  f.enunciado_elemento.focus();
      return false;
	}

	if(f.desc_elemento.value.length < 3){
	  alert('Debe ingresar un valor valido...');
	  f.desc_elemento.focus();
      return false;
	}

	f.actualiza_elemento_aula.value=1;
	return true;
	
}

function valida_elemento_guia(f){
	
	if(f.desc_elemento.value.length < 3){
	  alert('Debe ingresar un archivo de guia valido...');
	  f.desc_elemento.focus();
      return false;
	}

	f.actualiza_elemento_guia.value=1;
	return true;
	
}

function valida_elemento_web(f){
	
	if(f.enunciado_elemento.value.length < 3){
	  alert('Debe ingresar un enunciado valido\nMin. 3 caracteres...');
	  f.enunciado_elemento.focus();
      return false;
	}

	if(f.desc_elemento.value.length < 3){
	  alert('Debe ingresar un valor valido...');
	  f.desc_elemento.focus();
      return false;
	}

	if(f.desc_elemento_2.value.length < 3){
	  alert('Debe ingresar un valor valido...');
	  f.desc_elemento_2.focus();
      return false;
	}

	f.actualiza_elemento_web.value=1;
	return true;
	
}

function valida_edita_elemento_aula(f){
	
	if(f.enunciado_elemento.value.length < 3){
	  alert('Debe ingresar un enunciado valido\nMin. 3 caracteres...');
	  f.enunciado_elemento.focus();
      return false;
	}

	if(f.desc_elemento.value.length < 3){
	  alert('Debe ingresar un valor valido...');
	  f.desc_elemento.focus();
      return false;
	}

	f.actualiza_elemento_aula.value=2;
	return true;
	
}

function valida_edita_elemento_web(f){

	if(f.enunciado_elemento.value.length < 3){
	  alert('Debe ingresar un enunciado valido\nMin. 3 caracteres...');
	  f.enunciado_elemento.focus();
      return false;
	}

	if(f.desc_elemento.value.length < 3){
	  alert('Debe ingresar un texto valido...');
	  f.desc_elemento.focus();
      return false;
	}

	if(f.desc_elemento_2.value.length < 3){
	  alert('Debe ingresar un valor valido...');
	  f.desc_elemento_2.focus();
      return false;
	}

	f.actualiza_elemento_web.value=2;
	return true;
	
}

function valida_ingreso_opcion(f){
	
	if(f.op_respuesta.value.length < 1){
	  alert('Debe ingresar un valor valido...');
	  f.op_respuesta.focus();
      return false;
	}

	f.ingresa_op.value=1;
	FAjax('./aula/listado_opciones.php','opcion_respuesta','','post');
}

function valida_ingreso_opcion2(f){
	
	if(f.op_respuesta.value.length < 1){
	  alert('Debe ingresar un valor valido el la columna 1...');
	  f.op_respuesta.focus();
      return false;
	}

	if(f.op_respuesta2.value.length < 1){
	  alert('Debe ingresar un valor valido el la columna 2...');
	  f.op_respuesta2.focus();
      return false;
	}

	f.ingresa_op.value=1;
	FAjax('./aula/listado_opciones2.php','opcion_respuesta','','post');
}

function valida_pregunta_abierta(f){
	
	if(f.desc_pregunta.value.length < 3){
	  alert('Debe ingresar una pregunta valido...');
	  f.desc_pregunta.focus();
      return false;
	}

	f.actualiza_pregunta_aula.value=1;
	FAjax('./aula/info_elemento.php','list_concepto','','post');
}

function valida_pregunta_vf(f){
	
	if(f.desc_pregunta.value.length < 3){
	  alert('Debe ingresar una pregunta valido...');
	  f.desc_pregunta.focus();
      return false;
	}
	
	if(f.respuesta_p.value.length < 1){
	  alert('Debe seleccionar una respuesta valida...');
	  f.respuesta_p.focus();
      return false;
	}

	f.actualiza_pregunta_aula.value=1;
	FAjax('./aula/info_elemento.php','list_concepto','','post');
}

function valida_pregunta_columnas(f){
	
	if(f.desc_pregunta.value.length < 3){
	  alert('Debe ingresar una pregunta valido...');
	  f.desc_pregunta.focus();
      return false;
	}
	
	f.actualiza_pregunta_aula.value=1;
	FAjax('./aula/info_elemento.php','list_concepto','','post');
}

function valida_pregunta_columnas_imagen(f){
	
	if(f.desc_pregunta.value.length < 3){
	  alert('Debe ingresar una pregunta valido...');
	  f.desc_pregunta.focus();
      return false;
	}
	
	f.actualiza_pregunta_aula.value=1;
	return true;
}

function valida_pregunta_completar(f){
	
	if(f.desc_pregunta.value.length < 3 || f.desc_pregunta.value.split("[CAMPO_DE_COMPLETAR]").length!=2){
	  alert('Debe ingresar una pregunta valido...');
	  f.desc_pregunta.focus();
      return false;
	}

	f.actualiza_pregunta_aula.value=1;
	FAjax('./aula/info_elemento.php','list_concepto','','post');
}

function valida_pregunta_multiple(f){
	
	if(f.desc_pregunta.value.length < 3){
	  alert('Debe ingresar una pregunta valido...');
	  f.desc_pregunta.focus();
      return false;
	}

	var i=0;var ck=0;
	for(i=0;i<f.length;i++) {
		if(f.elements[i].type=="checkbox") { 
			if(f.elements[i].checked){
				 ck++;
				 f.elements[i].value=1;
			}else{
				f.elements[i].value=0;
			}
		}
	} 
	
	if(ck==0){ 
		alert("Debe seleccionar La respuesta correcta...");  
		return false;
	}
	
	if(ck>=2){ 
		alert("Debe seleccionar solo una respuesta correcta...");  
		return false;
	}
	
	f.actualiza_pregunta_aula.value=1;
	FAjax('./aula/info_elemento.php','list_concepto','','post');
}

function valida_resp_clase(f){
	if(f.respuesta_p.value.length < 1){
	  alert('Debe ingresar una respuesta valida...');
	  f.respuesta_p.focus();
      return false;
	}

	f.val_resp.value=1;
	FAjax('./aula/ver_pregunta.php','concepto','','post');
}

function valida_resp_clase2(f){
	var i=0;var ck=0;
	for(i=0;i<f.length;i++) {
		if(f.elements[i].type=="select-one") {
			//alert("entro"); 
			if(f.elements[i].value.length<1){
				alert("Debe seleccionar la opcion correcta...");
				 f.elements[i].focus();
				 return false;
			}
		}
	} 
	
	f.val_resp.value=2;
	FAjax('./aula/ver_pregunta.php','concepto','','post');
}

function valida_grupo_clase(f){
	if(f.grupo_asignatura.value.length < 1){
	  alert('Debe seleccionar un grupo...');
	  f.grupo_asignatura.focus();
      return false;
	}

	if(f.vence_grupo_clase.value == 2){
		if(f.fechaini.value.length < 10){
			alert('Debe seleccionar Fecha de vencimiento...');
			f.fechaini.focus();
      		return false;
		}
	}

	f.actualiza_grupo_clase.value=1;
	FAjax('./aula/info_elemento.php','list_concepto','','post');
}

function valida_grupo_clase_guia(f){
	if(f.grupo_asignatura.value.length < 1){
	  alert('Debe seleccionar un grupo...');
	  f.grupo_asignatura.focus();
      return false;
	}

	if(f.vence_grupo_clase.value == 2){
		if(f.fechaini.value.length < 10){
			alert('Debe seleccionar Fecha de vencimiento...');
			f.fechaini.focus();
      		return false;
		}
	}

	f.actualiza_grupo_clase.value=1;
	FAjax('./aula/info_elemento_guia.php','list_concepto','','post');
}

function valida_circular(f){

	if(f.tema.value.length < 1){
	  alert('Debe ingresar el tema de la guia...');
	  f.tema.focus();
      return false;
	}

	if(f.dirigida.value.length < 1){
	  alert('Debe seleccionar un grupo...');
	  f.dirigida.focus();
      return false;
	}

	if(f.imagen.value.length < 1){
	  alert('Debe ingresar el archivo de la guia...');
	  f.imagen.focus();
      return false;
	}
	
	return true;

}

function valida_evaluacion(f){
//alert('Debe ingresar la fecha...');
	if(f.fecha.value.length < 1){
	  alert('Debe ingresar la fecha...');
	  f.fecha.focus();
      return false;
	}

	if(f.grupo.value.length < 1){
	  alert('Debe seleccionar un grupo...');
	  f.grupo.focus();
      return false;
	}

	if(f.asignatura.value.length < 1){
	  alert('Debe seleccionar una asignatura...');
	  f.asignatura.focus();
      return false;
	}

	if(f.imagen_evaluacion.value.length < 1){
	  alert('Debe ingresar el archivo...');
	  f.imagen_evaluacion.focus();
      return false;
	}
	
	return true;

}

function valida_formato(f){

	if(f.tema.value.length < 1){
	  alert('Debe ingresar el tema de la guia...');
	  f.tema.focus();
      return false;
	}

	if(f.imagen_formato.value.length < 1){
	  alert('Debe ingresar el archivo del formato...');
	  f.imagen_formato.focus();
      return false;
	}
	
	return true;

}

function valida_guardar_seccion(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_seccion.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_seccion.focus();
      return false;
	}
	//seccion_plan_gestor
	if(f.seccion_plan_gestor.value.length < 1){
	  alert('Debe seleccionar una seccion valida...');
	  f.seccion_plan_gestor.focus();
      return false;
	}

	f.actualiza_seccion.value=1;
	FAjax('./profesor/seccion_plan_gestor.php','seccion_div','','post');
	
}
	 
function valida_edita_seccion(f){
	
	//alert("popopopo"+f.observaciones.value);
	if(f.descripcion_seccion.value.length < 5){
	  alert('Debe ingresar una descripcion valida.\nMin. 5 caracteres...');
	  f.descripcion_seccion.focus();
      return false;
	}
	//seccion_plan_gestor
	if(f.seccion_plan_gestor.value.length < 1){
	  alert('Debe seleccionar una seccion valida...');
	  f.seccion_plan_gestor.focus();
      return false;
	}

	f.actualiza_edita_seccion.value=1;
	FAjax('./profesor/seccion_plan_gestor.php','seccion_div','','post');
	
}
	 
