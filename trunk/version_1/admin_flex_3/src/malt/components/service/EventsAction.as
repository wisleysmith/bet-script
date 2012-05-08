/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.service
{
   
    import malt.core.service.Service;
	 
	public class EventsAction  extends EventService
	{  
		public var eventId:uint;	
		public  var eventNameUpdate:String;
		public  var eventNameTypeUpdate:String;
		public  var eventsTypesId:uint;	
		public  var sportId:uint;	
		public  var eventTypesName:String;
	    public  var eventTypeForSave:Array;
	    public var eventName:String; 
			
	 private static var _instance:EventsAction;
	 
	 public function EventsAction(pvt:PrivateClass)
		
		public static function getInstance( ):EventsAction
		{
			if(EventsAction._instance == null)
			{
				EventsAction._instance=new EventsAction(new PrivateClass( ));
			}
		 
			return 	EventsAction._instance;
		}
		
		public function callUpdate(func:Function):void
	    { 
	         EventsID.updateEventsRows.addEventListener("result",func);
	         EventsID.updateEventsRows(eventNameUpdate , eventId , sportId);
	    }
	    
 
	    public function callUpdateTypes(func:Function):void
	    {   
	        EventsID.updateEventsTypesRows.addEventListener("result",func);
	        EventsID.updateEventsTypesRows(eventNameTypeUpdate,eventsTypesId);
	    }
	 
	    public function callSelect(func:Function):void
	    {  
	 
	         EventsID.selectEventsRows.addEventListener("result",func);
	         EventsID.selectEventsRows(sportId);
	    }
			
		public function callInsert(func:Function):void
		{
            EventsID.insertEventsRows.addEventListener("result",func);
		    EventsID.insertEventsRows(eventName, sportId , eventTypeForSave ) 
	 	}
	 	
	 	public function callInsertTypes(func:Function):void
	 	{
	         EventsID.insertEventsTypeRows.addEventListener("result",func);
			 EventsID.insertEventsTypeRows(eventTypesName, eventId ) 
	 	}
	 	
	 	public function callSelectTypes(func:Function):void
	 	{  
	 	    EventsID.selectEventsTypesRows.addEventListener("result",func);
			EventsID.selectEventsTypesRows(eventId)   
	 	}
	 	
			
		 
		public function callDeleteTypes(func:Function):void
		{    
			 EventsID.deleteEventType.addEventListener("result",func);
			  EventsID.deleteEventType(eventsTypesId);
		}
		
			
		public function callDelete(func:Function):void
		{   
				 EventsID.deleteEventsRows.addEventListener("result",func);
		         EventsID.deleteEventsRows(eventId, sportId);
		} 
	 	 
	}
}

class PrivateClass
{
	public function PrivateClass( )
	{ 
	}
}