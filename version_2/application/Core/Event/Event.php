<?php 

abstract class Core_Event_Dispatcher
{
	public function dispatchEvent($eventName,$params=array())
	{
		if(isset($this->eventListners[$eventName]))
		{
			foreach($this->eventListners[$eventName] as $e)
			{
				$e['event']['currentTarget']['instance']=$this;
				$e['event']['currentTarget']['params']=$params; 
				if(method_exists($e['object'], $e['method']))
				{
					$e['object']->$e['method']($e['event']);
				}
			}
		}
	}
	
	public function addEventListener($eventToListen,$object,$method,$params=array())
	{
		$this->eventListners[$eventToListen][] = array('object'=>$object,'method'=>$method,'event'=>array('listener'=>$params));
	} 
}

?>