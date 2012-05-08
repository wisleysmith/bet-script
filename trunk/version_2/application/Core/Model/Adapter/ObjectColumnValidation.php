<?php
class Core_Model_Adapter_ObjectColumnValidation  
{	   
	public static function sizeValidation($value,$options)
	{
		$errors = array();   
		  
		if(strlen($value)>$options['max'])
		{
			$errors['errors'][] = 'Value must be between '.$options['min']. " and ".$options['max'];
		}
		
	   	if(strlen($value)<$options['min'])
		{
			$errors['errors'][] =  'Value must be between '.$options['min']. " and ".$options['max'];
		}
		
		return $errors;
	}	

	public static function requiredValidation($value)
	{ 
		if(!isset($value))
		{
			return 'Value not set';
		}
	} 

	public static function numericValidation($number)
	{  
		if(!is_numeric($number))
		{
			return 'Not valid numeric value: '.$number;
		} 
	} 
	
	public static function datetimeValidation($value)
	{ 
	    if (date('Y-m-d H:i:s', strtotime($value)) != $value) 
	    {
	       "Not valid sql date".$value ;
	    } 
	}
	
	public static function dateValidation($value)
	{ 
	    if (date('Y-m-d', strtotime($value)) != $value) 
	    {
	       "Not valid sql date".$value ;
	    } 
	}
}