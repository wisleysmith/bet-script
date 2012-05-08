<?php
class View_Frontend_UserBetSlip extends  Extension_Core_View_Yui_Template
{    
	private $betSlipId; 
	
	public function getBetSlipData()
	{
		$userId = $this->getUserId();
		if(!isset($userId))
		{
			return;
		}
		$model = new Model_BetSlipModel();
		$model->getBetSlipOdds();
		$model->addQuery('where',array('where_condition'=>'bp.bet_slip_id='.(int)$this->getBetSlipId())); 
		$model->addQuery('where',array('where_condition'=>'bp.user_id_FK='.$userId)); 
		return $model->executeQuery('fetchAssoc');
	}
	 
	public function getUserId()
	{
		$user = new Core_Auth_User();
		return $user->getUserId();
	}
	
	public function getBetSlipId()
	{ 
		if(!isset($this->betSlipId))
		{
			$this->setBetSlipId();
		} 
		return $this->betSlipId;
	}
	
	public function setBetSlipId($id=null)
	{
		if($id==null)
		{
			if(isset($_GET['bet_slip_id']))
			{
				$this->betSlipId = (int)$_GET['bet_slip_id'];
			}
			else 
			{
				$this->betSlipId = null;
			}
		}
		else 
		{
			$this->betSlipId = $id;
		} 
	} 
	
	public function getWinnings()
	{
		$userId = $this->getUserId();
		if(!isset($userId))
		{
			return;
		}

		$betSlipId = $this->getBetSlipId(); 
		$transaction = new Model_TransactionModel();
		$transaction->load(array('user_id_FK'=>$userId,'transaction_type_id_FK'=>2,'transaction_type_idendifier'=>$betSlipId));
		return $transaction->getMoney();
	}
	
	public function getStake()
	{
		$userId = $this->getUserId();
		if(!isset($userId))
		{
			return;
		}

		$betSlipId = $this->getBetSlipId(); 
		$transaction = new Model_TransactionModel();
		$transaction->load(array('user_id_FK'=>$userId,'transaction_type_id_FK'=>3,'transaction_type_idendifier'=>$betSlipId));
		return $transaction->getMoney();
	}
	
	
}