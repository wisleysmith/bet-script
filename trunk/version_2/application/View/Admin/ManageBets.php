<?php
class View_Admin_ManageBets extends Core_View_Layout_Template
{  
	private $betsTableWithPanel;
	
	public function __construct()
	{ 
		$this->betsTableWithPanel = new Extension_View_Yui35_DataTableEdit();
	}  
	
	public function setBetsTablePanel()
	{
		$table = $this->betsTableWithPanel->getTable(); 
		
		$this->betsTableWithPanel->isAddButtonEnabled(false);
		$model = new Model_BetsModel(); 
		$model->addQuery('select',array('table'=>$model->getTableName())) ;
		$model->addQuery('order',array('order'=>implode($model->getPrimaryKeys(),",").' DESC'));
		$model->addQuery('limit',array('limit'=>20));  
		$this->betsTableWithPanel->setModel($model); 
		    
		$table->addColumn(array('key'=>'bets_id','label'=> 'ID'));
		$table->addColumn(array('key'=>'bet_name','label'=> 'Name')); 
		 
		$groupsModel = new Model_GroupsModel();
		$groupsModel->addQuery('select',array('table'=>$groupsModel->getTableName()));
		$groupsCollection = new Core_Model_Adapter_ModelCollection();
		$groupsCollectionData = $groupsCollection->getModelCollection($groupsModel);
		$table->addColumn('{key:"groups_id_FK",label:"Group",allowHTML:true,formatter:'.$table->getFormatter("selectFromModel",array('values'=>$groupsCollectionData,'value'=>'groups_id','label'=>'name_of_group','attributes'=>array('name'=>'model['.$this->betsTableWithPanel->getModelName().'][groups_id_FK]'))).'}',false,'groups');
		  
		$table->addColumn(array('key'=>'bet_active','label'=> 'Active'));
		$table->addColumn(array('key'=>'end_date','label'=> 'Ends'));  
		 
		$select = new Extension_View_Html_Form_Elements_Select();
		$select->setModel($groupsCollection->toArray());
	  	$select->setAttribute('name','groups_id_FK');
	  	$select->setOptionLabelKey('name_of_group');
	  	$select->setOptionValueKey('groups_id');  
	  	$select->setPrependHtml('Group:');
	 	
		$this->betsTableWithPanel->addFilter($select); 
		$this->betsTableWithPanel->addFilterGroupOperators('active', 'and');
		$this->betsTableWithPanel->addFilterGroupOperators('end', 'and');
		
		$filterCalendar = new Extension_View_Html_Form_Elements_Calendar();
		$filterCalendar->setPrependHtml('Active from:');
		$filterCalendar->setAttribute('name','bet_active');
		$this->betsTableWithPanel->addFilter($filterCalendar,array('group'=>'active','operator'=>'and','comparison'=>'>')); 
		   
		$filterCalendar = new Extension_View_Html_Form_Elements_Calendar();
		$filterCalendar->setPrependHtml('Active to:');
		$filterCalendar->setAttribute('name','bet_active');
		$this->betsTableWithPanel->addFilter($filterCalendar,array('group'=>'active','operator'=>'and','comparison'=>'<')); 
		
		$filterCalendar = new Extension_View_Html_Form_Elements_Calendar();
		$filterCalendar->setPrependHtml('End from:');
		$filterCalendar->setAttribute('name','end_date');
		$this->betsTableWithPanel->addFilter($filterCalendar,array('group'=>'end','operator'=>'and','comparison'=>'>')); 
		   
		$filterCalendar = new Extension_View_Html_Form_Elements_Calendar();
		$filterCalendar->setPrependHtml('End to:');
		$filterCalendar->setAttribute('name','end_date');
		$this->betsTableWithPanel->addFilter($filterCalendar,array('group'=>'end','operator'=>'and','comparison'=>'<')); 
		 
   	} 
	 
	public function getBetsTablePanel()
	{ 
		$this->setBetsTablePanel();  
		$this->setPanelOptions($this->betsTableWithPanel->getPanel());
		return $this->betsTableWithPanel; 
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