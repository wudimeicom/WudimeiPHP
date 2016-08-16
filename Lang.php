<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;
class Lang{
	public  $locale;
	public  $path;
	public  $langs = array();
	public  $loadedFiles = [];
	public  function loadConfig( $configFile ){
		$config = include $configFile;
		$this->locale = $config['locale'];
		$this->path = $config['path'];
		
	}
	public  function setPath( $path2 ){
		$this->path = $path2;
	}
	
	public  function  setLocale( $locale ){
		$this->locale = $locale;
	}
	
	public  function load($group , $reload = false){
		$file = $this->path . "/" . $this->locale . "/" . $group . ".php";
		$loaded =  array_search( $file, $this->loadedFiles ) !== false;
		if( $loaded == false || $reload == true ){
			$this->loadedFiles[] = $file;
			
			$langs = include $file;
			$this->langs[ $group ] = $langs;
		}
	}
	public  function reload($group){
		$this->load( $group, true );
	}
	
	public  function  get( $name, $args = array() ){
		
		$lang = ArrayHelper::fetch( $this->langs, $name );
		//print_r( $lang );
		if( !empty( $args ) ){
			foreach ( $args as $k => $v ){
				$lang = str_replace(":" . $k, $v, $lang );
			}
		}
		return $lang;
	}
	
	public function set( $name, $value ){
		$nArr = explode(".", $name );
		$group = $nArr[0];
		$name = $nArr[1];
		if( !isset( $this->langs[ $group] )){
			$this->langs[ $group] = array();
		}
		$this->langs[ $group][ $name] = $value;
	}
	
	public function replaceGroup( $groupName , $langs){
		$this->langs[ $groupName ] = $langs;
	}
}