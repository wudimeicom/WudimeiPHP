<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;

require_once __DIR__.'/View/html.php';
require_once __DIR__.'/View/function.php';

use Wudimei\View\Tokenizer;
use Wudimei\View\Parser;



class View{
	
	public  $path;
	public  $compiled;
	public  $vars;
	public  $forceCompile = false;
	public  $skipCommentTags = false;
	/**
	 * load config array into View from file 
	 * @param string $file config file name
	 * @return void
	 */
	public  function loadConfig($file){
		$config = include $file;
		$this->path = $config['path'];
		$this->compiled = $config['compiled'];
		$this->forceCompile = $config['forceCompile'];
		$this->skipCommentTags = $config['skipCommentTags'];
		
		if( !is_dir( $this->path )){
			mkdir( $this->path ,0777,true );
		}
		if( !is_dir( $this->compiled )){
			mkdir( $this->compiled ,0777,true );
		}
	}
	/**
	 * 
	 * @param string $viewName view's name,eg default.article.index
	 * @param array $vars
	 * @return string 
	 */
	public  function make( $viewName, $vars ){
		$destFile = $this->compile($viewName);
		  
		$__tmpView = $this; 
		require_once $this->compiled .$destFile ;
		$className = Parser::getViewClassName( $viewName  );
		$obj = new $className(  $vars );
		$obj->__view = $this;
		$return = $obj->__main__();
		
		
		return $return;
	}
	
	/**
	 * 
	 * @param string $viewName view's name,eg default.article.index
	 * @return string return the dest view's relative path
	 */
	public  function compile( $viewName ){
		$viewName2 =  str_replace(".", "/", $viewName );
		$viewFile = $this->path . "/" . $viewName2 . ".view.phtml";
		$destFile = $this->compiled . "/" . $viewName2 . ".view.phtml";
		
		if( $this->forceCompile ==  false ){
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
		$parser->path = $this->path;
		$parser->compiled = $this->compiled; //compiled dir
		$parser->tokens = $tokens;
		$parser->viewName = $viewName;
		$parser->view = $this;
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
	
	/**
	 * 
	 * @param bool $bool
	 * @return void
	 */
	public function setForceCompile( $bool = true ){
		$this->forceCompile = $bool;
	}
	
	public function getForceCompile(){
		return $this->forceCompile;
	}
	
	public function setSkipCommentTags( $bool = true ){
		$this->skipCommentTags = $bool;
	}
	
	public function getSkipCommentTags(){
		return $this->skipCommentTags;
	}
}