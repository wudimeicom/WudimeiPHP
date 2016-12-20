<?php
namespace Wudimei\StaticProxies;
class Event{
    use \Wudimei\StaticProxy;

    public static function createObject(){
        return new \Wudimei\Event();
    }
}