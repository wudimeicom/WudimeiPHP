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
	
	public  function setPath( $path2 ){
		$this->path = $path2;
	}
	
	public  function  setLocale( $locale ){
		$this->locale = $locale;
	}
	
	public  function load($group){
		$file = $this->path . "/" . $this->locale . "/" . $group . ".php";
		$langs2 = include $file;
		if( !empty( $langs2)){
			$this->langs = array_merge( $this->langs,$langs2);
		}
	}
	
	public  function  get( $name, $args = array() ){
		$lang = ArrayHelper::fetch( $this->langs, $name );
		if( !empty( $args ) ){
			foreach ( $args as $k => $v ){
				$lang = str_replace(":" . $k, $v, $lang );
			}
		}
		return $lang;
	}
}