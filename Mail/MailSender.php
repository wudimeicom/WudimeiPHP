<?php
namespace Wudimei\Mail;

class MailSender{
	/**
	 * pending array("name"=>"","email"=>"")
	 * @var type string
	 */
	public $from = "";
	
	 
	/**
	 *
	 * @var array
	 */
	public $to = array();
	public $cc = array();
	public $bcc = array();
	
	public $subject = "";
	public $content = "";
	
	public $charset = "UTF-8";
	public $contentType = "text/html";
	public $debug = false;
	
	public function to($to)
	{
		$this->to = $to;
		return $this;
	}
	
	public function cc($cc)
	{
		$this->cc = $cc;
		return $this;
	}
	public function bcc($bcc)
	{
		$this->bcc = $bcc;
		return $this;
	}
	
	public function subject($subject)
	{
		$this->subject = $subject;
		return $this;
	}
	
	public function content($content)
	{
		$this->content = $content;
		return $this;
	}
	
	public function contentType($contentType)
	{
		$this->contentType = $contentType;
		return $this;
	}
	
	public function debug($debug)
	{
		$this->debug = $debug;
		return $this;
	}
	
	public function setProperties( $cfg ){
		foreach ( $cfg as $k => $v ){
			if( property_exists( get_class( $this), $k)){
				$this->{$k} = $v;
			}
		}
	}
	
	public function getEmailAddressArray($address){
		
		$resultArray = [];
		if( is_string( $address )){
			
			$arr = explode(",", $address );
			for( $i=0; $i< count( $arr ); $i++ ){
				$item = $arr[$i];
				if( strpos( $item, '<') === false ){
					$resultArray[] = '<' . $item . '>';
				}
				else{
					$resultArray[] = $item;
				}
				
			}
		}
		elseif( is_array( $address)){
			if( isset( $address['address'])){
				$resultArray[] = @$address['name'] . ' <' . $address['address'] . '>';
			}
			elseif( isset( $address[0]['address'] )) {
				foreach ( $address as $addr ){
					$resultArray[] = @$addr['name'] . ' <' . $addr['address'] . '>';
				}
			}
			elseif( isset($address[0] ) && is_string( $address[0]  )){
				$resultArray[] =   ' <' . $address[0] . '>';
			}
		}
		return $resultArray;
	}
	/**
	 * pending array("name"=>"","email"=>"")
	 * @var type string
	 */
	public function formatEmailAddresses($address){
		
		$resultArray = $this->getEmailAddressArray($address);
		return implode(',', $resultArray );
	}
}