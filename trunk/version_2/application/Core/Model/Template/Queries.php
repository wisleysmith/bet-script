<?php
 
class Core_Model_Template_Queries extends Core_Event_Dispatcher implements Core_Model_Template_IQueries
{ 
	protected $templateQueries; 
	   
	public function __construct()
	{
		foreach ($this->templateQueries as $key=>$t)
		{
			$this->addEventListener('on'.ucfirst($key),$this,'on'.ucfirst($key));
		}
	}    
	
	public function getTemplateQueries()
	{ 
		return $this->templateQueries;
	}
	
	public function addQueryTemplate($name="",$values=array())
	{
		if($name=="")
		{
			return false;
		}
		
		if(!is_array($values)||empty($values))
		{
			return false;
		} 
		
		$this->templateQueries[$name]=$values; 
	}
	 
	public function getTemplate($key,$innerKey=null)
	{
		if(isset($this->templateQueries[$key]))
		{
			if($innerKey!=null)
			{ 
				if(isset($this->templateQueries[$key][$innerKey]))
				{
					return $this->templateQueries[$key][$innerKey]; 
				}
				else 
				{ 
					return false;
				} 
			}
			return $this->templateQueries[$key];
		} 
		
		return false;
	}  

	public function queryFactoryTemplate($sqlObject)
	{
		$queryString = "";
		
		$queries = $this->prepareQueries($sqlObject);
		  
		foreach ($queries as $qH)
		{
			$key = $qH['template'];
			
			$templateQuery = "";
			 
			
			$templateQuery = $this->getTemplate($key,"query"); 
			$defaultTemplateQuery = $this->getTemplate($key,"default") ;
			
			if(!isset($qH['values']))
			{
				$values = array();
			}
			else 
			{
				$values = $qH['values'];
			} 
 
			if(!is_array($defaultTemplateQuery))
			{ 
				$defaultTemplateQuery = array();
			} 
			  
			$replaceData = array_merge($defaultTemplateQuery,$values);
			foreach($replaceData as $keyDefault => $value)
			{	
				$templateQuery = str_replace("[@$keyDefault]",$value, $templateQuery);
			} 
			   
			$queryString .= ' '.$templateQuery; 
		}
		return $queryString ;
	} 
	
	protected function prepareQueries($sqlObject)
	{ 
		foreach ($sqlObject->getQueryHolder() as $q)
		{
			$this->dispatchEvent('on'.ucfirst($q['template']),array('sqlObject'=>$sqlObject)); 
		}     
		
		return $sqlObject->getQueryHolder();
	} 
}