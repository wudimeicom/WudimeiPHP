<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei\Html;
use Wudimei\Html\Element;

class Textarea extends Element{
	function __construct(  ) {
		parent::__construct("textarea");
	}
	public function value($value){
		
	}
	public function name($value = null ){
		return $this->attr('name', $value);
	}
}