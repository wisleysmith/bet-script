<?php
 
class Model_UserModel extends Model_Base_UserModelBase
{   
	//change it before using application
	const SALT = 'bettins_script_custom_salt'; 
	private $passwordSizeValidator;
	public function __construct()
	{
		$this->data['password_before_salt'] = null;
		$this->excludeFromService[]='password';
		$this->addForceColumnUpdate('last_login'); 
		$this->addForceColumnUpdate('date_created'); 
		parent::__construct(); 
	}  
	  
	public function validate($excludeFromValidation = array())
	{  
		if(!in_array('user_name', $excludeFromValidation))
		{
			$usernameSizeValidator =  new Zend_Validate_StringLength(1,20);
			if (!$usernameSizeValidator->isValid($this->getUserName()))
		    {
				$this->setValidationError('user_name', "Username size must bee between 1-20");
			}
		}
		
		if(!in_array('email', $excludeFromValidation))
		{
			$emailValidator = new Zend_Validate_EmailAddress();
			if (!$emailValidator->isValid($this->getEmail())) 
			{
			    $this->setValidationError('email', "Email is not valid");
			}; 
		} 
		
	    if(!in_array('password_before_salt', $excludeFromValidation))
		{
			if($this->getPasswordBeforeSalt()!='')
			{
				$passwordSizeValidator =  new Zend_Validate_StringLength(1,20);
				 
				if (!$passwordSizeValidator->isValid($this->getPasswordBeforeSalt()))
			    { 
					$this->setValidationError('password', "Password size must bee between 1-20");
				}  
			} 
		}
		
		parent::validate($excludeFromValidation);
	}
	
	public function insert()
	{  
		$this->setDateCreated(date('Y-m-d H:i:s')); 
		parent::insert();
	}
	
	public function generatePassword($password)
	{  
		return sha1($password.Model_UserModel::SALT);
	}
	 
	private function passwordWithSalt()
	{
	
		return $this->generatePassword($this->getPasswordBeforeSalt());
	}
	
	public function login()
	{
		$userId = $this->getUserId();
		
		if(!isset($userId))
		{
			$this->load(array('user_name'=>$this->getUserName(),'password'=>$this->passwordWithSalt()));
		}

		$userId = $this->getUserId();
	 
		if(!isset($userId))
		{
			$this->setValidationError('user', 'Wrong login data');
			return false;
		}
		 
		return $this;
	}
	
	public function registration()
	{
		$bookhouse = new Model_BookhouseModel();
		$bookhouse->loadActiveBookhouse();
		if($bookhouse->getCanUserRegister()==0)
		{
			$this->setValidationError('Bookhouse', 'Registration is disabled');
		} 
		
		$userCheckModel = new Model_UserModel();
		$userCheckModel->load(array('user_name'=>$this->getUserName()));
		$userId = $userCheckModel->getUserId();
		if(isset($userId))
		{
			$this->setValidationError('username', 'Username already exist');
			return;
		}
		
		$userCheckModel->load(array('email'=>$this->getEmail()));
		$userId = $userCheckModel->getUserId();
		if(isset($userId))
		{
			$this->setValidationError('username', 'Email already exist');
			return;
		}
		$this->setLastLogin(date('Y-m-d H:i:s')); 
		$this->setUserStatusIdFK(3);
		$this->setBanned(0);
		$this->setEmailValidated(0); 
		$this->insert();
		
		$userIdFK = $this->getConnection()->getInsertId();
		
		$transaction = new Model_TransactionModel();
		$transaction->setUserIdFK($userIdFK);
		$transaction->setTransactionTypeIdFK(1);
		$transaction->setMoney($bookhouse->getDefaultMoneyValue());
		$transaction->setTransactionTypeIdendifier(null);
		$transaction->insert();  
	}
	
	public function setPasswordBeforeSalt($password)
	{
		if($password=='')
		{  
			$this->addForceColumnUpdate('password'); 
		}
		else 
		{
			$this->setPassword($this->generatePassword($password));
			$this->addData('password_before_salt',$password);
		}
	}
	
	public function getPasswordBeforeSalt()
	{
		return $this->getData('password_before_salt') ;
	}
} 