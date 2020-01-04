<?php
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Geraldo Marcano.
  Descripción General:  Muestra un listado de las descripciones de presupuesto que existen en la base de datos.
  		Modificado el: 	Geraldo Marcano. - Creación.
						18/11/2008 por Pedro E. Arrioja M. - Adaptación a bases de datos de intranet y plantillas, se cambio el metodo get a post y 
								   se eliminaron códigos de validación en java que ya no aplican; y se dividió el archivo para mejor comprension 
								   y uso de AJAX.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
 session_start();  // se inicia la sesión 
 include("../libs/utilidades.php");
 include("../libs/comprueba_permiso.php");
 require("../db/conexion.php");
 comprueba_acceso($_SERVER["SCRIPT_NAME"]); // para comprobar si se tiene acceso a este modulo.
 $link=conectarse("administracion"); 
 $sqlpresupuesto="select * from presupuesto";
 $sql="select * from descripcion_presupuesto";
 $ejecutar=mysql_query($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Listar Descripci&oacute;n Presupuestaria</title>
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(../imgs/CENE_11.png);
	background-repeat: repeat-y;
}
-->
</style>
<!-- InstanceBeginEditable name="head" -->


<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />

 <script language="JavaScript" type="text/javascript">
<!--

function listar(target,ox)
{
  var combo = document.getElementById(target);
  combo.options.length = 0;
   
  var response = ox;
  var items = response.split(";");
  var count = items.length;
  combo.options[0] =new Option(target,-1);
  for (var i=0;i<count;i++)
	{
	  var options = items[i].split("-");
	  combo.options[i+1] =
	  new Option(options[0],options[0]);
	}
};

function limpiar_desde(target)
{
  if (target == "ano")
    {
	  var combo = document.getElementById("Partida");
	  combo.options.length = 0;
	  combo.options[0] =new Option("Partida",-1);
	  
	  var combo = document.getElementById("Generica");
	  combo.options.length = 0;
	  combo.options[0] =new Option("Generica",-1);
	  
	  var combo = document.getElementById("Especifica");
	  combo.options.length = 0;
	  combo.options[0] =new Option("Especifica",-1);
	  
	  var combo = document.getElementById("Subespecifica");
	  combo.options.length = 0;
	  combo.options[0] =new Option("Subespecifica",-1);
	}
  if (target == "Partida")
    {
	  var combo = document.getElementById("Generica");
	  combo.options.length = 0;
	  combo.options[0] =new Option("Generica",-1);
	  
	  var combo = document.getElementById("Especifica");
	  combo.options.length = 0;
	  combo.options[0] =new Option("Especifica",-1)
	  
	  var combo = document.getElementById("Subespecifica");
	  combo.options.length = 0;
	  combo.options[0] =new Option("Subespecifica",-1);
	} 
  if (target == "Generica")
    {
	  var combo = document.getElementById("Especifica");
	  combo.options.length = 0;
	  combo.options[0] =new Option("Especifica",-1)
	  
	  var combo = document.getElementById("Subespecifica");
	  combo.options.length = 0;
	  combo.options[0] =new Option("Subespecifica",-1);
	}  
  if (target == "Especifica")
    {
	  var combo = document.getElementById("Subespecifica");
	  combo.options.length = 0;
	  combo.options[0] =new Option("Subespecifica",-1);
	}  

};


function carga(target)
{
  limpiar_desde(target);
  
  var peticion2;
  document.getElementById('resultado').innerHTML = 'Cargando Datos...';
  var myConn2 = new XHConn();


  var peticion;
  anio = document.getElementById("ano").value;  
  pa = document.getElementById("Partida").value;
  ge = document.getElementById("Generica").value;
  es = document.getElementById("Especifica").value;
  se = document.getElementById("Subespecifica").value;
  var myConn = new XHConn();
  if (!myConn) alert("XMLHTTP no esta disponible. Inténtalo con un navegador mas nuevo.");
  peticion=function(oXML){listar(target,oXML.responseText);};  
  myConn.connect("consulta_multinivel_ppto.php", "POST", "a="+anio+"&p="+pa+"&g="+ge+"&e="+es+"&s="+se, peticion);

  peticion2=function(oXML){document.getElementById('resultado').innerHTML=oXML.responseText;};  
  myConn2.connect("listar_descripcion_ppto_list.php", "POST", "a="+anio+"&p="+pa+"&g="+ge+"&e="+es+"&s="+se, peticion2);
   
};


