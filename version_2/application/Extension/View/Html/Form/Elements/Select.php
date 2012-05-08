<?php
class Extension_View_Html_Form_Elements_Select extends Extension_Core_View_Html_FormElementTemplate
{
	private $optionLabelKey ;
	private $optionValueKey;
	private $selectedValue=null;
	private $defaultValue=''; 
	private $defaultLabel='-'; 
	private $displayDefault=true;
	private $filedsetLabel='-'; 
	 
	public function setOptionLabelKey($value)
	{
		 $this->optionLabelKey = $value;
	}
	  
	public function setDisplayDefault($value)
	{
		$this->displayDefault = (boolean)$value;
	}
	
	public function isDisplayDefault()
	{
		return $this->displayDefault;
	}
	
	public function getDefaultValue()
	{
		return $this->defaultValue;
	}
	
	public function setDefaultValue($value)
	{
		$this->defaultValue = $value;
	}

	public function getDefaultLabel()
	{
		return $this->defaultLabel;
	}
	
	public function setDefaultLabel($label)
	{
		$this->defaultLabel = $label;
	} 
	
	public function setOptionValueKey($value)
	{
		$this->optionValueKey = $value;
	}
	
	public function getOptionLabelKey()
	{
		 return $this->optionLabelKey;
	}
	
	public function getOptionValueKey()
	{
		return $this->optionValueKey;
	}
	
	public function setSelectedValue($value)
	{
		$this->selectedValue = $value;
	}
	
	public function getSelectedValue()
	{
		return $this->selectedValue;
	}
}