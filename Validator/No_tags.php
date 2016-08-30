<?php
namespace Wudimei\Validator;
class No_tags  extends RuleValidator{
	
	 
	
	public function isValid($wantValidation = true){
		if( $wantValidation == true ){
			$text = preg_replace('/[[:^print:]]/', "", $this->value );
			if( preg_match('/<[a-zA-Z]+\s*[^>]*>/i', $text)){
				//echo "has tags";
				return false;
			}
			else{
				//echo 'no tags';
				return true;
			}
		}
		else{
			return true;
		}
	}
	

}