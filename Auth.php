<?php
namespace Wudimei;

class Auth{
	protected $name = "auth.user";
	protected $config;
	/**
	 * 
	 * @var \Wudimei\DB\Model
	 */
	protected $userModel;
	
	public function __construct(){
		
	}
	
	public  function loadConfig( $configFile ){
		$this->config = include( $configFile );
		$model = $this->config['model'];
		$this->userModel = new $model();
		//$arr = $this->userModel->where("id",'>',0)->get();//->toSql();
		//var_dump( $arr );
	}
	
	/**
	 * Determine if the current user is authenticated.
	 *
	 * @return bool
	 */
	public function check()
	{
		return ! is_null($this->user());
	}
	
	public function user(){
		$user =  \Session::get($this->name);
		if( is_null( $user ) ){
			
		}
		return $user;
	}
	
	public function logout(){
		\Session::delete( $this->name);
		\Session::destroy();
	}
	
	public function setUser($user){
		\Session::set( $this->name, $user);
	}
	
	public function attempt($kvArray, $remember){
		
	}
	
}