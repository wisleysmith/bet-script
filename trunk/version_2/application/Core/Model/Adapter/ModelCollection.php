<?php
class Core_Model_Adapter_ModelCollection extends Core_Model_Adapter_Sql implements IteratorAggregate
{  
	private $position = 0;
	private $dataToArray;
	private $model; 
	private $data = array();
	
	public function __construct() 
	{
        $this->position = 0;
        parent::__construct();
    } 
    
	public function toArray()
	{
		foreach($this->data as $d)
		{
			$this->dataToArray[] = $d->getData();
		}
		return $this->dataToArray;
	}
	
	public function toServiceArray()
	{ 
		$dataToArray = array();
		
		foreach($this->data as $d)
		{
			$dataToArray[] = $d->getData();
		}
		
		$excludeArray = $this->model->getExcludeFromService();
		
		if(empty($excludeArray))
		{
			return $dataToArray;
		}
		 
		foreach($dataToArray as &$e)
		{
			foreach ($excludeArray as $eA)
			{
				$e[$eA]=null;
			}
		} 
		
		return $dataToArray;
	}
	
	public function getKeysArray($key)
	{
		$data = array();
		foreach($this->data as $d)
		{
			$data[] = $d->getData($key);
		}
		return $data;
	}
	
	public function getIterator() 
	{
        return new ArrayIterator($this->data);
    }
	
	public function getModelCollection(Core_Model_Adapter_Object $model,$reset=true)
	{ 
		$this->model = $model;
		if($objectCollectionData = $this->model->executeQuery('fetchAssoc',$reset));
		{  
			if(is_array($objectCollectionData))
			{
				foreach ($objectCollectionData as $objectData)
				{
					$className = (string) get_class($this->model);
					$instance = new $className;
					$instance->setData($objectData);
					$this->data[] = $instance;
				}
				return $this->data;
			}
		}  
		return $this->model;
	} 
	
	public function modelValidationErrors()
	{
		return $this->model->getValidationErrors();
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