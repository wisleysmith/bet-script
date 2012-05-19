<?php

//this class is populate with all javascript currently used in javascript templates.
//javascript is added to class when user __toString in template example echo new View_Template_Admin
class Core_View_Layout_JavascriptTemplate
{
	const YUI = 'YUI';
    private static $instance; 
    private $javascript;
    private $currentJsFramework;

    private function __construct()
    {
    }

    public function setCurrentJsFramework($jsF)
    {
    	return $this->currentJsFramework = $jsF;
    }
    

    public function getCurrentJsFramework()
    {
    	return $this->currentJsFramework;
    }
    
    public static function singleton()
    {
        if (!isset(self::$instance)) { 
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }
  
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error('Unserializing is not allowed.', E_USER_ERROR);
    }
    
    public function appendJavascript($javascript)
    {
    	$this->javascript.= $javascript;
    } 
    
    public function getJavascript()
    { 
    	$jsF = $this->getCurrentJsFramework();
    	if($jsF == Core_View_Layout_JavascriptTemplate::YUI)
    	{
    		return $this->yuiTemplate();
    	}
    } 
    
    public function yuiTemplate()
    {
    	$widgetDependencies = Application::getSingleton('Extension_View_Yui35_ModuleDependencies')->getWidgetDependenciesHtml();
 		if($widgetDependencies!='')
 		{
 			$widgetDependencies = $widgetDependencies.',';
 		} 
 			
 		$javascript = 
 			    ' YUI().use('.$widgetDependencies.' function (Y) {'.
 				 $this->javascript.
		'})';
 		return $javascript;	 
    }
    
}
?>
