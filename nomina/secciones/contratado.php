<?php
include_once("definicion_fijo_contratado.php"); /* auto-ajax definition */
global $ajax; /* Important, always do this, because this page will be include */
$ajax->destiny("seccion"); /* the ajax destination of this page */
$ajax->start();//the page start here
?>
<table width="509" border="1">
  <tr>
    <td width="67">Decreto Contrato</td>
    <td width="150"><span id="sprytextfield1">
      <input type="text" name="decreto" id="decreto" />
    </span></td>
    <td width="71">Fecha Inicio</td>
    <td width="181"><input type="text" name="fecha_ini" id="fecha_ini" /></td>
  </tr>
  <tr>
    <td>Fecha Fin</td>
    <td><input type="text" name="fecha_fin" id="fecha_fin"  /></td>
    <td><input name="condicion" type="hidden" id="condicion" value="CONTRATADO" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php
$ajax->end(); //and ends here
?>