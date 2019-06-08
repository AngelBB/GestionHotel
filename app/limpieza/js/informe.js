function enviarDatos(){
	var dni_trab=$('#dni_trab').val();
	var num_hab=$('#hab').val();
	var estaDisp=$('#finalizada').val();
	var desc=$('#descripcion').val();
	
	if(dni_trab != "" && num_hab !="" && estaDisp || desc !=""){
		$.ajax({
			type: "POST",
			url: "php/informe.php",
			data: { dni_trabajador:dni_trab , numero_habitacion:num_hab , incidencias:desc , disponible:estaDisp },
			success: function(respuesta) {
						alert(respuesta);
					},
		});
	}	
	return false;	
}

//Funcion para abrir una nueva ventana
function abrirVentana(){
	window.open("php/estado_habitaciones.php", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=500, width=400, height=400");
}

$(document).ready(function(){
	$('#enviar').click(enviarDatos);
});