<?php
class View_Admin_Widgets_GroupsSelect extends  Extension_Core_View_Yui_Template
{   
	private $select;
	private $sportId = null;
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
		$sportId = $this->getSportId(); 
		  
		$groupsModel = new Model_GroupsModel();
		$groupsModel->addQuery('select',array('table'=>$groupsModel->getTableName()));
		if(is_numeric($sportId))
		{
			$groupsModel->addQuery('where',array('where_condition'=>'sports_id_FK='.$sportId));
		}
		
		$groupsCollection = new Core_Model_Adapter_ModelCollection();
		$groupsCollectionData = $groupsCollection->getModelCollection($groupsModel);
	 
		$select = new Extension_View_Html_Form_Elements_Select();
		$select->setModel($groupsCollection->toArray());
	  	$select->setAttribute('name','groups_id');
	  	$select->setAttribute('id',$select->getId());
	  	$select->setOptionLabelKey('name_of_group');
	  	$select->setOptionValueKey('groups_id');   
	    $this->select = $select;	
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
}