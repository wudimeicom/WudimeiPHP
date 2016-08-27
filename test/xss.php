<?php
use Wudimei\XSS;

require_once __DIR__ .'/../autoload.php';

$xss = new XSS();
//echo $xss->clean( @$_GET['key'] );
//echo @$_GET['key'];

$text = ' sf <br />hello,world<div name="bd" style="color:green" onclick="alert(\'hello\')"> abc</div>
		<script type="text/javascript"> alert(\'hello\');
		for(var i=0;i<10;i++){
		  document.writel( i +"");
		}
		
		</script>ddd
		<img name="abc" onmouseover="" onmouseout="" src="javaScript:alert(\'hello\');" onerror="this.src=\'http://a.com/a.jpg\';"/>
		a<script type="text/javascript"> alert(\'hello\');
		for(var i=0;i<10;i++){
		  document.writel( i +"");
		}
		
		</script>ddd
		<style type="text/css">body{font-size:12px;} </style> style 
		<iframe src="abc.php"></iframe>
		iframe
		<object id="saowro234salfsfslaf"></object>
		<embed src="a.swf"></embed>
		<meta http-equiv="refresh" content="0;">
		<iframe src=http://xxxx width=250 height=250></iframe> 
		hello
		<html><head><title>abc</title></head><body>efg</body></html>
		
		';
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
		<img name="abc" onmouseover="" onmouseout="" src="javaScript:alert(\'hello\');" onerror="this.src=\'http://a.com/a.jpg\';">
		a
		<script type="text/javascript"> alert(\'hello\');
		for(var i=0;i<10;i++){  
		document.writel( i +"");}
		</script>ddd
		
		style <iframe src="abc.php"></iframe>iframe
		<object id="saowro234salfsfslaf"></object>
		<embed src="a.swf"></embed>
		
		<iframe src="http://xxxx" width="250" height="250"></iframe> 
		hello<title>abc</title>efg
		<IMG SRC=@javascript:alert(\'XSS\')>
		<IMG SRC=@avascript:alert(\'XSS\')>
		
		
		<img STYLE="background-image: /75/72/6c/28/6a/61/76/61/73/63/72/69/70/74/3a/61/6c/65/72/74/28/27/58/53/53/27/29/29">
		以上写法等于
		<img STYLE="background-image: url(javascript:alert(\'XSS2\'))" >
		
		&#60&#115&#99&#114&#105&#112&#116&#62&#97&#108&#101&#114&#116&#40&#34&#72&#101&#108&#108&#111&#32&#119&#111&#114&#108&#100&#34&#41&#59&#60&#47&#115&#99&#114&#105&#112&#116&#62
		&#60;script&#62;alert("hi");&#60;/script&#62;
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
		
		<SCR%00IPT>alert("XSS")</SCRIPT>aa
		</body>
		</html>
		';
//$text = '\'><SCRIPT>alert("XSS")</SCRIPT><xss a=\'';
echo $xss->clean($text);