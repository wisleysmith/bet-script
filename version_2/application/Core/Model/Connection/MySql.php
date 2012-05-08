<?php
class Core_Model_Connection_MySql extends Core_Model_Connection_Sql
{ 
	 
	public function startConnection()
	{
		if(isset($this->connection))
		{
			return $this->connection; 
		} 
		 
		$this->connection = mysql_connect($this->getServer(),$this->getUsername(),$this->getPassword());
		mysql_select_db($this->getDatabaseName(),$this->connection);
		return $this->connection;
	}
	
	public function closeConnection()
	{
		mysql_close($this->connection);
	}
	 
	public function query($query)
	{ 
		return  mysql_query($query,$this->connection);  
	}
	
	public function fetchAssoc($result)
	{
		$resultSet = array();
		while ($row = mysql_fetch_assoc($result)) 
		{
		    $resultSet[] = $row; 
		}
		return  $resultSet;
	}
	
	public function fetchAssocOne($result)
	{ 
		return mysql_fetch_assoc($result);  
	}
	
	public function getError()
	{
		return mysql_error($this->connection);
	}
	
	public function getErrorNumber()
	{
		return mysql_errno($this->connection);
	}
	
	public function getInsertId()
	{  
	 	return mysql_insert_id($this->connection);
	}
}