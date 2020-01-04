<?php
include_once("definicion_fijo_contratado.php"); /* auto-ajax definition */
global $ajax; /* Important, always do this, because this page will be include */
$ajax->destiny("seccion"); /* the ajax destination of this page */
$ajax->start();//the page start here
?>
<link rel="stylesheet" type="text/css" media="all" href="../jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
  <script type="text/javascript" src="../jscalendar/calendar.js"></script>
  <script type="text/javascript" src="../jscalendar/lang/calendar-espanol.js"></script>
  <script type="text/javascript" src="../jscalendar/calendar-setup.js"></script>
  <table width="509" border="1">
  <tr>
    <td width="67">Decreto Contrato</td>
    <td width="150"><span id="sprytextfield1">
      <input type="text" name="decreto" id="decreto" />
    </span></td>
    <td width="71">Fecha ini</td>
    <td width="181"><input type="text" name="fecha_ini" id="fecha_ini" readonly="1" />
      <img src="../jscalendar/img.gif" alt="r" name="f_trigger_ini" id="f_trigger_ini" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
  </tr>
  <tr>
    <td>Fecha Fin</td>
    <td><input type="text" name="fecha_fin" id="fecha_fin" readonly="1" />
      <img src="../jscalendar/img.gif" alt="r" name="f_trigger_fin" id="f_trigger_fin" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha_ini",     // id of the input field
        ifFormat       :    "%d/%m/%Y",      // format of the input field
        button         :    "f_trigger_ini",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha_fin",     // id of the input field
        ifFormat       :    "%d/%m/%Y",      // format of the input field
        button         :    "f_trigger_fin",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>
<?php
$ajax->end(); //and ends here
?>