<?php


  
class Model_Base_TransactionTypeModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'transaction_type_id' =>array('numeric','required'),
		'transaction_name' =>array('size'=>array('min'=>0,'max'=>45)) 
	);
	
	private $filters = array
	(
		'transaction_type_id' =>array('addslashes','trim'),
		'transaction_name' =>array('addslashes','trim') 
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
		$this->setTableName('transaction_type');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'transaction_type','COLUMN_NAME'=>'transaction_type_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['transaction_type_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'transaction_type','COLUMN_NAME'=>'transaction_type_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'transactionTypeId');
		$this->data['transaction_type_id'] = null;
		$this->columns['transaction_name'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'transaction_type','COLUMN_NAME'=>'transaction_name','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'YES','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'45','CHARACTER_OCTET_LENGTH'=>'45','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'latin1','COLLATION_NAME'=>'latin1_swedish_ci','COLUMN_TYPE'=>'varchar(45)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'transactionName');
		$this->data['transaction_name'] = null;
   
	}  
	
	public function setTransactionTypeId($transactionTypeId)
	{
		$this->data['transaction_type_id'] = $transactionTypeId; 
	}

	public function setTransactionName($transactionName)
	{
		$this->data['transaction_name'] = $transactionName; 
	}


	public function getTransactionTypeId()
	{
		return $this->data['transaction_type_id']; 
	}

	public function getTransactionName()
	{
		return $this->data['transaction_name']; 
	}


}

?>
