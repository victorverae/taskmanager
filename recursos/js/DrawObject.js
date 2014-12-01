/**
 * @author mlabra
 */

/* Retorna la posicion horizontal de un objeto con respecto al borde
 * izquierdo.
*/
function findPosX(obj)
  {
    var curleft = 0;
    if(obj.offsetParent)
        while(1) 
        {
          curleft += obj.offsetLeft;
          if(!obj.offsetParent)
            break;
          obj = obj.offsetParent;
        }
    else if(obj.x)
        curleft += obj.x;
  
	return curleft;
  }
/* Retorna la posicion horizontal de un objeto con respecto
 *   al border superior
*/
 function findPosY(obj)
  {
    var curtop = 0;
    if(obj.offsetParent)
        while(1)
        {
          curtop += obj.offsetTop;
          if(!obj.offsetParent)
            break;
          obj = obj.offsetParent;
        }
    else if(obj.y)
        curtop += obj.y;
    return curtop;
  }
  
  /* Setea la posicion de un objeto, usa el objeto de referencia paea hacerlo
   * 
   */
 function  SetPositionObjectByOtherObject(objToubication, objReference,diffX,diffY)
 {
 	var posx = findPosX(objReference);
	var posy = findPosY(objReference);
	

	
	newposx = posx + diffX;
	newposty = posy + diffY;
	
	
	objToubication.style.left = newposx + 'px';
	objToubication.style.top=newposty + 'px';
		
	
 }
  /*Setea la posicion de un objeto en base al id de otro
   * 
   */
 function SetPositionObjectByOtherObjectUsingId(idObjToubication, idObjReference,diffX,diffY)
 {
	var objToubication = document.getElementById(idObjToubication);
	
	var objReference = document.getElementById(idObjReference);
	
	


	//alert(document.getElementById(idObjToubication));
	SetPositionObjectByOtherObject(objToubication,objReference,diffX,diffY);
	
	
 }
 
 function findPos(obj) {
    var curleft = curtop = 0;
    if (obj.offsetParent) {
        curleft = obj.offsetLeft
        curtop = obj.offsetTop
        while (obj = obj.offsetParent) {
            curleft += obj.offsetLeft
            curtop += obj.offsetTop
        }
    }
    return [curleft,curtop];
}

/* Hace aparecer un objeto oculto en base a su id, la posiciones es dada
 * por el id de otro objeto y las distancias a el
 */
function drawObjectByreference(idObjToubication, idObjReference,diffX,diffY)
{
	
	SetPositionObjectByOtherObjectUsingId(idObjToubication, idObjReference,diffX,diffY)
 	var obj = document.getElementById(idObjToubication);
	
	obj.style.display='block';
	
	//alert(obj.style.display);
	//alert(obj.style.top);
	//alert(obj.style.left);
	
	
}

function drawObject(idObjToDraw,pos_left, pos_top)
{
	objToDraw = document.getElementById(idObjToDraw);
	
	objToDraw.style.left = pos_left + 'px';
	objToDraw.style.top= pos_top + 'px';
		
	obj.style.display='block';
	
}

/* Marca como no visible a un objeto  a partir de su id*/
function cleanObject(idObjToClean)
{
	
	var obj = document.getElementById(idObjToClean);
	//alert(obj);
	obj.style.display='none';
	
	
}

 function SetPositionObjectByOtherObjectUsingId2(idObjToubication, idObjReference,diffX,diffY)
 {
	var objToubication = document.getElementById(idObjToubication);
	
	var objReference = document.getElementById(idObjReference);
	
	


	//alert(document.getElementById(idObjToubication));
	SetPositionObjectByOtherObject2(objToubication,objReference,diffX,diffY);
	
	
 }
 
 function  SetPositionObjectByOtherObject2(objToubication, objReference,diffX,diffY)
 {
 	var posx = findPosX(objReference);
	var posy = findPosY(objReference);
	

	
	newposx = posx + diffX;
	newposty = posy + diffY;
	
	
	objToubication.style.left = newposx + 'px';
	objToubication.style.top=newposty + 'px';
	
	

 }
 
 function mostrarIngresarListar(id_div_ingreso,id_div_listado,id_comando,txt_agregar,txt_listar){
     var divMostrarIngreso = document.getElementById(id_div_ingreso);
     var divMostrarListado = document.getElementById(id_div_listado);
     var comando = document.getElementById(id_comando);
     
     if(divMostrarIngreso.style.display=="")
     {
        divMostrarIngreso.style.display="none";
        divMostrarListado.style.display="";
        comando.innerHTML = txt_agregar;
     }else{
        divMostrarIngreso.style.display="";
        divMostrarListado.style.display="none";     
        comando.innerHTML = txt_listar;
     }

}

