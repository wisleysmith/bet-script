<?php

  
class Model_BookhouseModel extends Model_Base_BookhouseModelBase
{   
	public function __construct()
	{
		parent::__construct(); 
	}   
  
	public function validate($excludeFromValidation = array())
	{
		if(!in_array('house_name', $excludeFromValidation))
		{
			$bookhouseSizeValidator =  new Zend_Validate_StringLength(3,20);
			if (!$bookhouseSizeValidator->isValid($this->getHouseName()))
		    {
				$this->setValidationError('house_name', "Bookhouse name size must bee between 3-20");
			}
		}
	}
	
	//currently only one enabled so used first
	public function loadActiveBookhouse()
	{
		$this->resetQuery();
		$this->addQuery('select',array('table'=>$this->getTableName()));
		$this->setData($this->executeQuery('fetchAssocOne'));
	}
	
	public function insert()
	{
		$this->setValidationError('Bookhouse','Only one bookhouse can be in use');
		return;
	}
	
	public function delete()
	{
		$this->setValidationError('Bookhouse','Delete not possible');
		return;
	}
}