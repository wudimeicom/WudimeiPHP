<?php 




namespace App{	
	 
	
	require_once __DIR__ .'/../autoload.php';
	\Wudimei\ClassAlias::loadConfig(__DIR__."/class_alias_config.php");
	class User extends \Wudimei\Auth\User{
		public $table = "users";
		public $connection = "default";
		
	}
}

namespace {
	 
	Session::loadConfig( __DIR__ . '/session_config.php' );
	Session::start();
	 
	DB::loadConfig( __DIR__ . "/db_config.php" );
	
	Auth::loadConfig( __DIR__ . '/auth_config.php' );
	
	//echo md5('123456'); 
	//e10adc3949ba59abbe56e057f20f883e
	
	$act = @$_GET["act"];
	if( $act == "" ){
		
		
		if( Auth::check() ){
			$user = \Auth::user();
			echo $user->username;
			echo ",welcome!";
			echo " <a href=\"auth.php?act=logout\">logout</a> ";
		}
		else{
			echo "Please login";
			echo " <a href=\"auth.php?act=login\">login</a> ";
		}
		echo "<hr />";
		echo "cookies: "; print_r( $_COOKIE );
		
	}
	elseif( $act == "login" ){
		
		Auth::setTokenLifeTime(3600*24*7);//7 days
		$b = Auth::attempt(['username'=>'yqr','role_id'=>1,'password'=>'123456'], true );
		var_dump( $b );
		echo " <a href=\"auth.php?act=\">back</a> ";
		
	}
	elseif( $act == "logout" ){
		\Auth::logout();
		
		echo " <a href=\"auth.php?act=\">back</a> ";
	}
}
?>