<?php

 
class Model_TransactionModel extends Model_Base_TransactionModelBase
{   
	private $userId; 
	private $user;
	public function __construct()
	{
		$this->data['user_id'] = null;
		$this->addForceColumnUpdate('date_created');
		parent::__construct(); 
	}  
	
	public function getTransactionsByUser()
	{
		$this->resetQuery();
		$userId = $this->getUserId();
		if($userId===null)
		{
			throw new Core_Exceptions('User id not set');
		}
		$this->addQuery('select',array('table'=>$this->getTableName())) ;
		$this->addQuery('where',array('where_condition'=>'user_id_FK='.(int)$userId));
	}
	
	public function getUserId()
	{
		if(!isset($this->data['user_id']))
		{
			$this->setUserId();
		}
		return $this->data['user_id'];
	}
	
	public function insert()
	{
		$dateCreated = date('Y-m-d H:i:s',time());
		$this->setDateCreated($dateCreated); 
		
		return parent::insert();
	}
	
	public function getUser()
	{
		if(!isset($this->user))
		{
			$this->user = new Core_Auth_User();
		}
		return $this->user;
	}
	 
	public function getUserMoney()
	{
		$this->resetQuery();
		$userId = $this->getUserIdFK();
		if($userId===null)
		{
			throw new Core_Exceptions('User id not set');
		}
		$this->addQuery('select',array('table'=>$this->getTableName(),'select_expr'=>'SUM(money) as money'));
		$this->addQuery('where',array('where_condition'=>'user_id_FK='.(int)$userId));
		return $this;
	}
	
	public function setUserId($userId=null)
	{ 
		if($this->getUser()->getRole()=='admin'||$this->getUser()->getRole()=='superadmin')
		{
			$this->data['user_id'] = $userId;
		}
		else 
		{
			$this->data['user_id'] = $this->getUser()->getUserId();
		}
	}  
}