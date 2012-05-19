<?php
class View_Frontend_Widgets_OfferTableEvents extends Extension_Core_View_Yui_Template
{  
	private $offerTable;
	private $groupId;
	private $eventTypesId;
	private $connectToTicket;
	private $boundToBetslip=false;
	
	public function __construct()
	{
		$this->setWidgetDependencies('event-custom');  
	}
	 
	private function setOfferTable()
	{ 
		$this->offerTable = new Extension_View_Yui35_DataTable();
		$eventTypesValues = new Model_EventTypesValueModel(); 
		$eventTypesValues->addQuery('select',array('table'=>$eventTypesValues->getTableName())) ;
		
		$eventTypesId = $this->getEventTypesId();
		if(is_numeric($eventTypesId))
		{
			$eventTypesValues->addQuery('where', array('where_condition'=>'event_types_id_FK='.(int)$eventTypesId));
		}
		else 
		{
			return;
		}
		
		$eventTypesValues->addQuery('order',array('order'=>implode($eventTypesValues->getPrimaryKeys(),",").' DESC'));
		$eventTypesValuesCoellction = new Core_Model_Adapter_ModelCollection();
		$eventTypesValuesCoellction->getModelCollection($eventTypesValues); 

		$this->offerTable->addColumn(array('key'=>'event_bets_id','label'=> 'ID'));
		$this->offerTable->addColumn(array('key'=>'event_bets_name','label'=> 'Name'));
		$this->offerTable->addColumn(array('key'=>'end_date','label'=> 'Ends'));
		
		foreach ($eventTypesValuesCoellction->toArray() as $a)
		{
			$this->offerTable->addColumn(array('key'=>$a['event_types_value_id'],'allowHTML'=>true,'formatter'=>'<span class="betOfferElement">{value}</span>','label'=> $a['event_value_name'])); 		 
		}  
		
		$betsModel = new Model_BetsModel(); 
		$groupsId = $this->getGroupId();
		if(!is_numeric($groupsId))
		{
			return;	
		}
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
	    } 
	    
	    $preperedTableArray = array();
		foreach($data as $value) 
		{
    		$preperedTableArray[] = $value;
		} 
		
	   $this->offerTable->setData($preperedTableArray);
	   return $this->offerTable;
   	} 
	 
	public function getOfferTable()
	{   
		if(!isset($this->offerTable))
		{
			$this->setOfferTable();
		}
		return $this->offerTable; 
	} 
	
	public function getGroupId()
	{ 
		if(!isset($this->groupId))
		{
			$this->setGroupId();
		} 
		return (int)$this->groupId;
	}
	
	public function setGroupId($id=null)
	{
		if($id==null)
		{
			if(isset($_GET['groups_id']))
			{
				$this->groupId = (int)$_GET['groups_id'];
			}
			else 
			{
				$this->groupId = null;
			}
		}
		else 
		{
			$this->groupId = $id;
		} 
	} 
	
	public function getEventTypesId()
	{ 
		if(!isset($this->eventTypesId))
		{
			$this->setEventTypesId();
		} 
		return $this->eventTypesId;
	}
	
	public function setEventTypesId($id=null)
	{
		if($id==null)
		{
			if(isset($_GET['event_types_id']))
			{
				$this->eventTypesId = (int)$_GET['event_types_id'];
			}
			else 
			{
				$this->eventTypesId = null;
			}
		}
		else 
		{
			$this->eventTypesId = $id;
		} 
	} 
}