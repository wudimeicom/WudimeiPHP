<?php 

use Wudimei\ArrayHelper;

require_once __DIR__ .'/../autoload.php';

$arr = ["langs"=>["desk"=>["php"=>"php5"]]];
$dt = ArrayHelper::fetch($arr, "langs.desk.php");
$dt = ArrayHelper::fetch($arr, "langs.desk");
$dt = ArrayHelper::fetch($arr, "langs");
 
print_r( $dt );

?>