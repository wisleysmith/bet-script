<?php
class View_Admin_Widgets_OfferTableEvents extends Extension_Core_View_Yui_Template
{  
	private $offerTable;
	private $groupId;
	private $eventTypesId;

	public function __construct()
	{  
		$this->addEventListener('onGenerateViewBefore', $this, 'onGenerateViewBeforeHandler');
	}
	
	private function setOfferTable()
	{ 
		$offerTable = new Extension_View_Yui35_DataTableEdit();
		$offerTable->isAddButtonEnabled(false);
		 
		
		$eventTypesValues = new Model_EventTypesValueModel(); 
		$eventTypesValues->addQuery('select',array('table'=>$eventTypesValues->getTableName())) ;
		
		$model = new Model_EventBetsModel(); 
		$offerTable->setModel($model);		
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
		
		$offerTable->getTable()->addColumn(array('key'=>'event_bets_id','label'=> 'ID')); 
		$offerTable->getTable()->addColumn(array('key'=>'event_bets_name','label'=> 'Name'));
		$offerTable->getTable()->addColumn(array('key'=>'add_date','label'=> 'Active'));
		$offerTable->getTable()->addColumn(array('key'=>'end_date','label'=> 'Ends'));
		$offerTable->getTable()->addColumn(array('key'=>'score','label'=> 'Score')); 

		$offerTable->setUpdateRule('exclude','end_date');
		$offerTable->setUpdateRule('exclude','add_date'); 
		
		$offerTable->getTable()->addColumn('{key:"correct_type",label:"Correct Type",allowHTML:true,formatter:'.$offerTable->getTable()->getFormatter("selectFromModel",array('values'=>$eventTypesValuesCoellction,'value'=>'event_types_value_id','label'=>'event_value_name','attributes'=>array('name'=>'model['.$model->getModelClassName().'][correct_type]'))).'}',false,'correct_type');
		
		foreach ($eventTypesValuesCoellction->toArray() as $a)
		{
			$offerTable->getTable()->addColumn(array('key'=>$a['event_types_value_id'],'allowHTML'=>true,'formatter'=>'<span class="betOfferElement">{value}</span>','label'=> $a['event_value_name'])); 		 
			$offerTable->setUpdateRule('exclude', $a['event_types_value_id']);
		}  
		  
		$groupsId = $this->getGroupId();
		if(!is_numeric($groupsId))
		{
			return;	
		}
		
		$offerTable->setUrl('filter',Application::getRouter()->getFullUrl(array('controller'=>'servicejson','action'=>'method','params'=>'method=completeEventBetDataArray&groups_id='.$groupsId.'&event_types_id'.$eventTypesId))); 
		
		$preperedTableArray = $model->completeEventBetDataArray($groupsId,$eventTypesId);
		   
	    $offerTable->getTable()->setData($preperedTableArray);
	    
	   return $this->offerTable = $offerTable;
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