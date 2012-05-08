<?php


  
class Model_Base_SportsModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'sports_id' =>array('numeric','required'),
		'name_of_sport' =>array('size'=>array('min'=>0,'max'=>100),'required'),
		'bookhouse_id_FK' =>array('numeric','required') 
	);
	
	private $filters = array
	(
		'sports_id' =>array('addslashes','trim'),
		'name_of_sport' =>array('addslashes','trim'),
		'bookhouse_id_FK' =>array('addslashes','trim') 
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
		$this->setTableName('sports');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'sports','COLUMN_NAME'=>'sports_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['name'] =  array('TABLE_NAME'=>'sports','COLUMN_NAME'=>'name_of_sport','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'name','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['name'] =  array('TABLE_NAME'=>'sports','COLUMN_NAME'=>'bookhouse_id_FK','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'name','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'2','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['sports_to_bookhouse'] =  array('TABLE_NAME'=>'sports','COLUMN_NAME'=>'bookhouse_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'sports_to_bookhouse','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'bookhouse','REFERENCED_COLUMN_NAME'=>'bookhouse_id');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['sports_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'sports','COLUMN_NAME'=>'sports_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'sportsId');
		$this->data['sports_id'] = null;
		$this->columns['name_of_sport'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'sports','COLUMN_NAME'=>'name_of_sport','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'100','CHARACTER_OCTET_LENGTH'=>'300','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'utf8','COLLATION_NAME'=>'utf8_general_ci','COLUMN_TYPE'=>'varchar(100)','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'nameOfSport');
		$this->data['name_of_sport'] = null;
		$this->columns['bookhouse_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'sports','COLUMN_NAME'=>'bookhouse_id_FK','ORDINAL_POSITION'=>'3','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'bookhouseIdFK');
		$this->data['bookhouse_id_FK'] = null;
   
	}  
	
	public function setSportsId($sportsId)
	{
		$this->data['sports_id'] = $sportsId; 
	}

	public function setNameOfSport($nameOfSport)
	{
		$this->data['name_of_sport'] = $nameOfSport; 
	}

	public function setBookhouseIdFK($bookhouseIdFK)
	{
		$this->data['bookhouse_id_FK'] = $bookhouseIdFK; 
	}


	public function getSportsId()
	{
		return $this->data['sports_id']; 
	}

	public function getNameOfSport()
	{
		return $this->data['name_of_sport']; 
	}

	public function getBookhouseIdFK()
	{
		return $this->data['bookhouse_id_FK']; 
	}


}

?>
