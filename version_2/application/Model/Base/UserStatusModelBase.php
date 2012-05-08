<?php


  
class Model_Base_UserStatusModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'user_status_id' =>array('numeric','required'),
		'status_name' =>array('size'=>array('min'=>0,'max'=>50),'required') 
	);
	
	private $filters = array
	(
		'user_status_id' =>array('addslashes','trim'),
		'status_name' =>array('addslashes','trim') 
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
		$this->setTableName('user_status');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'user_status','COLUMN_NAME'=>'user_status_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['user_status_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'user_status','COLUMN_NAME'=>'user_status_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'tinyint','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'3','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'tinyint(4) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'userStatusId');
		$this->data['user_status_id'] = null;
		$this->columns['status_name'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'user_status','COLUMN_NAME'=>'status_name','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'50','CHARACTER_OCTET_LENGTH'=>'150','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'utf8','COLLATION_NAME'=>'utf8_general_ci','COLUMN_TYPE'=>'varchar(50)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'statusName');
		$this->data['status_name'] = null;
   
	}  
	
	public function setUserStatusId($userStatusId)
	{
		$this->data['user_status_id'] = $userStatusId; 
	}

	public function setStatusName($statusName)
	{
		$this->data['status_name'] = $statusName; 
	}


	public function getUserStatusId()
	{
		return $this->data['user_status_id']; 
	}

	public function getStatusName()
	{
		return $this->data['status_name']; 
	}


}

?>
