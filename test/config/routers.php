<?php 
return [
	[
		'namespace' => 'App\\Frontend', 'prefix' => 'admin', 'domain' => '{account}.myapp.com' ,
		'items' => [
			'login' => [
				'uri' => '/login',
				'verbs' => 'get',
				'Closure' => 'UserController@login'
			],
			'logout' => [
					'uri' => '/logout',
					'verbs' => 'get',
					'Closure' => 'UserController@logout'
			]
		]
	]	
];
?>