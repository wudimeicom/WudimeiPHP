<?php
namespace Wudimei\StaticProxies;
class Security{
    use \Wudimei\StaticProxy;
    
    public static function createObject(){
        return new \Wudimei\Security();
    }
}
