<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace  Wudimei\DB\Query\Pagination;
class Paginator{
	public $first;
	public $last;
	public $prev; // ..
	public $next; // .. 
	public $page;
	public $size;
	public $total;
	public $data;
	
	public function __construct( $config = array() )
	{
		if( !empty( $config )){
			foreach ( $config as $key => $value )
			{
				$this->$key = $value;
			}
		}
	}
	
	public function getUrl( $url , $row )
	{
		if( !empty( $row ) )
		{
			foreach( $row as $k => $v )
			{
				$url = str_replace( "{". $k . "}", $v , $url );
			}
		}
		return $url;
	}
	private function getUrlByPageAndSize( $url , $page , $size )
	{
		return $this->getUrl($url, array( "page" => $page , "size" => $size ) );
	}
	/**
	 *
	 * Enter description here ...
	 * @param unknown_type $url eg /index.php/list/ctg/5/page/{page}/size/{size}
	 * @param unknown_type $buttonCount
	 */
	public function render( $url , $buttonCount = 6 )
	{
		 
		$this->prev = ($this->page -1 >0 )? $this->page -1 : 1;
		$this->next = ( $this->page+1<= $this->last)? $this->page+1 : $this->last;
		
		$html = "<ul class=\"pagination\">";
		$html .= "<li><a href=\"" . $this->getUrlByPageAndSize($url, 1 , $this->size )  . "\">".trans('global.Page_First')."</a></li>";
		$html .= "<li><a href=\"" . $this->getUrlByPageAndSize($url, $this->prev , $this->size ) . "\">".trans('global.Page_Prev')."</a></li>";
		for( $i= $this->page - $buttonCount ; $i< $this->page + $buttonCount ; $i++ )
		{
			if( $i>0 && $i <= $this->last )
			{
				if( $i == $this->page )
				{
					$html .= "<li class=\"active\"><span>" . $i . "</span></li>";
				}
				else
				{
					$html .= "<li><a href=\"" . $this->getUrlByPageAndSize($url, $i , $this->size ).  "\">" . $i . "</a></li>";
				}
			}
		}
		$html .= "<li><a href=\"" . $this->getUrlByPageAndSize($url, $this->next , $this->size )  . "\">".trans('global.Page_Next')."</a></li>";
		$html .= "<li><a href=\"" . $this->getUrlByPageAndSize($url,  $this->last  , $this->size )   . "\">".trans('global.Page_Last')."</a></li>";
	
		$html .= "</ul>";
		return $html;
		if( $this->last <= 1 )
		{
			return "";
		}
		else
		{
			return $html;
		}
	}
	 
}