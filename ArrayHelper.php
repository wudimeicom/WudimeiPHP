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
	
	public static function only($array,$keys){
	    if( is_string( $keys ) ){
	        $keys = explode(",", $keys );
	    }
	    $arr = array();
	    if( !empty( $array )){
	        foreach ( $array as $k => $v ){
	            if( in_array( $k , $keys) == true ){
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
		$result = $array;
		for( $i=0;$i<count( $kArr);$i++ ){
			$k = $kArr[$i];
			if( !isset($result[$k] )){
				//throw new \Exception("Undefined index '" . $k . "'");
				$result = null;
				break;
			}
			else{
				$result= $result[$k];
			}
		}
		return $result;
	}
	
	public static function set( &$array, $keys , $value ){
		$kArr = explode(".", $keys);
		$cursor = &$array;
		for( $i=0;$i<count( $kArr);$i++ ){
			$k = $kArr[$i];
			if( !isset($cursor[$k] )){
				//throw new \Exception("Undefined index '" . $k . "'");
				$cursor = null;
				break;
			}
			else{
				$cursor= &$cursor[$k];
			}
		}
		if( $cursor != null ){
			$cursor = $value;
			 
		}
		return $array;
	}
	
	public static function toAssoc( $array_2d , $keyFiledName, $valueFieldName ){
		$arr = [];
		if( !empty( $array_2d )){
			foreach ( $array_2d as $item ){
				$key = "";
				$value = "";
				if( is_array( $item ) && isset( $item[$keyFiledName])){
					$key = $item[$keyFiledName];
				}
				elseif( isset( $item->{$keyFiledName} ) ){
					$key = $item->{$keyFiledName};
				}
				
				if( is_array( $item ) && isset( $item[$valueFieldName])){
					$value = $item[$valueFieldName];
				}
				elseif( isset( $item->{$valueFieldName} ) ){
					$value = $item->{$valueFieldName};
				}
				$arr[ $key] = $value;
			}
		}
		return $arr;
	}
	
	public static function groupBy( $array_2d , $fieldName ){
		$arr = [];
		if( !empty( $array_2d )){
			foreach ( $array_2d as $item ){
				$value = "";
				if( is_array( $item ) && isset( $item[$fieldName])){
					$value = $item[$fieldName];
				}
				elseif( isset( $item->{$fieldName} ) ){
					$value = $item->{$fieldName};
				}
				if( !isset( $arr[ $value] )){
					$arr[ $value] = [];
				}
				$arr[ $value][] = $item;
			}
		}
		return $arr;
	}
}