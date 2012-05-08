<?php
class Core_Model_Adapter_Query extends Core_Model_Adapter_Sql 
{   
	public function __construct() 
	{ 
        parent::__construct();
    } 
       
	public function getData()
	{
		return $this->data;	
	} 
	
	public function setData($data)
	{
		$this->data[] = $data;
	}
	
	public function executeQuery()
	{
		//do nothing
	} 
}