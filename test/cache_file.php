<?php
use Wudimei\Cache;

require_once __DIR__ .'/../autoload.php';

Cache::loadConfig(__DIR__.'/cache_config.php');
Cache::set('name','yqr',50 );

print_r( Cache::$config );
