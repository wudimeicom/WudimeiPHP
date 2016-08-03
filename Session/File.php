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
		
		
		//if( rand(0, $this->config['gc_max_random_num']) == 0  ){
			 //echo 'gc';
		$this->gc(  );
		//}
		$file = $this->getSessionFileName();
		
		$content = '';
		if( file_exists( $file )){
			$this->tryGcFile($file);
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

	function gc( )
	{
		$last_gc_time_filename = $this->config["files"] . "/last_gc_time.txt";
		$last_gc_time = @file_get_contents( $last_gc_time_filename );
		$last_gc_time = intval( $last_gc_time );
		if( $last_gc_time + $this->config["gc_maxlifetime"] < time() ){
			$this->gcDir(  $this->config["files"] );
			file_put_contents( $last_gc_time_filename, time() );
		}
		
		return true;
	}
	
	function gcDir(  $dir ){
		
		$dir = realpath( $dir );
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
				$this->gcFile($file);
			}
		}
		
	}
	
	public function gcFile($file){
		$lifetime =  $this->config["lifetime"];
		$gc_maxlifetime = $this->config['gc_maxlifetime'];
		if( $lifetime>0){ //if lifetime equals 0,will expire on close
			$gc_maxlifetime = $lifetime;
		}
		if (filemtime($file) + $gc_maxlifetime < time() && file_exists($file)) {
			if( strpos($file, "last_gc_time.txt") === false){
				unlink($file);
			}
		}
	}
	
	public function tryGcFile($file){
		$this->gcFile($file);
	}
	
}
