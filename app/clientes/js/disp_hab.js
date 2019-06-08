function habitacionesDisponibles(){
	var num_habitaciones=$("#habitaciones").val();
	$.ajax({
	  type: "POST",
	  url: "php/disp_hab.php",
	  data: {habitacion:num_habitaciones},
	  success: function(respuesta) {
					if(respuesta=='error'){
						alert("Se ha producido un error");
					}else{
						$('#resultado').html(respuesta);
					}
				}
	});
	return false;
}

window.onload=function(){
	$("#habitaciones").change(habitacionesDisponibles);
}