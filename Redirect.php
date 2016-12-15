<?php
namespace Wudimei;

class Redirect{
	
   
	public function to( $url ){
	    
	   
	    header("location:".$url);
	    return  $this;
	}
	
	public function back(){
		$url = $_SERVER["HTTP_REFERER"];
		$this->to($url);
		return $this;
	}
	
	public function with( $key,$value ){
	     \Session::flash( $key, $value );
	    
	     return $this;
	}
	
	public function withErrors(  $errors = [] , $key = "default" ){
	    if( empty( $errors )){
	        $errors = \Validator::getErrors() ;
	    }
	    $sess_errors = \Session::get("errors");
	    $sess_errors[$key] = $errors;
	    \Session::flash( "errors",$sess_errors );
	     
	    return $this;
	}
	
	public function withSuccess($message){
	    $this->with('message', $message);
	    $this->with('message_type', 'success');
	    return $this;
	}
	
	public function withWarning($message){
	    $this->with('message', $message);
	    $this->with('message_type', 'warning');
	    return $this;
	}
	
	public function withInfo($message){
	    $this->with('message', $message);
	    $this->with('message_type', 'info');
	    return $this;
	}
	
	public function withDanger($message){
	    $this->with('message', $message);
	    $this->with('message_type', 'danger');
	    return $this;
	}
}