<?php
use Wudimei\Validator;

require_once __DIR__ .'/../autoload2.php';

DB::loadConfig(__DIR__ . "/db_config.php" );
Lang::loadConfig( __DIR__ . '/lang_config.php');

Lang::setLocale("en");
Lang::setLocale("zh-cn");
//Lang::set('fieldlabels.login','username');

/*
Lang::groupUpdate('fieldlabels',[
	'login' => 	'用户名',
	'tel' => 'Telphone Number ',
	'email' => 'Your email',
	'confirm_password' => '确认密码',
	'password' => '密码'
]); */
Lang::groupAppend('fieldlabels','validator_test');

$v = new Validator();

$_POST_DATA = [
		'login'=> 'yq_' , 
		'password' => 'a',
		'confirm_password'=>'addddddddddddddddd',
		'tel' => '8613714715608a',
		'score' => '65.5a',
		'age' =>  2 ,
		'month' => 10,
];

$rules = [
		//'login'=> 'required;unique:users,username' , 
		'login'=> 'required; alpha_num_dash;email:true ; unique:users,username,21,id; rangelength:3,30' ,
		'password'=> 'required' ,
		'confirm_password' => 'required; equalTo:password; minlength:5; maxlength:6' ,
		'tel' => 'digits:true',
		'score' => 'number' ,
		'age' => 'min:18; max:65' ,
		'month' => 'range:1,12'
];

$messages = [
		/*
		//'login.required'=>'please enter login.',
		//'login.email'=>'must be an email. ',
		'login.unique' => 'username should be unique',
		'login.rangelength' => 'username length 4-30',
		'confirm_password.required' => 'please enter confirm_password',
		//'confirm_password.equalTo' => 'confirm_password should be same as password',
		'confirm_password.minlength' => 'please enter at lease 5 chars',
		'confirm_password.maxlength' => 'please enter less than 6 chars',
		//'tel.digits' => 'please enter a valid telphone number',
		'score.number' => 'please enter a vlaid score',
		'age.min' => 'age must greater than 18',
		'age.max' => 'age must less than 65',
		'month.range' => 'month should be in 1-12', */
];

$areValid = $v->validate( $_POST_DATA ,$rules, $messages);
var_dump( $areValid );
print_r( $v->errors );


