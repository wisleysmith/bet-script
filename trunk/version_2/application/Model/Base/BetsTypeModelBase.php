<?php


  
class Model_Base_BetsTypeModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'bet_types_id' =>array('numeric','required'),
		'event_bets_id_FK' =>array('numeric','required'),
		'teams_has_bets_id_FK' =>array('numeric'),
		'event_types_value_id_FK' =>array('numeric','required') 
	);
	
	private $filters = array
	(
		'bet_types_id' =>array('addslashes','trim'),
		'event_bets_id_FK' =>array('addslashes','trim'),
		'teams_has_bets_id_FK' =>array('addslashes','trim'),
		'event_types_value_id_FK' =>array('addslashes','trim') 
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
		$this->setTableName('bets_type');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'bets_type','COLUMN_NAME'=>'bet_types_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['new_index11'] =  array('TABLE_NAME'=>'bets_type','COLUMN_NAME'=>'event_bets_id_FK','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'new_index11','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['new_index11'] =  array('TABLE_NAME'=>'bets_type','COLUMN_NAME'=>'event_types_value_id_FK','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'new_index11','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'2','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['fk_bets_type_1'] =  array('TABLE_NAME'=>'bets_type','COLUMN_NAME'=>'event_types_value_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'fk_bets_type_1','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'event_types_value','REFERENCED_COLUMN_NAME'=>'event_types_value_id');
		$this->relations['Ref_28'] =  array('TABLE_NAME'=>'bets_type','COLUMN_NAME'=>'teams_has_bets_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'Ref_28','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'teams_has_bets','REFERENCED_COLUMN_NAME'=>'teams_has_bets_id');
		$this->relations['Ref_29'] =  array('TABLE_NAME'=>'bets_type','COLUMN_NAME'=>'event_bets_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'Ref_29','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'event_bets','REFERENCED_COLUMN_NAME'=>'event_bets_id');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['bet_types_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bets_type','COLUMN_NAME'=>'bet_types_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'betTypesId');
		$this->data['bet_types_id'] = null;
		$this->columns['event_bets_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bets_type','COLUMN_NAME'=>'event_bets_id_FK','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'0','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'eventBetsIdFK');
		$this->data['event_bets_id_FK'] = null;
		$this->columns['teams_has_bets_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bets_type','COLUMN_NAME'=>'teams_has_bets_id_FK','ORDINAL_POSITION'=>'3','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'YES','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'teamsHasBetsIdFK');
		$this->data['teams_has_bets_id_FK'] = null;
		$this->columns['event_types_value_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bets_type','COLUMN_NAME'=>'event_types_value_id_FK','ORDINAL_POSITION'=>'4','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'eventTypesValueIdFK');
		$this->data['event_types_value_id_FK'] = null;
   
	}  
	
	public function setBetTypesId($betTypesId)
	{
		$this->data['bet_types_id'] = $betTypesId; 
	}

	public function setEventBetsIdFK($eventBetsIdFK)
	{
		$this->data['event_bets_id_FK'] = $eventBetsIdFK; 
	}

	public function setTeamsHasBetsIdFK($teamsHasBetsIdFK)
	{
		$this->data['teams_has_bets_id_FK'] = $teamsHasBetsIdFK; 
	}

	public function setEventTypesValueIdFK($eventTypesValueIdFK)
	{
		$this->data['event_types_value_id_FK'] = $eventTypesValueIdFK; 
	}


	public function getBetTypesId()
	{
		return $this->data['bet_types_id']; 
	}

	public function getEventBetsIdFK()
	{
		return $this->data['event_bets_id_FK']; 
	}

	public function getTeamsHasBetsIdFK()
	{
		return $this->data['teams_has_bets_id_FK']; 
	}

	public function getEventTypesValueIdFK()
	{
		return $this->data['event_types_value_id_FK']; 
	}


}

?>
