<?php
namespace Wudimei\Menu;
class Item{
	public $id;
	public $url;
	public $label;
	public $icon;
	public $submenus = [];
	public $parent;
	public $active = false;
	
	public function __construct(){
		
	}
	
	public function __toString(){
		$html = "";
		$html .= '<li ';
		if( $this->active ){
			$html .= ' class="active" ';
		}
		$html .='><a href="'. $this->url.'"><i class="fa '.$this->icon.'"></i> <span>'. $this->label.'</span></a>';
		if( !empty( $this->submenus ) ){
			$html .= '<ul class="treeview-menu">';
			for( $i=0; $i< count( $this->submenus); $i++ ){
				$html .= $this->submenus[$i];
			}
			$html .= '</ul>';
		}
		$html .='</li>';
		return $html;
	}
}