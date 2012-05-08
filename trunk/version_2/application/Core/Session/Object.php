<?php 
class Core_Session_Object
{
	private $sessionData = array();
	
	public function __construct()
	{
		@session_start();
	}
	  
	public function sessionNamespace()
	{
		return get_class($this);
	}
	
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