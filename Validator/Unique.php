<?php
namespace Wudimei\Validator;
use DB;
class Unique extends RuleValidator{
	
	public function isValid($table,$field,$exceptedId='',$primaryKey="id",$connection="default"){
		$select = DB::connection( $connection);
		$select = $select->table( $table)->where($field, $this->value);
		if( $exceptedId != ""){
			$select = $select->where($primaryKey,'!=',$exceptedId);
		}
		$cnt = $select->count($primaryKey);
		if( $cnt == 0 ){
			return true;
		}
		else{
			return false;
		}
	}
	

	
}