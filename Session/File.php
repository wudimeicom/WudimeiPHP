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
		
		
		$this->gc( $lifetime );
		$file = $this->getSessionFileName();
		
		$content = '';
		if( file_exists( $file )){
			$content =  (string)@file_get_contents( $file );
		}
		$this->session_data = unserialize( $content);
	}

	
	
	function saveSession()
	{
		$data = serialize( $this->session_data );
		$filePath = $this->getSessionFileName();
		$dir = dirname( $filePath );
		if( !is_dir( $dir )){
			mkdir( $dir ,0777, true );
		}
		return file_put_contents( $filePath , $data) === false ? false : true;
	}

	public function getSessionFileName(){
		$folder = substr( $this->session_id, 0,2);
		$filePath = $this->config["files"]. "/" . $folder . "/" . $this->session_id;
		return $filePath;
	}

	function gc($maxlifetime)
	{
		$this->gcDir($maxlifetime, $this->config["files"] );
		
		return true;
	}
	
	function gcDir($maxlifetime, $dir ){
		$gc_maxlifetime = $this->config['gc_maxlifetime'];
		if( $dir == "" || $dir = "/" || strlen( $dir )<3){ //protect file system
			return false;
		}
		$files = glob($dir."/*");
		 
		foreach ($files as $file) {
			$path = $dir . "/" . basename($file);
			if( is_dir( $path )){
				$this->gcDir($maxlifetime, $path );
			}
			else{
				if( $maxlifetime>0 ){
					$gc_maxlifetime = $maxlifetime;
				}
				if (filemtime($file) + $gc_maxlifetime < time() && file_exists($file)) {
					unlink($file);
				} 
			}
		}
		
	}
	
	
}
