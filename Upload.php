<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;

class Upload
{
	public $UploadDir = "";
	public $AllowExt = "";
	public $status = true;
	public $message = "";
	public function __construct( $UploadDir , $AllowExt )
	{
		parent::__construct();
		$this->UploadDir = $UploadDir ;
		if( is_string( $AllowExt ) )
		{
			$AllowExt = explode(",", $AllowExt );
		}
		$this->AllowExt  = $AllowExt ;
	}
	
	
	
	public function upload( $InputFileName  )
	{
		$baseName  =  basename($_FILES[$InputFileName]['name']);
		$uploadedFile = new Rong_IO_File( $_FILES[$InputFileName]['name'] );
	    if( !is_dir( $this->UploadDir ) )
	    {
	    	@mkdir( $this->UploadDir , 0777, TRUE );
	    }
		$uniqid = uniqid();
		$uploadFile = $this->UploadDir . "/" . $uniqid . "." . $uploadedFile->getExt();
                $strUploadFile = new Rong_Text_String( $uploadFile );
                
		if( in_array( $uploadedFile->getExt() ,   $this->AllowExt ) === false )
		{
			$this->status = false;
			$this->message = "file ext not allowed!";
			return "";
		}
		
		if ( move_uploaded_file( $_FILES[$InputFileName]['tmp_name'], $uploadFile ) )
		{
		    $this->status = true;
		    return  $uploadFile;
		}
		else 
		{
		   $this->status = false;
		   $this->message = "can not move_uploaded_file()";
		   return "";
		}
		
	}
	
	
	
	public function  getStatus()
	{
		return $this->status;
	}
	
	
	
	public function success()
	{
		return $this->status;
	}
	
	
	
	public function getMessage( )
	{
		return $this->message;
	}
	
	
	
}
?>
