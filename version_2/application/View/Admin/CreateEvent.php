<?php
class View_Admin_CreateEvent extends Core_View_Layout_Template
{  
	private $groupSelectHtml;
	private $sportSelectHtml;
	private $calendars; 
	
	public function getGroupSelectHtml()
	{ 
		$groupsModel = new Model_GroupsModel();
		$groupsModel->addQuery('select',array('table'=>$groupsModel->getTableName()));
		$groupsCollection = new Core_Model_Adapter_ModelCollection();
		$groupsCollectionData = $groupsCollection->getModelCollection($groupsModel);
		  
		$select = new Extension_View_Html_Form_Elements_Select();
		$select->setModel($groupsCollection->toArray());
	  	$select->setAttribute('name','groups_id_FK');
	  	$select->setOptionLabelKey('name_of_group');
	  	$select->setOptionValueKey('groups_id'); 
	  	    
	  	return $select;
   	} 
	  
   	public function getCalendarClock($element)
   	{
   		if(isset($this->calendars[$element] ))
   		{
   			return $this->calendars[$element] ;
   		}
   		
   		$calendar = new Extension_View_Html_Form_Elements_CalendarClock(); 
   		
   		$calendar->getHours()->setAttribute('name', 'hours_'.$element); 
   		$calendar->getMinutes()->setAttribute('name', 'minutes_'.$element);
   		$calendar->getCalendar()->setAttribute('name', $element);
   		
   		$calendar->getHours()->setAttribute('id', 'hours_'.$element); 
   		$calendar->getMinutes()->setAttribute('id', 'minutes_'.$element);
   		$calendar->getCalendar()->setAttribute('id', $element);
   		
   		return $this->calendars[$element] =$calendar;
   	} 
    
   	
   	public function setSportSelectHtml()
   	{
   		$sportsModel = new Model_SportsModel();
		$sportsModel->addQuery('select',array('table'=>$sportsModel->getTableName()));
		$sportsCollection = new Core_Model_Adapter_ModelCollection();
		$sportsCollectionData = $sportsCollection->getModelCollection($sportsModel); 
		  
		$select = new Extension_View_Html_Form_Elements_Select();
		$select->setModel($sportsCollection->toArray());
	  	$select->setAttribute('name','sports_id_FK');
	  	$select->setOptionLabelKey('name_of_sport');
	  	$select->setOptionValueKey('sports_id');
	  	//bets_id bet_name groups_id_FK add_date end_date bet_active
	  	$select->setAttribute('id','sport_select');
	  	return $this->sportSelectHtml = $select; 
   	} 
   	
   	public function getSportSelectHtml()
   	{
   		if(!isset($this->sportSelectHtml))
   		{
   			$this->setSportSelectHtml();
   		} 
   		return $this->sportSelectHtml;
   	}
}