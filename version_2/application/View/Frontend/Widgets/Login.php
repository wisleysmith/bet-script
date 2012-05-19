<?php
class View_Frontend_Widgets_Login extends Extension_Core_View_Yui_Template
{  
	public function __construct()
	{
		$this->setWidgetDependencies('io-form'); 
		$this->setWidgetDependencies('json-parse');   
	} 
}