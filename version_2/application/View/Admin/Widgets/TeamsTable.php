<?php
class View_Admin_Widgets_TeamsTable extends Core_View_Layout_Template
{  
	private $teamsTable;
	private $groupId;
	
	public function __construct()
	{ 
		$this->teamsTable = new Extension_View_Yui35_DataTable();
		$this->setTeamsTable();
	}  
	
	private function setTeamsTable()
	{ 
		$model = new Model_TeamsModel(); 
		$model->addQuery('select',array('table'=>$model->getTableName())) ;
		
		$groupId = $this->getGroupId();
		if(is_numeric($groupId))
		{
			$model->addQuery('where', array('where_condition'=>'groups_id_FK='.$groupId));
		}
		
		$model->addQuery('order',array('order'=>implode($model->getPrimaryKeys(),",").' DESC'));
		$teamsCollection = new Core_Model_Adapter_ModelCollection();
		$teamsCollection->getModelCollection($model); 
		$this->teamsTable->setData($teamsCollection->toArray()); 
		   
		$this->teamsTable->addColumn(array('key'=>'teams_id','label'=> 'ID'));
		$this->teamsTable->addColumn(array('key'=>'team_name','label'=> 'Name')); 		 
   	} 
	 
	public function getTeamsTable()
	{   
		return $this->teamsTable; 
	} 
	
	public function getGroupId()
	{ 
		if(!isset($this->groupId))
		{
			$this->setGroupId();
		} 
		return $this->groupId;
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
	 
}