<?php


require_once __DIR__ .'/../autoload2.php';

Lang::loadConfig( __DIR__ . '/lang_config.php');
Lang::setLocale("en");
Lang::setLocale("zh-cn");
//Lang::setPath(__DIR__ . "/lang");
Lang::load("lang_test");
//Lang::load("index");
//Lang::reload("index");
$val = Lang::get("lang_test.name");
echo $val; echo "<br />";

$val = Lang::get("lang_test.hello",['name'=>'yqr']);
echo $val;

