<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema Gestión/Dirección/Listado de Objetivos Estratégicos </title>
<link href="../css/formularios.css" rel="stylesheet" type="text/css">
</head>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">

function confirma_eliminar(cod,objetivo_estrategico_direccion)
{
if (confirm("Se dispone a eliminar el objetivo estratégico: "+objetivo_estrategico_direccion+". ¿Desea continuar?"))
   elimina_objetivo_estrategico_direccion(cod);
}

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
	 
   }
   else
   {
      ajax=nuevoAjax();
      ajax.open("GET", "select/select_total.php?seleccionado="+valor+"&select=4", true);
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

function carga_plan()
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
      ajax.open("GET", "select/select_total.php?seleccionado="+valor+"&select=12", true);
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
            document.getElementById("plan").innerHTML=ajax.responseText;
         }
      }
      ajax.send(null);
   }
}

function carga_objetivo()
{
  var org=document.getElementById("select_0").options[document.getElementById("select_0").selectedIndex].value;
 
   var valor=document.getElementById("select_2").options[document.getElementById("select_2").selectedIndex].value;
   var codigo=document.getElementById("select_1").options[document.getElementById("select_1").selectedIndex].value;
// alert(valor);
   if(valor==0){
    document.getElementById("objetivo").innerHTML="No disponible";
   }
   else
   {
      ajax=nuevoAjax();
	 //alert(valor)
      ajax.open("GET", "muestra_objetivos_estrategicos_direcciones.php?seleccionado="+valor+"&cod_direccion="+document.form1.direccion.value+"&cod_org="+org, true);
      ajax.onreadystatechange=function()
      {
         if (ajax.readyState==1)
         {
            document.getElementById("objetivo").innerHTML="Cargando....";
         }
         if (ajax.readyState==4)
         {
            document.getElementById("objetivo").innerHTML=ajax.responseText;
			
         }
      }
      ajax.send(null);
   }
}

function elimina_objetivo_estrategico_direccion(cod)
{
      ajax=nuevoAjax();
      ajax.open("GET", "db/eliminar.php?seleccionado="+cod+"&elimina=6", true);
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
</script>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Gestión/Dirección/Listado de Objetivos Estratégicos</title>

<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

</head>

<body>
  
  <?php

function genera_organizacion()
{
   require("../db/conexion.php");
   $link=conectarse("organizacion");
   $result=mysql_query("SELECT * FROM organizacion.organizaciones");
   mysql_close($link);
   // Muestra el primer select compuesto por las organizaciones
   echo "<select class='combo' id='select_0' name='organizacion' onChange='carga_direccion()'>",
      "<option value='0'>Elige Organización....</option>";
	  
   while($row=mysql_fetch_row($result))
   {
      echo "<option value='".$row[1]."'>".$row[2]."</option>";
   }
   echo "</select>";
}
?>

<form id="f1" name="form1" method="POST" action="objetivos_estrategicos_direccion.php">
  <table width="600" height="160" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="encabezado_formularios">
      <td colspan="2" id="fila_1"><div align="center"><strong>Listado de Objetivos Estrat&eacute;gicos</strong> <strong>Direcci&oacute;n</strong>
          <input type="hidden" name="insertar" id="insertar" value="insertar" />
      </div></td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Organización:</strong></td>
      <td class="datos_formularios"><?php genera_organizacion(); ?> </td>
    </tr>
    <tr>
      <td width="31%" align="" class="titulos_formularios"><strong>Dirección:</strong></td>
      <td width="69%" align="" class="datos_formularios" id="cod"> <div align="justify">
        <select class="combo" disabled="disabled" id="select_1" name="direccion" onChange="carga_plan();">
          <option value="0">Selecciona Direcci&oacute;n...</option>
        </select>
      </div>  </td>
    </tr>
    <tr>
      <td class="titulos_formularios"><strong>Plan Estratégico:</strong></td>
      <td height="28" class="datos_formularios" id="plan">
      <select class="combo" disabled="disabled" name="plan" id="select_2" onChange="carga_objetivo();">
        <option value="0">Selecciona Plan...</option>
      </select>      </td>
    </tr>
    <tr>
      <td height="27" colspan="2" id="objetivo"></td>
    </tr>
    <tr>
      <td height="27" colspan="2" id="objetivo2"></td>
    </tr>
  </table>
</form>
</body>
</html>