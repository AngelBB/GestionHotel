			///////////////////////
			//Descraga de tarifas//
			///////////////////////
function descargarTarifas(){
	$.ajax({
	  type: "POST",
	  url: "php/lista_tarifas.php",
	  //data: {},
	  success: function(respuesta) {
      		$("#tarifa").html(respuesta);
		}
	});
	return false;
}	
				/////////////////////
				//Control de campos//
				/////////////////////
function nuevaTarifa(){//Nos servirá para controlar los campos ajenos para introducir un nuevo plato
var objetoDOM=this;
	if(objetoDOM.checked){
		//No se podrá ni elegir una tarifa de la lista ni marcar el checkbox de borrar
		document.getElementById("tarifa").disabled=true;
	
		//Será obligatorio meter nombre y precio y descripcion
		document.getElementById("nombre").required=true;
		document.getElementById("precio").required=true;
		document.getElementById("descripcion").required=true;
		
	}else{
		document.getElementById("tarifa").disabled=false;
		//document.getElementById("borrar").disabled=false;
		//Al no estar selecionada nueva tarifa no es obligatorio que se rellenen los tres campos
		document.getElementById("nombre").required=false;
		document.getElementById("precio").required=false;
		document.getElementById("descripcion").required=false;
		
	}
	//return devolver;
}
			/////////////////
			//Editar tarifa//
			/////////////////
function editarTarifa(){
	var tarifa_elegida=$("#tarifa").val();
	var nombre_nuevo=$("#nombre").val();
	var precio_nuevo=$("#precio").val();
	//var borrar=document.getElementById("borrar");
	var descripcioon=$("#descripcion").val();
	var nuevoo=$("#nuevo").is(':checked');
	
	$.ajax({
	  type: "POST",
	  url: "php/editar_tarifa.php",
	  data: {tarifa:tarifa_elegida, nombre:nombre_nuevo, descripcion:descripcioon, precio:precio_nuevo, nuevo:nuevoo  },
	  success: function(respuesta) {
      		alert(respuesta);
			descargarTarifas();
		}
	});
	return false;
}

/////////////////////////
// Autocompletar tarifa//
/////////////////////////
function autocompletarFormulario(){
var tarifa_sel=$('#tarifa').val();
$.ajax({
	  type: "POST",
	  url: "php/autocompletar_tarifa.php",
	  data: {tarifa_seleccionada:tarifa_sel},
	  dataType : "json",
	  success: function(respuesta) {//reciviremos una cadena json
				var nombre_nuevo=$("#nombre");
				var precio_nuevo=$("#precio");
				var descripcion=$("#descripcion");
				
				//Borramos los campos
				nombre_nuevo.empty();
				precio_nuevo.empty();
				descripcion.empty();
					
				//Insertamos los datos de json en los campos correspondientes
				nombre_nuevo.val(respuesta.nombre);
				precio_nuevo.val(respuesta.precio);
				descripcion.val(respuesta.desc);
		}
	});
	return false;
}


window.onload=function(){
	//Solo vamos a llamar al servidor y este nos enviara todos los platos
	descargarTarifas();
	$('#tarifa').change(autocompletarFormulario);
    document.getElementById("enviar").onclick=editarTarifa;
	document.getElementById("nuevo").onclick=nuevaTarifa;
}