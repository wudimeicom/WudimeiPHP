<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;
	
	class Config{
		public $dir;
		public $data;
		public function setDir( $dir ){
			$this->dir = $dir;
		}
		
		public function get( $keys ){
			
			$arr = explode(".", $keys);
			$sectionName = $arr[0];
			$this->load($sectionName);
			//print_r( $this->data);
			return ArrayHelper::fetch( $this->data, $keys);
			
		}
		
		public function load( $sectionName ){
			if( !isset($this->data[ $sectionName] )){
				$file = $this->dir . "/" . $sectionName . ".php";
				$this->data[ $sectionName] = [];
				if( file_exists( $file)){
					$this->data[ $sectionName] = include $file;
				}
					
			}
		}
		public function set( $keys , $value ){
			$arr = explode(".", $keys);
			$sectionName = $arr[0];
			$this->load($sectionName);
			
			 ArrayHelper::set( $this->data, $keys, $value);
			 //print_r( $this->data );
		}
	}


