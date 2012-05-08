<?php


  
class Model_Base_TeamsHasBetsModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'teams_has_bets_id' =>array('numeric','required'),
		'teams_id_FK' =>array('numeric'),
		'bets_id_FK' =>array('numeric','required') 
	);
	
	private $filters = array
	(
		'teams_has_bets_id' =>array('addslashes','trim'),
		'teams_id_FK' =>array('addslashes','trim'),
		'bets_id_FK' =>array('addslashes','trim') 
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
		$this->setTableName('teams_has_bets');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'teams_has_bets','COLUMN_NAME'=>'teams_has_bets_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['unike'] =  array('TABLE_NAME'=>'teams_has_bets','COLUMN_NAME'=>'teams_id_FK','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'unike','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['unike'] =  array('TABLE_NAME'=>'teams_has_bets','COLUMN_NAME'=>'bets_id_FK','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'unike','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'2','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['Ref_22'] =  array('TABLE_NAME'=>'teams_has_bets','COLUMN_NAME'=>'teams_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'Ref_22','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'teams','REFERENCED_COLUMN_NAME'=>'teams_id');
		$this->relations['Ref_23'] =  array('TABLE_NAME'=>'teams_has_bets','COLUMN_NAME'=>'bets_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'Ref_23','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'bets','REFERENCED_COLUMN_NAME'=>'bets_id');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['teams_has_bets_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'teams_has_bets','COLUMN_NAME'=>'teams_has_bets_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'teamsHasBetsId');
		$this->data['teams_has_bets_id'] = null;
		$this->columns['teams_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'teams_has_bets','COLUMN_NAME'=>'teams_id_FK','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'YES','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'teamsIdFK');
		$this->data['teams_id_FK'] = null;
		$this->columns['bets_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'teams_has_bets','COLUMN_NAME'=>'bets_id_FK','ORDINAL_POSITION'=>'3','COLUMN_DEFAULT'=>'0','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'betsIdFK');
		$this->data['bets_id_FK'] = null;
   
	}  
	
	public function setTeamsHasBetsId($teamsHasBetsId)
	{
		$this->data['teams_has_bets_id'] = $teamsHasBetsId; 
	}

	public function setTeamsIdFK($teamsIdFK)
	{
		$this->data['teams_id_FK'] = $teamsIdFK; 
	}

	public function setBetsIdFK($betsIdFK)
	{
		$this->data['bets_id_FK'] = $betsIdFK; 
	}


	public function getTeamsHasBetsId()
	{
		return $this->data['teams_has_bets_id']; 
	}

	public function getTeamsIdFK()
	{
		return $this->data['teams_id_FK']; 
	}

	public function getBetsIdFK()
	{
		return $this->data['bets_id_FK']; 
	}


}

?>
