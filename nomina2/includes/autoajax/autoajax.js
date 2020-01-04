/*
***************************************************************************
*   Copyright (C) 2007 by Cesar D. Rodas, Cristian Medeiros               *
*   {crodas,cmedieros}@phpy.org                                           *
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

var supportAjax=true; /* this browser suppor ajax? */

/**
 *  This function creates the event onclick that see if the browser support ajax,  
 *  if support ask the page to server using ajax, on otherwise ask by normal way
 */
function JSaddor_OnLoadInit() {
    var eList,i;
    eList =  document.getElementsByTagName("a");
    for(i=0; i < eList.length; i++) {
        eList[i].onclick = function (e) {
            if (!supportAjax) return true; /* ajax is supported? not!, so quit of here*/
            var ajaxUrl;
            ajaxUrl = this.href;
            var p = parseURL(ajaxUrl);
            /**
             *    Suggested by Mgr. Jan Nemec, 
             *    
             *    Provides a mechanism to avoid ajax query. This is done
             *    by ading rel="no-ajax" into the anchor tag.
             */
            if ( this.rel) {
                if (this.rel.indexOf('no-ajax') >= 0) return true;      
            }
            var actual = parseURL(document.location.href);
            /*
             *    The request link protocol is not the same than the actual page.
             *     So ask by regular way.
             */
            if (p.protocol != actual.protocol) return true;
            /* 
             *    The request link is not a file, and the host is diferent from the the actual host
             *    so ask thought ajax is imposible. So ask by regular way.
             */
            if ( p.protocol != "file" && p.host != actual.host) return true;
            /* if ports are diferents, so do simple query*/

            if (p.port != actual.port) return true;
            /* do ajax query */
            
            JSaddor_getPage( ajaxUrl );
            return false; 
        };
    }
}

/**
 *    Download Page using Ajax
 */
function JSaddor_getPage( url ) {
    var success  = function(t) { 
        /* try to parse the entry */
        try {
            
            elem = eval ( "(" + t.responseText  +")"); 
            JSaddor_DrawPage( elem );
            JSaddor_OnLoadInit();
        } catch(e) {
            /* an error was happened, so do simple request by simple method */
            JSaddor_DoNormalRequest( url );
        }
        
    }
    
    
    
    var failure  = function(t){ 
        JSaddor_DoNormalRequest(url);
    }
    var myAjax = new Ajax.Request(url,
        {
            method:'post',  onSuccess:success, onFailure:failure, parameters: "autoajaxvarname=Yes"
        }
    ) 
}

function JSaddor_DrawPage( obj ) {
    try {
        elem = document.getElementById(  obj.destiny );
        elem.innerHTML = obj.content;
    } catch(e) {
        throw "Error in DrawPage (" + e + ")";
    }

    eval( obj.before );
    eval( obj.after );
}
/**
 *  Some times the Ajax request fails or the server doesn't answer
 *  as we expected (normaly when JSaddor is not installed on server side)
 *  so force to request that page in normal way.
 */
function JSaddor_DoNormalRequest(url) {
    document.location.href = url;
}

function JSaddor_CleanString(str) {
    str=str.replace(/\\n/g,"\n");
    str=str.replace(/\\r/g,"\r");
    return str;
}

/**
 *  This functions add an event to the actual window.
 *  Used for generate "on paged loaded" event and change the 
 *  links for an Ajax query if is supported
 */
function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
        window.onload = func;
    } else {
        window.onload = function() {
            if (oldonload) 
                oldonload();
            func();
        }
    }
}





/** 
 *    Parse URL
 *
 *    Parse an URL and return and
 *    object with it parts.
 */
function parseURL(buffer) {
  var result = { };
  result.protocol = "";
  result.user = "";
  result.password = "";
  result.host = "";
  result.port = "";
  result.path = "";
  result.query = "";

  var section = "PROTOCOL";
  var start = 0;
  var wasSlash = false;

  while(start < buffer.length) {
    if(section == "PROTOCOL") {
      if(buffer.charAt(start) == ':') {
        section = "AFTER_PROTOCOL";
        start++;
      } else if(buffer.charAt(start) == '/' && result.protocol.length() == 0) { 
        section = PATH;
      } else {
        result.protocol += buffer.charAt(start++);
      }
    } else if(section == "AFTER_PROTOCOL") {
      if(buffer.charAt(start) == '/') {
    if(!wasSlash) {
          wasSlash = true;
    } else {
          wasSlash = false;
          section = "USER";
    }
        start ++;
      } else {
        throw new ParseException("Protocol shell be separated with 2 slashes");
      }       
    } else if(section == "USER") {
      if(buffer.charAt(start) == '/') {
        result.host = result.user;
        result.user = "";
        section = "PATH";
      } else if(buffer.charAt(start) == '?') {
        result.host = result.user;
        result.user = "";
        section = "QUERY";
        start++;
      } else if(buffer.charAt(start) == ':') {
        section = "PASSWORD";
        start++;
      } else if(buffer.charAt(start) == '@') {
        section = "HOST";
        start++;
      } else {
        result.user += buffer.charAt(start++);
      }
    } else if(section == "PASSWORD") {
      if(buffer.charAt(start) == '/') {
        result.host = result.user;
        result.port = result.password;
        result.user = "";
        result.password = "";
        section = "PATH";
      } else if(buffer.charAt(start) == '?') {
        result.host = result.user;
        result.port = result.password;
        result.user = "";
        result.password = "";
        section = "QUERY";
        start ++;
      } else if(buffer.charAt(start) == '@') {
        section = "HOST";
        start++;
      } else {
        result.password += buffer.charAt(start++);
      }
    } else if(section == "HOST") {
      if(buffer.charAt(start) == '/') {
        section = "PATH";
      } else if(buffer.charAt(start) == ':') {
        section = "PORT";
        start++;
      } else if(buffer.charAt(start) == '?') {
        section = "QUERY";
        start++;
      } else {
        result.host += buffer.charAt(start++);
      }
    } else if(section == "PORT") {
      if(buffer.charAt(start) = '/') {
        section = "PATH";
      } else if(buffer.charAt(start) == '?') {
        section = "QUERY";
        start++;
      } else {
        result.port += buffer.charAt(start++);
      }
    } else if(section == "PATH") {
      if(buffer.charAt(start) == '?') {
    section = "QUERY";
    start ++;
      } else {
    result.path += buffer.charAt(start++);
      }
    } else if(section == "QUERY") {
      result.query += buffer.charAt(start++);
    }
  }

  if(section == "PROTOCOL") {
    result.host = result.protocol;
    result.protocol = "http";
  } else if(section == "AFTER_PROTOCOL") {
    throw new ParseException("Invalid url");
  } else if(section == "USER") {
    result.host = result.user;
    result.user = "";
  } else if(section == "PASSWORD") {
    result.host = result.user;
    result.port = result.password;
    result.user = "";
    result.password = "";
  }

  return result;
}

function ParseException(description) {
    this.description = description;
}
        
/**
 *    Starting JSaddor 
 */
addLoadEvent( JSaddor_OnLoadInit );
