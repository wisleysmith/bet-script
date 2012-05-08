<?php
abstract class Core_Model_Connection_Sql
{
	private $server;
	private $username;
	private $password;
	private $databaseName;
	private $connection;
	
	public function __construct($server,$username,$password,$databaseName)
	{  
		$this->setServer($server);
		$this->setUsername($username);
		$this->setPassword($password);
		$this->setDatabaseName($databaseName);
	}
	
	public function setServer($server)
	{
		return $this->server = $server;
	}
	
	public function getServer()
	{
		return $this->server;
	}
	
	public function getUsername()
	{
		return $this->username;
	}
	
	public function setUsername($username)
	{
		$this->username = $username;
	}
	
	public function getPassword()
	{
		return $this->password;
	}
	
	public function setPassword($password)
	{
		$this->password = $password;
	}
	
	public function getDatabaseName()
	{
		return $this->databaseName;
	}
	
	public function setDatabaseName($databaseName)
	{
		$this->databaseName = $databaseName;
	}
	
	public function getConnection()
	{
		return $this->connection;
	}
	
	public function setConnection($connection)
	{
		return $this->connection = $connection;
	}
	
	abstract public function startConnection();
	
	abstract public function closeConnection(); 
	
	abstract public function query($query);
	
	abstract public function getError(); 
	
	abstract public function fetchAssoc($result);
	 
}