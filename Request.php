<?php
namespace Wudimei;

class Request{
	public function method(){
		return strtoupper( @$_SERVER['REQUEST_METHOD'] );
	}
	
	public function isMethod($method){
		$method = strtoupper( $method );
		$m = $this->method();
		if( $m == $method ){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function isPost(){
		return $this->isMethod('POST');
	}
	public function isGet(){
		return $this->isMethod('GET');
	}
	public function isPut(){
		return $this->isMethod('PUT');
	}
	public function isHead(){
		return $this->isMethod('HEAD');
	}
	public function isDelete(){
		return $this->isMethod('DELETE');
	}
	
	public function get( $key,$default = NULL ){
		if( isset(  $_GET[$key] )){
			return $_GET[$key];
		}
		else{
			return $default;
		}
	}
	
	public function post( $key,$default = NULL ){
		if( isset( $_POST[$key] )){
			return $_POST[$key];
		}
		else{
			return $default;
		}
	}
	
	public function item($key,$default = NULL ){
		if( isset( $_REQUEST[$key] )){
			return $_REQUEST[$key];
		}
		else{
			return $default;
		}
	}
	
	public function getInt( $key ,$default = 0){
		if( is_numeric( $_REQUEST[$key])){
			return intval( $_REQUEST[$key] );
		}
		else{
			return $default;
		}
	}
	
	public function getFloat( $key ,$default = 0){
		if( is_numeric( $_REQUEST[$key])){
			return floatval( $_REQUEST[$key] );
		}
		else{ 
			return $default;
		}
	}
	
	public function getDouble( $key ,$default = 0){
		if( is_numeric( $_REQUEST[$key])){
			return doubleval( $_REQUEST[$key] );
		}
		else{
			return $default;
		}
	}
	
	public function all(){
		return $_REQUEST;
	}
	
}