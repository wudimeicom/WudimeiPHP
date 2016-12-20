<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;

class Event{
    
    protected  $listeners = [];
    public function __construct(){
        
    }
    
    public function listen($eventName,$callback, $priority = 1024 ){
        if(!isset( $this->listeners[$eventName])){
            $this->listeners[$eventName] = [];
        }
        $keys = array_keys( $this->listeners[$eventName]);
        if( array_search( $priority, $keys) !== false ){
            $priority ++;
           while (  array_search( $priority, $keys) !== false  ){
               $priority ++;
           }
        }
        $this->listeners[$eventName][$priority] = $callback;
        ksort( $this->listeners[$eventName] ,SORT_NUMERIC|SORT_DESC);
    }
    
    public function fire($eventName, ...$args ){
        //echo $eventName;
      //print_r( $args);
        $param_arr = $args;
       //  array_shift( $param_arr);
       
        list( $eventGroup,$action ) = explode( "." , $eventName );
        if( $action == "*" ){
            foreach ( $this->listeners as $evtName2 => $events ){
                list( $eventGroup2, $action2) = explode(".", $evtName2 );
                    if( $eventGroup == $eventGroup2 ){
                        if( !empty( $events)){
                            foreach ( $events as $eventCallback ){
                                call_user_func_array( $eventCallback, $param_arr);
                            }
                        }
                    }
            }
        }
        else{
            $events = @$this->listeners[$eventName];
            if( !empty( $events)){
                foreach ( $events as $eventCallback ){ 
                   // print_r( $param_arr );
                    call_user_func_array( $eventCallback, $param_arr);
                }
            }
        }
    }
    
}