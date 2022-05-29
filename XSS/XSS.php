<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei\XSS;

class XSS{
    public static function cleanDeep( $arr ){
        if( is_array( $arr )){
            foreach ( $arr as $k=> $v ){
                if( is_array( $v )){
                    $arr[$k] = $this->cleanDeep( $v );
                }
                else{
                    $arr[$k] = $this->clean( $v );
                }
    
            }
            return $arr;
        }
        else{
            return $arr;
        }
    }
}