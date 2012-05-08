<?php
class Extension_View_Html_Form_Elements_CalendarClock extends Extension_Core_View_Yui_Template
{
	private $namespaceElements;
	private $calendar; 
	private $minutes;
	private $hours;
	
   	public function setCalendar()
   	{
   		$this->calendar = new Extension_View_Html_Form_Elements_Calendar(); 
   	}
   	
	public function getCalendar()
   	{
   		if(!isset($this->calendar))
   		{
   			$this->setCalendar() ;
   		}
   		return $this->calendar; 
   	}
   	
   	public function getHours()
   	{
   		if(!isset($this->hours))
   		{
   			$this->setHours() ;
   		}
   		return $this->hours; 
   	}
   	
	public function setHours()
   	{
   		$select = new Extension_View_Html_Form_Elements_Select();
		$select->setModel(Extension_Helpers_Models_Elements_Select::hours()); 
	  	$select->setOptionLabelKey('label');
	  	$select->setOptionValueKey('value'); 
	  	$this->hours =  $select;
   	}
   	
	public function getMinutes()
   	{
   		if(!isset($this->minutes))
   		{
   			$this->setMinutes() ;
   		}
   		return $this->minutes; 
   	}
   	
   	public function setMinutes()
   	{
   		$select = new Extension_View_Html_Form_Elements_Select();
		$select->setModel(Extension_Helpers_Models_Elements_Select::minutes()); 
	  	$select->setOptionLabelKey('label');
	  	$select->setOptionValueKey('value'); 
	  	$this->minutes = $select;
   	} 
}
?>