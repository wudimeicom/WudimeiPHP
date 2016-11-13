<?php
if( function_exists( 'config') == false ){
	function config( $name, $value = null ){
		if( $value === null ){
			return Wudimei\StaticProxies\Config::get( $name );
		}
		else{
			return Wudimei\StaticProxies\Config::set( $name , $value  );
		}
	}
}

if( function_exists( 'get') == false ){
	function get( $name, $default = null ){
		return Wudimei\StaticProxies\Request::get( $name, $default ); 
	}
}

if( function_exists( 'post') == false ){
	function post( $name, $default = null ){
		return Wudimei\StaticProxies\Request::post( $name, $default );
	}
}

if( function_exists( 'getInt') == false ){
	function getInt( $name, $default = null ){
		return Wudimei\StaticProxies\Request::getInt( $name, $default );
	}
}


if( function_exists( 'getFloat') == false ){
	function getFloat( $name, $default = null ){
		return Wudimei\StaticProxies\Request::getFloat( $name, $default );
	}
}

if( function_exists( 'isPost') == false ){
    function isPost(  ){
        return Wudimei\StaticProxies\Request::isPost();
    }
}

if( function_exists( 'trans') == false ){
    function trans( $text ,$params = [] ){
        return Wudimei\StaticProxies\Lang::get( $text, $params );
    }
}

if( function_exists( 'backend_url') == false ){
    function backend_url( $url  ,$params = [] ){
        return  config("app.backend_url") . $url;
    }
}
