/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.service
{
   
    import malt.core.service.Service;
	 
	public class EventsSupertotoAction  extends EventService
	{  
		public var eventId:uint;	
		public  var eventNameUpdate:String;
		public  var eventNameTypeUpdate:String;
		public  var eventsTypesId:uint;	 
		public  var eventTypesName:String;
	    public  var eventTypeForSave:Array;
	    public var eventName:String; 
			
	 private static var _instance:EventsSupertotoAction;
	 
	 public function EventsSupertotoAction(pvt:PrivateClass)
		
		public static function getInstance( ):EventsSupertotoAction
		{
			if(EventsSupertotoAction._instance == null)
			{
				EventsSupertotoAction._instance=new EventsSupertotoAction(new PrivateClass( ));
			}
		 
			return 	EventsSupertotoAction._instance;
		}
		
		public function callUpdate(func:Function):void
	    { 
	         EventsID.updateEventsRowsSupertoto.addEventListener("result",func);
	         EventsID.updateEventsRowsSupertoto(eventNameUpdate , eventId );
	    }
	    
 
	    public function callUpdateTypes(func:Function):void
	    {   
	        EventsID.updateEventsTypesRowsSupertoto.addEventListener("result",func);
	        EventsID.updateEventsTypesRowsSupertoto(eventNameTypeUpdate,eventsTypesId);
	    }
	 
	    public function callSelect(func:Function):void
	    {  
	 
	         EventsID.selectEventsRowsSupertoto.addEventListener("result",func);
	         EventsID.selectEventsRowsSupertoto();
	    }
			
		public function callInsert(func:Function):void
		{
            EventsID.insertEventsRowsSupertoto.addEventListener("result",func);
		    EventsID.insertEventsRowsSupertoto(eventName,   eventTypeForSave ) 
	 	}
	 	
	 	public function callInsertTypes(func:Function):void
	 	{
	         EventsID.insertEventsTypeRowsSupertoto.addEventListener("result",func);
			 EventsID.insertEventsTypeRowsSupertoto(eventTypesName, eventId ) 
	 	}
	 	
	 	public function callSelectTypes(func:Function):void
	 	{  
	 	    EventsID.selectEventsTypesRowsSupertoto.addEventListener("result",func);
			EventsID.selectEventsTypesRowsSupertoto(eventId)   
	 	}
	 	
			
		 
		public function callDeleteTypes(func:Function):void
		{    
			 EventsID.deleteEventTypeSupertoto.addEventListener("result",func);
			  EventsID.deleteEventTypeSupertoto(eventsTypesId);
		}
		
			
		public function callDelete(func:Function):void
		{   
				 EventsID.deleteEventsRowsSupertoto.addEventListener("result",func);
		         EventsID.deleteEventsRowsSupertoto(eventId );
		} 
	 	 
	}
}

class PrivateClass
{
	public function PrivateClass( )
	{ 
	}
}