<?php
class Core_Model_Adapter_ObjectColumnFiltration
{	 
	   
	public static function trimFilter($value)
	{
	 	return trim($value);
	}	

	public static function addslashesFilter($value)
	{
 		return addslashes($value);
	} 
}