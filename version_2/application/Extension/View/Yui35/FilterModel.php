<?php
class Extension_View_Yui35_FilterModel extends Extension_Core_View_Yui_Template
{   
	private $filters;
	private $filterGroupOperators; 
	
	public function __construct($elementName = 'default_filter')
	{ 
		$this->setId($elementName); 
        $this->setWidgetDependencies('calendar'); 
        $this->setWidgetDependencies('datatype-date'); 
        $this->setWidgetDependencies('cssbutton'); 
		$this->setHtmlElementId('calendar_'.$this->getId() );
        $this->addConstructorOption('contentBox',$this->getHtmlElementId(true),true );
		$this->addConstructorOption(' width','340px',true);
		$this->addConstructorOption('date','new Date()'); 
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
	
	public function getAdditionalFilterElements()
	{
		return $this->addAdditionalFilterElements;
	}
	
	public function addAdditionalFilterElement($element)
	{
		$this->addAdditionalFilterElements[$element->getId()] = $element;
	}
}  