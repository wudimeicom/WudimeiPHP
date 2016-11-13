<?php
namespace Wudimei\StaticProxies;
class Alert{
    use \Wudimei\StaticProxy;
    
    public static function createObject(){
        return new \Wudimei\Alert();
    }
}