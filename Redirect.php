<?php
namespace Wudimei;

class Redirect{
	
	public function to( $url ){
		header("location:".$url);
	}
	
	public function back(){
		$url = $_SERVER["HTTP_REFERER"];
		$this->to($url);
	}
}