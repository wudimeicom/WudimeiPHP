<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei\XSS;
 
class XSS1 extends XSS
{
	public $charset = "UTF-8";
	public $tags_to_be_remove = ['script','style','meta','xml','iframe','head','frame','object','embed','link','frameset', 'ilayer', 'layer', 'bgsound','body','html', 'base','javascript', 'vbscript','title', 'expression', 'applet', 'blink'];
	public $returnBodyInnerHtml = true;
	
	public  function clean( $htmlStr ){
		$htmlStr = preg_replace('/[[:^print:]]/', "", $htmlStr ); 
		
		$hasTag = preg_match('/<[a-zA-Z0-9]+\s*[^>]*>/i', $htmlStr );
		$html = "";
	 
		$html .= $htmlStr; 
		//$html .= '</body></html>';
		//echo $html;
		$doc = new \DOMDocument();
		@$doc->loadHTML($html);
		//echo $doc->saveHTML();
		
		
		$nodes = $doc->getElementsByTagName("*");
		$tagsToRemove = [];
		for( $i=0; $i< $nodes->length; $i++ ){
			$item = $nodes->item($i);
			$nodeName =  $item->nodeName  ;
			
			if( $this->wantRemove($nodeName  )){
				$tagsToRemove[] = $item;
			}
			
			
			$attrs = $item->attributes;
			$attrsArray = array();
			for( $j=0;$j<$attrs->length;$j++ ){
				$attr = $attrs->item($j);
				$attrName = $attr->name;
				$attrsArray[$attrName] =  $attr->nodeValue;
			}

			foreach( $attrsArray as $attrName =>  $attrValue ){
				if( preg_match("/^on/i", $attrName )){
					$item->removeAttribute( $attrName );
				}
				
				if( $attrName == "src" ){
					if( preg_match('/javascript/i', $attrValue )){
						$item->removeAttribute( $attrName );
					}
				}
				if( $attrName == 'style'){
					if( preg_match('/javascript/i', $attrValue )){
						$item->removeAttribute( $attrName );
					}
					if( preg_match('/expression/i', $attrValue )){
						$item->removeAttribute( $attrName );
					}
				}
				if( $attrName == 'href'){
					if( preg_match('/javascript/i', $attrValue )){
						$item->removeAttribute( $attrName );
					}
				}
			} 
		}
		
		for( $i=0; $i < count($tagsToRemove); $i++ ){
			$tagsToRemove[$i]->parentNode->removeChild($tagsToRemove[$i] );
		}
		
		 $doc->normalize();
		
		if( $this->returnBodyInnerHtml == true ){
			$innerHtml = '';
			$bodys = $doc->getElementsByTagName("body");
			$childNodes = $bodys[0]->childNodes;
			foreach ($childNodes as $childNode){
				$innerHtml .= $childNode->ownerDocument->saveHTML($childNode);
			}
			if( $hasTag == false ){
			    $innerHtml = strip_tags( $innerHtml);
			}
			return $innerHtml;
		}
		else{
			return  $doc->saveHTML(   );
		}
	}
	
	 
	private function wantRemove($nodeName){
		if( $nodeName == 'html' || $nodeName == 'body'){
			return false;
		}
		if( in_array( $nodeName, $this->tags_to_be_remove )){
			return true;
		}
		return false;
	}
	
	
} 
