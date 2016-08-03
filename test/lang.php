<?php
use Wudimei\Lang;

require_once __DIR__ .'/../autoload.php';

Lang::setLocale("en");
//Lang::setLocale("zh-cn");
Lang::setPath(__DIR__ . "/lang");
Lang::load("index");

$val = Lang::get("name");
echo $val; echo "<br />";

$val = Lang::get("hello",['name'=>'yqr']);
echo $val;