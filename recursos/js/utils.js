function getFechaPresentacion(dia,mes,anio){
  
   dia = (dia<10) ? '0'+dia : dia;
   mes = (mes<10) ? '0'+mes : mes;
   
   return anio+"-"+mes+"-"+dia; 
}
function collapsar(id_elemento,id_contenedor_ref,ref_expandir,ref_colapsar){
  var elemento = document.getElementById(id_elemento);
  var contenedor = document.getElementById(id_contenedor_ref);
  
  if(elemento.style.display=="none"){
    elemento.style.display="";
        contenedor.innerHTML=ref_colapsar;
  }else{
    elemento.style.display="none";
    contenedor.innerHTML=ref_expandir;
  }
  
}
