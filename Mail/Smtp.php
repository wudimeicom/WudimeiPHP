<?php
//http://www.ietf.org/rfc/rfc0822.txt

namespace Wudimei\Mail;

class Smtp   extends MailSender{

    private $fp;
    public $host;
    public $port;
    public $username;
    public $password;
    public $encryption = 'none';
    
    

    public function __construct() {
        
        //$this->login();
       
    }
    
    public function connect()
    {
        $errorNo = "";
        $errorStr = "";
        if( $this->encryption != "none" )
        {
            $this->host = $this->encryption."://" . $this->host;
            // echo $this->host;exit();
        }
        //echo $this->host . $this->port; exit();
        $this->fp = fsockopen( $this->host , $this->port , $errorNo , $errorStr , 300 );
        //$this->fp = fopen("d:/email.log","a+");
        if (!$this->fp) {
            echo $errorNo . "," . mb_convert_encoding(  $errorStr,"UTF-8","GBK,GB18030,UTF-8");
            exit();
        } else {
        	$res = $this->receive();
        }
        
    }
    
    public function login() {
        $this->cmd("EHLO " . $this->host . "\r\n");
        $this->cmd("auth login\r\n");
        $this->cmd(base64_encode($this->username) . "\r\n");
        $this->cmd(base64_encode($this->password) . "\r\n");
    }

    public function cmd($cmd) {
        fputs($this->fp, $cmd);
        $res = $this->receive();
        if ($this->debug) {
            echo ">>" . $cmd . "<br />";
            echo "<<" . $res . "<br />";
        }
        return $res;
    }

    function receive() {
        $res = fgets($this->fp, 4096);
        $status = socket_get_status($this->fp);
        if ($status["unread_bytes"] > 0) {
            $res .= fread($this->fp, $status["unread_bytes"]);
        }
        return $res;
    }

   

    public function sendMail( ) {
        $this->cmd("mail from:" .  $this->from['address'] . "\r\n");
        
        $to2 = $this->getEmailAddressArray(  $this->to );
        
        for( $i=0; $i< count( $to2 ); $i++ )
        {
            $this->cmd("rcpt to: " . $to2[$i] . "\r\n");
        }
        $this->cmd("data\r\n");
        $this->cmd("subject:" . $this->subject . "\r\n" .
                "from: " . $this->formatEmailAddresses($this->from) . "\r\n" .
                "content-type:". $this->contentType.";charset=\"".$this->charset."\"\r\n" .
                "to:" . $this->formatEmailAddresses( $this->to) ."\r\n" .
        		"cc:" . $this->formatEmailAddresses( $this->cc )."\r\n" .
        		"bcc:" . $this->formatEmailAddresses( $this->bcc ). 
        		"\r\n\r\n" .
                $this->content . "\r\n.\r\n" );
 
    }
    public function send(){

    	//print_r( $this ); exit();
    	$this->connect();
    	$this->login();
    	
    	$this->sendMail();//send an email
    	
    	 
    	$this->quit();
    	$this->close();
    }
    
    public function quit()
    {
        $this->cmd("quit\r\n");
    }
    
    public function close() {
        fclose($this->fp);
    }

}

 
?>
