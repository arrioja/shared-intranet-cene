      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Ajax - PHP example</title>
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
      document.getElementById('outputText').value = httpObject.responseText;
      }
	  
      }
       
      // Implement business logic
      function doWork(){
      httpObject = getHTTPObject();
      if (httpObject != null) {
      httpObject.open("GET", "upperCase.php?inputText="
      +document.getElementById('inputText').value, true);
      httpObject.send(null);
      httpObject.onreadystatechange = setOutput;
      }
      }
	  
      var httpObject = null;
      
	  //-->
      </script>
      
      <form name="testForm">
      Input text: <input type="text" onkeyup="doWork();" name="inputText" id="inputText" />
      Output text: <input type="text" name="outputText" id="outputText" />
      </form>
      </body>
      </html>