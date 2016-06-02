<?php
use Wudimei\Cache;

require_once __DIR__ .'/../autoload.php';

Cache::loadConfig(__DIR__.'/cache_config.php');

$value = ['yqr','yqr2'];
Cache::set('name', $value ,10  );

$val =  Cache::get('name');

 print_r( $val );
