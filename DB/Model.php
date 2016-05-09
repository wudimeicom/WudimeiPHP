<?php
namespace Wudimei\DB;
use Wudimei\DB;
use Wudimei\DB\Query\PDO_MYSQL;

class Model{
	public $table; //without prefix
	public $primaryKey = 'id';
	public $connection = 'default' ; //default connection
	/**
	 * 
	 * @var PDO_MYSQL
	 */
	public $select;
	public function __construct(){
		$select = DB::connection($this->connection);
		$select->table( $this->table );
		$this->select = $select;
	}
	
	public function select($select="*")
	{
		return $this->select->select( $select );
	}
	
	public function from($tableName){
		return $this->select->from($tableName);
	}
	
	public function table($tableName){
		return $this->select->from($tableName);
	}
	
	public function limit($limit,$offset){
		return $this->select->limit($limit,$offset);
	}
	
	public function orderBy($field,$direction="asc"){
		return $this->select->orderBy($field,$direction);
	}
	
	public function groupBy( $field ){
		return $this->select->groupBy( $field );
		
	}

	public function where($field,$param2,$param3 = null , $boolean = 'and' ){
		return $this->select->where($field,$param2,$param3  , $boolean   );
	}
	
	public function orWhere($field,$param2,$param3 = null  ){
		return $this->select->orWhere($field,$param2,$param3);
	}
	
	public function whereRaw($sql, array $bindings = array(), $boolean = 'and'){
		return $this->select->whereRaw($sql,   $bindings  , $boolean);
	}
	public function orWhereRaw($sql, array $bindings = array() )
	{
		return $this->select->orWhereRaw($sql,  $bindings );
	}
	
	public function whereIn($field, array $values = array(), $boolean = 'and')
	{
		return $this->select->whereIn($field,  $values  , $boolean );
	}
	
	public function orWhereIn($field, array $values = array() )
	{
		return $this->select->orWhereIn($field,  $values );
	}
	
	public function having($field,$param2,$param3 = null , $boolean = 'and'){
		return $this->select->having($field,$param2,$param3  , $boolean  );
	}
	public function orHaving($field,$param2,$param3 = null  ){
		return $this->select->orHaving($field,$param2,$param3 );
	}
	public function havingRaw($sql, array $bindings = array(), $boolean = 'and')
	{
		return $this->select->havingRaw($sql,   $bindings , $boolean );
	}
	
	public function orHavingRaw($sql, array $bindings = array() )
	{
		return $this->select->orHavingRaw($sql,  $bindings );
	}
	public function toSql(){
		return $this->select->toSql();
	}
	public function get(){
		return $this->select->get();
	}
	
	public function all(){
		return $this->select->all();
	}
	
	public function paginate($perPage = 15, $page = null)
	{
		return $this->select->paginate($perPage  , $page);
	}
	
	public function count($field = "*"){
		return $this->select->count($field );
	}
	
	public function max($field = "*"){
		return $this->select->max($field);
	}
	
	public function min($field = "*"){
		return $this->select->min($field);
	}
	public function sum($field = "*"){
		return $this->select->sum($field);
	}
	
	public function avg($field = "*"){
		return $this->select->avg($field);
	}
	
	public function _function($function,$field = "*"){
		return $this->select->_function($function,$field );
	}
	
	public function getPDO(){
		return $this->select->getPDO();
	}
	public function executeQuery( $sql ,$params = null ){
		return $this->select->executeQuery( $sql ,$params );
	}
	
	public function executeUpdate( $sql,$params = null ){
		return $this->select->executeUpdate( $sql,$params);
	}
	
	public function insert( $data ){
		return $this->select->insert( $data );
	}
	
	public function update( $data ){
		return $this->select->update( $data );
	}
	
	public function delete(  ){
		return $this->select->delete(  );
	}
	
	public function find( $id ){
		$data = $this->select->where($this->primaryKey, $id )->limit(1, 0)->get();
		
		return @$data[0];
	}
}