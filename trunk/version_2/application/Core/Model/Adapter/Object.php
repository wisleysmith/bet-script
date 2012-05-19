<?php
abstract class Core_Model_Adapter_Object extends Core_Model_Adapter_Sql
{ 
	private $tableName; 
	protected $columns = array();
	protected $relations  = array(); 
	private $validationErrors = array();  
	protected $data = array();
	
	
 	/**
 	 *  list of columns that canot be update without force update param set on update($force)
 	 *  this is step to prevent check if columns is set to updateable
 	 */
	private $forceColumnsUpdate = array();   
	
	/**
 	 *  list of columns to exclude from service
 	 */
	protected  $excludeFromService = array();   
	  
	  
	public function load($values = null)
	{     
		$this->addQuery('select',array('table'=>$this->getTableName()));
		if(!is_array($values)&&$values!==null)
		{
			$this->setPrimaryKeysValues($values);
			$this->addQuery('where',array('where_condition'=>$this->preparePKForWhere())); 
		}
		else 
		{ 
			foreach ($values as $key=>$v)
			{ 
				if($column = $this->getColumns($key))
				{ 
					$columnName = $column['COLUMN_NAME'];
					$this->addData($columnName, $v);
					$this->validateFields($columnName);
					$this->addQuery('where',array('where_condition'=>"$columnName='$v'"));  
				}
			}
		}
		
		if($data = $this->executeQuery())
		{	
			$objectData = $this->getConnection()->fetchAssoc($data);
			if(isset($objectData[0]))
			{
				$this->setData($objectData[0]);
			}
		}   
	}    
	
	public function setForceUpdateColumns($array)
	{
		$this->forceColumnsUpdate = $array;
	}
	
	public function removeForceColumnUpdate($key)
	{
		unset($this->forceColumnsUpdate[$key]);
	}
	 
	public function addForceColumnUpdate($columnName)
	{
		$this->forceColumnsUpdate[] = $columnName;
	}
	
	public function getForceColumnsUpdate()
	{
		return $this->forceColumnsUpdate;
	}
	
	public function isValid()
	{
		return empty($this->validationErrors);
	}
	
	public function getValidationErrors($id=null)
	{
		if($id!==null)
		{
			if(isset($this->validationErrors[$id]))
			{
				return $this->validationErrors[$id];
			}
			return null;
		}
		return $this->validationErrors;	
	}
	
	public function count($columns ='*')
	{ 
		$this->removeQuery('limit'); 
		$this->removeQuery('order'); 
		
		$select = $this->getQueryHolderTemplate('select');
		if(!empty($select))
		{
			$table = $select[0]['table']; 
		}
		else 
		{ 
			$table = $this->getTableName();
		}
		
		$this->updateQuery('select',array('select_expr'=>"COUNT($columns) as count", 'table'=>$table));
		$countResult = $this->executeQuery('fetchAssocOne'); 
		return $countResult['count'];
	}
	
	public function resetValidationErrors()
	{
		$this->validationErrors = array();
	}
	
	public function getExcludeFromService()
	{
		return $this->excludeFromService;
	}
	
	public function setValidationError($id,$errors)
	{
		if(!isset($this->validationErrors[$id]))
		{
			$this->validationErrors[$id] = array();
		}
		if(is_array($errors))
		{
			foreach ($errors as $e)
			{
				$this->validationErrors[$id][] = $e;
			}
		}
		else 
		{
			$this->validationErrors[$id][] = $errors;
		} 
	}
	
	public function setValidationErrors($array)
	{
		$this->validationErrors = $array; 
	}

	public function addValidationErrors($array)
	{
		foreach ($array as $key=>$a)
		{
			$this->validationErrors[$key] = $a; 
		}
	}
	
	public function update($forceUpdateFlag = false)
	{  
		$this->filter();
		$columnsToUpdateData = $this->getColumnsForUpdate($forceUpdateFlag);
		$this->validate($columnsToUpdateData['noUpdateColumns']); 
		$this->addQuery('update',array('columns'=>$columnsToUpdateData['query'],'table'=>$this->getTableName()));   
		$this->addQuery('where',array('where_condition'=>$this->preparePKForWhere())); 	 
		return $this->executeQuery(); 
	}
	 
	/**
	 * @todo Only woks if one primary key 
	 */
	public function insert()
	{
		$this->filter();
		$this->validate($this->getPrimaryKeys());
		$this->addQuery('insert',array('values'=>$this->prepareColumnsForInsert(),'table'=>$this->getTableName()));   
		
		if($result = $this->executeQuery())
		{
			$primary = $this->getPrimaryKeys();
			$this->getPropertyMethod($primary[0] ,"set", $this->getConnection()->getInsertId());	 	
		}; 
		return $result;
	}
	
	public function delete()
	{
		$this->addQuery('delete',array('table'=>$this->getTableName()));  
		$this->addQuery('where',array('where_condition'=>$this->preparePKForWhere()));  
		return $this->executeQuery(); 
	} 

