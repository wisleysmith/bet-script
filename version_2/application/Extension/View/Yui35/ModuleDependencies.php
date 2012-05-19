<?php
class Extension_View_Yui35_ModuleDependencies extends Core_View_Layout_Template
{
	private $widgetDependencies = array(); 
	//Y is used as instance but some widget are loaded in existing YUI instance so Y is not set and instance is used from parent 
	private $yuiInstance = '';
 
	public function setWidgetDependencies($value)
	{
		 if(!in_array($value, $this->widgetDependencies))
		 {
			$this->widgetDependencies[] = $value; 
		 }
	}
	
	public function getWidgetDependencies()
	{ 
		return $this->widgetDependencies;
	}  
	
	public function getWidgetDependenciesHtml()
	{
		$html = '';
		$divader = '';
		foreach($this->getWidgetDependencies() as $w)
		{
			$html.=$divader."'$w'";
			$divader = ',';
		}
		return $html;
	}
	
	public function getYuiInstance()
	{
		return $this->yuiInstance;
	}

	public function setYuiInstance($instance)
	{
		 $this->yuiInstance = $instance;
	}
	
}
?>
 