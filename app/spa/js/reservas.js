			///////////////////////
			//Descraga de tarifas//
			///////////////////////
function descargarTarifas(){
	$.ajax({
	  type: "POST",
	  url: "php/lista_tarifas.php",
	  //data: {},
	  success: function(respuesta) {
      		$("#servicios").html(respuesta);
		}
	});
	return false;
}

			////////////////////////
			//Descarga de clientes//
			////////////////////////
function descargarClientes(){
	$.ajax({
	  type: "POST",
	  url: "../clientes/php/lista_clientes.php",
	  //data: {},
	  success: function(respuesta) {
      		$("#cod_cliente").html(respuesta);
		}
	});
	return false;
}

			//////////////////////
			// Insertar Reserva //
			//////////////////////
function insertarReserva(){
	var serv_elegido=$("#servicios").val();
	var fecha=$("#fecha").val();
	var hora=$("#hora").val();
	var cood_cliente=$("#cod_cliente").val();//Esto sera un select
	
	if(serv_elegido != "" && fecha !="" && hora !=""){
		if(fecha.length > 0 && (hora.length) > 0){
			$.ajax({
			  type: "POST",
			  url: "php/reservas.php",
			  data: { cod_cliente:cood_cliente , servicios:serv_elegido , fecha:fecha , hora:hora },
			  success: function(respuesta) {
					alert(respuesta);
					}
			});
	}else{
		alert("¡ No has rellenado ningun campo !");
	}
	
	return false;
	}
}

$(document).ready(function(){
	descargarTarifas();
	descargarClientes();
    $("#enviar").click(insertarReserva);
});