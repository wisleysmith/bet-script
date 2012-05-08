<?php
class Extension_View_Yui35_Calendar extends Extension_Core_View_Yui_Template
{   
	public function __construct($elementName = 'default_calendar')
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
}  