<?php
class Core_Controller_Base
{
	 private $activeTemplate;
	 private $templates;
	 private $isRenderExecuted = false;
	 private $template;
	 
	 public function run()
	 {
	 	$this->init();
	 }  
	 
	 public function setTemplates($templates)
	 {
	 	$this->templates = $templates;
	 } 
	
	 public function setActiveTemplate($template)
	 {
	 	$this->activeTemplate = $template;
	 }
	 
	 public function getActiveTemplate()
	 {
	 	return $this->activeTemplate;
	 }
	 
	 public function isRenderExecuted()
	 {
	 	return $this->isRenderExecuted;
	 }
	 
	 private function renderExecuted()
	 {
	 	$this->isRenderExecuted = true;
	 }
	 
	 public function preventTemplateRender()
	 {
	 	$this->renderExecuted();
	 }
 
	 public function getTemplate()
	 { 
	 	 if(!isset($this->template))
	 	 {
	 	 	return $this->template = new $this->templates[$this->activeTemplate];
	 	 }
		 return $this->template;			
	 }
	 
	 public function render()
	 {
	 	if($this->isRenderExecuted == false)
	 	{
	 		echo $this->getTemplate();
	 	} 
	 	$this->renderExecuted();
	 }
	 
	 public function init()
	 {
	 	
	 }
	 
	public function exitWithError($message)
	{
		echo json_encode(array('status'=>'error','errors'=>array($message)));
		exit();
	}	
	
	public function redirect($controller,$view,$params = array())
	{
		$url = Application::getRouter()->getFullUrl(array('controller'=>$controller,'action'=>$view));
		header("Location: $url");
	}
}