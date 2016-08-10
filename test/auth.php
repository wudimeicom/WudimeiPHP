<?php 




namespace App{	
	require_once __DIR__ .'/../autoload2.php';
	class User extends \Wudimei\DB\Model{
		public $table = "users";
		
	}
}

namespace {
	 
	Session::loadConfig( __DIR__ . '/session_config.php' );
	Session::start();
	$config = include __DIR__ . "/db_config.php";
	DB::addConnection($config);
	Auth::loadConfig( __DIR__ . '/auth_config.php' );
	
	$act = @$_GET["act"];
	if( $act == "" ){
		if( Auth::check() ){
			echo "User,welcome!";
			echo " <a href=\"auth.php?act=logout\">logout</a> ";
		}
		else{
			echo "Please login";
			echo " <a href=\"auth.php?act=login\">login</a> ";
		}
	}
	elseif( $act == "login" ){
		\Auth::setUser(123);
	}
	elseif( $act == "logout" ){
		\Auth::logout();
	}
}
?>