      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Ajax Master - detail example</title>
      </head>
       
      <body>
       
      <script language="javascript" type="text/javascript">
      <!--
      // Get the HTTP Object
      function getHTTPObject(){
      if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
      else if (window.XMLHttpRequest) return new XMLHttpRequest();
      else {
      alert("Your browser does not support AJAX.");
      return null;
      }
      }
       
      // Change the value of the outputText field
      function setOutput(){
      if(httpObject.readyState == 4){
      var combo = document.getElementById('type');
      combo.options.length = 0;
       
      var response = httpObject.responseText;
      var items = response.split(";");
      var count = items.length;
      for (var i=0;i<count;i++){
      var options = items[i].split("-");
      combo.options[i] =
      new Option(options[0],options[1]);
      }
      }
      }
       
      // Implement business logic
      function doWork(){
      httpObject = getHTTPObject();
      if (httpObject != null) {
      httpObject.open("GET", "getSubcategory.php?brand="
      +document.getElementById('brand').value, true);
      httpObject.onreadystatechange = setOutput;
      httpObject.send(null);
      }
      }

      var httpObject = null;

      //-->
      </script>
      <form name="testForm" action="">
      Select car brand:<br/>
      <select name="brand" id="brand" onchange="doWork();">
      <option value="Audi">Audi</option>
      <option value="BMW">BMW</option>
      <option value="Mercedes">Mercedes</option>
      <option value="Lexus">Lexus</option>
      </select>
      <br/><br/>Select car type:<br/>
      <select name="type" id="type">
      <option value="1">A3</option>
      <option value="2">A4</option>
      <option value="3">A6</option>
      <option value="4">A8</option>
      </select>
      </form>
      </body>
      </html>
