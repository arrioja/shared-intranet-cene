<?php
include_once("definicion_fijo_contratado.php"); /* auto-ajax definition */
global $ajax; /* Important, always do this, because this page will be include */
$ajax->destiny("seccion"); /* the ajax destination of this page */
$ajax->start();//the page start here
?>

<table width="467" border="1">
  <tr>
    <td width="67">Decreto </td>
    <td width="150"><span id="sprytextfield1">
      <input type="text" name="decreto" id="decreto" />
    </span></td>
    <td width="71">Fecha Ingreso</td>
    <td width="151"><input type="text" name="fecha_ingreso" id="fecha_ingreso" />
    <input name="condicion" type="hidden" id="condicion" value="FIJO" /></td>
  </tr>
</table>
<?php
$ajax->end(); //and ends here
?>