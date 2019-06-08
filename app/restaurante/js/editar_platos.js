				/////////////////////////
				//Descargar los platos //
				/////////////////////////

//Solo vamos a llamar al servidor y este nos enviara todos los platos
function descargarPlatos(){
 	$.ajax({
	  type: "POST",
	  url: "php/lista_platos.php",
	  //data: {},
	  success: function(respuesta) {
      		$("#platos").html(respuesta);
		}
	});
	return false;
}


function nuevoPlato(){//Nos servirá para controlar los campos ajenos para introducir un nuevo plato
var objetoDOM=this;
	if(objetoDOM.checked){
		//No se podrá ni elegir un plato de la lista 
		document.getElementById("platos").disabled=true;
		//Será obligatorio meter nombre y precio
		document.getElementById("nombre_nuevo").required=true;
		document.getElementById("precio_nuevo").required=true;
	}else{
		document.getElementById("platos").disabled=false;
		//Al no estar selecionado nuevo plato no es obligatorio que se rellenen los dos campos
		document.getElementById("nombre_nuevo").required=false;
		document.getElementById("precio_nuevo").required=false;
	}
}


			////////////////
			//editar plato//
			////////////////
function editarPlato(){
var nnuevo_plato=$("#nuevo").is(':checked');//Para introducir un nuevo plato
var pplato_elegido=$("#platos").val();//Es un select
var nnombre_nuevo=$("#nombre_nuevo").val();
var pprecio_nuevo=$("#precio_nuevo").val();
	$.ajax({
	  type: "POST",
	  url: "php/editar_platos.php",
	  data: {plato_elegido:pplato_elegido ,nombre_nuevo:nnombre_nuevo, precio_nuevo:pprecio_nuevo, nuevo_plato:nnuevo_plato},
	  success: function(respuesta) {
      		descargarPlatos();
			alert(respuesta);
		}
	});
	return false;
}



////////////////////////
// Autocompletar plato//
////////////////////////
function autocompletarFormulario(){
var plato=$("#platos").val();
$.ajax({
	  type: "POST",
	  url: "php/autocompletar_plato.php",
	  data: {plato_seleccionado:plato},
	  dataType : "json",
	  success: function(respuesta) {//reciviremos una cadena json
				var nombre_nuevo=$("#nombre_nuevo");
				var precio_nuevo=$("#precio_nuevo");
								
				//Borramos los campos
				nombre_nuevo.empty();
				precio_nuevo.empty();
	
				//Insertamos los datos de json en los campos correspondientes
				nombre_nuevo.val(respuesta.nombre);
				precio_nuevo.val(respuesta.precio);
		}
	});
	return false;
}

window.onload=function(){
	descargarPlatos();
	$("#platos").change(autocompletarFormulario);
    $("#enviar").click(editarPlato);
	$("#nuevo").click(nuevoPlato);
}