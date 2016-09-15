<?php
namespace Wudimei;

use Wudimei\Mail\MailSender;

class Mail{
	/**
	 * 
	 * @var MailSender
	 */
	public $sender;
	public function loadConfig($configFile ){
		$cfg = include( $configFile );
		$driver = $cfg['driver'];
		$class = "\\Wudimei\\Mail\\" . $driver;
		if( class_exists( $driver )){
			$class = $driver;
		}
		$this->sender = new $class();
		$this->sender->setProperties($cfg);
	}
	
	public function __call($method, $args){
		//echo $method; print_r( $args );
		return call_user_func_array([$this->sender,$method], $args );
		
	}
}