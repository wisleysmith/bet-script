<?php
class Extension_View_Yui35_ModuleDependencies extends Core_View_Layout_Template
{
	private $widgetDependencies = array(); 
	 
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
}
?>
 