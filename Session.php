<?php
namespace Wudimei;
class Session{
	public  $session;
	/**
	 * load config array from file
	 * @param string $file
	 * @throws \Exception
	 * @return void
	 */
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
	
	/**
	 * session start
	 * @return void
	 */
	public  function start(){
		//session_start();
		$this->session->start();
	}
	/**
	 * set data to session from name $name
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	public  function set( $name,$value ){
		return $this->session->set( $name,$value );
	}
	/**
	 * get session item value by $name,if null then return the $default
	 * @param string $name
	 * @param mixed $default
	 * @return mixed
	 */
	public  function get( $name ,$default = null ){
		$value = $this->session->get( $name  );
		if( is_null( $value) || !isset( $value)){
			return $default;
		}
		return $value;
	}
	/**
	 * get all session
	 */
	public  function all(){
		//session_start();
		return $this->session->all();
	}
	/**
	 * delete the sesion item by name
	 * @param string $name
	 * @return bool
	 */
	public  function delete( $name ){
		return $this->session->delete( $name );
	}
	/**
	 * remove all session data,empty it!
	 */
	public  function destroy()
	{
		return $this->session->destroy();
	}
}