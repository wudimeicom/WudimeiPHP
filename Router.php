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
	
	public $routeArray;
	public $controller;
	public $action;
	
	
	public function loadConfig($routeFile){
		$this->routeArray = include $routeFile;
	}
	
	public  function handle(){
		$routeArray = $this->routeArray;
		$req_uri = $_SERVER['REQUEST_URI'];
		$uriArr = parse_url( $req_uri );
		//print_r( $uriArr );
		$uri = $uriArr['path'];
		//$queryStringArr = [];
		//parse_str( $uriArr['query'] , $queryStringArr);
		//print_r( $_GET );
		//print_r( $this->routeArray );
		
		$route = [];
		$params = array();
//	$s = microtime(true);
		foreach ( $routeArray as $routeItem ){
			$routeExpr = $routeItem['uri'];
			$item = $routeItem['closure'];
			$expr = $this->parseRoute($routeExpr);
			//echo $expr .'<br />';
			if( preg_match( $expr , $uri)){
				//echo $expr;
				preg_match_all( $expr, $uri,$m);
				// print_r( $m );
				//$params = @$m[1];
				for( $i=1;$i<count($m);$i++ ){
					$params[] = $m[$i][0];
				}
				$route = $routeItem;
				$verbs = $route['verbs'];
				if( $verbs== '*' || array_search( Request::method(),  @$verbs) !== false){
					break;
				}
			}
		}
	//echo microtime(true) - $s;
		
		if(  !empty($route)  ){
			  
			   $middlewares = @$route['middlewares'];
			 //  print_r( $middlewares );
			   
				@list( $class,$method) = @explode("@", $route['closure']);
				 
				 
				if( $method== null ){
					$method = "index";
				}
				
				$this->controller = $class;
				$this->action = $method;
				$ctrl = new $class();
				
				$middlewareResult = null;
				if( count( $middlewares)>0 ){
				    $middlewareResult = \Wudimei\Middleware::runMiddlewares($middlewares,"startUp", $ctrl );
				}
				
				if( method_exists($middlewareResult, "sendResponse")){ //redirect
				    $this->sendResponse( $middlewareResult);
				}
				else{
    				$response = null;
    				if( !empty( $params)){
    					$response = call_user_func_array( [$ctrl,$method] , $params );
    				}
    				else{
    					$response = call_user_func( [$ctrl,$method] );
    				}
    			    $this->sendResponse( $response );
				}
				
			    if( count( $middlewares)>0 ){
			        \Wudimei\Middleware::runMiddlewares($middlewares,"terminate");
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
	
	public function sendResponse( $res ){
	    if(is_string( $res)){
	        echo $res;
	    }
	    elseif( is_object($res) && method_exists( $res ,'sendResponse')){
	        $res->sendResponse();
	    }
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
		$regex = "/^";
		for( $i=0;$i< count( $arr);$i++ ){
			$regex .= $arr[$i] . @$partenArr[$i];
		}
		$regex .= "$/";
		$regex .= "i";
		//echo $regex ;
		return $regex;
	}
	
	public function controller(){
	    return $this->controller;
	}
	public function action(){
	    return $this->action;
	}
}
?>