	protected function preparePKForWhere()
	{ 
		$prepend = "";
 		$primaryKeyColumnString=''; 
		foreach($this->getPrimaryKeys() as  $pk)
		{ 
				$propertyValue = $this->getPropertyMethod($pk); 
				$primaryKeyColumnString = $prepend." ".$pk." = ". $propertyValue;
				$prepend = " AND ";
		} 
		return $primaryKeyColumnString;
	}
	 
	public function executeQuery($return='result',$reset=true)
	{        
		$queryString = $this->queryFactoryTemplate(); 
		$validationErrors = $this->getValidationErrors();
	 
		if(!empty($validationErrors))
		{  
			return false;
		}  
		//echo $queryString;
		
		$result = $this->getConnection()->query($queryString); 
		if($reset)
		{
			$this->resetQuery();
			$this->resetQuery();
		}
		 
		if(!$result) 
		{
			$errorNo = $this->getConnection()->getErrorNumber();
			if($errorNo==1062)
			{
				$this->setValidationError('sql', 'Entry already Exist');
			}
			 
		    $this->setError('database_error', array('error'=>$this->getConnection()->getError(),'query'=>$queryString)); 
			return false;
		}  
		
		if($return=='result')
		{
			return $result;
		}
		
		return $this->getConnection()->$return($result);
	}
	
	protected function setPrimaryKeysValues($value)
	{ 
		foreach($this->getPrimaryKeys() as  $pk)
		{
			if($this->getPropertyMethod($pk,"set",$value)===false)
			{
					$this->setValidationError('sql', 'Field key not set');
					return;
			};  
		} 
	} 
	
	protected function getColumnsForUpdate($forceUpdateFlag)
	{ 
		$dataArray = $this->getData();
		$divader = "";
		$columnsUpdateString = "";
		$updateColumns = array();
		$noUpdateColumns = array();
		
		foreach ($dataArray as $key=>$c)
		{ 
		 	//only columns that exist in table, skip other data
			 if(!isset($this->columns[$key]))
			 {
			 	continue;
			 }
			if(!$forceUpdateFlag)
			{
				if(in_array($key, $this->getForceColumnsUpdate()))
				{   
					$noUpdateColumns[] = $key;
					continue;
				}
			}
			
			if(in_array($key, $this->getPrimaryKeys() ))
			{  
				$noUpdateColumns[] = $key;
				continue;
			} 
			
			if($c!==null)
			{
				$columnsUpdateString.= $divader." ".$key." = '".$c."' ";
			}
			 
			else if($c===null)
			{
				$columnsUpdateString.= $divader." ".$key." = null "; 
			} 
			
			$updateColumns[] = $key;
			$divader = ",";  
			
		} 
		
		return array('query'=>$columnsUpdateString,'updateColumns'=>$updateColumns,'noUpdateColumns'=>$noUpdateColumns);
	}
	 
	protected function prepareColumnsForInsert()
	{
		$dataArray = $this->getData();
		$divader = "";
		$values = "(";
		$columns = "(";
		 
		foreach ($dataArray as $key=>$c)
		{  
			foreach($this->getPrimaryKeys() as $pK)
			{	 
				if($key==$pK)
				{
					continue 2;
				}
			} 
			 
			 //only validate columns that exist in table, skip other data
			 if(!isset($this->columns[$key]))
			 {
			 	continue;
			 }
			
			if($c!==null)
			{ 
				$values.= " ".$divader." '".$c."'" ;
			}
			else 
			{
				$values.= " ".$divader." null " ;
			}
			 
			$columns.= " ".$divader." ".$key." " ;
			$divader = ",";
		}
		$values.= ")";
		$columns.= ")";
		return $columns." values ".$values;
	}  
	
	public function getColumns($key=null)
	{
		if($key!==null)
		{
			if(isset($this->columns[$key]))
			{
				return $this->columns[$key];
			}
			else 
			{
				return false;
			}
		}
		return $this->columns; 
	} 
	
	public function getColumnNames()
	{
		$columnNamesArray = array();
		
		foreach ($this->columns as $column=>$data)
		{
			$columnNamesArray[] = $column;
		}
		return $columnNamesArray;
	}
	
	public function getTableName()
	{
		return $this->tableName;
	}
	
	public function setTableName($table)
	{
		$this->tableName = $table;
	}
	
	public function getPrimaryKeys()
	{
		$primary = array();
		foreach ($this->relations as $key=>$r)
		{
			if($key=="PRIMARY")
			{
				$primary[] = $r['COLUMN_NAME'];
			} 
		}
		return $primary;
	}  
	
	public function getData($key=null)
	{ 
		if($key!=null)
		{
			$key = $this->removeAlias($key);
			return $this->data[$key];
		}  
		 
		return $this->data;
	}

