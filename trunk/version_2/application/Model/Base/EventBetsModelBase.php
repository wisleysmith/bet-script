<?php


  
class Model_Base_EventBetsModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'event_bets_id' =>array('numeric','required'),
		'bets_id_FK' =>array('numeric','required'),
		'event_types_id_FK' =>array('numeric'),
		'event_bets_name' =>array('size'=>array('min'=>0,'max'=>250),'required'),
		'score' =>array('size'=>array('min'=>0,'max'=>100)),
		'correct_type' =>array('numeric') 
	);
	
	private $filters = array
	(
		'event_bets_id' =>array('addslashes','trim'),
		'bets_id_FK' =>array('addslashes','trim'),
		'event_types_id_FK' =>array('addslashes','trim'),
		'event_bets_name' =>array('addslashes','trim'),
		'score' =>array('addslashes','trim'),
		'correct_type' =>array('addslashes','trim') 
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
		$this->setTableName('event_bets');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'event_bets','COLUMN_NAME'=>'event_bets_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['new_index10'] =  array('TABLE_NAME'=>'event_bets','COLUMN_NAME'=>'bets_id_FK','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'new_index10','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['new_index10'] =  array('TABLE_NAME'=>'event_bets','COLUMN_NAME'=>'event_types_id_FK','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'new_index10','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'2','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['fk_event_bets_1'] =  array('TABLE_NAME'=>'event_bets','COLUMN_NAME'=>'event_types_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'fk_event_bets_1','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'event_types','REFERENCED_COLUMN_NAME'=>'event_types_id');
		$this->relations['fk_event_bets_2'] =  array('TABLE_NAME'=>'event_bets','COLUMN_NAME'=>'correct_type','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'fk_event_bets_2','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'event_types_value','REFERENCED_COLUMN_NAME'=>'event_types_value_id');
		$this->relations['Ref_24'] =  array('TABLE_NAME'=>'event_bets','COLUMN_NAME'=>'bets_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'Ref_24','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'bets','REFERENCED_COLUMN_NAME'=>'bets_id');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['event_bets_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'event_bets','COLUMN_NAME'=>'event_bets_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'eventBetsId');
		$this->data['event_bets_id'] = null;
		$this->columns['bets_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'event_bets','COLUMN_NAME'=>'bets_id_FK','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'0','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'betsIdFK');
		$this->data['bets_id_FK'] = null;
		$this->columns['event_types_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'event_bets','COLUMN_NAME'=>'event_types_id_FK','ORDINAL_POSITION'=>'3','COLUMN_DEFAULT'=>'0','IS_NULLABLE'=>'YES','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'eventTypesIdFK');
		$this->data['event_types_id_FK'] = null;
		$this->columns['event_bets_name'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'event_bets','COLUMN_NAME'=>'event_bets_name','ORDINAL_POSITION'=>'4','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'250','CHARACTER_OCTET_LENGTH'=>'750','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'utf8','COLLATION_NAME'=>'utf8_general_ci','COLUMN_TYPE'=>'varchar(250)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'eventBetsName');
		$this->data['event_bets_name'] = null;
		$this->columns['score'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'event_bets','COLUMN_NAME'=>'score','ORDINAL_POSITION'=>'5','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'YES','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'100','CHARACTER_OCTET_LENGTH'=>'300','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'utf8','COLLATION_NAME'=>'utf8_general_ci','COLUMN_TYPE'=>'varchar(100)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'score');
		$this->data['score'] = null;
		$this->columns['correct_type'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'event_bets','COLUMN_NAME'=>'correct_type','ORDINAL_POSITION'=>'6','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'YES','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'correctType');
		$this->data['correct_type'] = null;
   
	}  
	
	public function setEventBetsId($eventBetsId)
	{
		$this->data['event_bets_id'] = $eventBetsId; 
	}

	public function setBetsIdFK($betsIdFK)
	{
		$this->data['bets_id_FK'] = $betsIdFK; 
	}

	public function setEventTypesIdFK($eventTypesIdFK)
	{
		$this->data['event_types_id_FK'] = $eventTypesIdFK; 
	}

	public function setEventBetsName($eventBetsName)
	{
		$this->data['event_bets_name'] = $eventBetsName; 
	}

	public function setScore($score)
	{
		$this->data['score'] = $score; 
	}

	public function setCorrectType($correctType)
	{
		$this->data['correct_type'] = $correctType; 
	}


	public function getEventBetsId()
	{
		return $this->data['event_bets_id']; 
	}

	public function getBetsIdFK()
	{
		return $this->data['bets_id_FK']; 
	}

	public function getEventTypesIdFK()
	{
		return $this->data['event_types_id_FK']; 
	}

	public function getEventBetsName()
	{
		return $this->data['event_bets_name']; 
	}

	public function getScore()
	{
		return $this->data['score']; 
	}

	public function getCorrectType()
	{
		return $this->data['correct_type']; 
	}


}

?>
