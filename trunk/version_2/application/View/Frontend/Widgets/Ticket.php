<?php
class View_Frontend_Widgets_Ticket extends Extension_Core_View_Yui_Template
{  
	public function __construct()
	{
		$this->setWidgetDependencies('recordset-base');
		$this->setWidgetDependencies('cookie');
		$this->setWidgetDependencies('event');
		$this->setWidgetDependencies('cookie');
		$this->setWidgetDependencies('json');
		$this->setWidgetDependencies('io');
	} 
}