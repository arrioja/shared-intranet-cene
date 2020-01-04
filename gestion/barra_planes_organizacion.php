<html>
<head>
<meta name="keywords" content="web,web application,CC,BSD,GPL,LGPL,MIT,Resources,Free,web design "/>
<meta name="description" content="Only the Best and Free Resources for Web Application Developers"/>
<title>Indicadores Planes Estrat&eacute;gicos Organizaci&oacute;n</title> 
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" /> 

<link href="../progressbar/lib/style.css" rel="stylesheet" type="text/css" media="screen" />
<script language="javascript" type="text/javascript" src="../progressbar/lib/prototype.js"></script>
<script language="javascript" type="text/javascript" src="../progressbar/lib/progress.js"></script>



<link href="../css/tablas.css" rel="stylesheet" type="text/css">
</head>

<?php 
include "../db/conexion.php";
$link=conectarse("gestion");
$cod=$_GET['seleccionado'];
$sql=mysql_query("select * from gestion_planes_estrategicos where codigo=$cod",$link) or die (mysql_error);
$result=mysql_fetch_array($sql);
$completados=$result["completados"]; 

?>

<body>


<form name="form1" method="post" action="">
  <p>&nbsp;</p>
  <table width="626" border="1" align="center">
    <tr class="encabezado">
      <td colspan="4"><div align="center"><strong><?php echo $result["nombre"];?></strong></div>      </td>
    </tr>
    <tr>
      <td><div align="center"><strong>Indicador de Cumplimiento</strong></div></td>
      <td width="247" height="42"><div align="left"><strong>Indicador de Tiempo</strong></div></td>
      <td width="49"><div align="center"><strong>Detalles</strong></div></td>
    </tr>
    <tr>
      <td height="42"><div id="demo2">
        <div align="center">
          <script>display ('element2',<?php echo $completados?>,1);</script>
            <span>Completado</span></div>
      </div> </td>
      <td height="42"><div align="center">
        <?php if ($result[7]=='0') echo "<img src='../imgs/retraso_grave.png' height='55' border='0' title='Muy Retrasada'/>"; else if ($result[7]=='1') echo "<img src='../imgs/retraso_moderado.png' border='0' height='55' title='Retraso Moderado'/>"; else if ($result[7]=='2') echo "<img src='../imgs/en_tiempo.png' border='0' height='55' title='En Tiempo'/>";?>
        <?php if ($result[7]=='0') echo "Retraso Grave"; else if ($result[7]=='1') echo "Retraso Moderado"; if ($result[7]=='2') echo "En Tiempo";?>
      </div>      </td>
      <td><a href="objetivos_organizacion.php?seleccionado=<?php echo $cod;?>"><img src="../imgs/demo.png" width="58" height="50" border="0" title="Ver Detalles"></a></td>
    </tr>
    <tr class="encabezado">
      <td height="23" colspan="3">
        <div align="center"><a href="plan_estrategico_organizacion.php">
          <input type="submit" name="atras" id="atras" value="Atras">
         </a>         </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>

</body>
</html>
