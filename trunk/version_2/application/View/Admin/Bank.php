<?php
class View_Admin_Bank extends Core_View_Layout_Template
{
	private $bank;  
	
	public function getBank()
	{
		if(!isset($this->bank))
		{
			$this->setBank();
		}
		return $this->bank;
	}
	
	public function setBank()
	{
		$bank = new View_Admin_UserBank();
		$bank->setUserId(null);
		$this->bank = $bank; 
	} 
}