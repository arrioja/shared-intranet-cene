function nuevoAjax()
{
   /* Crea el objeto AJAX*/
   var xmlhttp=false;
   try
   {
      // Creacion del objeto AJAX para navegadores no IE
      xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
   }
   catch(e)
   {
      try
      {
         // Creacion del objet AJAX para IE
         xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(E) { xmlhttp=false; }
   }
   if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); }

   return xmlhttp;
}


function carga_direccion()
{
   var valor=document.getElementById("select_0").options[document.getElementById("select_0").selectedIndex].value;
   if(valor==0)
   {
      // Si el usuario eligio la opcion "Elige", no voy al servidor y pongo todo por defecto
      combo=document.getElementById("select_1");
      combo.length=0;
      var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Selecciona Dirección...";
      combo.appendChild(nuevaOpcion);   combo.disabled=true;
	  carga_plan_operativo();
	  
   }
   else
   {
      ajax=nuevoAjax();
      ajax.open("GET", "select/select_total.php?seleccionado="+valor+"&select=8", true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==1)
         {
            // Mientras carga elimino la opcion "Elige " y se coloca una que dice "Cargando"
            combo=document.getElementById("select_1");
            combo.length=0;
            var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Cargando...";
            combo.appendChild(nuevaOpcion); combo.disabled=true;   
         }
         if (ajax.readyState==4)
         {
            document.getElementById("cod").innerHTML=ajax.responseText;
			
         }
      }
      ajax.send(null);
   }
}

function carga_plan_operativo()
{

   var valor=document.getElementById("select_1").options[document.getElementById("select_1").selectedIndex].value;
   if(valor==0)
   {
      // Si el usuario eligio la opcion "Elige", no voy al servidor y pongo todo por defecto
      combo=document.getElementById("select_2");
      combo.length=0;
      var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Selecciona Plan...";
      combo.appendChild(nuevaOpcion);   combo.disabled=true;
   }
   else
   {
      ajax=nuevoAjax();
      ajax.open("GET", "select/select_total.php?seleccionado="+valor+"&select=13", true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==1)
         {
            // Mientras carga elimino la opcion "Elige plan" y pongo una que dice "Cargando"
            combo=document.getElementById("select_2");
            combo.length=0;
            var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Cargando...";
            combo.appendChild(nuevaOpcion); combo.disabled=true;   
         }
         if (ajax.readyState==4)
         {
            document.getElementById("plan_operativo").innerHTML=ajax.responseText;
			//carga_plan_direccion();

			}
      }
      ajax.send(null);
   }
}

//CODIGO PARA ENVIAR FORMULARIO POR POST

var peticion = false;
try {
      peticion = new XMLHttpRequest();
} catch (trymicrosoft) {
      try {
            peticion = new ActiveXObject("Msxml2.XMLHTTP");
} catch (othermicrosoft) {
      try {
            peticion = new ActiveXObject("Microsoft.XMLHTTP");
} catch (failed) {
            peticion = false;
} 
}
}
 
  function enviarFormulario(url, formid){
  
         var Formulario = document.getElementById(formid);
         var longitudFormulario = Formulario.elements.length;
		 
         var cadenaFormulario = "";
         var sepCampos;
         sepCampos = "";
         for (var i=0; i <= Formulario.elements.length-1;i++) {
         cadenaFormulario += sepCampos+Formulario.elements[i].name+'='+encodeURI(Formulario.elements[i].value);
         sepCampos="&";
}
  peticion.open("POST", url, true);		

  peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
  peticion.onreadystatechange = function () {
  if (peticion.readyState == 4) {
     document.getElementById('ficha').innerHTML = "Los datos han sido enviados correctamente";
  }
}
peticion.send(cadenaFormulario);
}


function elimina_objetivo_operativo(cod)
{
      ajax=nuevoAjax();
      ajax.open("GET", "eliminar/eliminar.php?seleccionado="+cod+"&elimina=3", true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==4)
		 {
            document.getElementById("objetivo2").innerHTML=ajax.responseText;
		    carga_objetivo();
		}
      }
      ajax.send(null);
}

function carga_objetivo_operativo()
{ 
   var valor=document.getElementById("select_2").options[document.getElementById("select_2").selectedIndex].value;
 //alert ("dir "+ valor + "act "+document.form1.codigo.value);
   if(valor==0){
    document.getElementById("objetivo").innerHTML="No disponible";
   }
   else
   {
      ajax=nuevoAjax();
	 //document.write(valor);
//alert(valor);
//alert (document.form1.codigo.value);
      ajax.open("GET", "select/select_total.php?seleccionado="+valor+"&select=15&codigo="+document.form1.codigo.value, true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==1)
         {
            document.getElementById("objetivo").innerHTML="Cargando....";
         }
         if (ajax.readyState==4)
         {
            document.getElementById("objetivo").innerHTML=ajax.responseText;
			//alert("skhd");
         }
      }
      ajax.send(null);
   }
}

 function elimina_actividad(cod)
{
      ajax=nuevoAjax();
      ajax.open("GET", "eliminar/eliminar.php?seleccionado="+cod+"&elimina=9", true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==4)
		 {
            document.getElementById("actividad2").innerHTML=ajax.responseText;
		    carga_actividad();
		}
      }
      ajax.send(null);
}


function elimina_fase(cod_fase)
{ 
      ajax=nuevoAjax();
      ajax.open("GET", "eliminar/eliminar.php?seleccionado="+cod_fase+"&elimina=1", true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==4)
		 {
            //document.getElementById("fase2").innerHTML=ajax.responseText;
		    muestra_fases();
		}
      }
      ajax.send(null);
}
