<?php


  
class Model_Base_UserModelBase extends Core_Model_Adapter_Object
{      
  	private $validators = array
	(
		'user_id' =>array('numeric','required'),
		'user_name' =>array('size'=>array('min'=>0,'max'=>20),'required'),
		'password' =>array('size'=>array('min'=>0,'max'=>50),'required'),
		'last_login' =>array('datetime','required'),
		'date_created' =>array('datetime','required'),
		'first_name' =>array('size'=>array('min'=>0,'max'=>50),'required'),
		'last_name' =>array('size'=>array('min'=>0,'max'=>50),'required'),
		'email' =>array('size'=>array('min'=>0,'max'=>250),'required'),
		'user_status_id_FK' =>array('numeric','required'),
		'mail_validation' =>array('size'=>array('min'=>0,'max'=>50)),
		'banned' =>array('numeric','required'),
		'email_validated' =>array('numeric','required') 
	);
	
	private $filters = array
	(
		'user_id' =>array('addslashes','trim'),
		'user_name' =>array('addslashes','trim'),
		'password' =>array('addslashes','trim'),
		'last_login' =>array('addslashes','trim'),
		'date_created' =>array('addslashes','trim'),
		'first_name' =>array('addslashes','trim'),
		'last_name' =>array('addslashes','trim'),
		'email' =>array('addslashes','trim'),
		'user_status_id_FK' =>array('addslashes','trim'),
		'mail_validation' =>array('addslashes','trim'),
		'banned' =>array('addslashes','trim'),
		'email_validated' =>array('addslashes','trim') 
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
		$this->setTableName('user');  
		$this->setColumnsData(); 
		$this->setTableRelationsData();	  
		parent::__construct();
	}
	 
