<?php
class View_Admin_UserBankBets extends Core_View_Layout_Template
{
	private $bank;
	private $bets;
	private $userId;
	
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
		$bank->setUserId($this->getUserId());
		$this->bank = $bank; 
	}
	
	public function getBets()
	{
		if(!isset($this->bets))
		{
			$this->setBets();
		}
		return $this->bets;
	} 
	
	public function setBets()
	{
		$bets = new View_Admin_UserBets();
		$bets->setUserId($this->getUserId());
		$this->bets = $bets; 
	}
	

	public function getUserId()
	{ 
		if(!isset($this->userId))
		{
			$this->setUserId();
		} 
		return $this->userId;
	}
	
	public function setUserId($id=null)
	{
		if($id===null)
		{
			if(isset($_REQUEST['user_id']))
			{
				$this->userId = (int)$_REQUEST['user_id'];
			}
			else 
			{
				$this->userId = null;
			}
		}
		else 
		{
			$this->userId = $id;
		} 
	}
}