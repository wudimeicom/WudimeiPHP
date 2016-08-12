<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei\DB\Query;

class PDO_MYSQL extends PDO_Abstract{
	
	
	public function __construct($config){
		parent::__construct($config);
	}
	
}