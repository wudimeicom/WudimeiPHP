<?php

namespace Wudimei;

use Wudimei\View\Tokenizer;
use Wudimei\View\Parser;

class View{
	
	public static $path;
	public static $compiled;
	public static $vars;
	public static $forceCompile = false;
	
	public static function loadConfig($file){
		$config = include $file;
		self::$path = $config['path'];
		self::$compiled = $config['compiled'];
		self::$forceCompile = $config['forceCompile'];
		
		if( !is_dir( self::$path )){
			mkdir( self::$path ,0777,true );
		}
		if( !is_dir( self::$compiled )){
			mkdir( self::$compiled ,0777,true );
		}
	}
	
	public static function make( $viewName, $vars ){
		$destFile = self::compile($viewName);
		  
		 
		require_once self::$compiled .$destFile ;
		$className = Parser::getViewClassName( $viewName  );
		$obj = new $className(  $vars );
		$return = $obj->__main__();
		
		
		return $return;
	}
	
	public static function compile( $viewName ){
		$viewName2 =  str_replace(".", "/", $viewName );
		$viewFile = self::$path . "/" . $viewName2 . ".view.phtml";
		$destFile = self::$compiled . "/" . $viewName2 . ".view.phtml";
		
		if( self::$forceCompile ==  false ){
			if( file_exists( $destFile) && @filemtime( $viewFile) < filemtime( $destFile)){
				//echo "no compile! " . $viewName . ' ! ';
				return "/" . $viewName2 . ".view.phtml";
			}
			else{
				//echo 'compile agiain !' . $viewName . ' . ';
			}
		}
		//echo 'test';
		 
		$content = file_get_contents($viewFile);
		
		$tokenizer = new Tokenizer();
		$tokens = $tokenizer->tokenize($content);
		
		$parser = new Parser();
		$parser->path = self::$path;
		$parser->compiled = self::$compiled;
		$parser->tokens = $tokens;
		$parser->viewName = $viewName;
		$result = $parser->parse();
		//echo $result;
		$destDir = dirname( $destFile );
		if( !is_dir( $destDir )){
			mkdir( $destDir,0777,true );
		}
		file_put_contents( $destFile, $result );
		//unset( $tokenizer );
		//unset( $parser );
		return   "/" . $viewName2 . ".view.phtml";
	}
}