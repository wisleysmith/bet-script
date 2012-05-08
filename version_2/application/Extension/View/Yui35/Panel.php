<?php
class Extension_View_Yui35_Panel extends Extension_Core_View_Yui_Template
{   
	private $body;
	
	public function __construct($elementName = 'default_panel')
	{  
        $this->setWidgetDependencies('panel'); 
        $this->setWidgetDependencies('dd-plugin');    
        $this->setHtmlElementId('panelContent_'.$this->getId() );
	}   
	 
	public function getBody()
	{
		return $this->body;
	}
	
	public function setBody($body)
	{
		$this->body= $body;
	} 
	
}  