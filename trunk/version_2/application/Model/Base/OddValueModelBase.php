<?php


  
class Model_Base_OddValueModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'odd_value_id' =>array('numeric','required'),
		'odd_value' =>array('required'),
		'bet_types_id_FK' =>array('numeric','required'),
		'active' =>array('numeric','required'),
		'is_correct' =>array('numeric') 
	);
	
	private $filters = array
	(
		'odd_value_id' =>array('addslashes','trim'),
		'odd_value' =>array('addslashes','trim'),
		'bet_types_id_FK' =>array('addslashes','trim'),
		'active' =>array('addslashes','trim'),
		'is_correct' =>array('addslashes','trim') 
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
		$this->setTableName('odd_value');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'odd_value','COLUMN_NAME'=>'odd_value_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['Ref_21'] =  array('TABLE_NAME'=>'odd_value','COLUMN_NAME'=>'bet_types_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'Ref_21','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'bets_type','REFERENCED_COLUMN_NAME'=>'bet_types_id');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['odd_value_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'odd_value','COLUMN_NAME'=>'odd_value_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'oddValueId');
		$this->data['odd_value_id'] = null;
		$this->columns['odd_value'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'odd_value','COLUMN_NAME'=>'odd_value','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'decimal','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'4','NUMERIC_SCALE'=>'2','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'decimal(4,2)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'oddValue');
		$this->data['odd_value'] = null;
		$this->columns['bet_types_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'odd_value','COLUMN_NAME'=>'bet_types_id_FK','ORDINAL_POSITION'=>'3','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'betTypesIdFK');
		$this->data['bet_types_id_FK'] = null;
		$this->columns['active'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'odd_value','COLUMN_NAME'=>'active','ORDINAL_POSITION'=>'4','COLUMN_DEFAULT'=>'0','IS_NULLABLE'=>'NO','DATA_TYPE'=>'tinyint','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'3','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'tinyint(4)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'active');
		$this->data['active'] = null;
		$this->columns['is_correct'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'odd_value','COLUMN_NAME'=>'is_correct','ORDINAL_POSITION'=>'5','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'YES','DATA_TYPE'=>'tinyint','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'3','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'tinyint(3) unsigned','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'isCorrect');
		$this->data['is_correct'] = null;
   
	}  
	
	public function setOddValueId($oddValueId)
	{
		$this->data['odd_value_id'] = $oddValueId; 
	}

	public function setOddValue($oddValue)
	{
		$this->data['odd_value'] = $oddValue; 
	}

	public function setBetTypesIdFK($betTypesIdFK)
	{
		$this->data['bet_types_id_FK'] = $betTypesIdFK; 
	}

	public function setActive($active)
	{
		$this->data['active'] = $active; 
	}

	public function setIsCorrect($isCorrect)
	{
		$this->data['is_correct'] = $isCorrect; 
	}


	public function getOddValueId()
	{
		return $this->data['odd_value_id']; 
	}

	public function getOddValue()
	{
		return $this->data['odd_value']; 
	}

	public function getBetTypesIdFK()
	{
		return $this->data['bet_types_id_FK']; 
	}

	public function getActive()
	{
		return $this->data['active']; 
	}

	public function getIsCorrect()
	{
		return $this->data['is_correct']; 
	}


}

?>
