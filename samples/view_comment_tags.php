<?php
require_once __DIR__ .'/../autoload.php';
//use Wudimei\View;
use Wudimei\StaticProxies\View;


View::loadConfig( __DIR__ . '/view_config.php' );
View::setForceCompile(true);
View::setSkipCommentTags( true ); // skip <!-- and -->

$vars = [
		'success' => true		,
		'role' => 'admin'	,
		'years' => [2016,2017,2018,2019]
];

echo View::make("default.index.comment_tags",$vars );