/*function listar(target2)
{
  a1 = document.getElementById("ano").value;  
  p1 = document.getElementById("Partida").value;
  g1 = document.getElementById("Generica").value;
  e1 = document.getElementById("Especifica").value;
  s1 = document.getElementById("Subespecifica").value;
  var peticion2;
  document.getElementById(target2).innerHTML = 'Cargando Datos...';
  var myConn2 = new XHConn();
  if (!myConn2) alert("XMLHTTP no esta disponible. Inténtalo con un navegador mas nuevo.");
  peticion2=function(oXML2){document.getElementById(target2).innerHTML=oXML2.responseText;};  
  myConn2.connect("eliminar_descripcion_ppto_list.php", "POST", "a="+a1+"&p="+p1+"&g="+g1+"&e="+e1+"&s="+s1, peticion2);
}*/

//-->
</script>
<script language="JavaScript" src="../libs/XHConn.js" type="text/javascript"></script>


<!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%"><img src="../imgs/CENE_02.png" width="149" height="138" /></td>
    <td width="94%"><img src="../imgs/CENE_03.png" width="100%" height="138" /></td>
    <td width="2%"><img src="../imgs/CENE_04.png" width="407" height="138" /></td>
    <td width="2%"><img src="../imgs/CENE_05.png" width="366" height="138" /></td>
  </tr>
  <tr>
    <td width="2%"><img src="../imgs/CENE_06.png" width="149" height="34" /></td>
    <td colspan="3" valign="top" background="../imgs/CENE_07.png">      <div align="right">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="vinculos"><div align="left">Usuario: <?php if (isset($_SESSION['nombres'])) { echo $_SESSION['apellidos']." ".$_SESSION['nombres']; } else {echo " Sin sesi&oacute;n iniciada";}?></div></td>
            <td><div align="right"><span class="vinculos"><a href="index.php" class="vinculos">Inicio</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="login.php" class="vinculos">Salir</a>&nbsp;&nbsp;</span></div></td>
          </tr>
        </table>
        </div></td>
  </tr>
  <tr>
    <td valign="top"><!-- InstanceBeginEditable name="menu_izquierda" --><!-- InstanceEndEditable -->    </td>
    <td colspan="3" valign="top"><!-- InstanceBeginEditable name="body" -->

<br />
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr class="encabezado_formularios">
    <td>Seleccione el criterio de b&uacute;squeda para el listado</td>
  </tr>
  <tr>
    <td><label>
      <select name="ano" id="ano" onchange="carga('Partida')">
      <option value="-1">Año</option>
      <?php 
    	$sqlinicial_ano="select distinct ano from descripcion_presupuesto order by ano";
	    $consulta_inicial_ano=mysql_query($sqlinicial_ano,$link); 
        while($resultadoinicial_ano = mysql_fetch_array($consulta_inicial_ano))
		 {?>     
           <option value="<?php echo $resultadoinicial_ano['ano'];?>"><?php echo $resultadoinicial_ano['ano'];?></option>
      <?php 
	     }?>
      </select>
      <select name="Partida" id="Partida" onchange="carga('Generica')">
        <option value="-1">Partida</option>
      </select>
      <select name="Generica" id="Generica" onchange="carga('Especifica')">
        <option value="-1">Generica</option>
      </select>
      <select name="Especifica" id="Especifica" onchange="carga('Subespecifica')">
        <option value="-1">Especifica</option>
      </select>
      <select name="Subespecifica" id="Subespecifica">
        <option value="-1">Subespecifica</option>
      </select>
    </label></td>
  </tr>
  <tr class="datos_formularios">
    <td><div align="center" id="resultado"></div></td>
  </tr>
  <tr class="datos_formularios">
    <td><div align="right">
      <input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='index.php?sis=<?php echo $_SESSION['sis']; ?>'" />
    </div></td>
  </tr>
</table>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Tuesday, 18 November, 2008 9:56 AM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>