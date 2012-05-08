<?php

 
class Model_CreateBetModel extends Model_Base_EventBetsModelBase
{   
	private $oddsData = array();
	private $odds = array();
	private $eventTypesValues = array();
	
	public function __construct()
	{
		parent::__construct(); 
	}  
	 
	public function insert()
	{
		parent::insert();
		$id = $this->getConnection()->getInsertId();
		$betTypeData = array(); 
		
		foreach ($this->getOddsData() as $key=>$o)
		{  
			$betType = new Model_BetsTypeModel();
			$betTypeData['event_bets_id_FK'] = $id;
			$betTypeData['teams_has_bets_id_FK'] = NULL;
			$betTypeData['event_types_value_id_FK'] = $key;
			$betType->setData($betTypeData);
			$betType->insert();
			$idBetType = $this->getConnection()->getInsertId();
			
			$oddsData = array();  
			$oddsData['odd_value'] = $o;
			$oddsData['bet_types_id_FK'] = $idBetType;
			$odds = new Model_OddValueModel();
			$odds->setData($oddsData);
			$odds->insert();
		} 
	}
	
	public function load($primKeys)
	{    
		if(!isset($primKeys))
		{
			$this->setValidationError('sql', 'Load data not set');
		}
		$odds = new Model_OddValueModel();
		$betType = new Model_BetsTypeModel();
		
		$this->setPrimaryKeysValues($primKeys);
		$this->addQuery('select',array('table'=>$this->getTableName()));
		
	 	$this->addQuery('leftJoin',array('table'=>$betType->getTableName(),'condition'=>'event_bets_id_FK = event_bets_id'));
		$this->addQuery('leftJoin',array('table'=>$odds->getTableName(),'condition'=>'bet_types_id_FK=bet_types_id'));
		
		$this->addQuery('where',array('where_condition'=>$this->preparePKForWhere())); 
		 
		if($data = $this->executeQuery())
		{	
			$objectData = $this->getConnection()->fetchAssoc($data);
			$this->setData($objectData[0]);
			foreach ($objectData as $o)
			{
				$this->addOdds($o);
				$this->addEventTypes($o);
			}
		}   
	}  
	
	public function setData($data)
	{
		if(isset($data['odds_data']))
		{
			$this->setOddsData($data['odds_data']);
		}
		
		parent::setData($data);
	}
	
	public function setOddsData($oddsData)
	{ 
		$this->oddsData = $oddsData;
	}
	 
	public function getOddsData()
	{
		return $this->oddsData;
	}
	
	public function addOdds($data)
	{
		$odds = new Model_OddValueModel();
		$odds->setData($data); 
		$this->odds[] = $odds; 
	}
	
	public function addEventTypes($data)
	{  
		$betType = new Model_BetsTypeModel();
		$betType->setData($data);
		$this->eventTypesValues[] = $betType;
	} 
}