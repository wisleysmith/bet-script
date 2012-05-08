<?php

  
class Model_BetsModel extends Model_Base_BetsModelBase
{   
	public function __construct()
	{
		$this->addForceColumnUpdate('add_date');
		parent::__construct(); 
	}   
	
	public function setData($data)
	{ 
		if(isset($data['bet_active']))
		{
			$data['bet_active'] = date('Y-m-d H:i:s', strtotime($data['bet_active']));
		}
		
		if(isset($data['end_date']))
		{
			$data['end_date'] = date('Y-m-d H:i:s', strtotime($data['end_date']));
		}  
		parent::setData($data);
	}
	
	public function validate($excludeFromValidation = array())
	{ 
		if(!in_array('bet_active', $excludeFromValidation))
		{
			$activeDate = strtotime($this->getBetActive());
			$endDate = strtotime($this->getEndDate());
			  
			if($endDate<=$activeDate)
			{ 
			 	$this->setValidationError('bet_active','Active time cant be larger or equal to end time');  
			}
		} 
		parent::validate($excludeFromValidation);
	}
	
	public function insert()
	{
		$this->setAddDate(date('Y-m-d H:i:s', time()));
		parent::insert();
	}
	
	public function betsWithEventBets($groupsId=null,$eventTypesId=null)
	{
		$this->resetQuery();
		$odds = new Model_OddValueModel();
		$betType = new Model_BetsTypeModel(); 
		$eventBetsModel = new Model_EventBetsModel(); 
		$this->resetQuery();
		$this->addQuery('select',array('table'=>$this->getTableName()));
		$this->addQuery('leftJoin',array('table'=>$eventBetsModel->getTableName(),'condition'=>'bets_id = bets_id_FK'));
		return $this;
	}
	
	public function completeBetData($groupsId=null,$eventTypesId=null)
	{
		$this->resetQuery();
		$odds = new Model_OddValueModel();
		$betType = new Model_BetsTypeModel(); 
		$eventBetsModel = new Model_EventBetsModel(); 
		$this->resetQuery();
		$this->addQuery('select',array('table'=>$this->getTableName()));
		$this->addQuery('leftJoin',array('table'=>$eventBetsModel->getTableName(),'condition'=>'bets_id = bets_id_FK'));
	 	$this->addQuery('leftJoin',array('table'=>$betType->getTableName(),'condition'=>'event_bets_id_FK = event_bets_id'));
		$this->addQuery('leftJoin',array('table'=>$odds->getTableName(),'condition'=>'bet_types_id_FK=bet_types_id'));
		 
		if($groupsId!==null)
		{  
			$this->addQuery('where',array('where_condition'=>'groups_id_FK='.(int)$groupsId)); 
		} 
		
		if($eventTypesId!==null)
		{
			$this->addQuery('where',array('where_condition'=>'event_types_id_FK='.(int)$eventTypesId));
		} 
		
		return $this;
	} 
	
	public function getInfomationByOdds($arrayOfOddIds)
	{
		$oddsIds = implode(',', $arrayOfOddIds);
		$odds = new Model_OddValueModel();
		$betType = new Model_BetsTypeModel(); 
		$eventBetsModel = new Model_EventBetsModel(); 
		
		$this->resetQuery();
		$this->addQuery('select',array('table'=>$this->getTableName()));
		$this->addQuery('leftJoin',array('table'=>$eventBetsModel->getTableName(),'condition'=>'bets_id = bets_id_FK'));
	 	$this->addQuery('leftJoin',array('table'=>$betType->getTableName(),'condition'=>'event_bets_id_FK = event_bets_id'));
		$this->addQuery('leftJoin',array('table'=>$odds->getTableName(),'condition'=>'bet_types_id_FK=bet_types_id'));
		$this->addQuery('where',array('where_condition'=>"odd_value_id in ($oddsIds)")); 
		return $this;
	}
}