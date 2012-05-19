<?php
class View_Frontend_WidgetsLoader extends  Extension_Core_View_Yui_Template
{     
	public function __construct()
	{  
		$this->setWidgetDependencies('event'); 
		$this->setWidgetDependencies('json');
		$this->setWidgetDependencies('io');
		$this->setWidgetDependencies('node');
		$this->setWidgetDependencies('cookie');
		Application::getSingleton('Extension_View_Yui35_ModuleDependencies')->setYuiInstance('Y');
	}  
}