<?php
namespace Wudimei;

class Redirect{
	
	public function to( $url ){
		header("location:".$url);
	}
}