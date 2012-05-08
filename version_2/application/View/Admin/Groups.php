<?php 
class View_Admin_Groups extends Core_View_Layout_Template
{ 
	private $groupsTableWithPanel;
	 
	private function setGroupsTablePanel()
	{
		$this->groupsTableWithPanel = new Extension_View_Yui35_DataTableEdit(); 
		$groups = $this->groupsTableWithPanel->getTable(); 
		$groupsModel = new Model_GroupsModel();
		$groupsModel->addQuery('select',array('table'=>$groupsModel->getTableName())) ;
		$groupsModel->addQuery('order',array('order'=>implode($groupsModel->getPrimaryKeys(),",").' DESC'));
		$groupsModel->addQuery('limit',array('limit'=>20));  
		$this->groupsTableWithPanel->setModel($groupsModel); 
		   
		$groups->addColumn(array('key'=>'groups_id','label'=> 'ID'));
		$groups->addColumn(array('key'=>'name_of_group','label'=> 'Group')); 
		 
		$sportsModel = new Model_SportsModel();
		$sportsModel->addQuery('select',array('table'=>$sportsModel->getTableName()));
		$sportsCollection = new Core_Model_Adapter_ModelCollection();
		$sportsCollectionData = $sportsCollection->getModelCollection($sportsModel);
		$groups->addColumn('{key:"sports_id_FK",label:"Sport",allowHTML:true,formatter:'.$groups->getFormatter("selectFromModel",array('values'=>$sportsCollectionData,'value'=>'sports_id','label'=>'name_of_sport','attributes'=>array('name'=>'model['.$this->groupsTableWithPanel->getModelName().'][sports_id_FK]'))).'}',false,'active');
		  
		$select = new Extension_View_Html_Form_Elements_Select();
		$select->setModel($sportsCollection->toArray());
	  	$select->setAttribute('name','sports_id_FK');
	  	$select->setOptionLabelKey('name_of_sport');
	  	$select->setOptionValueKey('sports_id');  
		$this->groupsTableWithPanel->addFilter($select); 
   	} 
	 
	public function getGroupsTablePanel()
	{ 
		if(!isset($this->groupsTableWithPanel))
		{
			$this->setGroupsTablePanel();  
			$this->setPanelOptions($this->groupsTableWithPanel->getPanel());
		} 
		return $this->groupsTableWithPanel;
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