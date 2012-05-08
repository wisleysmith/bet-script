<?php
class Extension_View_Yui35_DataTable extends Extension_Core_View_Yui_Template
{ 
	private $jsWidgetConstructor = array(); 
	private $data;
	private $columns = array(); 
	private $dataTableFormatters;   
	  
	public function __construct($elementName = 'default_datatable')
	{ 
		$this->setId($elementName); 
		 
		$this->setWidgetDependencies('datatable-scroll');
		$this->setWidgetDependencies('datatable-sort');
		$this->setWidgetDependencies('datatable-mutable');
        $this->setWidgetDependencies('datatable-message');
        $this->setWidgetDependencies('datasource-io'); 
        $this->setWidgetDependencies('datatable-datasource'); 
        $this->setWidgetDependencies('datasource-jsonschema');  
        $formatter = new Extension_Helpers_Yui_DataTableFormatters();
        $this->setDataTableFormatters('default',$formatter);
        $this->setHtmlElementId('datatable_'.$this->getId() );
	}
	 
	public function setData($data)
	{ 
		$this->jsWidgetConstructor['data'] = json_encode($data);
	}
	
	private function getColumnsDataForJsConstructor()
	{
		$columns='['; 
		foreach ($this->getColumns() as $key=>$c)
		{
			$columns.=$c.',';
		}
		
		return $columns.=']';
	}
	
	public function addColumn($data,$jsonEncode=true,$key=null)
	{  
		$columnKey = null;
		if($jsonEncode)
		{
			$columnKey = $data['key'];
			$data = json_encode($data); 
		}
		else 
		{
			 $columnKey = $key;
		}
		if(!isset($columnKey))
		{
			new Core_Exceptions("Column key must be set");
		}
		 
		$this->columns[$columnKey] = $data;
	}
	
	public function getColumns()
	{
		return $this->columns; 
	}
	
	public function removeColumn($key)
	{
		unset($this->columns[$key]); 
	}  
 
	public  function getData()
	{
		return $this->data;
	} 
	 
	/**
	 * 
	 * parent override
	 */
	public function getJSWidgetContructorJson()
	{
		$parsedToString=""; 
		$this->jsWidgetConstructor['columns']=$this->getColumnsDataForJsConstructor();
		foreach ($this->jsWidgetConstructor as $key=>$j)
		{
			$parsedToString.="$key:$j,";
		};
		return $parsedToString;
	}  
	
	public function getDataTableFormatters($formatterKey=null)
	{
		if(isset($formatterKey))
		{
			if(isset($this->dataTableFormatters[$formatterKey]))
			{
				return $this->dataTableFormatters[$formatterKey];
			}
			return null;
		}
		return $this->dataTableFormatters;
	}
	
	public function setDataTableFormatters($formatterKey,$dataTableFormatter)
	{
		$this->dataTableFormatters[$formatterKey] = $dataTableFormatter;
	}
	
	public function getFormatter($name,$options=array(),$formatterKey='default')
	{ 
		$formatter = $this->getDataTableFormatters($formatterKey);
		return $formatter->$name($options); 
	}
}