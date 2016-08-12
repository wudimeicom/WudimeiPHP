<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
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
	
	public function setConfigItem($key,$value ){
		$this->config[$key] = $value;
	}
	
	public function getConfigItem($key  ){
		return $this->config[$key]  ;
	}
	public function setTokenLifeTime($seconds){
		$this->setConfigItem("lifetime", $seconds);
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
			$user = $this->userModel->getUserByToken($this->config);
		}
		return $user;
	}
	
	public function logout(){
		\Session::delete( $this->name);
		\Session::destroy();
		$this->userModel->logout($this->config );
	}
	
	public function setUser($user){
		\Session::set( $this->name, $user);
	}
	
	public function attempt($kvArray, $remember = false){
		$user = $this->userModel->seekUser( $kvArray );
		//print_r( $user );
		if( $this->userModel->checkPassword( $kvArray, $user ) ){
			$this->setUser($user);
			if( $remember == true  ){
				$this->userModel->saveToken( $user , $this->config );
			}
			return true;
		}
		else{
			return false;
		}
	}
	
}