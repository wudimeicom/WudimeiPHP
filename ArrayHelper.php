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
}