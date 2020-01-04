<?php

$controlDestino=$_GET["tabla"]; $opcionSeleccionada=$_GET["texto"];

	conectarse3();
	
	//$consulta=mysql_query("SELECT  nombre FROM empresas WHERE nombre like='$opcionSeleccionada'%") or die(mysql_error());
	$consulta=mysql_query("SELECT  nombre FROM empresas") or die(mysql_error());
	desconectar();
	
	echo '<table width="100%" border="1" id='.$controlDestino.' >"';
    echo '<tr><td>Nombre Empresa</td> </tr>';
	while ($empresas=mysql_fetch_array($consulta))
	{
	  
    echo '<tr><td>'.$empresas['nombre'].'</td></tr>';
	}
	echo'</table>';
		
}
?>