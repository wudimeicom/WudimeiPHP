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
		$vars = array( 'sections' => array() ,'superClassPath' => '' ,'superViewName' =>'');
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
						$vars['superViewName'] = $superViewName;
						$vars['superClassPath'] = View::compile($superViewName);
					}
					elseif( $tag == 'include' ){
						$viewName = $this->parseInclude($token);
						$token['code'] = '$__output .= \Wudimei\View::make("'. $viewName.'",$this->__vars ); ';
						//echo $viewPath;
						
					}
					elseif( in_array( $tag , ['if','for','elseif','foreach','while'] )){
						$code = '';
						if( $tag == 'foreach'){
							$expr = $token['expression'];
							preg_match('/\((.+)\s+as\s+[^\)]+\)/i', $expr,$m);
							//print_r( $m );
							$code .= 'if( !empty('.$m[1].') ){';
						}
						if( $tag == 'elseif'){
							$code .= '}';
						}
						$code .=  $tag. $token['expression'].'{ ' ;
						$token['code'] = $code;
					}
					elseif( $tag == 'else'){
						$token['code'] = ' }else{  ';
					}
					elseif( $tag == 'endif'){
						$token['code'] = ' } ';
					}
					elseif( $tag == 'end'){
						$token['code'] = ' } ';
					}
					elseif( $tag == 'endforeach'){
						$token['code'] = '  }}  ';
					}
					elseif( $tag == 'foreachelse'){
						$token['code'] = '  }}else{{  ';
					}
					elseif( $tag == 'endfor'){
						$token['code'] = '  }  ';
					}
					elseif( $tag == "php" ){
						$expr = trim($token['expression']);
						
						if( substr($expr,0,1) == "("){
							$expr = substr($expr,1);
						}
						$len = strlen( $expr);
						if( substr($expr,$len-1,1) == ')'){
							$expr  = substr($expr,0, $len-1 );
						}
						$token['code'] = $expr . ';';
					}
					elseif( $tag == "endwhile"){
						$token['code'] = '  }  ';
					}
				}
				elseif( $type == 'function' ){
					$token['code'] = '  $__output .=   '.@$token['function_name'].@$token['expression'].';  ';
				}
				elseif( $type == 'variable') {
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
				elseif( $type == 'php' ){
					 
					$expr = trim($token['expression']);
						
						if( substr($expr,0,1) == "{"){
							$expr = substr($expr,1);
						}
						$len = strlen( $expr);
						if( substr($expr,$len-1,1) == '}'){
							$expr  = substr($expr,0, $len-1 );
						}
						$token['code'] = $expr . ';';
				}
				elseif( $type == 'escaped' ){
					$tag = trim($token['tag'],'\\');
					$token['code'] =  ' $__output .=   \''.$tag .'\';';
					
				}
				elseif( $type == "tag" ){
					$function_name = $token['function_name'];
					$attrs = $token['attrs'];
					$args = "[";
					foreach ( $attrs as $k=> $v ){
						$args .= "\"" . $k ."\" => " . $v . ",";
					}
					$args .= "]";
					$token['code'] =  ' $__output .= '.$function_name .'( '.$args.') ;';
				}
			}
			$this->tokens[$i] = $token;
		}
		
		  $sectionNameStack = [];
		  $sectionName = "";
		  for( $i=0;$i<$tokenCount; $i++ ){
		  	$token = $this->tokens[$i];
		  	$tag = @$token['tag'];
		  	if( $tag == 'section'){
		  		$expression = $token['expression'];
		  		$params = [];
		  		eval( "\$params = array" . $expression .";");
		  		$sectionName = $params[0];
		  		array_push( $sectionNameStack, $sectionName);
		  		
		  		$token['code'] = ' $__output .= $this->' . $sectionName . '(); ';
		  		if( count( $params ) == 2 ){
		  			$vars['sections'][$sectionName] = [ $params[1]];
		  			$sectionName = array_pop( $sectionNameStack );
		  			$sectionName = array_pop( $sectionNameStack );
		  		}
		  		else{
		  			
		  		}
		  		$sectionName2 = @$sectionNameStack[count( $sectionNameStack)-2];
		  		$vars['sections'][$sectionName2][] = $token;
		  		
		  	}
		  	elseif( $tag == 'endsection' ){
		  		$sectionName = array_pop( $sectionNameStack );
		  		$sectionName = array_pop( $sectionNameStack );
		  	}
		  	elseif( $tag == 'parent'){
		  		 
		  		$token['code'] = ' $__output .= parent::' . $sectionName . '();';
		  		$vars['sections'][$sectionName][] = $token;
		  	}
		  	else{
		  		$vars['sections'][$sectionName][] = $token;
		  	}
		}
		
		$data = $this->toPhp($vars);
		return $data;
	}
	
	public function toPhp($vars){	
		$output = "";
		$output = '<' . '?php '."\r\n";
		if( trim( @$vars['superClass'] ) != '' ){
			$output .= ' require_once \Wudimei\View::$compiled . \Wudimei\View::compile(\'' . 
						$vars['superViewName'] ."'); \r\n";
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
			if( $functionName == ""){
				$functionName = "__main__";
			}
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
	
	public function parseInclude( $token ){
		$viewNameOriginal = $token['expression'];
		$viewName = trim( $viewNameOriginal,'\'"()');
		
		return $viewName;
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