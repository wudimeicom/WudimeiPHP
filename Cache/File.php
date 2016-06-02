<?php
namespace Wudimei\Cache;
class File{
	
	public $config;
	
	public function __construct( $cfg ){
		$this->config = $cfg;
	}
	
	public  function set($name,$value,$lifetime=  30){
		$filename = $this->getCacheFileName($name);
		$dir = dirname( $filename );
		if( is_dir( $dir ) == false){
			@mkdir( $dir ,0777, true );
		}
		$data = ['lifetime' => $lifetime ,'data' => $value ];
		$data2 = serialize( $data );
		file_put_contents($filename, $data2);
	}
	
	public function get( $name ){
		 $filename = $this->getCacheFileName($name);
		 if( file_exists( $filename )){
		 	$cnt = file_get_contents( $filename);
		 	$data =  unserialize( $cnt );
		 	$lifetime = $data['lifetime'];
		 	
		 	$filemtime = filemtime($filename);
		 	if( $filemtime + $lifetime> time() ){
		 		return $data['data'];
		 	}
		 	else{
		 		//@unlink($filename);
		 		return null;
		 	}
		 }
		 return '';
	}
	
	private function getCacheFileName( $name ){
		$path = $this->config['path'];
		$prefix = $this->config['prefix'];
		$name2 = $prefix .$name;
		$name3 = md5( $name2 );
		$a = substr( $name3, 0,1);
		$b = substr($name3, 1,1);
		$dir = $path . "/" . $a . "/" . $b ;
		$file = $dir . "/" . $name3;
		return $file;
	}
}