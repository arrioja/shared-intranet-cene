<?php 
/*   ****************************************************  INFO DEL ARCHIVO 
  		   Creado por: 	Pedro E. Arrioja M.
  Descripción General:  Genera los menús de inicio y de sistema para que sean accesados por los usuarios, esta es la
  						página principal del sistema.
  Última modificación: 	22/08/2008 por Pedro E. Arrioja M.
  			  Versión: 	0.1b
     ****************************************************  FIN DE INFO
*/
session_start();
if (!isset($_SESSION['login']))  // si "login" no existe, no hay sesión iniciada y se envia al login para ingresar autenticar
  {
	session_destroy();
	echo '<script languaje="Javascript">location.href="login.php?pag=index.php"</script>';
	exit();
  }
else
  { 
    $set_sistemas=array(); // para mostrar el menu de los sistemas disponibles
	$set_modulos=array(); // para mostrar el menu de los modulos disponibles
	$login=$_SESSION['login'];
	require("db/conexion.php");
    $links=conectarse("intranet");
	// con esta consulta traigo todos los módulos a los que tiene tiene acceso el usuario.
	$result=mysql_query("SELECT distinct b.codigo_modulo 
	  					   FROM usuarios_grupos as a, permisos_grupos as b
						   WHERE ((a.login='$login') and (a.codigo=b.codigo_grupo))
						   ORDER BY b.codigo_modulo",$links);
						   
	  // inicio la construcción de los módulos del sistema
	  while ($sistemas=mysql_fetch_array($result))
	  { 
	    $esta_sistema=false;
		$x=0;
		// ahora extraigo sólo los primeros dos caracteres del código del módulo que es lo que me define al sistema al que pertenecen.
		$codigo_nuevo=$sistemas['codigo_modulo'][0].$sistemas['codigo_modulo'][1];
	    while (($x<count($set_sistemas)) && ($esta_sistema==false))
		 { 
		   if ($set_sistemas[$x] == $codigo_nuevo) {$esta_sistema=true;}	
		   $x++;	   
		 }
	    if ($esta_sistema==false) {$set_sistemas[]=$codigo_nuevo;}
	   }	
	
	// con esta linea nos devolvemos al inicio de la consulta, aunque no la uso aqui, no la quiero perder de vista
	//mysql_data_seek($result, 0);	
	
    if ((isset($_GET['sis'])) && ($_GET['sis'] != ''))
	{ // si viene "sis" como parámetro, el usuario ha seleccionado un sistema al cual desea acceder, entonces se consulta 
	  // la base de datos para todos los módulos de dicho sistema a los cuales el usuario tiene acceso que 
	  // comiencen con el codigo del sistema.
		$sistema_seleccionado=$_GET['sis'];
		$_SESSION['sis']=$sistema_seleccionado;
        $result_modulos=mysql_query("SELECT distinct * 
	  		 			             FROM usuarios_grupos as a, permisos_grupos as b
						             WHERE ((a.login='$login') and (a.codigo=b.codigo_grupo) and 
									 		(b.codigo_modulo LIKE '$sistema_seleccionado%')) 
						             Group by b.codigo_modulo",$links);
										 
		while ($sistemas=mysql_fetch_array($result_modulos))
		  { 
			$esta_sistema=false;
			$x=0;
			// ahora extraigo sólo los primeros dos caracteres del código del módulo 
			// que es lo que me define al sistema al que pertenecen.
			$codigo_nuevo=$sistemas['codigo_modulo'];
			while (($x<count($set_modulos)) && ($esta_sistema==false))
			 { 
			   if ($set_modulos[$x] == $codigo_nuevo) {$esta_sistema=true;}	
			   $x++;	   
			 }
			if ($esta_sistema==false) {$set_modulos[]=$codigo_nuevo;}
		   }  
		   
		 $result_directorio=mysql_query("SELECT directorio from sistemas 
		 								 where codigo_sistema='$sistema_seleccionado'",$links);  
		 $directorio=mysql_fetch_array($result_directorio);  
	}
  }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/CENE.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Bienvenido(a)</title>
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(imgs/CENE_11.png);
	background-repeat: repeat-y;
}
-->
</style>
<!-- InstanceBeginEditable name="head" -->


<link href="css/formularios.css" rel="stylesheet" type="text/css" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<!-- InstanceEndEditable -->
</head>

<body onload="MM_preloadImages('imgs/<?php echo $result_sistemas['imagen_p']; ?>')">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%"><img src="imgs/CENE_02.png" width="149" height="138" /></td>
    <td width="94%"><img src="imgs/CENE_03.png" width="100%" height="138" /></td>
    <td width="2%"><img src="imgs/CENE_04.png" width="407" height="138" /></td>
    <td width="2%"><img src="imgs/CENE_05.png" width="366" height="138" /></td>
  </tr>
  <tr>
    <td width="2%"><img src="imgs/CENE_06.png" width="149" height="34" /></td>
    <td colspan="3" valign="top" background="imgs/CENE_07.png">      <div align="right">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="vinculos"><div align="left">Usuario: <?php if (isset($_SESSION['nombres'])) { echo $_SESSION['apellidos']." ".$_SESSION['nombres']; } else {echo " Sin sesi&oacute;n iniciada";}?></div></td>
            <td><div align="right"><span class="vinculos"><a href="index.php" class="vinculos">Inicio</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="login.php" class="vinculos">Salir</a>&nbsp;&nbsp;</span></div></td>
          </tr>
        </table>
        </div></td>
  </tr>
  <tr>
    <td valign="top"><!-- InstanceBeginEditable name="menu_izquierda" -->
      <p class="vinculos">Sistemas:</p>
      <table width="131" border="0" cellspacing="0" cellpadding="0">
      
      <?php for ($num_sis=0; $num_sis<count($set_sistemas); $num_sis++)
	    {
		  $consulta_sistemas=mysql_query("SELECT * from sistemas WHERE (codigo_sistema='$set_sistemas[$num_sis]')",$links);
		  $result_sistemas=mysql_fetch_array($consulta_sistemas); 
		?>     
<!--        <tr>
          <td>&nbsp;</td>
        </tr>-->
        <tr>
          <td>
          <a href="index.php?sis=<?php echo $result_sistemas['codigo_sistema']; ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('codigo_sistema','','imgs/<?php echo $result_sistemas['imagen_p']; ?>',1)"><img src="imgs/<?php echo $result_sistemas['imagen_g']; ?>"  alt="<?php echo $result_sistemas['nombre_largo']; ?>" name="Image<?php echo $result_sistemas['codigo_sistema']; ?>" width="130" height="38" border="0" id="Image<?php echo $result_sistemas['codigo_sistema']; ?>" /></a> </td>
        </tr>
        <?php }// del for ?>
      </table>
      <p></p>
    <!-- InstanceEndEditable -->    </td>
    <td colspan="3" valign="top"><!-- InstanceBeginEditable name="body" -->
    <?php if (!(isset($_GET['sis']))) {?>
    <p class="textos">Bienvenido(a) a la Intranet de la Contralor&iacute;a del Estado Nueva Esparta, en este novedoso sistema basado en tecnolog&iacute;a web, usted podr&aacute; realizar de manera r&aacute;pida, segura y sencilla las tareas m&aacute;s comunes relacionadas con su trabajo, desde solicitar un permiso para llegar tarde hasta, pasando por la programaci&oacute;n de vacaciones hasta conocer su propia evaluaci&oacute;n de desempe&ntilde;o,  indicadores de gesti&oacute;n, indicadores estrat&eacute;gicos entre otras funcionalidades que har&aacute;n de la Intranet de la Contralor&iacute;a su mas &uacute;til herramienta de trabajo.</p>
<p class="textos">Para iniciar, haga click sobre algunos de los botones de men&uacute; que representan los diversos sistemas a los que tiene acceso.</p>
<p class="textos">Para volver a esta p&aacute;gina, siempre puede hacer click en el v&iacute;nculo &quot;<strong>Inicio</strong>&quot; que se encuentra en la parte superior y para salir del sistema es necesario que haga click en el v&iacute;nculo &quot;<strong>Salir</strong>&quot; que se encuentra en la parte superior.</p>
<p class="textos">&nbsp;</p>
<?php
     }  
   else
	 { 
	 // si viene "sis" como parámetro, el usuario ha seleccionado un sistema al cual desea acceder, entonces se consulta 
	  // la base de datos para todos los módulos de dicho sistema a los cuales el usuario tiene acceso.
	  // Para calcular el número de filas de cuatro casillas que necesitaré:
	  //1.- Saco la parte entera de la división, p.e. 7/4=1,75 ; el floor da como resultado "1";
	  $cuenta_filas=floor(mysql_num_rows($result_modulos)/4);
	  //2.- Saco la parte decimal restando la división menos el entero. p.e. 1,75-1= 0,75
	  $decimal=(mysql_num_rows($result_modulos)/4)-$cuenta_filas;
	  // si la parte decimal da mayor que cero, quiere decir que necesitaré una fila más porque hay por lo menos un modulo que estará en la siguiente fila.
	  if ($decimal>0){$cuenta_filas++;}
	 // echo "filas=".$cuenta_filas." ";
	  
	?>
<table width="789" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <?php 
	  $otra_fila=true;
	  $contador_modulos=0;
	  $contotal_modulos=0;
	  $contador_modulos2=0;
	  $contotal_modulos2=0;
	  for ($num_fil=0; $num_fil<$cuenta_filas; $num_fil++)
	    {
    ?>
  <?php if ($otra_fila==true){?>
  <tr bgcolor="#FFFFFF"><?php }?>
   <?php while (($contador_modulos < 4) && ($contador_modulos <= count($set_modulos) ) && ($contotal_modulos < count($set_modulos)))
           {
		   	$result_datos_modulos=mysql_query("SELECT * 
											   FROM modulos 
											   WHERE codigo_modulo='$set_modulos[$contotal_modulos]'",$links);
			$dato_modulo=mysql_fetch_array($result_datos_modulos);

   ?> <td width="25%" class="encabezado_formularios"><a href="<?php echo $directorio['directorio'].$dato_modulo['archivo_php']; ?>"><img src="imgs/<?php echo $dato_modulo['imagen_g']; ?>" alt="<?php echo $dato_modulo['nombre_largo']; ?>" width="128" height="128" border="0" /></a></td>
   <?php 
            $contotal_modulos++;
			$contador_modulos++;
           } 
		 ?>
   
  <?php if ($otra_fila==true){?></tr><?php }?>
  <?php if ($otra_fila==true){?><tr><?php }?>
  
  <?php 
  	//  $otra_fila=true;

  
       while (($contador_modulos2 < 4) && ($contador_modulos2 <= count($set_modulos) ) && ($contotal_modulos2 < count($set_modulos)))
           {
		   	$result_datos_modulos=mysql_query("SELECT * 
											   FROM modulos 
											   WHERE codigo_modulo='$set_modulos[$contotal_modulos2]'",$links);
			$dato_modulo=mysql_fetch_array($result_datos_modulos);

   ?> 
   <td width="25%" class="datos_formularios"><div align="center"><a href="<?php echo $directorio['directorio'].$dato_modulo['archivo_php']; ?>"> <?php echo $dato_modulo['nombre_corto']; ?></a></div></td>
   
   <?php 
            $contotal_modulos2++;
			$contador_modulos2++;
           } 
		 ?>
  
      
  <?php if ($otra_fila==true){?></tr><?php }?>
  <?php if (($contotal_modulos < count($set_modulos)) && ($contador_modulos>=3)) 
          {
		    $otra_fila=true;
			$contador_modulos=0;
			$contador_modulos2=0; 
		  }
        else
		{
		$otra_fila=false;
		}
	?>
  <tr>
    <td colspan="4">&nbsp;</td>
    </tr>
    <?php }//del for de los módulos?>
 </table>

<?php }?>
<p class="datos_formularios">&nbsp;</p>
<!-- InstanceEndEditable --></td>
  </tr>
  <tr >
    <td >&nbsp;</td>
    <td colspan="3" valign="middle" height="2%"><h5 align="center">Contralor&iacute;a del Estado Nueva Esparta -      
    Ultima actualizaci&oacute;n: 
    <!-- #BeginDate format:fcSw1a -->Monday, 8 December, 2008 12:16 PM<!-- #EndDate -->
    </h5></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>