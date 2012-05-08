<?php
class View_Frontend_Offer extends  Extension_Core_View_Yui_Template
{    
	private $eventListWidget;
	private $betsAvailable; 
	private $offersTableHolder = array();
	
	public function __construct()
	{ 
		$this->teamsTableWithPanel = new Extension_View_Yui35_DataTableEdit();
		$this->setWidgetDependencies('recordset-base');
		$this->setWidgetDependencies('cookie');
		$this->setWidgetDependencies('json');
	}  
	
	public function getEventListWidget()
	{
		if(!isset($this->eventListWidget))
		{
			$this->setEventListWidget();
		}
		return $this->eventListWidget;
	}
	
	public function setEventListWidget()
	{
		$list = new View_Frontend_Widgets_EventTypesList();
		$sportId = $this->getSportId();
		if(!isset($sportId))
		{
			$groupsId = $this->getGroupId();
			if(isset($groupsId))
			{
				$groupModel = new Model_GroupsModel();
				$groupModel->load($groupsId);
				$sportId = $groupModel->getData('sports_id_FK');
				$list->setGroupId($groupModel->getGroupsId());
				if($sportId)
				{
					$list->setSportId($sportId);
				}
			}
		}
		$this->eventListWidget = $list;
	}
	
	public function getOfferList()
	{ 
		if(isset($this->offersTableHolder))
		{
			$this->setOfferList();
		}
		return $this->offersTableHolder;
	}
	
	public function setOfferList()
	{
		$list = $this->getEventListWidget()->getSelectList();
		if(!is_array($list))
		{
			return;
		}
		
		$eventTypesId = $this->getEventTypesId();
		 
		foreach($list as $l)
		{
			if(isset($eventTypesId))
			{
				if($l['event_types_id']!=$eventTypesId)
				{
					continue;
				}
			}
			
			$offerTable = new View_Frontend_Widgets_OfferTableEvents();
			$offerTable->setEventTypesId($l['event_types_id']);
			$groupId = $this->getGroupId();
			if($groupId)
			{
				$offerTable->setGroupId($this->getGroupId());
			}
			$this->offersTableHolder[] = $offerTable;
		}
		return $this->offersTableHolder;
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