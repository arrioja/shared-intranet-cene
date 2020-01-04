<?php
/*
***************************************************************************
*   Copyright (C) 2007 by Cesar D. Rodas                                  *
*   crodas@phpy.org                                                       *
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

if ( defined('AUTOAJAX_VARNAME') ) return;

define('AUTOAJAX_TAG','autoajaxvarname'); /* don't change this*/
define('AUTOAJAX_VARNAME','JSaddor_Client_Ajax');

/**
 *    Use json_encode PHP function, if it exist, if not
 *    use the JSON class.
 */
if ( !is_callable('json_encode') ) {
    (require_once dirname(__FILE__)."/JSON.php") or die("http://cesars.users.phpclasses.org/json is missing, download and copy  here: ".dirname(__FILE__));
    
    function json_encode($obj)  {
        $json = new JSON;
        return $json->serialize( $obj );
    }    
} 
        

/**
 *    AutoAjax
 *    @category   Javascript
 *    @package    AUTOAJAX
 *    @author     Cesar D. Rodas <crodas@phpy.org>
 *    @copyright  2007 Cesar D. Rodas
 *    @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 *    @version    1.0
 *    @link       http://cesars.users.phpclasses.org/autoajax 
 */
class autoajax 
{
    /**
     *    Actual directory
     *
     *    @access private
     *    @var string
     */
    var $pwd;
    /**
     *    Version of the package
     *
     *    @access private
     *    @var string
     */
    var $version;
    /**
     *    DIV destination for this page.
     *
     *    @var string
     *    @access public
     */
    var $Destiny; 
    /**
     *    True is the page was asked by an Ajax method
     *
     *    @var boolean
     *    @access private
     */
    var $AjaxRequest;
    /**
     *    All ajax containers are saved here.
     *
     *    @var array
     *    @access private
     */
    var $_sections;
    /**
     *    Extra options
     *
     *    OnLoad=Execute this Javascript code when page being tobe loaded
     *
     *    @var array
     *    @access private
     */
    var $_extra;
    /**
     *    Cointainer Page
     *
     *    The path of the page that will contain the actual page
     *
     *    @var array
     *    @access private
     */
    var $mainpage;
    /**
     *    Stop AutoAjax
     *
     *    @var boolean
     *    @access private
     */
    var $StopAjax;
    /**
     *    Destination of the buffer output
     *    @access private
     *    @var array string
     */
    var $_destiny;
    function autoajax($path='.') {
        $this->path = $path;
        $this->AjaxRequest = isset($_POST[AUTOAJAX_TAG]) and $_POST[AUTOAJAX_TAG] === "Yes";
    }
    
    function turnOff() {
        ob_end_clean();
        $this->StopAjax = true;
    }
    
    /**
     *    Start the actual page
     *    
     *    @access public
     */
    function Start() {
        ob_start( array($this,'PageHandler') ); 
    }

    /**
     *    End the actual page
     *
     *  @access public
     */
    function End() {
        ob_end_flush();
        unset( $this->_destiny[ count($this->_destiny) - 1] );
 
        if (!$this->AjaxRequest and !$this->isIncludedMain()) {
            require($this->mainpage);
        }
    }
    
    /** 
     *    Add a new destination for the actual buffer output
     *
     *    @param $text
     *    @access private
     */
    function destiny($text) {
         $this->_destiny[] = $text;
    }
    
    /**
     *    Handle the buffer output
     *
     *    @param $text
     *    @access private
     */
    function PageHandler($text) {
        $ajaxquery = & $GLOBALS[AUTOAJAX_VARNAME];
        if (!$this->AjaxRequest) {         
            $ajaxquery[  $this->_destiny[count($this->_destiny) - 1] ] = $text;        
            if ( !$this->isIncludedMain()  ) 
                return '';
            else
                return $ajaxquery[$this->Destiny];        
        }
        $obj = new stdClass;
        $obj->content = $text;
        $obj->destiny = $this->_destiny[count($this->_destiny) - 1];
        $obj->before = "";
        $obj->after = "";

        return json_encode( $obj );
    }
    
    /**
     *    Print JavaScript Code
     *
     *    Prints the necesary javascript code for made AutoAjax work.
     *    @access public.
     */
    function printjs() {
        echo "<script src='".$this->path."/prototype.js' type='text/javascript'></script>\r\n";
        echo "<script src='".$this->path."/autoajax.js' type='text/javascript'></script>\r\n";
        
    }
    
    /**    
     *    Define a new AJAX section or container
     *
     *    @param string $name Name of the ajax section
     *    @param string $defPage Name of the default contained page.
     *    @param array  $property extra HTML properties for the DIV container 
     *    @access public
     */
    function Add($name, $defPage, $property='') {
        $this->_sections[$name] = array('default'=>$defPage, 'properties' => $property);
    }
    
    /**
     *    Crete an Ajax section
     *
     *    @param string $name Section Name
     *    @access private
     */
    function AjaxSection($name) {
        if ( ! isset($this->_sections[$name] ) ) {
            trigger_error(ADDING_NOT_EXISTEN,E_USER_WARNING);
            return false;
        }
        /* tip for perfomance http://cesarodas.com/2007/09/php-optimizing-the-use-of-arrays.html */
        $actual = & $this->_sections[$name]; 
        $str="";
        $properties = "";
        
        if ( is_array($actual['properties']) ) {
            foreach($actual['properties'] as $k => $v){
                $properties.=" ${k}=\"$v\"";
            }
        }
        
        $ajaxquery = & $GLOBALS[AUTOAJAX_VARNAME];
        echo "<div id=\"${name}\"${properties}>";
            if ( isset($ajaxquery) and is_array($ajaxquery) and isset($ajaxquery[$name]) ) {
                echo $ajaxquery[$name];
            } else {
                $this->_execute($actual['default']);
            }
        echo '</div>';
    }
    
    /**
     *    True if the main page is included.
     *
     *    @access private
     *    @return bool
     */
    function isIncludedMain() {
        $main = realpath($this->mainpage);
        foreach( get_included_files() as $filename) {
            if ( $main == realpath($filename)) {
                return true;
            }
        }
        return false;
    }
    /**
     *    Execute a PHP function or includes a file.
     *
     *    @access private
     *    @param string $f File to include or function name
     */
    function _execute($f) {
        if ( is_callable($f) ) {
            call_user_func($f);
        } else {
            require $f;
        }
    } 

} 
?>