<?php

namespace Wudimei\Session;
class BasicSession
{
	protected $config;
	protected $session_id;
	protected $session_data;
	protected $hasChanged = false;
	
	public function __construct($config){
		$this->config = $config;

	}

	function create_sid(){
		$this->hasChanged = true;
		return md5( uniqid("").rand(1,10000) . microtime(true) );
	}
	
	
	public function start(){
		$cfg = $this->config;
		$session_name = @$cfg["cookie"];
		if( trim( $session_name ) == "" ){
			$session_name = "wudimei_session";
		}
		$sessionId = @$_COOKIE[$session_name];
			
		if( !isset( $sessionId) ){
			$sessionId = $this->create_sid();
			$expire = 0;
			$cookie_lifetime = $cfg["lifetime"];
			if(  $cookie_lifetime >0 ){
				$expire = time()+ $cookie_lifetime*60;
			}
				
			setcookie($session_name, $sessionId, $expire, $cfg["path"],$cfg["domain"],
					@$cfg['secure'],@$cfg['httponly'] );
		}
		$this->session_id = $sessionId;
		$this->loadSession();
	}
	
	function loadSession()
	{
		
	}
	

	public function set( $name,$value ){
		$this->hasChanged = true;
		$this->session_data[$name] = $value;
	}
	
	public function get( $name  ){
			
		return  $this->session_data[$name];
	}
	public function all(  ){
	
		return $this->session_data;
	}
	
	public function delete( $name ){
		$this->hasChanged = true;
		unset( $this->session_data[$name]);
	}
	
	
	function destroy()
	{
		$this->hasChanged = true;
		$this->session_data = [];
	}
}