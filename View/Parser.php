<?php
namespace Wudimei\View;

use Wudimei\View;

class Parser{
	
	public $tokens;
	public $viewName;
	public $path;
	public $compiled;
	
	public function __construct(   ){
		
	}
	
	public function parse(){
		$tokenCount = count( $this->tokens );
		$vars = array( 'sections' => array() ,'superClassPath' => '');
		$vars['class'] = self::getViewClassName( $this->viewName );
		
		for( $i=0;$i<$tokenCount; $i++ ){
			$token = $this->tokens[$i];
			if( !empty($token)){
				$type = @$token['type'];
				if( $type == 'statement'){
					$tag = trim(@$token['tag']);
					$tag = strtolower( $tag );
					
					if( $tag == "extends" ){
						$vars['superClass'] = $this->parseExtends($token);
						$token['code'] = '';
						$superViewName = self::getViewName( $token['expression'] );
						 
						$vars['superClassPath'] = View::compile($superViewName);
					}
					elseif( in_array( $tag , ['if','for','elseif','foreach'] )){
						$token['code'] =  $tag. $token['expression'].': ' ;
					}
					elseif( $tag == 'else'){
						$token['code'] = ' else:  ';
					}
					elseif( $tag == 'endif'){
						$token['code'] = '  endif; ';
					}
					elseif( $tag == 'endforeach'){
						$token['code'] = '  endforeach;  ';
					}
					 
				}
				if( $type == 'function' ){
					$token['code'] = '  $__output .=   '.@$token['function_name'].@$token['expression'].';  ';
				}
				if( $type == 'variable') {
					$code = '  $__r ='  . $token['expression'] . ';';
					if( $token['output_type'] == 'encode'){
						$code .= '  $__output .=  htmlspecialchars($__r);';
					}
					else{
						$code .= ' $__output .=  $__r;';
					}
					$code .= ' ';
					$token['code'] = $code;
				}
			}
			$this->tokens[$i] = $token;
		}
		
		for( $i=0;$i<$tokenCount; $i++ ){
			$token = $this->tokens[$i];
			$tag = @$token['tag'];
			if( $tag == 'section'){
				$expression = $token['expression'];
				$params = [];
				eval( "\$params = array" . $expression .";");
				//print_r( $params );
				$token['code'] = ' $__output .= $this->' . $params[0] . '(); ';
				if( count( $params ) == 2 ){
					$vars['sections'][$params[0]] = [ $params[1]];
				}
				else{
					$vars['sections'][$params[0]] = [ ];
					for( $j= $i+1;$j<$tokenCount;$j++ ){
						$tk = $this->tokens[$j];
						$tk_tag = @$tk['tag'];
						$vars['sections'][$params[0]][] = $tk;
						
						if( is_string( $tk)){
							$tk = '';
						}
						else{
							$tk['code'] = '';
						}
						$this->tokens[$j] = $tk;
						if( $tk_tag == "endsection" ){
							break;
						}
					}
				}
			}
			$this->tokens[$i] = $token;
		}
		$vars['sections']['__main__'] = $this->tokens;
		 //print_r( $this->tokens );
		//print_r( $vars );
		$data = $this->toPhp($vars);
		return $data;
	}
	
	public function toPhp($vars){	
		$output = "";
		$output = '<' . '?php '."\r\n";
		if( trim( @$vars['superClass'] ) != '' ){
			$output .= ' require_once \Wudimei\View::$compiled . \'' . 
						$vars['superClassPath'] ."'; \r\n";
		}
		$output .= 'class ' . $vars['class'] . ' ';
		if( trim( @$vars['superClass'] ) != '' ){
			$output .= ' extends ' . $vars['superClass'];
		}
		$output .= "\r\n".'{'  . "\r\n";
		$output .= " public \$__vars; \r\n";
		$output .= " public function __construct( \$vars ) { \r\n";
		$output .= "    \$this->__vars = \$vars; \r\n";
		
		$output .= " } \r\n";
		
		foreach ( $vars['sections'] as $functionName => $codes ){
			$output .= "public function " . $functionName . "(){ \r\n";
			$output .= ' $__output = ""; ' . "\r\n";
			//$output .= "    print_r( \$this->__vars ); \r\n";
			$output .= " extract( \$this->__vars ); \r\n";
			foreach ( $codes as $code ){
				if( is_string($code )){
					if(   $code   != ""){
						$output .= ' $__output .= \'' . addcslashes ( $code ,"'" ) .'\'; ' . "\r\n";
					}
				}
				else{
					$output .= @$code['code'] . " \r\n";
				}
			}
			if( trim( @$vars['superClass'] ) != '' && $functionName == "__main__" ){
				$output .= ' return parent::__main__(); ' . "\r\n";
			}
			else{
				$output .= ' return $__output; ' . "\r\n";
			}
			$output .= "} \r\n" ;
		}
		$output .= "\r\n".'}';
		// echo $output;
		return $output;
	}
	
	public function parseExtends( $token ){
		
		$superClass = $token['expression'];
		$superClass = $this->getViewClassName( $superClass );
		
		return $superClass;
	}
	
	public static function getViewName($str){
		$str = trim( $str,'\'"()');
		
		return $str;
	}
	
	public static function getViewClassName($str){
		$str = trim( $str,'\'"()');
		$str = str_replace(".", "_", $str);
		$str = str_replace("/", "_", $str);
		$str = "wudimei_view_" . $str;
		return $str;
	}
	
	public function viewClassNameToFilePath(  $str ){
		$str = str_replace('wudimei_view_', '', $str );
		$str = str_replace("_", "/", $str );
		$str .= ".view.phtml";
		return $str;
	}
}