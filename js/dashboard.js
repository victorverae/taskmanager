$( document ).ready(
	$.ajax({
	  type: "POST",
	  url: url + "/financiero/menu_financiero/getCuentas",
	  data: { name: "John", location: "Boston" }
	})
	  .done(function( msg ) {
		  var obj = jQuery.parseJSON(msg);
		  console.log(obj);
		  cargarElementos(obj);
		  // alert( obj.name === "John" );
	    // alert( "Data Saved: " + msg );
	  })
);

function cargarElementos(objJson){
	var strHtml = "";
	if(objJson.type == 'select'){
		strHtml = '<select name="'+objJson.name+'">';
		$.each(objJson.data,function(indice,valor){
			strHtml = '<option value="'+indice+'">'+valor+'</option>';
		});
		strHtml = '</select>';
		console.log($("."+objJson.clase));
		$("."+objJson.clase).html(strHtml);
		console.log('Es un select');
	} 
//	$.each(objJson, function(indice, valor){
//		console.log('indice:'+indice+',valor:'+valor);
//		if(valor == 'cuenta'){
//			var a = $( ".dashboard" );
			//console.log(a);
//		}
		//console.log(' >', 'Posición: '+posicion, '>estudiante:'+estudiante);
		//$.each(estudiante, function(posicion1, estudiante1){
		//	console.log(' >>', 'Posición1: ' + posicion1, '>estudiante1:'+estudiante1);
		//});
//	});
}