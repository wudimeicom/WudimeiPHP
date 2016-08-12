<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;
class Cache{
	public $config;
	public  $stores;
	/**
	 * 
	 * @param string $file
	 * @throws \Exception
	 */
	public  function loadConfig( $file ){
		if( file_exists( $file ) ){
			$config = include $file;
			$this->config = $config;
		}
		else{
			throw new \Exception('cache configuration file ' . $file . ' does not exists');
		}
	}
	/**
	 * 
	 * @param string $name
	 * @param mixed $value
	 * @param int $lifetime
	 * @return void
	 */
	public  function set($name,$value,$lifetime=  30){
		return $this->store()->set($name,$value,$lifetime);
	}
	/**
	 * 
	 * @param string $name
	 * @return mixed
	 */
	public  function get( $name ){
		return $this->store()->get( $name );
	}
	/**
	 * 
	 * @param string $name
	 * @return \Wudimei\Cache\File
	 */
	public  function store( $name = ""){
		if( $name == "" ){
			$name = $this->config['default'];
		}
		if( isset( $this->stores[$name] ) ){
			return $this->stores[$name];
		}
		else{
			$cfg = $this->config['stores'][$name];
			$cfg['prefix'] = $this->config['prefix'];
			$driver = $cfg['driver'];
			$obj = null;
			if( $driver == 'file' ){
				$obj = new \Wudimei\Cache\File($cfg);
			}
			else{
				$driverCls = ucfirst( $driver);
				$buildinDriverCls = '\\Wudimei\\Cache\\' . $driverCls;
				$userDriverCls = '\\' . $driverCls;
				if( class_exists( $buildinDriverCls ) ){
					$obj = new $buildinDriverCls( $cfg );
				}
				elseif( class_exists($userDriverCls)){
					$obj = new $userDriverCls( $cfg );
				}
			}
			return $this->stores[$name] = $obj;
		}
	}
}