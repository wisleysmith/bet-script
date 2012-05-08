<?php
//datatable with filter and pagination
class Extension_View_Yui35_DataTablePF extends Extension_Core_View_Yui_Template
{
	
	private $table; 
	private $urls = array();
	private $updateRules;
	private $insertRules;  
	private $filters = array(); 
	private $filterButtonEnabled = true; 
	private $totalRows;
	private $model; 
	private $modelCollection;
	private $removeKeyFromData = array();
	private $filterGroupOperators = array();
	private $addAdditionalFilterElements = array(); 
	
	public function __construct($rowsPerPage=20,$totalRows=null, $updateTableUrlsToService=true)
	{
		$this->table =  new Extension_View_Yui35_DataTable();  
		$this->paginator = new Extension_View_Yui35_Paginator();  
		$this->setRowsPerPage((int)$rowsPerPage);
		$this->setTotalRows($totalRows);
		 
		$this->addEventListener('onGenerateViewBefore', $this, 'onGenerateViewBeforeHandler');
		$this->addFilterGroupOperators('default','and'); 
		
		if($updateTableUrlsToService)
		{
			$this->setUrl('filter',Application::getRouter()->getUrl(array('controller'=>'servicejson','action'=>'modelcollection'))); 
    		$this->setUrlCRUD(Application::getRouter()->getUrl(array('controller'=>'servicejson','action'=>'model')));        
		}  
		 
		$this->setWidgetDependencies('io-form'); 
		$this->setWidgetDependencies('json-parse');  
		$this->setWidgetDependencies('json-parse');  
		$this->setWidgetDependencies('recordset');    
		
	}
  
	public function getTable()
	{
		return $this->table; 
	}
 
	/**
	 * add key data to remove from table data, it will display empty cell.
	 * must be called before setModel, because set Model populate data
	 */
	public function addRemoveKeyFromData($key)
	{
		$this->removeKeyFromData[] = $key;
	}
	
	public function getRemoveKeyFromData()
	{
		return $this->removeKeyFromData;
	}
	
	 
	
	public function setTable($table)
	{ 
		return $this->table = $table; 
	} 
	 
	
	public function setUrls($urls)
	{
		$this->urls=$urls;
	}
	
	public function setUrl($key,$url)
	{  
		$this->urls[$key]=$url;
	}
	
	/**
	 * select is done through filter url key
	 * @param string $url
	 */
	public function setUrlCRUD($url)
	{
		$this->urls['delete'] = $url;
		$this->urls['insert'] = $url;
		$this->urls['update'] = $url;
	}
	
	public function getUrls()
	{
		return $this->urls;
	}
	 
	public function setInsertRules($rules)
	{
		$this->inserRules = $rules;
	}
	 
	public function setUpdateRules($rules)
	{
		$this->updateRules = $rules;
	} 
	 
	public function getInsertRules()
	{
		return $this->insertRules;
	}
	
	public function setUpdateRule($rule,$key)
	{
		$this->updateRules[$rule][] = $key;		
	}
	
	public function setInsertRule($rule,$key)
	{
		$this->insertRules[$rule][] = $key;
	} 
	  
	public function getUpdateRules()
	{
		return $this->updateRules;
	} 
	
	public function addFilter(Core_View_Layout_Template $filter,$filterData=array())
	{  
		$data = array('group'=>'default','operator'=>'and','comparison'=>'='); 
		
		foreach ($filterData as $key=>$d)
		{
			$data[$key] =$d; 
		} 
		$data['name']=$filter->getAttribute('name');
		$this->filters[$filter->getId()] = array('filter'=>$filter,'data'=>$data);
	}  
	
	public function getFilterGroupsOperators()
	{
		return $this->filterGroupOperators;
	}
	
	public function addFilterGroupOperators($key,$value)
	{
		$this->filterGroupOperators[$key] = $value; 
	}
	
	public function getFilters()
	{ 
		return $this->filters; 
	}
	
	public function removeFilter($id)
	{
		unset($this->filters[$id]);
	}
	
	public function setTotalRows($totalRows)
	{
		$this->totalRows = $totalRows;
	}
	
	public function getTotalRows()
	{
		return $this->totalRows;
	}
	 
	public function setRowsPerPage($rowsPerPage) 
	{
		$this->getPaginator()->addConstructorOption('rowsPerPage',$rowsPerPage); 
	} 
	
	public function getRowsPerPage()
	{
		$this->getPaginator()->getConstructorOption('rowsPerPage');
	}
 
 
	
	public function getAdditionalFilterElements()
	{
		return $this->addAdditionalFilterElements;
	}
	
	public function addAdditionalFilterElement($element)
	{
		$this->addAdditionalFilterElements[$element->getId()] = $element;
	}
	
	public function onGenerateViewBeforeHandler($e)
	{      
		//first check if set, if not then try with model if set
		$model = $this->getModel();
		 
		$totalRows = $this->getTotalRows();
		if(is_null($totalRows))
		{
			$totalRows = 0;
			if(isset($model))
			{
				$totalRows =(int) $model->count();
			}  
		}
 		
		$this->getPaginator()->addConstructorOption('totalRecords',$totalRows );
	  
	}    
	  
	public function getPrimaryKeys()
	{
		$model = $this->getModel();
		if(isset($model))
		{
			return $this->getModel()->getPrimaryKeys();
		}
		return array();
	}
	
	public function isFilterButtonEnabled($value=null)
	{ 
		if($value!==null)
		{ 
			 $this->filterButtonEnabled = (bool) $value;
		}
		return $this->filterButtonEnabled;
	}
	
	public function getPaginator()
	{
		return $this->paginator;
	}
	
	public function getModel()
	{
		return $this->model;
	}
	
	public function getModelName()
	{
		return get_class($this->model);
	}
	
	public function setTableData($data)
	{
		$removeKeys = $this->getRemoveKeyFromData() ;
		if(!empty($removeKeys))
		{
			for($i=0;$i<sizeof($data);$i++)
			{
				 foreach ($removeKeys as $r)
				 {
				 	unset($data[$i][$r]);
				 }
			}
		}
		$this->getTable()->setData($data);
	}
	
	public function setModel(Core_Model_Adapter_Object $model,$useModel=true)
	{  
		$this->model = $model; 
		if($useModel)
		{
			$modelCollection = new Core_Model_Adapter_ModelCollection();
			$modelCollection->getModelCollection($model,false); 
			 
			if(sizeof($modelCollection->getData())>0)
			{
				$this->setTableData($modelCollection->toArray());
			}
			$this->modelCollection = $modelCollection;
		}
	}  
	 
}