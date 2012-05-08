<?php


  
class Model_Base_TransactionModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'transaction_id' =>array('numeric','required'),
		'user_id_FK' =>array('numeric','required'),
		'money' =>array('required'),
		'date_created' =>array('datetime','required'),
		'transaction_type_id_FK' =>array('numeric','required'),
		'transaction_type_idendifier' =>array('numeric') 
	);
	
	private $filters = array
	(
		'transaction_id' =>array('addslashes','trim'),
		'user_id_FK' =>array('addslashes','trim'),
		'money' =>array('addslashes','trim'),
		'date_created' =>array('addslashes','trim'),
		'transaction_type_id_FK' =>array('addslashes','trim'),
		'transaction_type_idendifier' =>array('addslashes','trim') 
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
		$this->setTableName('transaction');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'transaction','COLUMN_NAME'=>'transaction_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['fk_transaction_1'] =  array('TABLE_NAME'=>'transaction','COLUMN_NAME'=>'transaction_type_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'fk_transaction_1','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'transaction_type','REFERENCED_COLUMN_NAME'=>'transaction_type_id');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['transaction_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'transaction','COLUMN_NAME'=>'transaction_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'transactionId');
		$this->data['transaction_id'] = null;
		$this->columns['user_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'transaction','COLUMN_NAME'=>'user_id_FK','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'0','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'userIdFK');
		$this->data['user_id_FK'] = null;
		$this->columns['money'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'transaction','COLUMN_NAME'=>'money','ORDINAL_POSITION'=>'3','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'decimal','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'11','NUMERIC_SCALE'=>'2','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'decimal(11,2)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'money');
		$this->data['money'] = null;
		$this->columns['date_created'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'transaction','COLUMN_NAME'=>'date_created','ORDINAL_POSITION'=>'4','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'datetime','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'datetime','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'dateCreated');
		$this->data['date_created'] = null;
		$this->columns['transaction_type_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'transaction','COLUMN_NAME'=>'transaction_type_id_FK','ORDINAL_POSITION'=>'5','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'transactionTypeIdFK');
		$this->data['transaction_type_id_FK'] = null;
		$this->columns['transaction_type_idendifier'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'transaction','COLUMN_NAME'=>'transaction_type_idendifier','ORDINAL_POSITION'=>'6','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'YES','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'transactionTypeIdendifier');
		$this->data['transaction_type_idendifier'] = null;
   
	}  
	
	public function setTransactionId($transactionId)
	{
		$this->data['transaction_id'] = $transactionId; 
	}

	public function setUserIdFK($userIdFK)
	{
		$this->data['user_id_FK'] = $userIdFK; 
	}

	public function setMoney($money)
	{
		$this->data['money'] = $money; 
	}

	public function setDateCreated($dateCreated)
	{
		$this->data['date_created'] = $dateCreated; 
	}

	public function setTransactionTypeIdFK($transactionTypeIdFK)
	{
		$this->data['transaction_type_id_FK'] = $transactionTypeIdFK; 
	}

	public function setTransactionTypeIdendifier($transactionTypeIdendifier)
	{
		$this->data['transaction_type_idendifier'] = $transactionTypeIdendifier; 
	}


	public function getTransactionId()
	{
		return $this->data['transaction_id']; 
	}

	public function getUserIdFK()
	{
		return $this->data['user_id_FK']; 
	}

	public function getMoney()
	{
		return $this->data['money']; 
	}

	public function getDateCreated()
	{
		return $this->data['date_created']; 
	}

	public function getTransactionTypeIdFK()
	{
		return $this->data['transaction_type_id_FK']; 
	}

	public function getTransactionTypeIdendifier()
	{
		return $this->data['transaction_type_idendifier']; 
	}


}

?>
