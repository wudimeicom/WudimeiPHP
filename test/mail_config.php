<?php

return [
	/**
		 * Smtp or SendMail
	*/
	'driver' => 'Smtp',
	
	'host' => 'smtp.qq.com',
	'port' => 465,
	'from' => ['address' => '******@qq.com', 'name' => 'wudimei'],
	'encryption' => 'ssl', //none,tls,ssl,sslv3 ...
	'username' => '******@qq.com',
	'password' => '******',
	'sendmail' => 'D:/AppServ/sendmail/sendmail.exe -t' , // '/usr/sbin/sendmail -bs',
	'debug' => false
];
