<?php
class View_Admin_EventTypes extends Core_View_Layout_Template
{  
	private $eventTypesTableWithPanel;
	
	public function __construct()
	{ 
		$this->eventTypesTableWithPanel = new Extension_View_Yui35_DataTableEdit();
		$this->eventTypesValuesTableWithPanel = new Extension_View_Yui35_DataTableEdit($rowsPerPage=20,$totalRows=null,$defaultPanelRules=false);
	}
	
	private function setEventTypesValuesTablePanel()
	{ 
		$model = new Model_EventTypesValueModel(); 
		$table = $this->eventTypesValuesTableWithPanel->getTable();  
		
		$this->eventTypesValuesTableWithPanel->setModel($model) ; 
	 	$this->eventTypesValuesTableWithPanel->setUpdateRule('event_types_id_FK', 'hidden');
		$this->eventTypesValuesTableWithPanel->isFilterButtonEnabled(false);
		
		$table->addColumn(array('key'=>'event_types_value_id','label'=> 'ID'));
	    $table->addColumn(array('key'=>'event_value_name', 'label'=> 'Name'));
	    $table->addColumn(array('key'=>'event_types_id_FK', 'label'=> 'Event Type ID'));
	    
	    $select = new Extension_View_Html_Form_Elements_Input(); 
	  	$select->setAttribute('name','event_types_id_FK');
	  	$select->setAttribute('type','hidden');   
		$this->eventTypesValuesTableWithPanel->addFilter($select); 
	} 
	
	public function getEventTypesValuesTablePanel()
	{ 
		$this->setEventTypesValuesTablePanel();  
		$this->setPanelOptions($this->eventTypesValuesTableWithPanel->getPanel());
		return $this->eventTypesValuesTableWithPanel;
	} 
	
	private function setEventTypesTablePanel()
	{
		$table = $this->eventTypesTableWithPanel->getTable(); 
		$model = new Model_EventTypesModel(); 
		$model->addQuery('select',array('table'=>$model->getTableName())) ;
		$model->addQuery('order',array('order'=>implode($model->getPrimaryKeys(),",").' DESC'));
		$model->addQuery('limit',array('limit'=>20));  
		$this->eventTypesTableWithPanel->setModel($model); 
		   
		$table->addColumn(array('key'=>'event_types_id','label'=> 'ID'));
		$table->addColumn(array('key'=>'event_types_name','label'=> 'Name')); 
		$table->addColumn('{key:"event_types_id",label:"Event Types Values",allowHTML:true,formatter:'.$table->getFormatter("inputFieldCell",array('attributes'=>array('type'=>'button','class'=>'event_type_values','value'=>'Edit values'))).'}',false,'active');
		
		
		$sportsModel = new Model_SportsModel();
		$sportsModel->addQuery('select',array('table'=>$sportsModel->getTableName()));
		$sportsCollection = new Core_Model_Adapter_ModelCollection();
		$sportsCollectionData = $sportsCollection->getModelCollection($sportsModel);
		$table->addColumn('{key:"sports_id_FK",label:"Sport",allowHTML:true,formatter:'.$table->getFormatter("selectFromModel",array('values'=>$sportsCollectionData,'value'=>'sports_id','label'=>'name_of_sport','attributes'=>array('name'=>'model['.$this->eventTypesTableWithPanel->getModelName().'][sports_id_FK]'))).'}',false,'sports');
		  
		$select = new Extension_View_Html_Form_Elements_Select();
		$select->setModel($sportsCollection->toArray());
	  	$select->setAttribute('name','sports_id_FK');
	  	$select->setOptionLabelKey('name_of_sport');
	  	$select->setOptionValueKey('sports_id');  
		$this->eventTypesTableWithPanel->addFilter($select); 
   	} 

	public function getEventTypesValuesTableWithPanelInstance()
   	{
   		return $this->eventTypesValuesTableWithPanel; 
   	}
   	
   	public function getEventTypesTablePanelInstance()
   	{
   		return $this->eventTypesTableWithPanel; 
   	}	
   	
	public function getEventTypesTablePanel()
	{ 
		$this->setEventTypesTablePanel();  
		$this->setPanelOptions($this->eventTypesTableWithPanel->getPanel());
		return $this->eventTypesTableWithPanel; 
	} 
	
	public function setPanelOptions($panel)
	{ 
		$panel->addConstructorOption('srcNode' , $panel->getHtmlElementId(true),true); 
        $panel->addConstructorOption('width'        , '450');
        $panel->addConstructorOption('height'        , '450');
        $panel->addConstructorOption('zIndex'       , '1005');
        $panel->addConstructorOption('centered'     , 'true');
        $panel->addConstructorOption('modal'        , 'true');
        $panel->addConstructorOption('visible'      , 'false');
        $panel->addConstructorOption('render'       , 'true');
        $panel->addConstructorOption('plugins'     , '[Y.Plugin.Drag]');  
	}
}