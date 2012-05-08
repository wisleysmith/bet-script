<?php


  
class Model_Base_BetsModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'bets_id' =>array('numeric','required'),
		'bet_name' =>array('size'=>array('min'=>0,'max'=>250),'required'),
		'groups_id_FK' =>array('numeric','required'),
		'add_date' =>array('datetime','required'),
		'end_date' =>array('datetime','required'),
		'bet_active' =>array('datetime','required') 
	);
	
	private $filters = array
	(
		'bets_id' =>array('addslashes','trim'),
		'bet_name' =>array('addslashes','trim'),
		'groups_id_FK' =>array('addslashes','trim'),
		'add_date' =>array('addslashes','trim'),
		'end_date' =>array('addslashes','trim'),
		'bet_active' =>array('addslashes','trim') 
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
		$this->setTableName('bets');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'bets','COLUMN_NAME'=>'bets_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['Ref_07'] =  array('TABLE_NAME'=>'bets','COLUMN_NAME'=>'groups_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'Ref_07','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'groups','REFERENCED_COLUMN_NAME'=>'groups_id');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['bets_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bets','COLUMN_NAME'=>'bets_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'betsId');
		$this->data['bets_id'] = null;
		$this->columns['bet_name'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bets','COLUMN_NAME'=>'bet_name','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'250','CHARACTER_OCTET_LENGTH'=>'750','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'utf8','COLLATION_NAME'=>'utf8_general_ci','COLUMN_TYPE'=>'varchar(250)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'betName');
		$this->data['bet_name'] = null;
		$this->columns['groups_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bets','COLUMN_NAME'=>'groups_id_FK','ORDINAL_POSITION'=>'3','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'groupsIdFK');
		$this->data['groups_id_FK'] = null;
		$this->columns['add_date'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bets','COLUMN_NAME'=>'add_date','ORDINAL_POSITION'=>'4','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'datetime','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'datetime','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'addDate');
		$this->data['add_date'] = null;
		$this->columns['end_date'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bets','COLUMN_NAME'=>'end_date','ORDINAL_POSITION'=>'5','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'datetime','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'datetime','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'endDate');
		$this->data['end_date'] = null;
		$this->columns['bet_active'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bets','COLUMN_NAME'=>'bet_active','ORDINAL_POSITION'=>'6','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'datetime','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'datetime','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'betActive');
		$this->data['bet_active'] = null;
   
	}  
	
	public function setBetsId($betsId)
	{
		$this->data['bets_id'] = $betsId; 
	}

	public function setBetName($betName)
	{
		$this->data['bet_name'] = $betName; 
	}

	public function setGroupsIdFK($groupsIdFK)
	{
		$this->data['groups_id_FK'] = $groupsIdFK; 
	}

	public function setAddDate($addDate)
	{
		$this->data['add_date'] = $addDate; 
	}

	public function setEndDate($endDate)
	{
		$this->data['end_date'] = $endDate; 
	}

	public function setBetActive($betActive)
	{
		$this->data['bet_active'] = $betActive; 
	}


	public function getBetsId()
	{
		return $this->data['bets_id']; 
	}

	public function getBetName()
	{
		return $this->data['bet_name']; 
	}

	public function getGroupsIdFK()
	{
		return $this->data['groups_id_FK']; 
	}

	public function getAddDate()
	{
		return $this->data['add_date']; 
	}

	public function getEndDate()
	{
		return $this->data['end_date']; 
	}

	public function getBetActive()
	{
		return $this->data['bet_active']; 
	}


}

?>
