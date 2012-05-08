<?php

abstract class Core_Model_Adapter_Sql
{
	private $errors = array(); 
	protected $queryHolder = array();
	protected $templateQueries; 
	private static $sqlConnection = null;	
	private static $sqlTemplate = null; 
	private $connection; 
	
	public static function startSqlConnection()
	{
		if(!isset(self::$sqlConnection))
		{
			throw new Core_Exceptions("Database connection not set");
		} 
			
		return self::$sqlConnection->startConnection();
	} 
		
	public static function getSqlConnection()
	{
			return self::$sqlConnection ;
	}
		
	public static function setSqlConnection(Core_Model_Connection_Sql $sql)
	{
			self::$sqlConnection = $sql;
	}
	
	public function getConnection()
	{ 
		return $this->connection;
	}

	public function setConnection(Core_Model_Connection_Sql $connection)
	{
		$this->connection = $connection;
	}
	
	public static function setSqlTemplate(Core_Model_Template_IQueries $template)
	{
		 self::$sqlTemplate = $template;
	} 
		
	public static function getSqlTemplate()
	{
		return self::$sqlTemplate;
	} 
	
	public function setTemplateQueries(Core_Model_Template_IQueries $template)
	{
		 $this->templateQueries = $template;
	} 
		
	public function getTemplateQueries()
	{
		return $this->templateQueries;
	} 
  
	public function __construct()
	{   
		Core_Model_Adapter_Sql::startSqlConnection();
		$this->setConnection(Core_Model_Adapter_Sql::getSqlConnection());
        $this->templateQueries = Core_Model_Adapter_Sql::getSqlTemplate(); 
	}  		
	
	public function hasErrors()
	{
		return empty($this->errors);
	}
	
	protected function setError($type,$errors)
	{
		$this->errors[$type] = $errors;
	}
	
	public function getErrorByType($key)
	{
		if(!isset($this->errors[$key]))
		{
			return false;
		}		
		return $this->errors[$key];
	}
	
	public function getErrors()
	{
		return $this->errors;
	}
	 
	public function resetQuery()
	{ 
		$this->queryHolder = array();
	}
	 
	protected function queryFactoryTemplate()
	{
		return $this->templateQueries->queryFactoryTemplate($this);  
	}
	
	public function getTemplateQuery($key,$innerKey=null)
	{	
		if($template = $this->templateQueries->getTemplate($key,$innerKey))
		{
			return $template;
		}
	
		return false;
	}
	  
	public function addQuery($template,$values=null)
	{   
		$this->queryHolder[] = array("template"=>$template,"values"=>$values); 
		return $this;
	} 
	
	public function removeQuery($template)
	{   
		foreach ($this->queryHolder as &$q)
		{ 
			if($q['template']==$template)
			{ 
				$q = null;
				break;
			}
		} 
	}
	
	public function updateQuery($template,$values)
	{  
		foreach ($this->queryHolder as &$q)
		{  
			if($q['template']==$template)
			{   
				$q=array("template"=>$template,"values"=>$values);
			}
		} 
	}
	 
	public function getQueryHolder()
	{
		return $this->queryHolder;
	}
	
	public function getQueryHolderTemplate($template)
	{
		$elementsKey = array();
		foreach ($this->queryHolder as $q)
		{  
			if($q['template']==$template)
			{   
				$elementsKey[] = $q['values'];
			}
		} 
		return $elementsKey;
	}
	
	public function setQueryHolder($query)
	{
		$this->queryHolder = $query;
	}
	
	public abstract function executeQuery();
	public abstract function getData();
	public abstract function setData($data);
}
?>