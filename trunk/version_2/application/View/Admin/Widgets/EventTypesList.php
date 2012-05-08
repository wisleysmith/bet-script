<?php
class View_Admin_Widgets_EventTypesList extends  Extension_Core_View_Yui_Template
{   
	private $selectList;
	private $sportId = null;
	
	public function getSelectList()
	{ 
		if(!isset($this->selectList))
		{
			$this->setSelectList();
		}
		return $this->selectList;
	}
	
	public function setSelectList()
	{
		$sportId = $this->getSportId();
		 
		$eventTypesModel = new Model_EventTypesModel();
		$eventTypesModel->addQuery('select',array('table'=>$eventTypesModel->getTableName()));
		
		if(is_numeric($sportId))
		{
			$eventTypesModel->addQuery('where',array('where_condition'=>'sports_id_FK='.$sportId));
		}
		 
		$eventTypesCollection = new Core_Model_Adapter_ModelCollection();
		$eventTypesCollection->getModelCollection($eventTypesModel); 
	 
	    $this->selectList = $eventTypesCollection->toArray();	
	}
	
	public function getSportId()
	{ 
		if(!isset($this->sportId))
		{
			$this->setSportId();
		} 
		return $this->sportId;
	}
	
	public function setSportId($id=null)
	{
		if($id==null)
		{
			if(isset($_GET['sports_id']))
			{
				$this->sportId = (int)$_GET['sports_id'];
			}
			else 
			{
				$this->sportId = null;
			}
		}
		else 
		{
			$this->sportId = $id;
		} 
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