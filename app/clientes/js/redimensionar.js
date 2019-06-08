function abrirVentana() {
    window.open("calcular_factura.php", "", "width=1024, height=800");
}	

window.onload=function(){
	var enlaces=document.getElementsByClassName("enlace");
	for(var i=0;i<enlaces.length;i++){
		enlaces[i].onclick=abrirVentana;
	}
}