	public function getServiceData($key=null)
	{
		$excludeArray = $this->getExcludeFromService();
		if(isset($key))
		{   
			$key = $this->removeAlias($key);
			if(!in_array($key, $excludeArray))
			{
				if(isset($this->data[$key]))
				{
					return $this->data[$key];
				} 
			}
		}  
		
		if(empty($excludeArray))
		{
			return $this->data;
		}
		
		$serviceData = array();
		foreach($this->data as $key=>$s)
		{
			if(!in_array($key, $excludeArray))
			{
				$serviceData[] = $s; 
			}
		} 
		return $serviceData;
	}
	
	public function isDataExist($key)
	{	 
 		$key = $this->removeAlias($key);
		if(array_key_exists($key,$this->data))
		{
			return true;
		}
		if(method_exists($this, $key))
		{
			return true;
		}
		return false;
	}
	
	//remove ??. if used with alias as like in join tables
	public function removeAlias($key)
	{ 
		return  preg_replace('/^[^\.]*\.\s*/', '', $key);
	}
	
	public function setData($data)
	{    
		if(!is_array($data))
		{
			return false;
		}
		
		foreach($data as $key=>$value)
		{ 
			if($this->getPropertyMethod($key,"set",$value)===false)
			{
				if(method_exists($this, $key))
				{
					$this->$key($value);
				}
				else 
				{
					$this->data[$key] = $value;
				}
			};
			
		}
	}
	
	public function addData($key,$value)
	{
		$key = $this->removeAlias($key);
		$this->data[$key]=$value;
	}
	
	public function removeDataByKey($key)
	{
		$key = $this->removeAlias($key);
		unset($this->data[$key]);
	}
 
	protected function getPropertyMethod($method,$getOrSet="get",$value=null)
	{ 
		if(!is_string($method))
		{
			return false;
		}
		$method = $this->removeAlias($method);
		$methodName = '';
	 	$propertiesArrayTemp = explode ('_', $method); 
		
	 	foreach ($propertiesArrayTemp as $p)
		{
			$methodName.= ucfirst($p);
		}   
		 
 
		if($getOrSet=="get")
		{
			$methodName = "get".$methodName;
		}
		else 
		{
			$methodName = "set".$methodName;
		}
 	 
		if(!method_exists(get_class($this),$methodName))
		{
			return false;
		};
		
		if($getOrSet=="get")
		{
			return $this->$methodName();
		}
		else 
		{    
			 $this->$methodName($value); 
			 return true;
		} 
	}  
	
	abstract public function getValidators();
	abstract public function getFilters();
	
	public function filter()
	{
		$data = $this->getData(); 
		
		$filters = $this->getFilters();	
	
		foreach($filters as $key=>$filtersValue)
		{ 
			foreach($filtersValue as $f)
			{  
				 $value = $this->data[$key]; 
				 if($value!=null&&$value!=''&&isset($value))
				 {
				 	$filterFunction = $f."Filter"; 
					$this->data[$key] = Core_Model_Adapter_ObjectColumnFiltration::$filterFunction($value);			
				 }
			} 
		} 
	} 
	 
	public function getModelClassName()
	{
		return get_class($this);
	}
	
	public function validateFields($fildsToValidate)
	{	 
		if(!is_array($fildsToValidate))
		{
			$fildsToValidate = array($fildsToValidate);
		}
		$data = $this->getData();
		$excludeFromValidationFiedls = array();
		foreach ($this->data as $key=>$value)
		{
			if(!in_array($key, $fildsToValidate))
			{
				$excludeFromValidationFiedls[] = $key;
			}
		}
		$this->validate($excludeFromValidationFiedls);
	} 
	
	public function validate($excludeFromValidation = array())
	{ 
		$validators = $this->getValidators();
		foreach($validators  as $key=>$value)
		{	 
			 if(in_array($key, $excludeFromValidation))
			 {
			 	continue;
			 } 
			  
			 //if value can be null and is set to null no validation is perform
			 if(isset($this->columns[$key]))
			 { 
				 if($this->columns[$key]['IS_NULLABLE']=='YES'&&$this->data[$key]===NULL)
				 { 
				 	continue;	
				 }
			 }
			 
			 foreach($value as $keyValidation=>$v)
			 { 
		 		if(is_array($v))
				{
					
					$validationFunction = $keyValidation."Validation";
					if(!method_exists('Core_Model_Adapter_ObjectColumnValidation',$validationFunction))
					{
						continue;
					}
					$errors=Core_Model_Adapter_ObjectColumnValidation::$validationFunction($this->data[$key],$v);
					if(!empty($errors))
					{
						 $this->setValidationError($key,$errors);
					}
				}
				else
				{
					$validationFunction = $v."Validation";
					$errors = Core_Model_Adapter_ObjectColumnValidation::$validationFunction($this->data[$key]);
					if(!empty($errors))
					{
						 $this->setValidationError($key,$errors);
					}
				}	
			 } 
		} 
	} 
}