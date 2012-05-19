<?php


  
class Model_Base_SessionStorageModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'session_storage_id' =>array('numeric','required'),
		'hash' =>array('size'=>array('min'=>0,'max'=>45),'required'),
		'user_id' =>array('numeric','required') 
	);
	
	private $filters = array
	(
		'session_storage_id' =>array('addslashes','trim'),
		'hash' =>array('addslashes','trim'),
		'user_id' =>array('addslashes','trim') 
	);
	
	
	public function getValidators()
	{
		return $this->validators;
	}
	
	public function getFilters()
	{
		return $this->filters;	
	}  
	  
	public function __construct()
	{ 
		$this->setTableName('session_storage');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'session_storage','COLUMN_NAME'=>'session_storage_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['fk_session_storage_1'] =  array('TABLE_NAME'=>'session_storage','COLUMN_NAME'=>'user_id','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'fk_session_storage_1','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'user','REFERENCED_COLUMN_NAME'=>'user_id');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['session_storage_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'session_storage','COLUMN_NAME'=>'session_storage_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(10) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'sessionStorageId');
		$this->data['session_storage_id'] = null;
		$this->columns['hash'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'session_storage','COLUMN_NAME'=>'hash','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'45','CHARACTER_OCTET_LENGTH'=>'45','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'latin1','COLLATION_NAME'=>'latin1_swedish_ci','COLUMN_TYPE'=>'varchar(45)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'hash');
		$this->data['hash'] = null;
		$this->columns['user_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'session_storage','COLUMN_NAME'=>'user_id','ORDINAL_POSITION'=>'3','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'userId');
		$this->data['user_id'] = null;
   
	}  
	
	public function setSessionStorageId($sessionStorageId)
	{
		$this->data['session_storage_id'] = $sessionStorageId; 
	}

	public function setHash($hash)
	{
		$this->data['hash'] = $hash; 
	}

	public function setUserId($userId)
	{
		$this->data['user_id'] = $userId; 
	}


	public function getSessionStorageId()
	{
		return $this->data['session_storage_id']; 
	}

	public function getHash()
	{
		return $this->data['hash']; 
	}

	public function getUserId()
	{
		return $this->data['user_id']; 
	}


}

?>
