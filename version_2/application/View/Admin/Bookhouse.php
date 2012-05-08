<?php 
class View_Admin_Bookhouse extends Core_View_Layout_Template
{
	private $bookhouseTableWithPanel; 
	private $sportsTableWithPanel; 
	private $groupsTableWithPanel;
	
	public function __construct()
	{  
		$this->bookhouseTableWithPanel = new Extension_View_Yui35_DataTableEdit(); 
	}   
	  
	private function setBookhouseTable()
	{ 
		$bookhouse =  $this->bookhouseTableWithPanel->getTable(); 
		$bookhouseModel = new Model_BookhouseModel();
		$bookhouseModel->addQuery('select',array('table'=>$bookhouseModel->getTableName()));
		$this->bookhouseTableWithPanel->setModel($bookhouseModel); 
		$this->bookhouseTableWithPanel->isAddButtonEnabled(false);
		$this->bookhouseTableWithPanel->isDeleteEnabled(false);
		$bookhouse->addColumn(array('key'=>'bookhouse_id','label'=> 'ID'));
		$bookhouse->addColumn(array('key'=>'house_name','label'=> 'Bookhouse')); 
		$bookhouse->addColumn(array('key'=>'default_money_value','label'=> 'Default Money')); 
		$bookhouse->addColumn('{key:"can_user_register",label:"Can User Register",allowHTML:true,formatter:'.$bookhouse->getFormatter('selectYesNo',array('attributes'=>array('name'=>'model['.$this->bookhouseTableWithPanel->getModelName().'][can_user_register]'))).'}',false,'can_user_register'); 
		$bookhouse->addColumn('{key:"active",label:"Active",allowHTML:true,formatter:'.$bookhouse->getFormatter("selectYesNo",array('attributes'=>array('name'=>'model['.$this->bookhouseTableWithPanel->getModelName().'][active]'))).'}',false,'active');
    } 
	
	public function getBookhouseTablePanel()
	{ 
		$this->setBookhouseTable();  
		$this->setPanelOptions($this->bookhouseTableWithPanel->getPanel());
		return $this->bookhouseTableWithPanel;
	} 
	
	private function setSportsTablePanel()
	{ 
		$this->sportsTableWithPanel = new View_Admin_Sports();
	}
	
	public function getSportsTablePanel()
	{ 
		if(!isset($this->sportsTableWithPanel))
		{
			$this->setSportsTablePanel(); 
		}
		return $this->sportsTableWithPanel;
	}  
	
	public function getGroupsTablePanel()
	{
		if(!isset($this->groupsTableWithPanel))
		{
			$this->setGroupsTablePanel();
		}
		return $this->groupsTableWithPanel;
   	} 
	 
   	private function setGroupsTablePanel()
	{
		$this->groupsTableWithPanel =  new View_Admin_Groups();
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