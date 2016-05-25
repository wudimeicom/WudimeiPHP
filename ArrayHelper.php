<?php
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
}