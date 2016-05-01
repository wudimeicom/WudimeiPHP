<?php

namespace Wudimei\Session;
class File  extends BasicSession
{

	public function __construct($config){
		parent::__construct($config);
	}
	
	function loadSession()
	{
		$id = $this->session_id;
		$lifetime =  $this->config["lifetime"];
		
		static $hasClean = false;
		
		if( $hasClean == false ){
			$this->gc( $lifetime );
			$hasClean = true;
			
		}
		if( !is_dir( $this->config["files"] )){
			@mkdir($this->config["files"],777,true);
		}
		$file = $this->config["files"]."/sess_".$id;
		if( $lifetime>0 ){
			if (@filemtime($file) + $lifetime < time() && file_exists($file)) {
				unlink($file);
			}
		}
		$content = '';
		if( file_exists( $file )){
			$content =  (string)@file_get_contents( $file );
		}
		$this->session_data = unserialize( $content);
	}

	function write($id, $data)
	{
		$data = serialize( $data );
		return file_put_contents($this->config["files"]."/sess_".$id, $data) === false ? false : true;
	}

	

	function gc($maxlifetime)
	{
		foreach (glob($this->config["files"]."/sess_*") as $file) {
			if( $maxlifetime >0 ){
				if (filemtime($file) + $maxlifetime < time() && file_exists($file)) {
					unlink($file);
				}
			}
		}

		return true;
	}
	
	
	
	
	public function __destruct(){
		 
		if( $this->hasChanged ){
			$this->write( $this->session_id, $this->session_data );
		}
	}
}
