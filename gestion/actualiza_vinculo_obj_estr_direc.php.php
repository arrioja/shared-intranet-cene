<?php
   require("../db/conexion.php");
   $link=conectarse("gestion");
   $codigo=$_GET['codigo'];
   $seleccionado=$_GET['seleccionado'];

if ($_GET['activo']==1)
  {//inserta
     $sql="insert into gestion_obje_org_dir (cod_obj_e_dir, cod_obj_e_org) value ('$codigo','$seleccionado')";
  }
else
  {
     $sql="delete from gestion_obje_org_dir where cod_obj_e_dir = $codigo and cod_obj_e_org = $seleccionado";
  }
 $result=mysql_query($sql,$link) or die (mysql_error());
 mysql_close($link);
 //header ("location:select_obj_estrategicos_organizacion.php?seleccionado=$_GET[seleccionado]&codigo=$_GET[codigo]");
?>