<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Asignación de Montos</title>
</head>
<body>
<script language="javascript" type="text/javascript">
function objetoAjax()
  {
	var xmlhttp=false;
	try 
	  {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	  } 
	catch (e) 
	  {
	    try 
		  {
		    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } 
		 catch (E) 
		  {
		    xmlhttp = false;
		  }
	  }

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') 
	  {
		xmlhttp = new XMLHttpRequest();
	  }
	return xmlhttp;
}

function MostrarConsulta(datos)
  {
    datos=datos+"?cod="+document.getElementById('constantes').value;//pag a cargar con el nombre del control
	divResultado = document.getElementById('resultado');//div destino
	ajax=objetoAjax();
	ajax.open("GET", datos);
	ajax.onreadystatechange=function() 
	  {
		if (ajax.readyState==4) 
		  {
			divResultado.innerHTML = ajax.responseText
		  }
	  }
	ajax.send(null)
}    
    
</script>


<input type="hidden" name="btnSubmit" id="btnSubmit" value="">
<?php

include("includes/miclase.php");
$link=conectarse("nomina");

?>
<form id="form1" name="form1" method="post" action="includes/actualizar_integrantes_constantes.php">
  <table width="849" border="1">
    <tr>
      <td colspan="4" align="center"><input type="hidden" name="total" id="total" value="<? echo $k; ?>" />
        <strong>Asignación Múltiple de Montos para la Constante:</strong> <strong><?php 
	 $resultado=mysql_query("select * from constantes");
	 ?>
      <select name="constantes" id="constantes" onchange="MostrarConsulta('includes/muestra_integrantes_constantes.php')">
      <option value="">Seleccione una Constante</option>
      <?php while ($const=mysql_fetch_array($resultado)){?>
        <option value="<?php echo $const['cod'];?>"><?php echo $const['descripcion']; ?></option>
      <?php }?>
      </select>
      <label></label>
      </strong></td>
      <tr>
    <td colspan="6" class="datos_formularios"><div id="resultado" align="right">
      <div align="center">Seleccione una Constante para generar la lista de integrantes y Montos</div>
    </div></td>
  </tr>   

    <tr>
      <td align="center"><label></label>        <input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
      <td colspan="3" align="center"><input type="button" name="volver" id="volver" value="Volver" onclick="javascript: location.href='visualizar_integrantes.php'" />
      </span></td>
    </tr>
  </table>
</form>
</TR>
</body>
</html>