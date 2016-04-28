<?php
namespace Wudimei\View;

class Tokenizer{
	/**
	 * 
	 * @param string $content
	 */
	public function tokenize( $content  ){
		$tokens_1 = array();
		$len = strlen( $content );

		for( $i=0; $i< $len; $i++ ){
			$ch = substr( $content, $i,1);
			if( $ch == '@'){
				$ret = $this->getStatement($content, $i);
				$tokens_1[] = $ret;
			}
			if( $ch == '{' ){
				$netCh = @substr( $content, $i+1,1);
				if( $netCh == "{" || $netCh == "!" ){
					$var = $this->getVariableExpression($content, $i );
					$var['start'] = $i-1;
					$tokens_1[] = $var;
				}
			}
		}
		$tokens_2 = array();
		$plainTextStart =0;
		for( $i=0;$i< count( $tokens_1); $i++ ){
			
			$item = $tokens_1[$i];
			if( empty( $item)){
				continue;
			}
			$start = $item['start'];
			$end = $item['end'];
			$str =substr($content, $plainTextStart, $start-$plainTextStart +1 );
			if( $str != ""){
				$tokens_2[] = $str;
			}
			$plainTextStart = $end+1;
			if( $start<0){
				$item['start'] =0;
			}
			$tokens_2[] = $item;
		}
		$tokens_2[]=substr($content, $plainTextStart);
		
		return $tokens_2;
	}
	/**
	 * 
	 * @param string $content
	 * @param ints $index
	 */
	public function getStatement($content, $index){
		$keywords = ['endsection','section','elseif','else','if','foreach','for','while','do','endphp','endforeach', 'endif','extends','php'];
		$keywords_needExpressions = ['section','elseif','if','foreach', 'for','while','extends'];
		$ret = array();
		$predefinedTagFound = false;
		for( $i=0;$i<count( $keywords ); $i++ ){
			$keyword = $keywords[$i];
			$len = strlen($keyword);
			
			if(substr($content, $index+1,$len) == $keyword ){
				
				if( array_search( $keyword, $keywords_needExpressions) !== false ){
					$ret = $this->getExpressions($content, $index+$len+1);
					
				}
				else{
					$ret['end'] = $index+$len;
				}
				$start = $index -1;
				
				$ret['start'] = $start;
				$ret['tag'] = $keyword;
				$ret['type'] = 'statement';
				$predefinedTagFound = true;
				break;
			}
			 
		}
		
		if( $predefinedTagFound == false ){
			$left = strpos( $content, '(', $index +1);
			$nextTag = strpos( $content, '@', $index+1 );
			
			if( $nextTag === false ){
				$nextTag = strlen( $content );
			}
			if( $left<  $nextTag ){
				$tag = substr( $content, $index+1,$left-$index-1);
				
				$len = strlen( $tag);
				$ret = $this->getExpressions($content, $index+$len+1);
				$start = $index -1;
				$ret['start'] = $start;
				$ret['function_name'] = $tag;
				$ret['type'] = 'function';
			}
		}
		
		return $ret;
		
	}
	
	public function getExpressions($content, $index){
		$stack = array();
		$stack_fresh = true;
		$expression = "";
		for( $i= $index; $i<$index+1024 ;$i++ ){
			$ch = substr($content, $i,1);
			$expression .= $ch;
			if( $ch == '('){
				array_push( $stack, '(');
				$stack_fresh = false;
			}
			if( $ch == ')'){
				array_pop( $stack );
			}
			if( $stack_fresh == false && empty( $stack )){
				break;
			}
		}
		return [
			 
			'expression' =>	$expression,
			'end' => $i	
		];
	}
	
	public function getVariableExpression($content, $index ){
		$stack = array();
		$stack_fresh = true;
		$expression = "";
		for( $i= $index; $i<$index+1024 ;$i++ ){
			$ch = substr($content, $i,1);
			$expression .= $ch;
			if( $ch == '{'){
				array_push( $stack, '{');
				$stack_fresh = false;
			}
			if( $ch == '}'){
				array_pop( $stack );
			}
			if( $stack_fresh == false && empty( $stack )){
				break;
			}
		}
		$output_type = "encode";
		if( substr( $expression,1,1) == "!"){
			$output_type = "";
		}
		$expression = trim( $expression, "!{}");
		return [
		
				'expression' =>	$expression,
				'type' => 'variable',
				'output_type' => $output_type,
				'end' => $i,
				
		];
	}
}