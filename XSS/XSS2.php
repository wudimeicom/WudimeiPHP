<?php 
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei\XSS;

class XSS2 extends XSS
{

    public $evil_tags = ['script','style','meta','xml','iframe','head','frame','object','embed','link','frameset', 'ilayer', 'layer', 'bgsound','body','html', 'base','javascript', 'vbscript','title', 'expression', 'applet', 'blink'];
    public $evil_attributes = ['ondblclick','onclick','onmousedown','onmouseup','onmouseover','onmousemove','onmouseout','onkeypress','onkeydown','onkeyup','onbeforeunload','onerror','onload','onmove','onresize','onscroll','onstop','onunload','onchange','onfocus','onreset','onsubmit','onfinish','onstart','onbeforecut','onbeforeeditfocus','onbeforepaste','onbeforeupdate','oncontextmenu','oncopy','oncut','ondrag','ondragdrop','ondragend','ondragenter','ondragleave','ondragover','ondragstart','ondrop','onlosecapture','onpaste','onselect','onselectstart','oncellchange','ondataavailable','ondatasetchanged','ondatasetcomplete','onerrorupdate','onrowenter','onrowexit','onrowsdelete','onrowsinserted','onbeforeprint','onfilterchange','onhelp','onpropertychange','onreadystatechange'];
    public $evil_value_keywords = ['/javascript/i' ,'/vbscript/i','/expression/i','/behaviour/i','/^refresh$/i','/0;url=data:/i','/(\/[0-9a-zA-Z]{1,3}){5,}/i','/%00/i'];
    public  function clean( $text ){
        // $text = preg_replace('/[^[:print:]]/i', '', $text );
        
       $text = preg_replace('/([\x00-\x08|\x0b-\x0c|\x0e-\x19]{1})/', '', $text);
        $text = html_entity_decode( $text);
        /*
        $text = preg_replace_callback('/(&#[0-9]{1,16};?)|(&#x[a-fA-f0-9]{1,15};?)/', function($m){
          //  print_r( $m );
            return ' ';
        }, $text);*/
       // echo $text; exit();
        
        
        $text = preg_replace_callback('/<(\/)*([^\s<>]+)([^<>]*)>/i', function ($matches){
             // print_r( $matches);
            $s = $matches[1];
            $tag = $matches[2]; // tagName
            $attrs = $matches[3];
            $tag2 = strtolower(  $tag );
            $tag2 = $this->cleanInjection( $tag2 );
            $tag2 = preg_replace('/[^a-zA-Z0-9\-]+/i', '', $tag2 );
            
            $attrs2 = $this->cleanAttr( $attrs );
            $isEvilTag = in_array( $tag2 , $this->evil_tags );
           // $noAttr = trim($attrs2) == "";
          // echo $tag2 . "\r\n";
            if( $isEvilTag == false   ){
                return '<'.$s .$tag2.$attrs2.'>';
            }   
            return "";
        }, $text );
        
        
        return $text;
             
    }
    function cleanAttr($attrs){
       // echo $attrs;
        preg_match_all("/([a-zA-Z0-9\-\_\$]+)\s*=(\"([^\"]*)\")/i", $attrs,$m );
        // print_r( $m );
        $attrs_new = " ";
        $attrNames = $m[1];
        $attrValues = $m[3];
        for( $i=0; $i< count( $attrNames);$i++ ){
            $n = $attrNames[$i];
            $v = $attrValues[$i];
            $n2 = strtolower( $n);
            $isEvilAttr = in_array( $n2, $this->evil_attributes);
            $v2 = $this->cleanInjection( $v );
            $hasEvilAttrValue = false;
            for( $j=0; $j<count( $this->evil_value_keywords); $j++ ){
                $k = $this->evil_value_keywords[$j];
                if( preg_match( $k, $v2)){
                    $hasEvilAttrValue = true;
                }
            }
            if( $isEvilAttr == false &&  $hasEvilAttrValue == false){
                $attrs_new .= $n . "=\"" . $v  . "\" "; 
            }
        }
       // $attrs_new = '';
        return $attrs_new;
    }
    function cleanInjection( $text ){
        
        $txt = "";
         
        $l = strlen( $text );
        for( $i=0;$i<$l;$i++ ){
            $ch = substr( $text, $i,1);
            $ord = ord( $ch);
            if( in_array( $ch, array("\0")) == false){
                $txt .=$ch;
            }
            else{
               // echo "0000";
            }
        } 
        $txt = $text;
        $txt = preg_replace('/[\s]+/i', "", $txt);
        $txt = preg_replace('/(&#0*[9|10|13];?)|(&#x0*[9|a|b];?)/i','',$txt);
        return $txt;
    }
}
