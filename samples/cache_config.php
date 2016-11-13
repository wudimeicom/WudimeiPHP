<?php
return [ 
		
		/*
		 * |--------------------------------------------------------------------------
		 * | Default Cache Store
		 * |--------------------------------------------------------------------------
		 * |
		 * | This option controls the default cache connection that gets used while
		 * | using this caching library. This connection is used when another is
		 * | not explicitly specified when executing a given caching function.
		 * |
		 */
		
		'default' =>   'file'  , // or 'file_2',see below

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the cache "stores" for your application as
    | well as their drivers. You may even define multiple stores for the
    | same cache driver to group types of items stored in your caches.
    |
    */

    

        
	'stores' => [
	    'database' => [ 
			'driver' => 'database',
			'table' =>  'cache'  ,
			'connection' => null 
		],
			
		'file' => [ 
			'driver' => 'file',
			'path' => __DIR__.'/storage/cache' 
		 ],
		
		'file_2' => [
			'driver' => 'file',
			'path' => __DIR__.'/storage/cache_2'
		],
			
		'memcached' => [ 
			'driver' => 'memcached',
			'servers' => [ 
				[ 
					'host' => '127.0.0.1' ,
					'port' =>  11211  ,
					'weight' => 100 
				] 
			] 
		],
			
		'redis' => [ 
			 'driver' => 'redis',
			 'connection' => 'default' 
		],
	],
    

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | When utilizing a RAM based store such as APC or Memcached, there might
    | be other applications utilizing the same cache. So, we'll specify a
    | value to get prefixed to all our keys so we can avoid collisions.
    |
    */

    'prefix' => 'wudimei' 
]
;
