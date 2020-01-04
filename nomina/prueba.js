function upperCase(x)
{
var y=document.getElementById(x).value;
alert(y);
document.getElementById(x).value=y.toUpperCase();
}
function nuevoAjax()
{ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
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
		catch(E)
		{
			if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
		}
	}
	return xmlhttp; 
}

function cargaContenido(idSelectOrigen)
{	
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=idSelectOrigen.value;
		var ajax=nuevoAjax();
		ajax.open("GET", "busqueda_text_box_ajax_proceso.php?tabla=tabla_empresa&texto="+opcionSeleccionada, true);

}