/*
* NOTA: Este  archivo solo esta destinado a clientes.php ya que devuelve
* unicamente <option> para un select especifico
* La pagina web y la pagina para consultar la disponibilidad dispondran de otro archivo que
* usaran en común llamado disp_hab.js y el php sera disp_hab.php .
* Este devolvera un parrafo y un h2 con el numero de habitaciones diponibles
*/

				//////////////////////////////////////////
				// Descarga de habitaciones disponibles //
				//////////////////////////////////////////
function descargarHabitaciones(){
	var num_habitaciones=$("#habitaciones").val();
	$.ajax({
	  type: "POST",
	  url: "php/disponibilidad_habitaciones.php",
	  data: {habitacion:num_habitaciones},
	  success: function(respuesta) {
      		if(respuesta!= ""){
				var num_habitacion=$("#num_habitaciones");
				num_habitacion.html(respuesta);
				num_habitacion.prop('disabled', false);
			}else{
				$("#num_habitaciones").html("<option value=''>Habitaciones ocupadas</option>");
			}
		}
	});
	return false;
}

				//////////////////////
				// Insertar cliente //				
				//////////////////////
	
//***********Descarga del contenido*********** 
function insertarCliente(){
	//Una vez hechas las validaciones cogemos todos los datos validos y seran enviados al servidor
	var noombre=$("#nombre").val();
	var dnii=$("#dni").val();
	var aapellidos=$("#apellidos").val();
	var teelefono=$("#telefono").val();
	var fecha=$("#fecha_salida").val();
	var nuum_hab=$("#num_habitaciones").val();
	var nuum_personas=$("#numero_personas").val();
		
	$.ajax({
	  type: "POST",
	  url: "php/insertar_cliente.php",
	  data: {dni:dnii, nombre:noombre, apellidos:aapellidos,telefono:teelefono, fecha_salida:fecha, num_personas:nuum_personas, numero_habitacion:nuum_hab},
	  success: function(respuesta) {
      		alert(respuesta);
		}
	});
	return false;
}


window.onload=function(){
	document.getElementById("habitaciones").onchange=descargarHabitaciones;
	$("#enviar").click(insertarCliente);//Al insertar cliente revisamos todo 
}