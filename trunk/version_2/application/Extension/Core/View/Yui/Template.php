<?php
class Extension_Core_View_Yui_Template extends Core_View_Layout_Template
{
	private $jsWidgetConstructor = array(); 
	private $widgetDependencies = array(); 
	private $htmlElementId; 
	 
	/**
	 * 
	 * Keep seperate interface so if js key change we can modify keys in one place.
	 * @param $key
	 * @param $value
	 */
	public function addConstructorOption($key,$value,$jsonEncode=false)
	{ 
		if($jsonEncode)
		{
			$value = json_encode($value);
		}
		$this->jsWidgetConstructor[$key] = $value;  
	} 
	
	public function getConstructorOption($key)
	{
		if(isset($this->jsWidgetConstructor[$key]))
		{
			return  $this->jsWidgetConstructor[$key];
		}
		return null;
	}  
	 
	public function setWidgetDependencies($value)
	{
		if(!in_array($value, $this->widgetDependencies))
		{
			$this->widgetDependencies[] = $value; 
		}	
		$yui = Application::getSingleton('Extension_View_Yui35_ModuleDependencies');
		$yui->setWidgetDependencies($value);
	}
	
	public function getWidgetDependencies()
	{ 
		return $this->widgetDependencies;
	} 
	
	public function removeConstructorOption($key)
	{
		 unset($this->jsWidgetConstructor[$key]); 
	} 
	
	public function setJSWidgetContructor($data)
	{
		$this->jsWidgetConstructor = $data;
	}
   
	public function getJSWidgetContructor()
	{
		return $this->jsWidgetConstructor;
	} 
	
	public function getJSWidgetContructorJson()
	{
		$parsedToString="";  
		foreach ($this->jsWidgetConstructor as $key=>$j)
		{
			$parsedToString.="$key:$j,";
		};
		return $parsedToString;
	}    
	
	public function getHtmlElementId($withIdentifier = false)
	{ 
		if($withIdentifier)
		{
			return '#'.$this->htmlElementId; 
		}
		return $this->htmlElementId;
	}
	
	public function setHtmlElementId($id)
	{  
		$this->htmlElementId = $id;
	}   
}