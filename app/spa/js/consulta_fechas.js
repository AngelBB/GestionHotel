// JavaScript Document
function prepararDescargarContenido(){
	var fecha=document.getElementById("datepicker");
	var cadenaEnvio="fecha="+encodeURIComponent(fecha.value)+"&nochache="+Math.random();
			descargarContenido(cadenaEnvio);
}

function descargarContenido(cadenaEnvio){
 var xmlhttp;
    if(window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
    }
    else{
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        mostrarContenido(xmlhttp);
    }
    xmlhttp.open("POST","php/consulta_fechas.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send(cadenaEnvio);
}

function mostrarContenido(xmlhttp){
    if(xmlhttp.readyState==4&&xmlhttp.status==200){
		var respuesta=xmlhttp.responseText;
		var resultado=document.getElementById("resultado");
			resultado.innerHTML=resultado;
	}
}

window.onload=function(){
	document.getElementById("datepicker").onchange=prepararDescargarContenido;
}