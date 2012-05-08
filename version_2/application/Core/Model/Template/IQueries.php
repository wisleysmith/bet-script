<?php
interface  Core_Model_Template_IQueries 
{  
	public function getTemplateQueries(); 
	
	public function addQueryTemplate($name="",$values=array());
	 
	public function getTemplate($key,$innerKey=null);
	
	public function queryFactoryTemplate($queries);
}