<?php
class View_Admin_Offer extends Core_View_Layout_Template
{  
	private $eventListWidget;
	private $betsAvailable; 
	private $offersTableHolder = array();
	 
	
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
		$list = new View_Admin_Widgets_EventTypesList();
		$sportId = $this->getSportId();
		if(!isset($sportId))
		{
			$groupsId = $this->getGroupId();
			if(isset($groupsId))
			{
				$groupModel = new Model_GroupsModel();
				$groupModel->load($groupsId);
				$sportId = $groupModel->getData('sports_id_FK');
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
			$offerTableEdit = new View_Admin_Widgets_OfferTableEvents();
			$offerTableEdit->setEventTypesId($l['event_types_id']);
			$this->setPanelOptions($offerTableEdit->getOfferTable()->getPanel());
			$groupId = $this->getGroupId();
			 
			if($groupId)
			{
				$offerTableEdit->setGroupId($this->getGroupId());
			}
			$this->offersTableHolder[] = $offerTableEdit;
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