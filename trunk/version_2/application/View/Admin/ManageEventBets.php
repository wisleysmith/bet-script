<?php
class View_Admin_ManageEventBets extends Core_View_Layout_Template
{  
	private $betsTableWithPanel;
	private $menu;
	 
	public function setMenu()
	{
		$url = Application::getRouter()->getFullUrl(array('controller'=>'servicehtml','action'=>'view'));
		$menu = new Extension_View_Yui35_Menu();
		$menu->setDirection('horizontal');
		
		$sportsModel = new Model_SportsModel();
		$sportsModel->addQuery('select',array('table'=>$sportsModel->getTableName()));
		$sportsCollection = new Core_Model_Adapter_ModelCollection();
		$sportsCollection->getModelCollection($sportsModel);
		  
		$select = new Extension_View_Html_Form_Elements_Select();
	    foreach ($sportsCollection->toArray() as $s)
	    { 
	    	$menu->addLink('sport_'.$s['sports_id'],array('content'=>$s['name_of_sport']));
	    	$menu->addChild('menu','sport_'.$s['sports_id']); 
	    }
		 
	    $groupsModel = new Model_GroupsModel();
		$groupsModel->addQuery('select',array('table'=>$groupsModel->getTableName()));
		$groupsCollection = new Core_Model_Adapter_ModelCollection();
		$groupsCollection->getModelCollection($groupsModel);
		  
		foreach ($groupsCollection->toArray() as $g)
		{
			$menu->addLink('group_'.$g['groups_id'],array('content'=>$g['name_of_group'],'attributes'=>array('class'=>'systemSubServiceLink','servicehtml'=>$url.'&view=View_Admin_Offer&groups_id='.$g['groups_id'])));
	    	$menu->addChild('sport_'.$g['sports_id_FK'],'group_'.$g['groups_id']); 
		} 
		 
		$this->menu = $menu;     
	}
	
	public function getMenu()
	{
		if(!isset($this->menu))
		{
			$this->setMenu();
		}
		return $this->menu;
	}  
}