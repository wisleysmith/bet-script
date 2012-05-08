<?php
class Extension_View_Html_Form_Elements_Calendar extends Extension_Core_View_Html_FormElementTemplate
{
	public function setCalendar()
   	{
   		$this->calendar = new Extension_View_Yui35_Calendar(); 
   	}
	 
	public function getCalendar()
   	{
   		if(!isset($this->calendar))
   		{
   			$this->setCalendar() ;
   		}
   		return $this->calendar; 
   	}
}