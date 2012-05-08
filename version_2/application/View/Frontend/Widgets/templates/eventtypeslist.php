<?php 

$url = Application::getRouter()->getUrl(array('controller'=>'servicehtml','action'=>'view',array('params'=>'&view=View_Frontend_Offer')));
$selectList = $this->getSelectList();
$eventTypesIdSelected = $this->getEventTypesId();
if(!empty($selectList))
{
	foreach ($this->getSelectList() as $s)
	{  
		if($eventTypesIdSelected==$s['event_types_id'])
		{
			$className = 'selectedEventTypes';
		}
		else 
		{
			$className = '';
		}
	?> 
		<a style="padding:10px"  class="systemServiceLink <?php echo $className;?>"  href="javascript:void(0);" class="eventTypesLink" servicehtml="<?php echo $url ?>&view=View_Frontend_Offer&event_types_id=<?php echo $s['event_types_id'] ?>&groups_id=<?php echo $this->getGroupId()?>" ><?php echo $s['event_types_name']?> </a>
	<?php 
	}
} 
?> 
 