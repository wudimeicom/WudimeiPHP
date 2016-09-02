<?php
namespace Wudimei\Mail;

class SendMail  extends MailSender{

    
	public $sendmail;
	public $host;
	public $port;
    public function send() {
        ini_set("SMTP", $this->host);
        ini_set("smtp_port", $this->port);
    	ini_set("sendmail_path" , $this->sendmail );
    	
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: '.$this->contentType.'; charset=' . $this->charset . "\r\n";
        
        $toArray = $this->getEmailAddressArray( $this->to );
        // Additional headers
        /*
        for( $i=0; $i< count( $toArray ); $i++ )
        {
            $headers .= 'To: ' . $toArray[$i] . '' . "\r\n";
        }*/
        $headers .= 'From: ' . $this->formatEmailAddresses( $this->from ) . "\r\n";
        if( !empty( $this->cc )){
        	$headers .= 'Cc: ' . $this->formatEmailAddresses( $this->cc ) . "\r\n";
        }
        if( !empty( $this->bcc )){
        	$headers .= 'Bcc: ' . $this->formatEmailAddresses( $this->bcc) . "\r\n";
        }
        
        mail( $this->formatEmailAddresses( $this->to ), $this->subject, $this->content, $headers );
    }

}

?>