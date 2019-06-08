//Hora
function hora(id){
	var fecha=new Date();
	if(id=='fecha'){
		//Fecha
		var dia=fecha.getDate();
		var mes=fecha.getMonth();
		var anio=fecha.getFullYear();
		info=dia+"/"+mes+"/"+anio;	
		
	}else{
		//Horas
		var horas=fecha.getHours();
		var minutos=fecha.getMinutes();
		var segundos=fecha.getSeconds();
		info=horas+":"+minutos+":"+segundos;
	}
	document.getElementById(id).innerHTML=info;
}
function llamarHora(){
	hora('fecha');
	hora('hora');
	
	setTimeout("llamarHora()",1000);//cada segundo
}

window.onload=function(){
	llamarHora();
	setTimeout("location.reload(true)",30000);
}