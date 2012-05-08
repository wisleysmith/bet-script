<?php
class Extension_Core_View_Html_FormElementTemplate extends Extension_Core_View_Yui_Template 
{ 
	private $name;
	private $model = array();
	private $attributes;
	 
	public function getAttribute($attributeName)
	{
		if(isset($this->attributes[$attributeName]))
		{
			return $this->attributes[$attributeName]; 
		}
		return null;
	}
	
	public function getAttributes()
	{
		return $this->attributes; 
	}
	
	public function setAttribute($attributeName,$attributeValue)
	{
		$this->attributes[$attributeName]=$attributeValue; 
	}
	
	public function setAttributes($arrayOfAttributes)
	{
		foreach ($arrayOfAttributes as $key=>$name)
		{
			 $this->attributes[$key] = $name; 
		}
	}
	 
	protected function getAttributesHtml()
	{ 
		$html='';
		foreach ($this->attributes as $key=>$a)
		{
			$html .=' '.$key.'="'.$a.'"'; 
		}  
		return $html;
	}
	
	public function setModel($model)
	{
		$this->model = $model;
	}
	
	public function getModel()
	{
		return $this->model;
	} 
}