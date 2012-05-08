<?php


  
class Model_Base_GroupsModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'groups_id' =>array('numeric','required'),
		'name_of_group' =>array('size'=>array('min'=>0,'max'=>100),'required'),
		'sports_id_FK' =>array('numeric','required') 
	);
	
	private $filters = array
	(
		'groups_id' =>array('addslashes','trim'),
		'name_of_group' =>array('addslashes','trim'),
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
		$this->setTableName('groups');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'groups','COLUMN_NAME'=>'groups_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['group_name'] =  array('TABLE_NAME'=>'groups','COLUMN_NAME'=>'name_of_group','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'group_name','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['group_name'] =  array('TABLE_NAME'=>'groups','COLUMN_NAME'=>'sports_id_FK','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'group_name','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'2','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['groups_to_sports'] =  array('TABLE_NAME'=>'groups','COLUMN_NAME'=>'sports_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'groups_to_sports','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'sports','REFERENCED_COLUMN_NAME'=>'sports_id');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['groups_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'groups','COLUMN_NAME'=>'groups_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'groupsId');
		$this->data['groups_id'] = null;
		$this->columns['name_of_group'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'groups','COLUMN_NAME'=>'name_of_group','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'100','CHARACTER_OCTET_LENGTH'=>'300','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'utf8','COLLATION_NAME'=>'utf8_general_ci','COLUMN_TYPE'=>'varchar(100)','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'nameOfGroup');
		$this->data['name_of_group'] = null;
		$this->columns['sports_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'groups','COLUMN_NAME'=>'sports_id_FK','ORDINAL_POSITION'=>'3','COLUMN_DEFAULT'=>'0','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'sportsIdFK');
		$this->data['sports_id_FK'] = null;
   
	}  
	
	public function setGroupsId($groupsId)
	{
		$this->data['groups_id'] = $groupsId; 
	}

	public function setNameOfGroup($nameOfGroup)
	{
		$this->data['name_of_group'] = $nameOfGroup; 
	}

	public function setSportsIdFK($sportsIdFK)
	{
		$this->data['sports_id_FK'] = $sportsIdFK; 
	}


	public function getGroupsId()
	{
		return $this->data['groups_id']; 
	}

	public function getNameOfGroup()
	{
		return $this->data['name_of_group']; 
	}

	public function getSportsIdFK()
	{
		return $this->data['sports_id_FK']; 
	}


}

?>
