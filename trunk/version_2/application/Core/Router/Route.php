<?php
class Core_Router_Route implements Core_Router_IRouter
{
	private $action; 
	private $controller;
	   
	public function getAction()
	{
		if(isset($this->action))
		{
			return $this->action; 
		}
		return $this->action = $this->getRequestedAction();
	}  
	
	public function getControllerClass()
	{ 
		$controller = "Controller_".ucfirst($this->getController()); 
		return  $controller;
	} 
	
	public function getActionMethod()
	{
		$action = "action".ucfirst($this->getAction()); 
		return $action;
	}
	
	public function getController()
	{
		if(isset($this->controller))
		{
			return $this->controller;
		}
		return $this->controller = $this->getRequestedController();
	}
  
	private function getRequestedController()
	{ 
		if(isset($_REQUEST['controller']))
		{
			if(!ctype_alpha($_REQUEST['controller']))
			{
				throw new Core_Exceptions("Controller is not valid string");
			}  
			
			if(strlen($_REQUEST['controller'])>99)
			{
				throw new Core_Exceptions("Controller is not valid over 100 string long");	
			}
			$controller = $_REQUEST['controller'];
			
		}
		else 
		{
			$controller = 'index';
		}
		return $controller;
	}
	
	
	private function getRequestedAction()
	{  
		if(isset($_REQUEST['action']))
		{
			if(!ctype_alpha($_REQUEST['action']))
			{
				throw new Core_Exceptions("Action is not valid string");
			}  
			
			if(strlen($_REQUEST['action'])>99)
			{
				throw new Core_Exceptions("View is not valid over 100 string long");	
			}
			$action = $_REQUEST['action']; 
		}
		else 
		{
			$action = "index";
		}
		return $action;
	} 
	
	public function getFullUrl($params)
	{
		return Application::getBaseUrl().'/'.Application::getRouter()->getUrl($params);
	}
	
	
	public function getUrl($params=array())
	{
		if(!isset($params['controller']))
		{
			$controller = 'index';
		}
		else 
		{
			$controller = $params['controller'];
		}
		
		if(!isset($params['action']))
		{
			$action = 'index';	
		}
		else 
		{
			$action = $params['action'];
		}
		
		if(!isset($params['params']))
		{
			$params = "";
		}
		else 
		{
			$params = "&".$params['params'];
		}  
		
		$url = '?controller='.$controller.'&action='.$action.$params;
		$session = '';
		
		if(session_id()!='')
		{
			$session = '&session='.session_id(); 
		}
		return $url.$session;
	}    
}
?>