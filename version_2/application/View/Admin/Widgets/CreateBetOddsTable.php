<?php
class View_Admin_Widgets_CreateBetOddsTable extends Core_View_Layout_Template
{  
	private $betOddsTable;
	private $eventTypesId;
	
	public function __construct()
	{ 
		$this->betOddsTable = new Extension_View_Yui35_DataTable();
		$this->setBetOddsTable();
	}  
	
	private function setBetOddsTable()
	{ 
		$model = new Model_EventTypesValueModel(); 
		$model->addQuery('select',array('table'=>$model->getTableName())) ;
		
		$eventTypesId = $this->getEventTypesId();
		if(is_numeric($eventTypesId))
		{
			$model->addQuery('where', array('where_condition'=>'event_types_id_FK='.$eventTypesId));
		}
		
		$model->addQuery('order',array('order'=>implode($model->getPrimaryKeys(),",").' DESC'));
		$valuesCollection = new Core_Model_Adapter_ModelCollection();
		$valuesCollection->getModelCollection($model); 
		$this->betOddsTable->setData($valuesCollection->toArray());  
		$this->betOddsTable->addColumn(array('key'=>'event_types_value_id','label'=> 'ID')); 	
		$this->betOddsTable->addColumn(array('key'=>'event_value_name','label'=> 'Name')); 	
		$this->betOddsTable->addColumn('{key:"event_types_value_id",label:"Odds",allowHTML:true,formatter:"<input class=\'oddsInput\' valueid=\'{value}\' value=\'1\' type=\'text\' />"}',false,'active');		 	 	 	 
    } 
	 
	public function getBetOddsTable()
	{   
		return $this->betOddsTable; 
	} 
	
	public function getEventTypesId()
	{ 
		if(!isset($this->eventTypesId))
		{
			$this->setEventTypesId();
		} 
		return (int)$this->eventTypesId;
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