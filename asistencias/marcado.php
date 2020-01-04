<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripci�n General:  Esta p�gina se encarga (conjuntamente con marcado_log.php) de marcar la entrada y salida del personal de la instituci�n, funciona
  						con AJAX con marcado_log y dice a qu� hora se esta marcando y si es entrada y salida.
						Para no recargar al servidor, se ha realizado de manera que consulte la hora del servidor s�lo al momento de ser cargada, luego
						continua con su reloj interno.
  		Modificado el: 	24/10/2008 por Pedro E. Arrioja M.
  			  Versi�n: 	0.1b
     ****************************************************  FIN DE INFO
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Entrada y Salida de Personal</title>
<link href="../css/index.css" rel="stylesheet" type="text/css" />
<link href="../css/formularios.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	font-size: 60px
}
-->
</style>

<script>

// Es este script de localiza la hora del servidor al momento de cargar la pahina solamente, luego se ense�a el avance del tiempo sin consultar 
// de nuevo al servidor, para evitar la sobrecarga de la red.
  var inicio=false;
  var ajustehora=0;
  var ajusteminuto=0;
  var ajustesegundo=0;

  function relojear()
    { 
	  import java.text.*;
	  if(!inicio)
	    {
	      serv_ahora=new Date();
		  serv_ahora.setHours(<?php echo intval(date("H",strtotime("now"))) ?>);
		  serv_ahora.setMinutes(<?php echo intval(date("i",strtotime("now"))) ?>);
		  serv_ahora.setSeconds(<?php echo intval(date("s")) ?>);
		  ahora=new Date();
		  ajustehora=serv_ahora.getHours()-ahora.getHours();
		  ajusteminuto=serv_ahora.getMinutes()-ahora.getMinutes();
		  ajustesegundo=serv_ahora.getSeconds()-ahora.getSeconds();
	    }
      inicio=true;
      horasinajuste=new Date();
      ahora=new Date();
      ahora.setHours(horasinajuste.getHours()+ajustehora);
      ahora.setMinutes(horasinajuste.getMinutes()+ajusteminuto);
      ahora.setSeconds(horasinajuste.getSeconds()+ajustesegundo);
	// SimpleDateFormat formatter;
    //  formatter = new SimpleDateFormat("hh:mm:ss a");		
	//  document.getElementById('reloj').innerHTML = formatter.format(ahora); 	  
      document.getElementById('reloj').innerHTML=ahora.getHours()+':'+ahora.getMinutes()+':'+ahora.getSeconds();

    }
  onload=function()
    {
      setInterval('relojear()',1000);
    }
</script>

</head>

<body>

<script language="JavaScript" src="../libs/XHConn.js"></script>    
<SCRIPT language="JavaScript">
<!--
function registra_hora(target,valor)
{
  var peticion;
  //document.getElementById(target).innerHTML = 'Cargando Datos...';
  var myConn = new XHConn();
  if (!myConn) alert("XMLHTTP no esta disponible. Int�ntalo con un navegador mas nuevo.");
  peticion=function(oXML){document.getElementById(target).innerHTML=oXML.responseText;};
  myConn.connect("marcado_log.php", "POST", "cedula="+valor, peticion);
}

function limpia_control()
{
  document.getElementById('cedula_carnet').value = '';
}

//-->
</SCRIPT>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr class="encabezado_formularios">
    <td colspan="2">Registro de Entrada y Salida del Personal</td>
  </tr>
  <tr>
    <td width="50%" class="datos_formularios"><div align="center" class="style1"><?php echo date("d/m/Y",strtotime("now")); ?></div></td>
    <td width="50%" class="datos_formularios"><span class="style1">
    <div align="center" id="reloj">Hora.</div></span></td>
  </tr>
  <tr class="encabezado_formularios">
    <td colspan="2"><div align="center">
      <form id="form1" name="form1" method="post" action="">
        <label>
          <input name="cedula_carnet" type="text" id="cedula_carnet" onkeypress="if (event.keyCode == 13){  
                                                               registra_hora('log',this.value);
															   limpia_control();	
                                							   return false;
                        									   }" maxlength="10" />
          </label>
      </form>
      </div></td>
  </tr>
  <tr>
    <td colspan="2" id="log">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="log2"><div align="center">NOTA: Para ingresar la c&eacute;dula, coloquela sin puntos y sin cero a la izquierda en las menores de diez millones.</div></td>
  </tr>
</table>
</body>
</html>
