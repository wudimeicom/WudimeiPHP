<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;
class Lang{
	public  $locale;
	public  $autoDetectLanguage;
	public  $language_mapping;
	public  $path;
	public  $langs = array();
	public  $loadedFiles = [];
	
	/**
	 * 
	 * @param string $configFile
	 */
	public  function loadConfig( $configFile ){
		$config = include $configFile;
		$this->locale = $config['locale'];
		$this->autoDetectLanguage = $config['autoDetectLanguage'];
		$this->language_mapping  = $config['language_mapping'];
		$this->path = $config['path'];
		if( $this->autoDetectLanguage == true ){
		   $this->autoDetectLanguage();
		}
	}
	public  function autoDetectLanguage(){
	    /**
	     * 
	     * @var string language folder name,eg:cn,en
	     */
	    $lang = \Session::get("__language");
	    if( is_null( $lang)){
	        $lang = @$_COOKIE['__language'];
	    }
	    if( is_null( $lang)){
	        $al = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	        //echo $al;
	        $larr = preg_split('/[,;]/', $al);
	        //print_r( $larr );
	        for( $i=0;$i<count( $larr);$i++){
	            $l = $larr[$i];
	            if( strpos($l, 'q=') === false ){
	                //echo $l;
	                $lang2 = $this->findLanguageFromLanguageMapping($l);
	                if( $lang2 != null ){
	                    $lang = $lang2;
	                    //echo $lang;
	                    break;
	                }
	            }
	        }
	    }
	    if( is_null( $lang)){
	        $lang = $this->locale;
	    }
	   
	    $this->locale = $lang;
	}
	
	public function findLanguageFromLanguageMapping($l){
	    foreach ($this->language_mapping as $lang => $arr ){
	        if( array_search( $l, $arr) !== false ){
	            return $lang;
	        }
	    }
	    return null;
	}
	        
	/**
	 * 
	 * @param string $path2
	 */
	public  function setPath( $path2 ){
		$this->path = $path2;
	}
	/**
	 * 
	 * @param string $locale
	 */
	public  function  setLocale( $locale ){
		$this->locale = $locale;
	}
	/**
	 * 
	 * @param string $group
	 * @param bool $reload
	 * @return void
	 */
	public  function load($group , $reload = false){
		$file = $this->path . "/" . $this->locale . "/" . $group . ".php";
		$loaded =  array_search( $file, $this->loadedFiles ) !== false;
		if( $loaded == false || $reload == true ){
			$this->loadedFiles[] = $file;
			$langs = [];
			if( file_exists( $file )){
				$langs = include $file;
			}
			$this->langs[ $group ] = $langs;
		}
	}
	/**
	 * 
	 * @param string $group
	 */
	public  function reload($group){
		$this->load( $group, true );
	}
	
	/**
	 * 
	 * @param string $name
	 * @param array $args
	 */
	public  function  get( $name, $args = array() ){
		$tokens = explode(".", $name );
		 
		if( count( $tokens)<=1 ){
			return $name;
		}
		$this->load( $tokens[0] );
		
		$lang = ArrayHelper::fetch( $this->langs, $name );
		
		if( !empty( $args ) ){
			foreach ( $args as $k => $v ){
				$lang = str_replace("{" . $k."}", $v, $lang );
			}
		}
		return $lang;
	}
	/**
	 * 
	 * @param string $name
	 * @param string $value
	 */
	public function set( $name, $value ){
		$nArr = explode(".", $name );
		$group = $nArr[0];
		$name = $nArr[1];
		if( !isset( $this->langs[ $group] )){
			$this->langs[ $group] = array();
		}
		$this->langs[ $group][ $name] = $value;
	}
	
	public function transAll( $var ){
	     if( is_null($var)){
	         return null;
	     }
	     elseif( is_numeric( $var )){
	         return $var;
	     }
         elseif( is_string( $var )){
             $var = $this->get( $var );
         }
         elseif( is_array( $var )){
             foreach ( $var as $k => $v ){
                 $var[$k] = $this->transAll( $v );
             }
         }
         elseif( is_object( $var )){
             foreach ( $var as $property => $value ){
                   $var->{$property} = $this->transAll( $value );
             }
         }
	    return $var;
	}
	/**
	 * 
	 * @param string $groupName
	 * @param array $value
	 */
	public function groupUpdate( $groupName , $value){
		$this->langs[ $groupName ] = $value;
		 $this->loadedFiles[] = $this->path . "/" . $this->locale . "/" . $groupName . ".php"; //the file may not real exists
	}
	
	/**
	 * append a group or array to the group
	 * @param string $groupName
	 * @param string|array $groupName2OrArray
	 * @param bool $replace
	 */
	public function groupAppend( $groupName, $groupName2OrArray , $replace = true ){
		$this->load($groupName);
		$data = [];
		if( is_array( $groupName2OrArray ) ){
			$data = $groupName2OrArray;
		}
		else{
			$this->load( $groupName2OrArray );
			$data = $this->langs[ $groupName2OrArray];
		}
		if( !empty( $data)){
			foreach ($data as $k => $v ){
				if( isset( $this->langs[$groupName][$k])){
					if( $replace == true ){
						$this->langs[ $groupName ][$k] = $v;
					}
				}
				else{
					$this->langs[ $groupName ][$k] = $v;
				}
				
			}
		}
		
	}
}