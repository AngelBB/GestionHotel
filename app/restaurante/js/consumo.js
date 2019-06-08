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
      		$("#cod_plato").html(respuesta);
		}
	});
	return false;
}//funcion

				//////////////////////
				//Descargar clientes//
				//////////////////////
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

//////////////////////////////////
//Para coger platos selecionados//
//////////////////////////////////

function getValue()
{
	var arrayValores=new Array();
	var selectMultiple=document.getElementById("cod_plato");
	for (var i = 0; i < selectMultiple.options.length; i++) 
	{
		if(selectMultiple.options[i].selected ==true)
		{
			arrayValores.push((selectMultiple.options[i].value));
		}
	}
  
  return arrayValores;
}

//En esta funcion hacemos uso de JSON para enviar un array por POST a traves de AJAX
//El formato JSON es el mas adecuado a la hora de trabajar con PHP
function serializar(){
	var arr=new Array();
	arr=getValue();
	var res = 'a:'+arr.length+':{';
	for(i=0; i<arr.length; i++){
		res += 'i:'+i+';s:'+arr[i].length+':"'+arr[i]+'";';
	}
	res +='}';
	return res;//devolvemos la cadena con formato JSON
 }


///////////////////////////////////////
//Para apuntar el consumo del cliente// 
///////////////////////////////////////

function hacerConsumo(){
	var cood_cliente=$("#cod_cliente").val();
	var cood_plato=serializar();//no devuelve una cadena JSON

	if(cood_plato.length > 0 && cood_cliente != ""){
		$.ajax({
		  type: "POST",
		  url: "php/consumo.php",
		  data: {cod_cliente:cood_cliente, cod_plato:cood_plato },
		  success: function(respuesta) {
				alert(respuesta);
			}
		});
	}else{
		alert("¡Revisa los campos!");
	}
	return false;
}

window.onload=function(){
	descargarPlatos();
	descargarClientes();
    $("#enviar").click(hacerConsumo);
}