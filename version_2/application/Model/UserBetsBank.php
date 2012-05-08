<?php
 
class Model_UserBetsBank extends Model_Base_UserModelBase
{    
	private $bank;
	private $bets;
	
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
		$this->bets = $bets;
	}
} 