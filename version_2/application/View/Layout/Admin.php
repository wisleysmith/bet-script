<?php
 
class View_Layout_Admin extends Core_View_Layout_Template
{ 
	private $content;
	private $menu; 
	  
	public function __construct()
	{ 
		$yui = Application::getSingleton('Extension_View_Yui35_ModuleDependencies'); 
		$yui->setWidgetDependencies('io-base');  
		$yui->setWidgetDependencies('json');  
	} 
	  
	public function getContent()
	{ 
		return $this->content;  
	} 
	
	public function setContent($content)
	{
		$this->content = $content;
	}
	
	public function getMenu()
	{
		return $this->menu;
	}
	
	public function setMenu($menu)
	{
		return $this->menu = $menu; 
	}
} 

?>