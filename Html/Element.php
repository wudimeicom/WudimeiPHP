<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei\Html;

class Element{
	protected $tagName;
	protected $attrs = array(); //k=>v array
	protected $children = array(); //2d array
	protected $isEmptyElementTag = false; //empty-element tag
	
	public function __construct( $tagName ){
		$this->tagName = $tagName;
	}
	
	public function attrs( $attrs = null ){
		if( $attrs == null ){
			return $this->attrs;
		}
		$this->attrs = $attrs;
		return $this;
	}
	
	public function attr($name,$value = null ){
		if( is_array( $name ) ){
			foreach ( $name as $k=> $v ){
				$this->attrs[$k] = $v;
			}
			return $this;
		}
		if( $value === null ){
			return $this->attrs[$name];
		}
		$this->attrs[$name] = $value;
		return $this;
	}
	
	public function removeAttr($name){
		unset( $this->attrs[$name] );
		return $this;
	}
	
	public function children( $children = null ){
		if( $children == null ){
			return $this->children;
		}
		$this->children = $children;
		return $this;
	}
	
	public function removeChild($index){
		unset($this->children[$index]);
		return $this;
	}
	
	public function addChild($element){
		$this->children[] = $element;
		return $this;
	}
	
	public function id( $value =null ){
		return $this->attr('id', $value);
	}
	
	public function className( $value = null){
		return $this->attr('class', $value);
	}
	
	public function toString(){
		$html = "<" . $this->tagName . " ";
		if( !empty( $this->attrs )){
			foreach ( $this->attrs as $attr => $value ){
				 
				if( is_array( $value)){
					$value = implode(",", $value );
				}
				$html .= " " . $attr . "=\"" . $value . "\" ";
			}
		}
		if( $this->isEmptyElementTag == true ){
			if( count( $this->children)==0 ){
				$html .= "/";
			}
		}
		$html .= ">";
		
		if( $this->isEmptyElementTag == false ){
			foreach ( $this->children as $childElement ){
				if( $childElement instanceof Element){
					$html .= $childElement->toString();
				}
				elseif( is_string( $childElement)){
					$html.= $childElement;
				}
			}
			$html .= "</" . $this->tagName . ">";
		}
		return $html;
	}
	
	public function __toString(){
		return $this->toString();
	}
}