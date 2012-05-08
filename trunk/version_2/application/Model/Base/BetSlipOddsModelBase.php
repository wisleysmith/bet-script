<?php


  
class Model_Base_BetSlipOddsModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'bets_slip_odds' =>array('numeric','required'),
		'odd_value_id_FK' =>array('numeric','required'),
		'bet_slip_id_FK' =>array('numeric','required') 
	);
	
	private $filters = array
	(
		'bets_slip_odds' =>array('addslashes','trim'),
		'odd_value_id_FK' =>array('addslashes','trim'),
		'bet_slip_id_FK' =>array('addslashes','trim') 
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
		$this->setTableName('bet_slip_odds');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'bet_slip_odds','COLUMN_NAME'=>'bets_slip_odds','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['Ref_30'] =  array('TABLE_NAME'=>'bet_slip_odds','COLUMN_NAME'=>'odd_value_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'Ref_30','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'odd_value','REFERENCED_COLUMN_NAME'=>'odd_value_id');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['bets_slip_odds'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bet_slip_odds','COLUMN_NAME'=>'bets_slip_odds','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'betsSlipOdds');
		$this->data['bets_slip_odds'] = null;
		$this->columns['odd_value_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bet_slip_odds','COLUMN_NAME'=>'odd_value_id_FK','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'oddValueIdFK');
		$this->data['odd_value_id_FK'] = null;
		$this->columns['bet_slip_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'bet_slip_odds','COLUMN_NAME'=>'bet_slip_id_FK','ORDINAL_POSITION'=>'3','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'betSlipIdFK');
		$this->data['bet_slip_id_FK'] = null;
   
	}  
	
	public function setBetsSlipOdds($betsSlipOdds)
	{
		$this->data['bets_slip_odds'] = $betsSlipOdds; 
	}

	public function setOddValueIdFK($oddValueIdFK)
	{
		$this->data['odd_value_id_FK'] = $oddValueIdFK; 
	}

	public function setBetSlipIdFK($betSlipIdFK)
	{
		$this->data['bet_slip_id_FK'] = $betSlipIdFK; 
	}


	public function getBetsSlipOdds()
	{
		return $this->data['bets_slip_odds']; 
	}

	public function getOddValueIdFK()
	{
		return $this->data['odd_value_id_FK']; 
	}

	public function getBetSlipIdFK()
	{
		return $this->data['bet_slip_id_FK']; 
	}


}

?>
