<?php /*
Copyright (c) 2007, Gurú Sistemas and/or Gustavo Adolfo Arcila Trujillo
All rights reserved.
www.gurusistemas.com

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

    * Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer
	  in the documentation and/or other materials provided with the distribution.
    * Neither the name of the Gurú Sistemas Intl nor Gustavo Adolfo Arcila Trujillo nor the names of its contributors may be used to
	  endorse or promote products derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS  "AS IS"  AND ANY EXPRESS  OR  IMPLIED WARRANTIES, INCLUDING, 
BUT NOT LIMITED TO,  THE IMPLIED WARRANTIES  OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.  IN NO EVENT
SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT,  INDIRECT,  INCIDENTAL, SPECIAL, EXEMPLARY,  OR CONSEQUENTIAL 
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF  USE, DATA, OR PROFITS;  OR BUSINESS 
INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE 
OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. 

phpMyDataGrid is Open Source released under the BSD License, and we need your help if you like this script and think to use it 
please make a donation. Our goal is To buy a house for 2 little childrens, so we need to collect USD 20.000 by receiving 4.000 
donations of USD 5 each, (If you think you can do a higher donation, don't think twice, just do it ;-) if you compare, you can 
find commercial versions with less features than phpMyDataGrid with prices higher than USD499.  So, just to make a donation is 
a cheap. 

Please remember donating is one way to show your support, copy and paste in your internet browser the following link to make your donation
https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=tavoarcila%40gmail%2ecom&item_name=phpMyDataGrid%202007&no_shipping=0&no_note=1&tax=0&currency_code=USD&lc=US&bn=PP%2dDonationsBF&charset=UTF%2d8

For more info, samples, tips, screenshots, help, contact, forum, please visit phpMyDataGrid site  
http://www.gurusistemas.com/indexdatagrid.php

For contact author: tavoarcila at gmail dot com or info at gurusistemas dot com
*/ 

include ("phpmydatagrid.class.php");
$objGrid = new datagrid;

$objGrid->closeTags(true);  
$objGrid->friendlyHTML();  
$objGrid->methodForm("get"); 
$objGrid -> conectadb("127.0.0.1", "capepo", "capepo", "guru");
$objGrid->salt("Myc0defor5tr0ng3r-Pro3EctiOn");
$objGrid->language("en");
$objGrid->buttons(true,false,true,false);

$objGrid->form('employee', true);
$objGrid->searchby("name,lastname");
$objGrid->tabla ("employees");
$objGrid->keyfield("id");
$objGrid->datarows(20);
$objGrid->orderby("name", "ASC");
$objGrid -> FormatColumn("id", "ID Employee", 5, 5, 1, "50", "center", "integer");
$objGrid -> FormatColumn("name", "Name", 30, 30, 0, "150", "left");
$objGrid -> FormatColumn("lastname", "Last name", 30, 30, 0, "150", "left");
$objGrid -> FormatColumn("age", "Age", 5, 5, 0, "50", "right");
$objGrid -> FormatColumn("afiliation", "Afiliation Date", 10, 10, 0, "100", "center", "date:dmy:/");
$objGrid -> FormatColumn("status", "Status", 5, 5, 0, "60", "left", "select:1_Single:2_Married:3_Divorced");
$objGrid -> FormatColumn("active", "Active", 2, 2, 0,"50", "center", "check:No:Yes");
$objGrid -> FormatColumn("salary", "Salary", 10, 10, 0, "90", "right", "money:&euro;");
$objGrid -> FormatColumn("workeddays", "Work days", 5, 2, 0, "50", "right", "integer");
$objGrid->checkable();

if (!isset($_REQUEST["DG_ajaxid"])){ // If we intercept an AJAX request from page 
									 // then do not display data below	
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'.
		 '<html xmlns="http://www.w3.org/1999/xhtml">'.
		 '<head>'.
		 '<meta http-equiv="Content-Type" content="text/html; charset=$charset" />'.
		 '<meta name="description" content="Site description" />'.
		 '<meta name="revisit-after" content="8 days" />'.
		 '<meta name="keywords" content="keywords for site" />'.
		 '<meta http-equiv="Pragma" content="no-cache" />'.
		 '<meta name="robots" content="all" />'.
		 '<link rel="shortcut icon" href="images/guru.ico" />'.
		 '<meta http-equiv="Content-Script-Type" content="type" />'.
		 '<link type="text/css" rel="stylesheet" href="./css/styles.css" />'.
		 '<title>phpMyDataGrid Test script</title>';

$objGrid -> setHeader();

?>
<script type='text/javascript' src='./js/myscripts.js'></script>
<link href="../css/styles.css" rel="stylesheet" type="text/css" media="screen" />
<body>
<div id='content'>
	<?php // echo myheader(); // print or insert your own header ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td colspan="5">&nbsp;</td>
	  </tr>
	  <tr>
		<td colspan="5">
		<div id="masthead">
			<div id="logodiv">
				<img src="http://www.gurusistemas.com/images/logo.jpg" alt="phpMyDataGrid Logo" />
			</div>
		</div>
		This is the header of page. here goes a menu or wherever you want</td>
	  </tr>
	  <tr>
		<td style="width:5%">&nbsp;</td>
		<td style="width:42.5%">&nbsp;</td>
		<td style="width:5%">&nbsp;</td>
		<td style="width:42.5%" align="right">Employees</td>
		<td style="width:5%">&nbsp;</td>
	  </tr>
	  <tr>
		<td style="width:5%">&nbsp;</td>
		<td colspan="3" align="center"><br />
<? 
    } // if (!isset($_REQUEST["DG_ajaxid"])) end interception, until here, script wont be processed when DG_ajaxid is set
		$objGrid -> ajax('silent');
		$objGrid -> grid();
		$objGrid -> desconectar();
?>
		</td>
		<td style="width:5%">&nbsp;</td>
	  </tr>
	</table><br />
	<?php // echo myfooter(); // print or insert your own footer ?>
</div>
</body>
</html>