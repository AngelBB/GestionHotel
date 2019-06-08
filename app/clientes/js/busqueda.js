/////////////////////////////////////////////////////
// Para enviar la limpieza y liberar la habitacion //
/////////////////////////////////////////////////////
function extraerDatos(){
	if(this.value!=""){
		//Enviamos el valor y el id del elemento actual
		liberar_limpiar((this.value),(this.className));//El atributo className iria completo con todas las clases que le hallamos definido en el HTML
	}
	return false;
}

function liberar_limpiar(valor,idDireccion){
	var dir="";//Declaramos la variable 
	
	//Para saber exactamente de que clase viene hacemos split y nos quedamos con el primer trozo 
	var trozoIdentificativo=idDireccion.split(" ");
	if(trozoIdentificativo[0]=='limpieza'){
		dir="php/limpieza.php";
	}else if(trozoIdentificativo[0]=='liberar'){
		dir="php/liberar.php";
	}
	
	$.ajax({
				type: "POST",
				url: dir,
				dataType: "text",
				data: {informacion:valor},//cadena en formato json
				error: function(){
					alert("error peticion ajax");
				},
				success: function(aviso){                                                   
					alert(aviso);
				}
            });
			return false;
}


$(document).ready(function(){
        var consulta;
        //hacemos focus al campo de busqueda
        $("#busqueda").focus();
		
		$("#lista_completa").click(function(){
			if($(this).is(':checked')) {
				$.ajax({
						type: "POST",
						url: "php/busqueda.php",
						data: {lista_completa:'true'},
						dataType: "html",
						error: function(){
							alert("error peticion ajax");
						},
						success: function(data){                                                   
							  $(".box-body").empty();
							  $(".box-body").append(data);//Pintamos la caja
							  
							  //Sacamos los botones por sus clases. Al ser varios elementos nos devuelve un array
								//Tengo que hacer esto de forma nativa ya que con jquery no funciona no entiendo porque.
								var limpieza=document.getElementsByClassName("limpieza");
								var liberar=document.getElementsByClassName("liberar");
								
							  //Asignamos eventos a los botones limpiar y liberar de la tabla. Lo hacemos todo en el mismo bucle 
							  //ya que siempre habra el mismo numero de botones, por lo que nos ahorramos hacer otro bucle.
							  for(var i=0;limpieza.length >i;i++){
									limpieza[i].onclick=extraerDatos;
									liberar[i].onclick=extraerDatos;
								}
							  
								//Creamos la nueva con los datos buenos
								$("#resultado").dataTable({
										  "bPaginate": true,
										  "bLengthChange": false,
										  "bFilter": false,
										  "bSort": true,
										  "bInfo": false,
										  "bAutoWidth": true
										});
						
								
						}
				  });
			}else{
				$(".box-body").empty();
			}
		});
		

        //comprobamos si se pulsa una tecla
        $("#busqueda").keyup(function(e){
        
              //obtenemos el texto introducido en el campo de busqueda
              consulta = $("#busqueda").val();
				
				
              //hace la busqueda
              $.ajax({
                    type: "POST",
                    url: "php/busqueda.php",
                    data: {busqueda:consulta},
                    dataType: "html",
                    error: function(){
                        alert("error peticion ajax");
                    },
                    success: function(data){                                                   
							$(".box-body").empty();
							$(".box-body").append(data);//Pintamos la caja
							
							var limpieza=document.getElementsByClassName("limpieza");
							var liberar=document.getElementsByClassName("liberar");
							
							  //Asignamos eventos a los botones limpiar y liberar de la tabla. Lo hacemos todo en el mismo bucle 
							  //ya que siempre habra el mismo numero de botones, por lo que nos ahorramos hacer otro bucle.
							  for(var i=0;limpieza.length >i;i++){
									limpieza[i].onclick=extraerDatos;
									liberar[i].onclick=extraerDatos;
								}
						 
							//Creamos la nueva con los datos buenos
							$("#resultado").dataTable({
									  "bPaginate": true,
									  "bLengthChange": false,
									  "bFilter": false,
									  "bSort": true,
									  "bInfo": false,
									  "bAutoWidth": true
									});
					
							//Sacamos los botones por sus clases. Al ser varios elementos nos devuelve un array
							//Tengo que hacer esto de forma nativa ya que con jquery no funciona no entiendo porque.
							/*var limpieza=document.getElementsByClassName("limpieza");
							var liberar=document.getElementsByClassName("liberar");*/
							
				    }
              });
        });
});