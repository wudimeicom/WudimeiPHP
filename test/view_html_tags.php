<?php
require_once __DIR__ .'/../autoload.php';
use Wudimei\View;

View::loadConfig( __DIR__ . '/view_config.php' );

$vars = [
		'name' => 'Yang Qing-rong'		,
		'site' => 'http://wudimei.com',
		'link' => '<a href="http://wudimei.com/">wudimei</a>'
];
View::$forceCompile = true;

echo View::make("default.index.html_tags",$vars );
?>
 
