<?php
/*
***************************************************************************
*   Copyright (C) 2007 by Cesar D. Rodas                                  *
*   cesar@sixdegrees.com.br                                               *
*                                                                         *
*   Permission is hereby granted, free of charge, to any person obtaining *
*   a copy of this software and associated documentation files (the       *
*   "Software"), to deal in the Software without restriction, including   *
*   without limitation the rights to use, copy, modify, merge, publish,   *
*   distribute, sublicense, and/or sell copies of the Software, and to    *
*   permit persons to whom the Software is furnished to do so, subject to *
*   the following conditions:                                             *
*                                                                         *
*   The above copyright notice and this permission notice shall be        *
*   included in all copies or substantial portions of the Software.       *
*                                                                         *
*   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,       *
*   EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF    *
*   MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.*
*   IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR     *
*   OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, *
*   ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR *
*   OTHER DEALINGS IN THE SOFTWARE.                                       *
***************************************************************************
*/ 
error_reporting(E_ALL);
require "url_rewriter.php";
require "autoajax.php";

$url = new url_rewriter('example-aa-ur/');
$url->e404 = "error.php"; 



/* will math on http://www.site.com/ and http://www.site.com/index.html */
$url->add_rule("page.php","/{index.[ext]}" );
/**
 *    Will match /country/index.html and /country/
 *
 */

$country=array('Argentina','Brasil','Paraguay');
$url->add_rule("page.php","/[country]/{index.html}", array('country'=> $country) );

/**
 *    Will match
 *    /9489-site.html
 *    /9456-site-948.html
 */
$url->add_rule("page.php","/[str]-[:number1]-site{-[:number2]}.[ext]");

/* execute and search pattern */
/* difine autoajax handler */
$ajax = new autoajax("");
/* defining ajax section */
$ajax->add("central","example-aa-ur/page.php");

$ajax->mainpage = "example-aa-ur/index.php"; /* ajax default main template */
$url->execute();

?>