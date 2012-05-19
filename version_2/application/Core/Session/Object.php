<?php 
abstract class Core_Session_Object
{
	private $sessionData = array();
	
	public function __construct()
	{ 
		if(!isset($_SESSION))
		{ 
			session_start();
			if(isset($_SESSION[$this->sessionNamespace()]))
			{
				if(isset($_SESSION[$this->sessionNamespace()]['ip']))
				{
					if($_SESSION[$this->sessionNamespace()]['ip'] != $_SERVER['REMOTE_ADDR'])
					{
						$this->destroy();
					}
				}
			}
			else 
			{
				$_SESSION[$this->sessionNamespace()]['ip'] = $_SERVER['REMOTE_ADDR'];
			} 
		} 
	} 
	
	public function sessionNamespace()
	{
		return $this->getSessionNameSpace();
	}
	
	public static function setSessionId($value = null)
	{
		
		if(isset($_SESSION))
		{ 
			return false;
		} 
 
		if($value!==null)
		{
			session_id($value);
			return;
		}
	 
		if(session_id()=='')
		{
			$sessionId = '';
			 
			if(isset($_GET['session']))
			{
				session_id($_GET['session']);
			}
			else if(isset($_COOKIE['PHPSESSID']))
			{
				session_id($_COOKIE['PHPSESSID']);
			}
			else 
			{
				session_id(Core_Session_Object::generateSessionId()); 
			}
		} 
	}
	
	public static function generateSessionId($additionString='')
	{
		return md5($additionString.uniqid((rand()*rand())));
	}
	
	abstract function getSessionNameSpace();
	
	public function addData($key,$value)
	{
		$_SESSION[$this->sessionNamespace()][$key] = $value;
	}
	
	public function setData($arrayOfKeyValues)
	{
		foreach ($arrayOfKeyValues as $key=>$value)
		{
			$_SESSION[$this->sessionNamespace()][$key] = $value;
		}
	}
	
	public function removeData($key)
	{
		if(isset($_SESSION[$this->sessionNamespace()][$key]))
		{
			$_SESSION[$this->sessionNamespace()][$key] = null;
		} 
	}
	
	public function destroy()
	{
		session_destroy();
	}
	
	public function getData($key=null)
	{
		if($key!==null)
		{
			if(isset($_SESSION[$this->sessionNamespace()][$key]))
			{
				return $_SESSION[$this->sessionNamespace()][$key];
			}
		}
		return $_SESSION[$this->sessionNamespace()];	
	}
}
?>