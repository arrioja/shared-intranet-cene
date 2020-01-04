<html>
<head>
<meta name="keywords" content="web,web application,CC,BSD,GPL,LGPL,MIT,Resources,Free,web design "/>
<meta name="description" content="Only the Best and Free Resources for Web Application Developers"/>
<title></title> 
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" /> 

<link href="lib/style.css" rel="stylesheet" type="text/css" media="screen" />
<script language="javascript" type="text/javascript" src="lib/prototype.js"></script>
<script language="javascript" type="text/javascript" src="lib/progress.js"></script>

<style type = "text/css">

/* General Links */
a:link { text-decoration : none; color : #3366cc; border: 0px;} 
a:active { text-decoration : underline; color : #3366cc; border: 0px;} 
a:visited { text-decoration : none; color : #3366cc; border: 0px;} 
a:hover { text-decoration : underline; color : #ff5a00; border: 0px;} 
img { padding: 0px; margin: 0px; border: none;}

body {
margin : 0 auto;
width:100%;
font-family: 'Verdana';
color: #40454b;
font-size: 12px;

 text-align:center;
}



.content {
margin:20px;
line-height:20px;
}

body h1 {


font-size:14px;
font-weight:bold;
color:#CC0000;
padding:5px;
margin-left:10px;
border-bottom:solid;
border-bottom-width:1px;
border-bottom-color:#333333;


}

#demo {
margin : 0 auto;
width:100%;
margin:20px;

}

#demo .extra {
padding-left:30px;
}

#demo .options {
padding-left:10px;
}

#demo .getOption {
padding-left:40px;
}

.document {
margin : 0 auto;

border-style:solid;
border-width:1px;
background:#f7f7f7;
border-color:#efefef;
margin:20px;
}

.document h2 {
padding:5px;
padding-bottom:0px;
color:#333333;
font-weight:bold;
font-size:12px;
}

.document h3 {
padding:5px;
padding-bottom:0px;
padding-top:0px;
font-weight:normal;
font-size:12px;
}

</style>


</head>

<?php 
include "../../db/conexion.php";
$link=conectarse("gestion");
$cod=$_GET['seleccionado'];
$sql=mysql_query("select * from gestion.gestion_planes_estrategicos where codigo=01") or die (mysql_error);
$result=mysql_fetch_array($sql);
$completados=$result["completados"]; 

?>

<body>


<form name="form1" method="post" action="">
  <p>&nbsp;</p>
  <table width="561" border="1" align="center">
    <tr>
      <td colspan="3"> </td>
    </tr>
    <tr>
      <td width="49"></td>
      <td width="353" height="30">
  <div id="demo">
<script>display ('element2',25,1);</script>
<span>Completado</span></div>
</div></td>
      <td width="137"></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>

</body>
</html>
