<?php


  
class Model_Base_TeamsModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'teams_id' =>array('numeric','required'),
		'team_name' =>array('size'=>array('min'=>0,'max'=>100),'required'),
		'groups_id_FK' =>array('numeric','required') 
	);
	
	private $filters = array
	(
		'teams_id' =>array('addslashes','trim'),
		'team_name' =>array('addslashes','trim'),
		'groups_id_FK' =>array('addslashes','trim') 
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
		$this->setTableName('teams');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'teams','COLUMN_NAME'=>'teams_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['unike'] =  array('TABLE_NAME'=>'teams','COLUMN_NAME'=>'team_name','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'unike','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['unike'] =  array('TABLE_NAME'=>'teams','COLUMN_NAME'=>'groups_id_FK','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'unike','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'2','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['teams_to_groups'] =  array('TABLE_NAME'=>'teams','COLUMN_NAME'=>'groups_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'teams_to_groups','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'groups','REFERENCED_COLUMN_NAME'=>'groups_id');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['teams_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'teams','COLUMN_NAME'=>'teams_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'teamsId');
		$this->data['teams_id'] = null;
		$this->columns['team_name'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'teams','COLUMN_NAME'=>'team_name','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'100','CHARACTER_OCTET_LENGTH'=>'300','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'utf8','COLLATION_NAME'=>'utf8_general_ci','COLUMN_TYPE'=>'varchar(100)','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'teamName');
		$this->data['team_name'] = null;
		$this->columns['groups_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'teams','COLUMN_NAME'=>'groups_id_FK','ORDINAL_POSITION'=>'3','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'groupsIdFK');
		$this->data['groups_id_FK'] = null;
   
	}  
	
	public function setTeamsId($teamsId)
	{
		$this->data['teams_id'] = $teamsId; 
	}

	public function setTeamName($teamName)
	{
		$this->data['team_name'] = $teamName; 
	}

	public function setGroupsIdFK($groupsIdFK)
	{
		$this->data['groups_id_FK'] = $groupsIdFK; 
	}


	public function getTeamsId()
	{
		return $this->data['teams_id']; 
	}

	public function getTeamName()
	{
		return $this->data['team_name']; 
	}

	public function getGroupsIdFK()
	{
		return $this->data['groups_id_FK']; 
	}


}

?>