	private function setTableRelationsData()
	{
		$this->relations['PRIMARY'] =  array('TABLE_NAME'=>'user','COLUMN_NAME'=>'user_id','CONSTRAINT_TYPE'=>'PRIMARY KEY','CONSTRAINT_NAME'=>'PRIMARY','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['unike'] =  array('TABLE_NAME'=>'user','COLUMN_NAME'=>'user_name','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'unike','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['unikeemail'] =  array('TABLE_NAME'=>'user','COLUMN_NAME'=>'email','CONSTRAINT_TYPE'=>'UNIQUE','CONSTRAINT_NAME'=>'unikeemail','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'','REFERENCED_TABLE_SCHEMA'=>'','REFERENCED_TABLE_NAME'=>'','REFERENCED_COLUMN_NAME'=>'');
		$this->relations['Ref_39'] =  array('TABLE_NAME'=>'user','COLUMN_NAME'=>'user_status_id_FK','CONSTRAINT_TYPE'=>'FOREIGN KEY','CONSTRAINT_NAME'=>'Ref_39','TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','ORDINAL_POSITION'=>'1','POSITION_IN_UNIQUE_CONSTRAINT'=>'1','REFERENCED_TABLE_SCHEMA'=>'betting_last','REFERENCED_TABLE_NAME'=>'user_status','REFERENCED_COLUMN_NAME'=>'user_status_id');
   
	}
	
	
	private function setColumnsData()
	{
		$this->columns['user_id'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'user','COLUMN_NAME'=>'user_id','ORDINAL_POSITION'=>'1','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'int','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'10','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'int(11) unsigned','COLUMN_KEY'=>'PRI','EXTRA'=>'auto_increment','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'userId');
		$this->data['user_id'] = null;
		$this->columns['user_name'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'user','COLUMN_NAME'=>'user_name','ORDINAL_POSITION'=>'2','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'20','CHARACTER_OCTET_LENGTH'=>'60','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'utf8','COLLATION_NAME'=>'utf8_general_ci','COLUMN_TYPE'=>'varchar(20)','COLUMN_KEY'=>'UNI','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'userName');
		$this->data['user_name'] = null;
		$this->columns['password'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'user','COLUMN_NAME'=>'password','ORDINAL_POSITION'=>'3','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'50','CHARACTER_OCTET_LENGTH'=>'150','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'utf8','COLLATION_NAME'=>'utf8_general_ci','COLUMN_TYPE'=>'varchar(50)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'password');
		$this->data['password'] = null;
		$this->columns['last_login'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'user','COLUMN_NAME'=>'last_login','ORDINAL_POSITION'=>'4','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'datetime','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'datetime','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'lastLogin');
		$this->data['last_login'] = null;
		$this->columns['date_created'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'user','COLUMN_NAME'=>'date_created','ORDINAL_POSITION'=>'5','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'datetime','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'datetime','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'dateCreated');
		$this->data['date_created'] = null;
		$this->columns['first_name'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'user','COLUMN_NAME'=>'first_name','ORDINAL_POSITION'=>'6','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'50','CHARACTER_OCTET_LENGTH'=>'150','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'utf8','COLLATION_NAME'=>'utf8_general_ci','COLUMN_TYPE'=>'varchar(50)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'firstName');
		$this->data['first_name'] = null;
		$this->columns['last_name'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'user','COLUMN_NAME'=>'last_name','ORDINAL_POSITION'=>'7','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'50','CHARACTER_OCTET_LENGTH'=>'150','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'utf8','COLLATION_NAME'=>'utf8_general_ci','COLUMN_TYPE'=>'varchar(50)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'lastName');
		$this->data['last_name'] = null;
		$this->columns['email'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'user','COLUMN_NAME'=>'email','ORDINAL_POSITION'=>'8','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'250','CHARACTER_OCTET_LENGTH'=>'750','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'utf8','COLLATION_NAME'=>'utf8_general_ci','COLUMN_TYPE'=>'varchar(250)','COLUMN_KEY'=>'UNI','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'email');
		$this->data['email'] = null;
		$this->columns['user_status_id_FK'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'user','COLUMN_NAME'=>'user_status_id_FK','ORDINAL_POSITION'=>'9','COLUMN_DEFAULT'=>'0','IS_NULLABLE'=>'NO','DATA_TYPE'=>'tinyint','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'3','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'tinyint(4) unsigned','COLUMN_KEY'=>'MUL','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'userStatusIdFK');
		$this->data['user_status_id_FK'] = null;
		$this->columns['mail_validation'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'user','COLUMN_NAME'=>'mail_validation','ORDINAL_POSITION'=>'10','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'YES','DATA_TYPE'=>'varchar','CHARACTER_MAXIMUM_LENGTH'=>'50','CHARACTER_OCTET_LENGTH'=>'150','NUMERIC_PRECISION'=>'','NUMERIC_SCALE'=>'','CHARACTER_SET_NAME'=>'utf8','COLLATION_NAME'=>'utf8_general_ci','COLUMN_TYPE'=>'varchar(50)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'mailValidation');
		$this->data['mail_validation'] = null;
		$this->columns['banned'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'user','COLUMN_NAME'=>'banned','ORDINAL_POSITION'=>'11','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'tinyint','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'3','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'tinyint(4)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'banned');
		$this->data['banned'] = null;
		$this->columns['email_validated'] =  array('TABLE_CATALOG'=>'','TABLE_SCHEMA'=>'betting_last','TABLE_NAME'=>'user','COLUMN_NAME'=>'email_validated','ORDINAL_POSITION'=>'12','COLUMN_DEFAULT'=>'','IS_NULLABLE'=>'NO','DATA_TYPE'=>'tinyint','CHARACTER_MAXIMUM_LENGTH'=>'','CHARACTER_OCTET_LENGTH'=>'','NUMERIC_PRECISION'=>'3','NUMERIC_SCALE'=>'0','CHARACTER_SET_NAME'=>'','COLLATION_NAME'=>'','COLUMN_TYPE'=>'tinyint(4)','COLUMN_KEY'=>'','EXTRA'=>'','PRIVILEGES'=>'select,insert,update,references','COLUMN_COMMENT'=>'','PROPERTY_COLUMN_NAME'=>'emailValidated');
		$this->data['email_validated'] = null;
   
	}  
	
	public function setUserId($userId)
	{
		$this->data['user_id'] = $userId; 
	}

	public function setUserName($userName)
	{
		$this->data['user_name'] = $userName; 
	}

	public function setPassword($password)
	{
		$this->data['password'] = $password; 
	}

	public function setLastLogin($lastLogin)
	{
		$this->data['last_login'] = $lastLogin; 
	}

	public function setDateCreated($dateCreated)
	{
		$this->data['date_created'] = $dateCreated; 
	}

	public function setFirstName($firstName)
	{
		$this->data['first_name'] = $firstName; 
	}

	public function setLastName($lastName)
	{
		$this->data['last_name'] = $lastName; 
	}

	public function setEmail($email)
	{
		$this->data['email'] = $email; 
	}

	public function setUserStatusIdFK($userStatusIdFK)
	{
		$this->data['user_status_id_FK'] = $userStatusIdFK; 
	}

	public function setMailValidation($mailValidation)
	{
		$this->data['mail_validation'] = $mailValidation; 
	}

	public function setBanned($banned)
	{
		$this->data['banned'] = $banned; 
	}

	public function setEmailValidated($emailValidated)
	{
		$this->data['email_validated'] = $emailValidated; 
	}


	public function getUserId()
	{
		return $this->data['user_id']; 
	}

	public function getUserName()
	{
		return $this->data['user_name']; 
	}

	public function getPassword()
	{
		return $this->data['password']; 
	}

	public function getLastLogin()
	{
		return $this->data['last_login']; 
	}

	public function getDateCreated()
	{
		return $this->data['date_created']; 
	}

	public function getFirstName()
	{
		return $this->data['first_name']; 
	}

	public function getLastName()
	{
		return $this->data['last_name']; 
	}

	public function getEmail()
	{
		return $this->data['email']; 
	}

	public function getUserStatusIdFK()
	{
		return $this->data['user_status_id_FK']; 
	}

	public function getMailValidation()
	{
		return $this->data['mail_validation']; 
	}

	public function getBanned()
	{
		return $this->data['banned']; 
	}

	public function getEmailValidated()
	{
		return $this->data['email_validated']; 
	}


}

?>
