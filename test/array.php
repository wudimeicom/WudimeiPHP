<?php 

use Wudimei\ArrayHelper;

require_once __DIR__ .'/../autoload.php';

$arr = ["langs"=>["web"=>["php"=>"php5"]]];
$dt = ArrayHelper::fetch($arr, "langs.web.php");
//$dt = ArrayHelper::fetch($arr, "langs.web");
//$dt = ArrayHelper::fetch($arr, "langs");
 
//$arr2 = ArrayHelper::set( $arr, "langs.web.php", "php7777");
//print_r( $arr );
//print_r( $arr2 );

print_r( $dt );

?>