<?php

class XSS
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



$text = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
		<head>
		<meta http-equiv="refresh" content="0;">
		<style type="text/css">body{font-size:12px;} </style>
		<title>hello</title>
		</head>
		<body  onload!#$%&()*~+-_.,:;?@[/|\]^`=alert(“XSS”)>
		<p>sf <br>hello,world</p>
		<div name="bd" style="color:green" onclick="alert(\'hello\')"> a<span color=red>b</span>c</div>
		<script type="text/javascript"> alert(\'hello\');
		for(var i=0;i<10;i++){  document.writel( i +"");}
		</script>ddd
		<img name="abc" onmouseover="javaScript:alert(\'hello\');" onmouseout="javaScript:alert(\'hello\');" src="javaScript:alert(\'hello\');" src2="javaScript:alert(\'hello\');" onerror="this.src=\'http://a.com/a.jpg\';">
		a
		<script type="text/javascript"> alert(\'hello\');
		for(var i=0;i<10;i++){
		document.writel( i +"");}
		</script>ddd

		style <iframe src="abc.php"></iframe>iframe
		<object id="saowro234salfsfslaf"></object>
		<embed src="a.swf"></embed>
<a style="beh%00aviour">beh%00aviour</a>
		<iframe src="http://xxxx" width="250" height="250"></iframe>
		hello<title>abc</title>efg
		<IMG SRC=@javascript:alert(\'XSS\')>
		<IMG SRC=@avascript:alert(\'XSS\')>


		<img STYLE="background-image: /75/72/6c/28/6a/61/76/61/73/63/72/69/70/74/3a/61/6c/65/72/74/28/27/58/53/53/27/29/29">
		以上写法等于
		<img STYLE="background-image: url(javascript:alert(\'XSS2\'))" >

		&#60&#115&#99&#114&#105&#112&#116&#62&#97&#108&#101&#114&#116&#40&#34&#72&#101&#108&#108&#111&#32&#119&#111&#114&#108&#100&#34&#41&#59&#60&#47&#115&#99&#114&#105&#112&#116&#62
		&#60;script&#62;alert("hi,entity decode");&#60;/script&#62;
		<IMG SRC="" onerror="alert(\'XSS\')">
		<IMG SRC=javascript：alert(\'XSS\')>
<IMG SRC=javascript：alert(&quot;XSS&quot;)>
		<IMG SRC=javascript：alert(String.fromCharCode(88,83,83))>
		<IMG  SRC=&#106;&#97;&#118;&#97;&#115;&#99;&#114;&#105;&#112;&#116;&#58;&#97;&#108;&#10
1; &#114;&#116;&#40;&#39;&#88;&#83;&#83;&#39;&#41;>
 <IMG  SRC=&#x6A;&#x61;&#x76;&#x61;&#x73;&#x63;&#x72;&#x69;&#x70;&#x74;&#x3A;&#x61;&#x6C
;& #x65;&#x72;&#x74;&#x28;&#x27;&#x58;&#x53;&#x53;&#x27;&#x29;>
		<IMG name="abc" SRC="jav&#x9ascript:alert(\'XSS\');">
		<DIV STYLE="width: expre%00ssion(alert(\'XSS3344\'));"></DIV>
		<DIV STYLE="width: expreSsion(alert(\'XSS3344\'));"></DIV>

		<META HTTP-EQUIV="refresh"  CONTENT="0;url=data:text/html;base64,PHNjcmlwdD5hbGVydCgnWFNTJyk8L3NjcmlwdD4
K">
		<IMG SRC=`javascript：alert("Look its, \'XSS\'")`>
		<IMG SRC=`javascript：alert(\"XSS\")`>
		%2BADw-script%2BAD4-alert%281%29%2BADw-/script%2BAD4-
		<img src="
		jav
		ascript:alert(123)" name="fff">


		<A HREF="java
script:location.href=\'http://www.wudimei.com/\'">XSS</A>

		<IMG SRC=&#x6A&#x61&#x76&#x61..省略..&#x58&#x53&#x53&#x27&#x29>

		<SCR%00IPT>alert("XSS")</SCR%00IPT>aa onerror
        <sCR'."\0".'&#x09;IPT>alert("XSS")</SC'."\0".'&#x09;RIPT>aa onerror
                <tsCR'."\0".'IPT>alert("XSS")</tSC'."\0".'RIPT>aa onerror
        <IMG SRC=JaVaScRiPt:alert(\'XSS\') alt="xss">
                        
		</body>
		</html>
		';
//$text = '\'><SCRIPT>alert("XSS")</SCRIPT><xss a=\'';
/*
$text = '<A HREF="java
script:location.href=\'http://www.wudimei.com/\'">XSS</A>';
*/

//$text = 'yaqy@qq.com 杨庆荣 wudimei123 1985#@5*（35323#4（） <d';
$xss = new XSS();
echo $xss->clean($text);
 

