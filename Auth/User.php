<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei\Auth;

use Wudimei\DB\Model;

class User extends Model{
	public $table = "users";
	public $connection = "default";
	/**
	 * 
	 * @param array $kvArr conditions
	 */	
	public function seekUser( $kvArr ){
		$password = @$kvArr["password"];
		unset( $kvArr["password"]);
		$user = new static();
		foreach ( $kvArr as $k => $v ){
			$user = $user->where( $k, $v);
				
		}
		//$user2 = clone $user; echo $user2->toSql();
		$userObj  = $user->first();
		return $userObj;
			
	}
	/**
	 * 
	 * @param User $userObj
	 * @param array $config an array from auth config file
	 */
	public function saveToken( $userObj ,$config ){
		$token = md5( uniqid() );
		$this->where('id', $userObj->id )->limit(1,0)->update(['remember_token' => $token ]);
	
		$time = time()+$config['lifetime'];
		if( $config['lifetime'] ==0 ){
			$time =0;
		}
		setcookie($config['token_name'] , $token , $time ,
				$config['path'] ,$config['domain'],$config['secure'],$config['httponly']);
		
	}
	/**
	 * 
	 * @param array $config an array from auth config file
	 */
	public function getUserByToken($config){
		$token = @$_COOKIE[ $config['token_name'] ];
		$user = $this->where('remember_token', $token )->first();
		return $user;
	}
	/**
	 * 
	 * @param array $kvArr condition
	 * @param User $userObj
	 */
	public function checkPassword( $kvArr , $userObj ){
		$password = @$kvArr["password"];
		if( $this->encryptPassword( $password) == @$userObj->password  ){
			return true;
		}
		else{
			return false;
		}
	}
	/**
	 * 
	 * @param string $password
	 */
	public function encryptPassword( $password ){
		return md5( $password );
	}
	
	/**
	 * 
	 * @param array $config an array from auth config file
	 */
	public function logout( $config ){
		setcookie($config['token_name'] , "" , time() -3600*24*2 ,
				$config['path'] ,$config['domain'],$config['secure'],$config['httponly']);
	}
}