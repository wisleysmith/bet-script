<?php


  
class Model_Base_UserMoneyOverallModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'user_id_FK' =>array('numeric','required'),
		'money' =>array('numeric','required') 
	);
	
	private $filters = array
	(
		'user_id_FK' =>array('addslashes','trim'),
		'money' =>array('addslashes','trim') 
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
		$this->setTableName('user_money_overall');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['fk_user_money_overall_1'] =  array('TABLE_NAME'=>'user_money_overall','COLUMN_NAME'=>'user_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'fk_user_money_overall_1','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'user','REFERENCED_COLUMN_NAME'=>'user_id');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['user_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'user_money_overall','COLUMN_NAME'=>'user_id_FK','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(10) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'userIdFK');
		$this->data['user_id_FK'] = null;
		$this->columns['money'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'user_money_overall','COLUMN_NAME'=>'money','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'float','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'2','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'float(10,2)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'money');
		$this->data['money'] = null;
   
	}  
	
	public function setUserIdFK($userIdFK)
	{
		$this->data['user_id_FK'] = $userIdFK; 
	}

	public function setMoney($money)
	{
		$this->data['money'] = $money; 
	}


	public function getUserIdFK()
	{
		return $this->data['user_id_FK']; 
	}

	public function getMoney()
	{
		return $this->data['money']; 
	}


}

?>
