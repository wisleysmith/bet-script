<?php
class View_Admin_UserBetSlips extends Core_View_Layout_Template
{ 
	private $bets; 
	
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
		$bets = new View_Frontend_UserBets();
		$bets->setUserId(null);
		$this->bets = $bets; 
	}
}