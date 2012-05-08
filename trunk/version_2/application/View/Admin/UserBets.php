<?php
class View_Admin_UserBets extends Core_View_Layout_Template
{  
	private $userBetsTableWithPanel;
	
	public function __construct()
	{ 
		$this->userBetsTableWithPanel = new Extension_View_Yui35_DataTable();
	}  
	
	private function setUserBetsTablePanel()
	{
		$table = $this->userBetsTableWithPanel->getTable(); 
		$model = new Model_TeamsModel(); 
		$model->addQuery('select',array('table'=>$model->getTableName())) ;
		$model->addQuery('order',array('order'=>implode($model->getPrimaryKeys(),",").' DESC'));
		$model->addQuery('limit',array('limit'=>20));  
		$this->userBetsTableWithPanel->setModel($model); 
		   
		$table->addColumn(array('key'=>'teams_id','label'=> 'ID'));
		$table->addColumn(array('key'=>'team_name','label'=> 'Name')); 
		 
		$groupsModel = new Model_GroupsModel();
		$groupsModel->addQuery('select',array('table'=>$groupsModel->getTableName()));
		$groupsCollection = new Core_Model_Adapter_ModelCollection();
		$groupsCollectionData = $groupsCollection->getModelCollection($groupsModel);
		$table->addColumn('{key:"groups_id_FK",label:"Group",allowHTML:true,formatter:'.$table->getFormatter("selectFromModel",array('values'=>$groupsCollectionData,'value'=>'groups_id','label'=>'name_of_group','attributes'=>array('name'=>'model['.$this->userBetsTableWithPanel->getModelName().'][groups_id_FK]'))).'}',false,'groups');
		  
		$select = new Extension_View_Html_Form_Elements_Select();
		$select->setModel($groupsCollection->toArray());
	  	$select->setAttribute('name','groups_id_FK');
	  	$select->setOptionLabelKey('name_of_group');
	  	$select->setOptionValueKey('groups_id');  
		$this->userBetsTableWithPanel->addFilter($select); 
   	} 
	 
	public function getTeamsTablePanel()
	{ 
		$this->setUserBetsTablePanel();  
		$this->setPanelOptions($this->userBetsTableWithPanel->getPanel());
		return $this->userBetsTableWithPanel; 
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