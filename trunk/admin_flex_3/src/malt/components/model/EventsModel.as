/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.model
{
	import malt.core.model.ModelManager;
	
	import mx.collections.ArrayCollection;
 
	
	
	public class EventsModel extends ModelManager  
	{ 
		private var _eventName:String; 
		private var _eventTypeForSave:Array;
		private var _eventTableData:ArrayCollection;  
		private var _eventTableTyesData:ArrayCollection;   
	    private var _eventID:String;
		private var _eventsTypesID:String;
		private var _eventTableTyesUpdate:ArrayCollection;
		private var _eventTypesName:String;
		private var _eventNameUpdate:String;
		private var _eventNameTypeUpdate:String;
		
	    public function EventsModel()
	    {
	    	eventTableTyesUpdate=new ArrayCollection();
	    }
		
		public function set eventNameTypeUpdate(data:String):void
        {
            _eventNameTypeUpdate=data; 
        }
        
        public function get eventNameTypeUpdate():String
        {
        	return _eventNameTypeUpdate;
        }  
		
		public function set eventNameUpdate(data:String):void
        {
            _eventNameUpdate=data; 
        }
        
        public function get eventNameUpdate():String
        {
        	return _eventNameUpdate;
        }  
		
		public function set eventTypesName(data:String):void
        {
            _eventTypesName=data; 
        }
        
        public function get eventTypesName():String
        {
        	return _eventTypesName;
        }  
		 
		public function set eventID(data:String):void
        {
            _eventID=data; 
        }
        
        public function get eventID():String
        {
        	return _eventID;
        }  
		 
		public function set eventTableTyesData(data:ArrayCollection):void
		{
			_eventTableTyesData=data ;
			updateModel("eventTableTyesData") 
		}
		
		public function get eventTableTyesData():ArrayCollection
		{
			return _eventTableTyesData;
	 	}
	 	
	 	public function set eventTableTyesUpdate(data:ArrayCollection):void
		{
			_eventTableTyesUpdate=data ;
			updateModel("eventTableTyesUpdate") 
		}
		
		public function get eventTableTyesUpdate():ArrayCollection
		{
			return _eventTableTyesUpdate;
	 	}
				
		public function set eventsTypesID(data:String):void
		{
			_eventsTypesID=data;
		}
		
		public function get eventsTypesID():String
		{
			return _eventsTypesID;
		}
		 
        public function set eventName(data:String):void
        {
            _eventName=data; 
            updateModel("eventName")
        }
        
        public function get eventName():String
        {
        	return _eventName;
        } 
        
         public function set eventTypeForSave(data:Array):void
        {
            _eventTypeForSave=data; 
        }
        
        public function get eventTypeForSave():Array
        {
        	return _eventTypeForSave;
        } 
        
        public function set eventTableData(data:ArrayCollection):void
        {
            _eventTableData=data; 
        	updateModel("eventTableData") 
        }
        
        public function get eventTableData():ArrayCollection
        {
        	return _eventTableData;
        } 
        
     
	}
}