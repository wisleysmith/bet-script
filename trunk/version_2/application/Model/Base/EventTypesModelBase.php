<?php


  
class Model_Base_EventTypesModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'event_types_id' =>array('numeric','required'),
		'event_types_name' =>array('size'=>array('min'=>0,'max'=>100),'required'),
		'sports_id_FK' =>array('numeric','required') 
	);
	
	private $filters = array
	(
		'event_types_id' =>array('addslashes','trim'),
		'event_types_name' =>array('addslashes','trim'),
		'sports_id_FK' =>array('addslashes','trim') 
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
		$this->setTableName('event_types');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'event_types','COLUMN_NAME'=>'event_types_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['index'] =  array('TABLE_NAME'=>'event_types','COLUMN_NAME'=>'event_types_name','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'index','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['index'] =  array('TABLE_NAME'=>'event_types','COLUMN_NAME'=>'sports_id_FK','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'index','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'2','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['event_types_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'event_types','COLUMN_NAME'=>'event_types_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'eventTypesId');
		$this->data['event_types_id'] = null;
		$this->columns['event_types_name'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'event_types','COLUMN_NAME'=>'event_types_name','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'100','CHARACTER_OCTET_LENGTH'=>'300','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'utf8','COLLATION_NAME'=>'utf8_general_ci','COLUMN_TYPE'=>'varchar(100)','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'eventTypesName');
		$this->data['event_types_name'] = null;
		$this->columns['sports_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'event_types','COLUMN_NAME'=>'sports_id_FK','ORDINAL_POSITION'=>'3','COLUMN_DEFAULT'=>'0','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'sportsIdFK');
		$this->data['sports_id_FK'] = null;
   
	}  
	
	public function setEventTypesId($eventTypesId)
	{
		$this->data['event_types_id'] = $eventTypesId; 
	}

	public function setEventTypesName($eventTypesName)
	{
		$this->data['event_types_name'] = $eventTypesName; 
	}

	public function setSportsIdFK($sportsIdFK)
	{
		$this->data['sports_id_FK'] = $sportsIdFK; 
	}


	public function getEventTypesId()
	{
		return $this->data['event_types_id']; 
	}

	public function getEventTypesName()
	{
		return $this->data['event_types_name']; 
	}

	public function getSportsIdFK()
	{
		return $this->data['sports_id_FK']; 
	}


}

?>
