<?php
return array(
		//'driver' => 'eloquent',
		'model' => 'App\\User',
		'table' => 'w_users',
		/*
		'reminder' => array(
				'email' => 'emails.auth.reminder',
				'table' => 'password_reminders',
				'expire' => 60,
		),*/
		/**
		 * token name in cookie
		 */
		'token_name' => 'wudimei_tk',
		/**
		 * token lifetime,in seconds.
		 */
		'lifetime' =>  0,
		/**
		 * token's cookie path
		 */
		'path' => '/',
		/**
		 * token's cookie domain
		 */
		'domain' => null,
		 /**
		  * token's cookie secure
		  */
		'secure' => false,
		'httponly' => false,
);