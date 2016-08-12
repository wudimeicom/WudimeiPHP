<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;
class  ArrayHelper{
	
	public static function except($array,$keys){
		$arr = array();
		if( !empty( $array )){
			foreach ( $array as $k => $v ){
				if( in_array( $k , $keys) == false ){
					$arr[$k] = $v;
				}
			}
		}
		return $arr;
	}
	
	public static function divide( $arr ){
		$keys = array();
		$values = array();
		if( !empty( $arr )){
			foreach ( $arr as $k => $v ){
				$keys[] = $k;
				$values[] = $v;
			}
		}
		return [$keys, $values];
	}
	
	public static function getColumn($array, $columnName ){
		$rs = array();
		for( $i=0; $i< count( $array); $i++ ){
			$item = $array[$i];
			if( is_array( $item )){
				$rs[] = $item[$columnName];
			}
			else{
				$rs[] = $item->$columnName;
			}
		}
		return $rs;
	}
	
	public static function fetch( $array, $keys ){
		$kArr = explode(".", $keys);
		for( $i=0;$i<count( $kArr);$i++ ){
			$k = $kArr[$i];
			if( !isset($array[$k] )){
				throw new \Exception("Undefined inde '" . $k . "'");
			}
			else{
				$array= $array[$k];
			}
		}
		return $array;
	}
}