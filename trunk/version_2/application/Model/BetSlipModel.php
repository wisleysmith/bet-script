<?php

 
class Model_BetSlipModel extends Model_Base_BetSlipModelBase
{   
	private $userId; 
	
	public function __construct()
	{ 
		$this->data['money'] = null;
		$this->data['user_id'] = null;
		$this->addForceColumnUpdate('date_created');
		parent::__construct(); 
	}  
	
	public function proccessBetSlips()
	{
		$this->resetQuery();
		$this->addQuery('string',array('string'=>'
			insert into transaction (user_id_FK,money,date_created,transaction_type_id_FK,transaction_type_idendifier)
			select bp.user_id_FK, sum(od.odd_value*od.is_correct*t.money) as money,now(),2,bp.bet_slip_id from bet_slip bp 
			inner join transaction t
			on t.transaction_type_idendifier = bp.bet_slip_id and transaction_type_id_FK = 3
			left join bet_slip_odds bso
			on bso.bet_slip_id_FK = bp.bet_slip_id
			left join odd_value od
			on od.odd_value_id = bso.odd_value_id_FK  
			where bp.status = 1
			group by bp.bet_slip_id
		'));
		$this->executeQuery();
	} 
	
	public function setStatusOne()
	{
		$this->resetQuery(); 
		$this->addQuery('update',array('table'=>$this->getTableName(),'columns'=>'status=1'));	 
		$this->addQuery('where',array('where_condition'=>'finished=played and status=0'));
		$this->executeQuery();
	} 
	
	public function setStatusTwo()
	{
		$this->resetQuery(); 
		$this->addQuery('update',array('table'=>$this->getTableName(),'columns'=>'status=2'));	 
		$this->addQuery('where',array('where_condition'=>'finished=played and status=1'));
		$this->executeQuery();
	} 
	
	public function getBetSlipOdds()
	{ 
		/**
		select * from bet_slip bp
		left join bet_slip_odds bso
		on bso.bet_slip_id_FK = bp.bet_slip_id
		left join odd_value ov
		on bso.odd_value_id_FK = ov.odd_value_id
		left join bets_type bt 
		on bt.bet_types_id =  ov.bet_types_id_FK
		left join event_types_value evt 
		on evt.event_types_value_id =  bt.event_types_value_id_FK
		left join event_bets eb 
		on eb.event_bets_id =  bt.event_bets_id_FK
		*/
		
		$this->resetQuery();
		$this->addQuery('select',array('table'=>$this->getTableName().' bp'));
		$this->addQuery('leftJoin',array('table'=>'bet_slip_odds bso','condition'=>'bso.bet_slip_id_FK = bp.bet_slip_id'));
	 	$this->addQuery('leftJoin',array('table'=>'odd_value ov','condition'=>'bso.odd_value_id_FK = ov.odd_value_id'));
		$this->addQuery('leftJoin',array('table'=>'bets_type bt ','condition'=>'bt.bet_types_id =  ov.bet_types_id_FK'));
		$this->addQuery('leftJoin',array('table'=>'event_types_value evt','condition'=>'evt.event_types_value_id =  bt.event_types_value_id_FK'));
		$this->addQuery('leftJoin',array('table'=>'event_bets eb','condition'=>'eb.event_bets_id =  bt.event_bets_id_FK'));
		 
		return $this;
	}
	
	public function getBetSlipsTransactionByUser()
	{
		$userId = $this->getUserId();
		if($userId===null)
		{
			throw new Core_Exceptions('User id not set');
		}
		$this->resetQuery();
		$this->addQuery('select',array('table'=>$this->getTableName().' bs','select_expr'=>'t.money,bs.*')) ;
		$this->addQuery('leftJoin',array('table'=>'transaction  t','condition'=>'t.transaction_type_idendifier = bs.bet_slip_id  and t.transaction_type_id_FK = 3 '));
		$this->addQuery('where',array('where_condition'=>'bs.user_id_FK='.(int)$userId)); 
		return $this;
	}
	
	public function getBetSlipsTransaction()
	{ 
		$this->resetQuery();
		$this->addQuery('select',array('table'=>$this->getTableName().' bs','select_expr'=>'t.money,bs.*')) ;
		$this->addQuery('leftJoin',array('table'=>'transaction  t','condition'=>'t.transaction_type_idendifier = bs.bet_slip_id  and t.transaction_type_id_FK = 3 '));
 		return $this;
	} 
	
	public function getMoney()
	{
		return $this->data['money'];
	}
	
	public function setMoney($money)
	{
		$this->data['money'] = (float)$money;
	}
	
	public function getUser()
	{
		if(!isset($this->user))
		{
			$this->user = new Core_Auth_User();
		}
		return $this->user;
	}
	
	public function getUserId()
	{
		if(!isset($this->data['user_id']))
		{
			$this->setUserId();
		}
		return $this->data['user_id'];
	}
	
	public function setUserId($userId=null)
	{ 
		if($this->getUser()->getRole()=='admin'||$this->getUser()->getRole()=='superadmin')
		{
			$this->data['user_id'] = $userId;
		}
		else 
		{
			$this->data['user_id'] = $this->getUser()->getUserId();
		}
	}  
}