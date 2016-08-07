<?php
namespace Wudimei;
class Session{
	public  $session;
	public  function loadConfig( $file ){
		if( file_exists( $file ) ){
			$config = include $file;
			$driver = $config['driver'];
			if( $driver == 'file'){
				$session = new \Wudimei\Session\File($config);
			}
			$this->session = $session;
		}
		else{
			throw new \Exception('sesstion config file "' . $file . '" does not exists');
		}
		

	}
	
	public  function start(){
		//session_start();
		$this->session->start();
	}
	
	public  function set( $name,$value ){
		return $this->session->set( $name,$value );
	}
	
	public  function get( $name ,$default = null ){
		$value = $this->session->get( $name  );
		if( is_null( $value) || !isset( $value)){
			return $default;
		}
		return $value;
	}
	
	public  function all(){
		//session_start();
		return $this->session->all();
	}
	
	public  function delete( $name ){
		return $this->session->delete( $name );
	}
	
	public  function destroy()
	{
		return $this->session->destroy();
	}
}