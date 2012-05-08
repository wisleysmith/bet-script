<?php
class View_Layout_Main extends Core_View_Layout_Template
{ 
	public function onInitView()
	{ 
	}
	
	public function widget()
	{
		$view = new View_HelloWorld();
		$view->test="------------------TEST-------------";
		return $view;
	}
}
?>