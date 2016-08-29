<?php 
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;

use Request;

class Router{
	
	public  function handle($routeFile){
		$routeArray = include $routeFile;
		$uri = $_SERVER['REQUEST_URI'];
		
		$route = '';
		$params = array();
		if( $uri == '/'){
			$route = $routeArray['default'];
		}
		else{
			// echo $uri;
			//print_r( $routeArray );
			foreach ( $routeArray as $routeExpr => $item ){
				$expr = $this->parseRoute($routeExpr);
				if( preg_match( $expr , $uri)){
					//echo $expr;
					preg_match_all( $expr, $uri,$m);
					//print_r( $m );
					//$params = @$m[1];
					for( $i=1;$i<count($m);$i++ ){
						$params[] = $m[$i][0];
					}
					$route = $item;
					break;
				}
			}
		}
		
		if( $route != ''){
			 
			if( is_array( $route)){
				$route = $route[Request::method()];
			}
			@list( $c,$method) = @explode("@", $route);
			//echo $c, $m;
			$class = "\\App\\Controllers\\".$c;
			if( class_exists( $class) == false ){
				$class = $c;
			}
			if( $method== null ){
				$method = "index";
			}
			$ctrl = new $class();
			//$ctrl->$m();
			if( !empty( $params)){
				call_user_func_array( [$ctrl,$method] , $params );
			}
			else{
				call_user_func( [$ctrl,$method] );
			}
		}
		else{
			header("HTTP/1.0 404 Not Found");
			$vars = [
				"uri" => $uri	
			];
			echo \View::make("404", $vars);
		}
		//$c = new  \App\Controllers\IndexController();
		//$c->index();
	}
	
	public  function parseRoute($expr){
		preg_match_all('/(\([^\)]+\))/i', $expr ,$m );
		//print_r( $m );
		$arr =preg_split( '/(\([^\)]+\))/i' , $expr );
		
		$replaceChars = ['.'=>'\.','-'=>'\-','/'=>'\/','_'=>'\_','?'=>'\?','+'=>'\+','*'=>'\*'];
		for( $i=0;$i< count( $arr); $i++ ){
			$item = $arr[$i];
			foreach ( $replaceChars as $from => $to ){
				$item = str_replace($from, $to, $item );
			}
			$arr[$i] = $item;
		}
		$partenArr = array();
		for($i=0;$i<count($m[0]);$i++ ){
			$item = $m[0][$i];
			if( $item == "(:num)"){
				$item = "([0-9\.]+)";
			}
			if( $item == "(:any)"){
				$item = "([^\/]+)";
			}
			$partenArr[$i] = $item;
		}
		
		//print_r( $arr );
		//print_r( $partenArr );
		$regex = "/";
		for( $i=0;$i< count( $arr);$i++ ){
			$regex .= $arr[$i] . @$partenArr[$i];
		}
		$regex .= "/";
		$regex .= "i";
		//echo $regex ;
		return $regex;
	}
}
?>