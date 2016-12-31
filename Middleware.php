<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;
class Middleware{
    public $controller;
    public $controllerClassName;
    public $controllerName;
    public $actionName;
    
    public static $middlewares = array();
    
    public static function runMiddlewares( $middlewares , $method = "startUp" , $controller = null ){
        for( $i=0; $i <count( $middlewares ); $i++ ){
            $class = $middlewares[$i];
            if( !isset( static::$middlewares[$class])){
                $class2 = "App\\Middlewares\\" . $class;
                if( class_exists( $class2)){
                    static::$middlewares[$class] = new $class2();
                    
                }
                elseif( class_exists( $class)){
                    static::$middlewares[$class] = new $class();
                }
                static::$middlewares[$class]->controller = $controller;
                static::$middlewares[$class]->controllerClassName  = $ccName= \Router::controller();
                static::$middlewares[$class]->actionName = \Router::action();
                $ccNameArr = explode("\\", $ccName);
                $ccName2 = $ccNameArr[ count( $ccNameArr)-1];
                $ccName2 = strtolower(str_replace("Controller", "", $ccName2));
                static::$middlewares[$class]->controllerName = $ccName2;
            }
            
           $ret =  static::$middlewares[$class]->$method();
           if( method_exists( $ret, "sendResponse")){
               return $ret;
           }
        }
        
    }
}