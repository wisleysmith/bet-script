<?php


  
class Model_Base_EventTypesValueModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'event_types_value_id' =>array('numeric','required'),
		'event_types_id_FK' =>array('numeric','required'),
		'event_value_name' =>array('size'=>array('min'=>0,'max'=>100)) 
	);
	
	private $filters = array
	(
		'event_types_value_id' =>array('addslashes','trim'),
		'event_types_id_FK' =>array('addslashes','trim'),
		'event_value_name' =>array('addslashes','trim') 
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
		$this->setTableName('event_types_value');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'event_types_value','COLUMN_NAME'=>'event_types_value_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['unique'] =  array('TABLE_NAME'=>'event_types_value','COLUMN_NAME'=>'event_types_id_FK','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'unique','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['unique'] =  array('TABLE_NAME'=>'event_types_value','COLUMN_NAME'=>'event_value_name','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'unique','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'2','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['fk_event_types_value_1'] =  array('TABLE_NAME'=>'event_types_value','COLUMN_NAME'=>'event_types_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'fk_event_types_value_1','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'event_types','REFERENCED_COLUMN_NAME'=>'event_types_id');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['event_types_value_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'event_types_value','COLUMN_NAME'=>'event_types_value_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'eventTypesValueId');
		$this->data['event_types_value_id'] = null;
		$this->columns['event_types_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'event_types_value','COLUMN_NAME'=>'event_types_id_FK','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'0','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'eventTypesIdFK');
		$this->data['event_types_id_FK'] = null;
		$this->columns['event_value_name'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'event_types_value','COLUMN_NAME'=>'event_value_name','ORDINAL_POSITION'=>'3','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'YES','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'100','CHARACTER_OCTET_LENGTH'=>'300','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'utf8','COLLATION_NAME'=>'utf8_general_ci','COLUMN_TYPE'=>'varchar(100)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'eventValueName');
		$this->data['event_value_name'] = null;
   
	}  
	
	public function setEventTypesValueId($eventTypesValueId)
	{
		$this->data['event_types_value_id'] = $eventTypesValueId; 
	}

	public function setEventTypesIdFK($eventTypesIdFK)
	{
		$this->data['event_types_id_FK'] = $eventTypesIdFK; 
	}

	public function setEventValueName($eventValueName)
	{
		$this->data['event_value_name'] = $eventValueName; 
	}


	public function getEventTypesValueId()
	{
		return $this->data['event_types_value_id']; 
	}

	public function getEventTypesIdFK()
	{
		return $this->data['event_types_id_FK']; 
	}

	public function getEventValueName()
	{
		return $this->data['event_value_name']; 
	}


}

?>
