<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 * @deprecated
 */
namespace Wudimei\Html;

class DocumentParser{
	public function parse( $string ){
		$string = preg_replace('/[[:^print:]]/', "", $string ); //anti xss
		$len = strlen( $string );
		$tokens1 = [];
		
		for( $i=0;$i<$len;$i++ ){
			$ch = substr($string, $i,1);
			$start = -1;
			$end = -1;
			if( $ch == '<'){
				for( $j= $i+1;$j<$len;$j++ ){
					$ch2 = substr($string, $j,1);
					if( $ch2 == '>'){
						$start = $i;
						$end = $j;
						$tokens1[] = [$start,$end, substr($string, $start,$end-$start+1)];
						break;
					}
				}
			}
			
		}
		
		//remove invalid tags
		
		$tk_cnt = count( $tokens1);
		$tokens2 = array();
		for( $i=0;$i< $tk_cnt; $i++ ){
			$n = $tokens1[$i][2];
			
			$tokenLen = strlen($n);
			$cnt =0;
			$cnt2 =0;
			for( $j=0;$j<$tokenLen;$j++){
				$ch = substr( $n, $j,1);
				if( $ch == '<'){
					$cnt ++;
				}
				if( $ch == '>'){
					$cnt2 ++;
				}
			}
			//echo $cnt . ' ' . $cnt2 . ' ; ';
			if( $cnt>1 || $cnt2>1){
				$tokens1[$i] = array();
				unset( $tokens1[$i]);
			}
			else{
				$tokens1[$i][3] = 'tag';
				$this->parseTag($tokens1[$i][2]);
				$tokens2[] = $tokens1[$i];
			}
		}
		unset( $tokens1 );
		//print_r( $tokens2 );
		$tokens3= [];
		$tk_cnt = count( $tokens2 );
		for( $i=0;$i<$tk_cnt;$i++ ){
			$s = 0;
			if( $i>0){
				$s = $tokens2[$i-1][1]+1;
			}
			$l = $tokens2[$i][0]-$s ;
			$txt = substr($string, $s,$l);
			$tokens3[] = [$s,$tokens2[$i][0]-1, $txt,'txt'];
			$tokens3[] = $tokens2[$i];
		}
		$txt = substr($string, $tokens2[$tk_cnt-1][1]+1 );
		$tokens3[] = [$tokens2[$tk_cnt-1][1]+1, $len, $txt,'txt'];
		print_r( $tokens3 );
	}
	
	public function parseTag( $tagString ){
		
		
		
		
	}
}
