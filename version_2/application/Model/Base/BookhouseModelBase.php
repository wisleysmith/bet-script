<?php


  
class Model_Base_BookhouseModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'bookhouse_id' =>array('numeric','required'),
		'house_name' =>array('size'=>array('min'=>0,'max'=>100),'required'),
		'default_money_value' =>array('required'),
		'can_user_register' =>array('numeric','required'),
		'active' =>array('numeric','required') 
	);
	
	private $filters = array
	(
		'bookhouse_id' =>array('addslashes','trim'),
		'house_name' =>array('addslashes','trim'),
		'default_money_value' =>array('addslashes','trim'),
		'can_user_register' =>array('addslashes','trim'),
		'active' =>array('addslashes','trim') 
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
		$this->setTableName('bookhouse');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'bookhouse','COLUMN_NAME'=>'bookhouse_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['bookhouse_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bookhouse','COLUMN_NAME'=>'bookhouse_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'bookhouseId');
		$this->data['bookhouse_id'] = null;
		$this->columns['house_name'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bookhouse','COLUMN_NAME'=>'house_name','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'100','CHARACTER_OCTET_LENGTH'=>'300','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'utf8','COLLATION_NAME'=>'utf8_general_ci','COLUMN_TYPE'=>'varchar(100)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'houseName');
		$this->data['house_name'] = null;
		$this->columns['default_money_value'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bookhouse','COLUMN_NAME'=>'default_money_value','ORDINAL_POSITION'=>'3','COLUMN_DEFAULT'=>'0.00','IS_NULLABLE'=>'NO','DATA_TYPE'=>'decimal','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'11','NUMERIC_SCALE'=>'2','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'decimal(11,2)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'defaultMoneyValue');
		$this->data['default_money_value'] = null;
		$this->columns['can_user_register'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bookhouse','COLUMN_NAME'=>'can_user_register','ORDINAL_POSITION'=>'4','COLUMN_DEFAULT'=>'1','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'canUserRegister');
		$this->data['can_user_register'] = null;
		$this->columns['active'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bookhouse','COLUMN_NAME'=>'active','ORDINAL_POSITION'=>'5','COLUMN_DEFAULT'=>'0','IS_NULLABLE'=>'NO','DATA_TYPE'=>'tinyint','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'3','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'tinyint(4)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'active');
		$this->data['active'] = null;
   
	}  
	
	public function setBookhouseId($bookhouseId)
	{
		$this->data['bookhouse_id'] = $bookhouseId; 
	}

	public function setHouseName($houseName)
	{
		$this->data['house_name'] = $houseName; 
	}

	public function setDefaultMoneyValue($defaultMoneyValue)
	{
		$this->data['default_money_value'] = $defaultMoneyValue; 
	}

	public function setCanUserRegister($canUserRegister)
	{
		$this->data['can_user_register'] = $canUserRegister; 
	}

	public function setActive($active)
	{
		$this->data['active'] = $active; 
	}


	public function getBookhouseId()
	{
		return $this->data['bookhouse_id']; 
	}

	public function getHouseName()
	{
		return $this->data['house_name']; 
	}

	public function getDefaultMoneyValue()
	{
		return $this->data['default_money_value']; 
	}

	public function getCanUserRegister()
	{
		return $this->data['can_user_register']; 
	}

	public function getActive()
	{
		return $this->data['active']; 
	}


}

?>
