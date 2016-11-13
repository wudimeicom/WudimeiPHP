<?php
/**
 * @deprecated
 */
use Wudimei\Html\Document;

require_once __DIR__ .'/../autoload.php';
\Wudimei\ClassAlias::loadConfig(__DIR__."/class_alias_config.php");

$doc = new Document();

$string = ' sf <br />hello,world<div> abc</div>
		<<scri\0pt type="text/javascript">
		for(var i=0;i<10;i++){
		  echo i;
		}
		</script>ddd
		a';

$string = ' sf <br />hello,world<div> abc</div>
		<script type="text/javascript">
		for(var i=0;i<10;i++){
		  echo i;
		}
		</script>ddd
		a';
$doc->load_from_string($string);


