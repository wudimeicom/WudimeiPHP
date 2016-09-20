<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;

class Route{
	
	public $group_prefix_stack = [];
	public  $group_namespace_stack = [];
	public $group_domain = "";
	public $routes;
	
	public function getRoutes(){
		return $this->routes;
	}
	public function get( $url, $callback ){
		$this->add(['GET'], $url, $callback);
		  
	}
	
	public function post( $url, $callback ){
		$this->add(['POST'], $url, $callback);
	}
	
	public function put( $url, $callback ){
		$this->add(['PUT'], $url, $callback);
	}
	
	public function delete( $url, $callback ){
		$this->add(['DELETE'], $url, $callback);
	}
	
	public function any( $url, $callback ){
		$this->add('*', $url, $callback);
	}
	
	public function match( $verbs, $url, $callback ){
		$this->add($verbs, $url, $callback);
	}
	
	public function add( $verbs, $url , $callback ){
		
		$namespace = $this->getNamespace();
		$closure = $callback;
		if( $namespace != ""){
			$closure = $namespace .'\\'. $callback;
		} 
		$this->routes[] = [
			'uri' => $this->getPrefix() . $url ,
			'closure' => $closure,
			'verbs' => $verbs,
			'domain' => $this->group_domain
		];
	}
	
	
	
	
	public function group( $setting, $closure ){
		$prefix = $setting['prefix'];
		array_push( $this->group_prefix_stack, $prefix );
		if( isset( $setting['namespace'])){
			array_push($this->group_namespace_stack , @$setting['namespace']);
		}
		$this->group_domain = @$setting['domain'];
		
		if( is_callable( $closure )){
			call_user_func( $closure);
		}
		
		array_pop($this->group_prefix_stack );
		if( isset( $setting['namespace'])){
			array_pop($this->group_namespace_stack  );
		}
		$this->group_domain = '';
	}
	
	public function getPrefix(){
		$p = "";
		$p = implode( "", $this->group_prefix_stack   );
		return $p;
	}
	
	public function getNamespace(){
		$cnt = count( $this->group_namespace_stack);
		$n = @$this->group_namespace_stack[$cnt-1];
		return $n;
	}
}