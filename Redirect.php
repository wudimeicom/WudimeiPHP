<?php
namespace Wudimei;

class Redirect{
	public $url = "";
   /**
    * 
    * @param string $url
    * @return \Wudimei\Redirect
    */
	public function to( $url ){
	    
	    $this->url = $url;
	    //header("location:".$url);
	    return  $this;
	}
	/**
	 *
	 * @return \Wudimei\Redirect
	 */
	public function back(){
		$url = $_SERVER["HTTP_REFERER"]; 
		$this->to($url);
		
		return $this;
	}
	/**
	 * 
	 * @param string $key
	 * @param mixed $value
	 * @return \Wudimei\Redirect
	 */
	public function with( $key,$value ){
	     \Session::flash( $key, $value );
	    
	     return $this;
	}
	/**
	 * 
	 * @param array $errors
	 * @param string $key
	 * @return \Wudimei\Redirect
	 */
	public function withErrors(  $errors = [] , $key = "default" ){
	    if( empty( $errors )){
	        $errors = \Validator::getErrors() ;
	    }
	    $sess_errors = \Session::get("errors");
	    $sess_errors[$key] = $errors;
	    \Session::flash( "errors",$sess_errors );
	    
	    return $this;
	}
	/**
	 * 
	 * @param string $message
	 * @return \Wudimei\Redirect
	 */
	public function withSuccess($message){
	    $this->with('message', $message);
	    $this->with('message_type', 'success');
	    return $this;
	}
	/**
	 * @param string $message
	 * @return \Wudimei\Redirect
	 */
	public function withWarning($message){
	    $this->with('message', $message);
	    $this->with('message_type', 'warning');
	    return $this;
	}
	/**
	 * 
	 * @param string $message
	 * @return \Wudimei\Redirect
	 */
	public function withInfo($message){
	    $this->with('message', $message);
	    $this->with('message_type', 'info');
	    return $this;
	}
	/**
	 * 
	 * @param string $message
	 * @return \Wudimei\Redirect
	 */
	public function withDanger($message){
	    $this->with('message', $message);
	    $this->with('message_type', 'danger');
	    return $this;
	}
	
	public function sendResponse(){

	    if( strlen($this->url)>0 ){
	        header("location:".$this->url);
	    }
	}
	public function done(){
	    $this->sendResponse();
	}
	
	public function __destruct(){
	    
	}
}