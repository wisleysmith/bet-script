/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.serviceActions
{
 
	import mx.rpc.events.ResultEvent;
	import mx.collections.ArrayCollection;
	import malt.components.service.EventService;
	import malt.core.service.Service;
	 
	public class EventsAction extends Service  
	{
		private var _functionHolder:Function;	
		private var _eventService:EventService;
			
		public function EventsAction()
		{
			_eventService=new EventService();
		}
		
	 
	    public function callSelect(func:Function):void
	    { 
	         _functionHolder=func;
	         _eventService.EventsID.selectEventsRows.addEventListener("result",loadDataResult);
	         _eventService.EventsID.selectEventsRows(model('Global').bookhouseId);
	    }
			
		public function callInsert(func:Function):void
		{
			_functionHolder=func;
			_eventService.EventsID.insertEventsRows.addEventListener("result",loadDataResult);
			 var array:Array=new Array(); 
			 array.push([model('EventsModel').eventName,  model('Global').bookhouseId ,model('EventsModel').eventType]);
			 _eventService.EventsID.insertEventsRows(array) 
	 	}
	 	
	 	public function callSelectTypes(func:Function):void
	 	{
	 		_functionHolder=func;
	 		_eventService.EventsID.selectEventsTypesRows.addEventListener("result",loadDataResult);
			var array:Array=new Array(); 
			trace(model('EventsModel').editedEventID)
			array.push([model('EventsModel').editedEventID]);
			_eventService.EventsID.selectEventsTypesRows(array) 
	 	}
	 	
			
		public function callUpdate(func:Function):void
		{
			  _functionHolder=func;
			  _eventService.EventsID.updateSportRows.addEventListener("result",loadDataResult);
			  var array:Array=new Array();
			  array.push([model('SportsModel').textForUpdate, "name",model('Global').bookhouseId,model('SportsModel').EventsID]);
			  _eventService.EventsID.updateSportRows(array );
		}
		
		public function callUpdateLive(func:Function):void
		{
			  _functionHolder=func;
			  _eventService.EventsID.updateSportRows.addEventListener("result",loadDataResult);
			  var array:Array=new Array();
			  array.push([model('SportsModel').newLiveStatus, "live",model('Global').bookhouseId,model('SportsModel').EventsID]);
			  _eventService.EventsID.updateSportRows(array );
		}
		
			
		public function callDelete(func:Function):void
		{   
				 _eventService.EventsID.deleteSportRows.addEventListener("result",loadDataResult);
				 _functionHolder=func;
				 var array:Array=new Array();
				 array.push([model('Global').bookhouseId,model('SportsModel').EventsID]); 
			     _eventService.EventsID.deleteSportRows(array);
		}
		
		private function loadDataResult(event:ResultEvent):void
		{
			var datas=event.currentTarget.name
		    _eventService.EventsID[datas].removeEventListener("result",loadDataResult);
			
			 trace("listener je napravio eviedenciju")
			
		 	if(event.result)
		 	{ 
		 		 trace(String(event.currentTarget.name))
		 		 _functionHolder(event.result);		  
		 	}
	 	 }
	 	 
	}
}