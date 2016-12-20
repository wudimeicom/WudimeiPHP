<?php
namespace Wudimei;

class Request{
	public function method(){
		return strtoupper( @$_SERVER['REQUEST_METHOD'] );
	}
	/**
	 * 
	 * @param string $method
	 * @return bool
	 */
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
	/**
	 *
	 * @return bool
	 */
	public function isPost(){
		return $this->isMethod('POST');
	}
	/**
	 *
	 * @return bool
	 */
	public function isGet(){
		return $this->isMethod('GET');
	}
	/**
	 *
	 * @return bool
	 */
	public function isPut(){
		return $this->isMethod('PUT');
	}
	/**
	 *
	 * @return bool
	 */
	public function isHead(){
		return $this->isMethod('HEAD');
	}
	/**
	 *
	 * @return bool
	 */
	public function isDelete(){
		return $this->isMethod('DELETE');
	}
	/**
	 * 
	 * @param string $key
	 * @param mixed $default
	 * @return string|mixed
	 */
	public function get( $key,$default = NULL ){
		if( isset(  $_GET[$key] )){
			return $_GET[$key];
		}
		else{
			return $default;
		}
	}
	/**
	 * 
	 * @param string $key
	 * @param mixed $default
	 * @return string|mixed
	 */
	public function post( $key,$default = NULL ){
		if( isset( $_POST[$key] )){
			return $_POST[$key];
		}
		else{
			return $default;
		}
	}
	/**
	 * 
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function item($key,$default = NULL ){
		if( isset( $_REQUEST[$key] )){
			return $_REQUEST[$key];
		}
		else{
			return $default;
		}
	}
	/**
	 * 
	 * @param string $key
	 * @param number $default
	 * @return integer
	 */
	public function getInt( $key ,$default = 0){
		if( is_numeric( @$_REQUEST[$key])){
			return intval( $_REQUEST[$key] );
		}
		else{
			return $default;
		}
	}
	/**
	 * 
	 * @param string $key
	 * @param number $default
	 * @return float
	 */
	public function getFloat( $key ,$default = 0){
		if( is_numeric( $_REQUEST[$key])){
			return floatval( $_REQUEST[$key] );
		}
		else{ 
			return $default;
		}
	}
	/**
	 * 
	 * @param string $key
	 * @param number $default
	 * @return double
	 */
	public function getDouble( $key ,$default = 0){
		if( is_numeric( $_REQUEST[$key])){
			return doubleval( $_REQUEST[$key] );
		}
		else{
			return $default;
		}
	}
	/**
	 * @return array
	 */
	public function all(){
		return $_REQUEST;
	}
	
}