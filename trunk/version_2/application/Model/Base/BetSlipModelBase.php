<?php


  
class Model_Base_BetSlipModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'bet_slip_id' =>array('numeric','required'),
		'date_created' =>array('datetime','required'),
		'status' =>array('numeric'),
		'finished' =>array('numeric'),
		'played' =>array('numeric','required'),
		'user_id_FK' =>array('numeric','required') 
	);
	
	private $filters = array
	(
		'bet_slip_id' =>array('addslashes','trim'),
		'date_created' =>array('addslashes','trim'),
		'status' =>array('addslashes','trim'),
		'finished' =>array('addslashes','trim'),
		'played' =>array('addslashes','trim'),
		'user_id_FK' =>array('addslashes','trim') 
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
		$this->setTableName('bet_slip');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'bet_slip','COLUMN_NAME'=>'bet_slip_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['fk_bet_slip_1'] =  array('TABLE_NAME'=>'bet_slip','COLUMN_NAME'=>'user_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'fk_bet_slip_1','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'user','REFERENCED_COLUMN_NAME'=>'user_id');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['bet_slip_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bet_slip','COLUMN_NAME'=>'bet_slip_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'betSlipId');
		$this->data['bet_slip_id'] = null;
		$this->columns['date_created'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bet_slip','COLUMN_NAME'=>'date_created','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'datetime','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'datetime','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'dateCreated');
		$this->data['date_created'] = null;
		$this->columns['status'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bet_slip','COLUMN_NAME'=>'status','ORDINAL_POSITION'=>'3','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'YES','DATA_TYPE'=>'tinyint','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'3','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'tinyint(4) unsigned','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'status');
		$this->data['status'] = null;
		$this->columns['finished'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bet_slip','COLUMN_NAME'=>'finished','ORDINAL_POSITION'=>'4','COLUMN_DEFAULT'=>'0','IS_NULLABLE'=>'YES','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(10) unsigned','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'finished');
		$this->data['finished'] = null;
		$this->columns['played'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bet_slip','COLUMN_NAME'=>'played','ORDINAL_POSITION'=>'5','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(10) unsigned','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'played');
		$this->data['played'] = null;
		$this->columns['user_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bet_slip','COLUMN_NAME'=>'user_id_FK','ORDINAL_POSITION'=>'6','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'userIdFK');
		$this->data['user_id_FK'] = null;
   
	}  
	
	public function setBetSlipId($betSlipId)
	{
		$this->data['bet_slip_id'] = $betSlipId; 
	}

	public function setDateCreated($dateCreated)
	{
		$this->data['date_created'] = $dateCreated; 
	}

	public function setStatus($status)
	{
		$this->data['status'] = $status; 
	}

	public function setFinished($finished)
	{
		$this->data['finished'] = $finished; 
	}

	public function setPlayed($played)
	{
		$this->data['played'] = $played; 
	}

	public function setUserIdFK($userIdFK)
	{
		$this->data['user_id_FK'] = $userIdFK; 
	}


	public function getBetSlipId()
	{
		return $this->data['bet_slip_id']; 
	}

	public function getDateCreated()
	{
		return $this->data['date_created']; 
	}

	public function getStatus()
	{
		return $this->data['status']; 
	}

	public function getFinished()
	{
		return $this->data['finished']; 
	}

	public function getPlayed()
	{
		return $this->data['played']; 
	}

	public function getUserIdFK()
	{
		return $this->data['user_id_FK']; 
	}


}

?>
