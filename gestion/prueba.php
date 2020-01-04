<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
function desactivar(enlace)
{
enlace.disabled='disabled';
}
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <label>
  <input type="button" name="prueba" id="prueba" value="Button" onclick="javascript:desactivar(this)" />
  </label>
</form>
</body>
</html>
