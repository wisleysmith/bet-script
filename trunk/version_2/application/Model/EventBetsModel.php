<?php

 
class Model_EventBetsModel extends Model_Base_EventBetsModelBase
{   
	public function __construct()
	{
		$this->addForceColumnUpdate('bets_id_FK');
		$this->addForceColumnUpdate('event_types_id_FK');
		parent::__construct(); 
	}  
	 
	public function setData($data)
	{ 
		if(isset($data['correct_type']))
		{
			if(empty($data['correct_type'])||$data['correct_type']=='')
			{
				$data['correct_type'] = null;
			}
		}
		 
		parent::setData($data);
	}
	
	public function update($forceUpdateFlag = false)
	{ 
		$checkIfModelIsUpdatebale = new Model_EventBetsModel();
		$checkIfModelIsUpdatebale->load($this->getEventBetsId());
		
		if($checkIfModelIsUpdatebale->getCorrectType()!=null)
		{
			return $this->setValidationError('update', 'Correct Type is set, Event can be updated anymore');
		}

		parent::update($forceUpdateFlag);
		$this->load($this->getEventBetsId());
		 
		if($this->getCorrectType()!=null)
		{
			$betTypesModel = new Model_BetsTypeModel(); 
			$betTypesModel->load(array('event_bets_id_FK'=>$this->getEventBetsId(),'event_types_value_id_FK'=>$this->getCorrectType()));
			  
			$betTypesModel->addQuery('select',array('table'=>$betTypesModel->getTableName()));
			$betTypesModel->addQuery('where',array('where_condition'=>'event_bets_id_FK='.$this->getEventBetsId()));
			$betTypesModelCollection = new Core_Model_Adapter_ModelCollection();
			$betTypesModelCollection->getModelCollection($betTypesModel);
			
			$betTypesKeys = $betTypesModelCollection->getKeysArray('bet_types_id');
			$odds = new Model_OddValueModel();
			$odds->addQuery('update',array('table'=>$odds->getTableName(),'columns'=>'is_correct=0'));	 
			$odds->addQuery('where',array('where_condition'=>'bet_types_id_FK in ('.implode(',', $betTypesKeys).')'));
			$odds->executeQuery(); 
			$odds->load(array('bet_types_id_FK'=>$betTypesModel->getBetTypesId()));
			$odds->setIsCorrect(1);
			$odds->update();  
			
			$odds->addQuery('select',array('table'=>$odds->getTableName()));
			$odds->addQuery('where',array('where_condition'=>'bet_types_id_FK in ('.implode(',', $betTypesKeys).')'));
			$oddsValuesCollection = new Core_Model_Adapter_ModelCollection();
			$oddsValuesCollection->getModelCollection($odds);
			$oddValuesKeys = $oddsValuesCollection->getKeysArray('odd_value_id');
		 
			$betSlip = new Model_BetSlipModel();
			$betSlip->addQuery('update',array('table'=>$betSlip->getTableName(),'columns'=>'finished = finished+1'));
			$betSlip->addQuery('where',array('where_condition'=>'bet_slip_id in (select bet_slip_id_FK from bet_slip_odds where odd_value_id_FK in  ('.implode(',', $oddValuesKeys).'))'));
			$betSlip->executeQuery();
			 
			$betSlip->setStatusOne();
			$betSlip->proccessBetSlips();
			$betSlip->setStatusTwo(); 
		}
	}
	
	public function completeEventBetDataArray($groupsId=null,$eventTypesId=null)
	{
		if($groupsId===null)
		{
			if(isset($_GET['groups_id']))
			{
				$groupsId = (int)$_GET['groups_id'];
			}
		}
		
		if($eventTypesId===null)
		{
			if(isset($_GET['event_types_id']))
			{
				$eventTypesId = (int)$_GET['event_types_id'];
			}
		}
		
		$betsModel = new Model_BetsModel();
		$eventBetsInTable = $betsModel->completeBetData($groupsId,$eventTypesId)->executeQuery('fetchAssoc');
		  
	    $data = array();
	    
	    if(!is_array($eventBetsInTable))
	    {
	    	return;
	    } 
	    
	    foreach ($eventBetsInTable as $d)
	    { 
	    	$data[$d['event_bets_id']][$d['event_types_value_id_FK']] = $d['odd_value'];
	    	$data[$d['event_bets_id']]['event_bets_name'] = $d['event_bets_name'];
	    	$data[$d['event_bets_id']]['end_date'] = $d['end_date']; 
	    	$data[$d['event_bets_id']]['event_bets_id'] = $d['event_bets_id'];
	    	$data[$d['event_bets_id']][$d['event_types_value_id_FK'].'_odd_value_id'] = $d['odd_value_id']; 
	    	$data[$d['event_bets_id']]['bets_id'] = $d['bets_id'];  
	    	$data[$d['event_bets_id']]['score'] = $d['score']; 
	    	$data[$d['event_bets_id']]['correct_type'] = $d['correct_type']; 
	    	$data[$d['event_bets_id']]['add_date'] = $d['add_date']; 
	    	$data[$d['event_bets_id']]['event_bets_id'] = $d['event_bets_id'];
	    } 
	    
	    $preperedTableArray = array();
		foreach($data as $value) 
		{
    		$preperedTableArray[] = $value;
		}
		return $preperedTableArray;
	}
}