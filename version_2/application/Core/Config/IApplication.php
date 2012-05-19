<?php
 
interface  Core_Config_IApplication
{
 	public function run(); 
 	public function getTemplates();
 	public function getActiveTemplate(); 
 	public function getRouter(); 
 	public function getAcl();
 	public function getSessionTypeFile();
}