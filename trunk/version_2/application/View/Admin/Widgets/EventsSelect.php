<?php
class View_Admin_Widgets_EventsSelect extends  Extension_Core_View_Yui_Template
{   
	private $select;
	private $groupId = null;
	public function getSelectElement()
	{ 
		if(!isset($this->select))
		{
			$this->setSelectElement();
		}
		return $this->select;
	}
	
	public function setSelectElement()
	{
		$groupsId = $this->getGroupId();
		 
		$betsModel = new Model_BetsModel();
		$betsModel->addQuery('select',array('table'=>$betsModel->getTableName()));
		
		if(is_numeric($groupsId))
		{
			$betsModel->addQuery('where',array('where_condition'=>'groups_id_FK='.$groupsId));
		}
		 
		$betsCollection = new Core_Model_Adapter_ModelCollection();
		$betsCollectionData = $betsCollection->getModelCollection($betsModel);
	  
		$select = new Extension_View_Html_Form_Elements_Select();
		$select->setModel($betsCollection->toArray());
	  	$select->setAttribute('name','bets_id');
	  	$select->setAttribute('id',$select->getId());
	  	$select->setOptionLabelKey('bet_name');
	  	$select->setOptionValueKey('bets_id');   
	    $this->select = $select;	
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
}