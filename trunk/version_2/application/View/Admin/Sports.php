<?php 
class View_Admin_Sports extends Core_View_Layout_Template
{ 
	private $sportsTableWithPanel;  
	  
	private function setSportsTablePanel()
	{
		$this->sportsTableWithPanel = new Extension_View_Yui35_DataTableEdit();
		$sports =  $this->sportsTableWithPanel->getTable(); 
		$sportsModel = new Model_SportsModel();
		$sportsModel->addQuery('select',array('table'=>$sportsModel->getTableName())); 
		$sportsModel->addQuery('order',array('order'=>implode($sportsModel->getPrimaryKeys(),",").' DESC'));
		$sportsModel->addQuery('limit',array('limit'=>20));  
		$this->sportsTableWithPanel->setModel($sportsModel); 
		$this->sportsTableWithPanel->setRowsPerPage(20);
		
		$sports->addColumn(array('key'=>'sports_id','label'=> 'ID'));
		$sports->addColumn(array('key'=>'name_of_sport','label'=> 'Sport')); 
		 
		$bookhouseModel = new Model_BookhouseModel();
		$bookhouseModel->addQuery('select',array('table'=>$bookhouseModel->getTableName()));
		$bookhouseCollection = new Core_Model_Adapter_ModelCollection();
		$bookhouseCollectionData = $bookhouseCollection->getModelCollection($bookhouseModel);
		
		$sports->addColumn('{key:"bookhouse_id_FK",label:"Bookhouse",allowHTML:true,formatter:'.$sports->getFormatter("selectFromModel",array('values'=>$bookhouseCollectionData,'value'=>'bookhouse_id','label'=>'house_name','attributes'=>array('name'=>'model['.$this->sportsTableWithPanel->getModelName().'][bookhouse_id_FK]'))).'}',false,'active');
	} 
	
	public function getSportsTablePanel()
	{ 
		if(!isset($this->sportsTableWithPanel))
		{
			$this->setSportsTablePanel(); 
			$this->setPanelOptions($this->sportsTableWithPanel->getPanel());
		} 
		return $this->sportsTableWithPanel;
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