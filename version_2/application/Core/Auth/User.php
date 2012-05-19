<?php
class Core_Auth_User extends Core_Session_Object 
{  
	public function __construct($sessionId = null)
	{  
		parent::__construct();
	}
	 
	public function getSessionNameSpace()
	{
		return 'USER';
	}
	
	public function setRole($role)
	{
		return $_SESSION[$this->sessionNamespace()]['role'] = $role;
	}
	
	public function getRole()
	{
		if(isset( $_SESSION[$this->sessionNamespace()]['role']))
		{
			return $_SESSION[$this->sessionNamespace()]['role'];
		}
		return null;
	}
	
	public function setUserName($username)
	{
		 $_SESSION[$this->sessionNamespace()]['user_name'] = $username;
	}
	 
	public function getUserName()
	{
		if(isset($_SESSION[$this->sessionNamespace()]['user_name']))
		{
			$_SESSION[$this->sessionNamespace()]['user_name'];
		}
		return null;
	}
	
	public function setUserId($userid)
	{ 
		$_SESSION[$this->sessionNamespace()]['userid'] = $userid;
	}
	 
	public function getUserId()
	{
		if(isset($_SESSION[$this->sessionNamespace()]['user_id']))
		{
			return $_SESSION[$this->sessionNamespace()]['user_id'];
		}
		return null;
	} 
	
	public function isAuth($value=null)
	{
		if($value===null)
		{
			if(isset($_SESSION[$this->sessionNamespace()]['is_auth']))
			{
				return $_SESSION[$this->sessionNamespace()]['is_auth'];
			}
			return false;
		}
		else 
		{ 
			
			$_SESSION[$this->sessionNamespace()]['is_auth'] = (bool) $value;
		}
	} 
}