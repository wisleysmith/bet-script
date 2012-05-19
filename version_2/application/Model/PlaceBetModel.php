<?php
 
class Model_PlaceBetModel extends Model_BetSlipModel
{   
	private $stake;
	private $odds;
	private $user;
	
	public function __construct()
	{
		parent::__construct(); 
	} 
	
	public function setStake($stake)
	{
		$this->stake = (float)$stake;	
	}
	
	public function getStake()
	{
		return $this->stake;
	}
	
	public function setOdds($odds)
	{ 
		$oddsArray = array();
		foreach ($odds as $d)
		{
				$oddsArray[] = (int)$d;
		}
		$this->odds = $oddsArray;
	}
	
	public function getOdds()
	{
		return $this->odds;
	}
	
	public function getUser()
	{
		if(!isset($this->user))
		{
			$this->user = new Core_Auth_User(); 
		}
		return $this->user;
	}
 
	/**
	 * @todo put this on sql transaction
	 */
	public function insert()
	{ 		
		$dateCreated = date('Y-m-d H:i:s',time());
		$this->setDateCreated($dateCreated);
		$this->setPlayed(sizeof($this->getOdds()));
		$this->setUserIdFK($this->getUser()->getUserId());
		$this->setFinished(0);
		$this->setStatus(0);
		if(!parent::insert())
		{ 
			return false;
		}
		
		$betSlipId = $this->getConnection()->getInsertId();
		$transaction = new Model_TransactionModel();
		$transaction->setMoney($this->getStake()*-1);
		$transaction->setTransactionTypeIdFK(3);
		$transaction->setUserIdFK($this->getUser()->getUserId());
		$transaction->setTransactionTypeIdendifier($betSlipId);
		$transaction->setDateCreated($dateCreated);
	
		if(!$transaction->insert($dateCreated))
		{
			$this->setValidationError('sql', 'Server Error');
			$this->delete();
		};    
	
		/**
		 * @todo put this in one query
		 */
		foreach($this->getOdds() as $o)
		{
			$odds = new Model_BetSlipOddsModel();
			$odds->setOddValueIdFK($o);
			$odds->setBetSlipIdFK($betSlipId);
			$odds->insert();
		};
	}
	
	public function validate($excludeFromValidation = array())
	{ 
		$userBanned = $this->getUser()->getData('banned');
		$userId = $this->getUser()->getUserId();
		
		$transaction = new Model_TransactionModel();
		$transaction->setUserIdFK($userId);
		$transaction->getUserMoney();
		$money = $transaction->executeQuery('fetchAssocOne');
		if($money['money']<$this->getStake())
		{
			$this->setValidationError('money', 'You dont have enough money');
			return;
		} 
		
		
		if($userBanned==1)
		{
			$this->setValidationError('user','You are not currently allowed to bet');
		}
		
		$odds = $this->getOdds(); 
		 
		if(!in_array('user_id_FK', $excludeFromValidation))
		{
			
			if(!isset($userId))
			{
			 	$this->setValidationError('user','Please login');
			 	//if user id does not exist breaks future validation
			 	return;
			}
		}
		
		if(!in_array('odds', $excludeFromValidation))
		{
			if(!isset($odds)||empty($odds))
			{
				$this->setValidationError('odds','Odds not set');
			}
		}
		
		if(!in_array('stake', $excludeFromValidation))
		{
			if(!$this->getStake())
			{
				$this->setValidationError('stake', 'Stake not set');
			} 
		}
		
		 
		$bets = new Model_BetsModel();
		$currentOddsData = $bets->getInfomationByOdds($this->getOdds())->executeQuery('fetchAssoc');
		$sortedByOdds = array();
		foreach ($currentOddsData as $c)
		{
			$sortedByOdds[$c['odd_value_id']] = $c;
		}
		 
		$time = time();
		$betSlipErrors = array();
		$betsIdsList = array();
		$oddsDuplicate = array();
		foreach ($odds as $o)
		{
			//check on duplicates
			if(in_array($o,$oddsDuplicate))
			{	
				$this->setValidationError('odds', 'Multiple bets: '.$sortedByOdds[$o]['event_bets_name']);
				return;
			}
			else 
			{
				$oddsDuplicate[]=$o;
			}
			
			if($sortedByOdds[$o]["active"]!=1)
			{
				$this->setValidationError('odds','Odds changed '.$sortedByOdds[$o]['event_bets_name']);
				return;
			}  
			
			if(strtotime($sortedByOdds[$o]["end_date"])<$time)
			{
				$this->setValidationError('odds','Time ended on '.$sortedByOdds[$o]['event_bets_name']);
				return;
			} 
			
			if($sortedByOdds[$o]["correct_type"]!=null)
			{
				$this->setValidationError('odds', 'Bet Suspended: '.$sortedByOdds[$o]['event_bets_name']);
				return;
			} 
			
			$betsIdsList[] = $sortedByOdds[$o]["bets_id"];
		}
		 
		
		$betsIdsListDuplicates = array();
		foreach ($betsIdsList as $b)
		{
			if(in_array($b,$betsIdsListDuplicates))
			{	 
				$this->setValidationError('odds', 'Multiple bets: '.$b);
				return;
			}
			else 
			{
				$betsIdsListDuplicates[]=$b;
			}
		}
		
		parent::validate($excludeFromValidation);
	}
	
	public function setData($data)
	{ 
		if(isset($data['stake']))
		{ 
			$this->setStake((float)$data['stake']);
		}
		 
		if(isset($data['odds']))
		{  
			$this->setOdds($data['odds']);
		} 
	
		parent::setData($data);
	} 
}