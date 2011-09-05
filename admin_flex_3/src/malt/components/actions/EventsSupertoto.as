/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */

package malt.components.actions
{
	import malt.components.classes.CheckData;
	import malt.components.service.EventsSupertotoAction; 
	import malt.core.controls.Actions;
 
	import mx.collections.ArrayCollection;
	import mx.controls.Alert;
	import mx.events.CloseEvent;
	import mx.events.ListEvent;
	import mx.rpc.events.ResultEvent;  
	import flash.events.Event;
 	
	public class EventsSupertoto extends Actions
	{
		private var eventArray:ArrayCollection;
		private var _serviceEvents:EventsSupertotoAction;
		public var _tabChangeByTable:Boolean=false; 
		public var _repData:ArrayCollection;
 		public var _repData2:ArrayCollection;
        private var _checkData:CheckData; 
 
        
        public function EventsSupertoto()
        {
        	
        	  _serviceEvents= EventsSupertotoAction.getInstance() ;
	    _checkData=CheckData.getInstance(); 		
        }
        
        public function loadEvents( ):void
        {     
            _serviceEvents.callSelect(resultSelect)
        }
        
        
        
        public function constructComponent():void
 		{  
 		     _repData=new ArrayCollection();
 		     _repData2=new ArrayCollection(); 
 			   loadEvents( )
 	  	}
 	  	
 	  	    	
    	public function setRep2ToComplete():void
    	{
    		_tabChangeByTable=true;
    	}
 	  	 
 	   public function changeEventData(event,data:uint):void
 	   {
 	   	 _repData.getItemAt(data)['name']=event.currentTarget.text;
 	   }
 	  	
 	  	 public function deleteAlertHandler(event:CloseEvent):void
		 {
		 	  if (event.detail==Alert.OK) 
		 	  {
			 	 component.mainTab.selectedIndex=0;
              }
              else
              {
              	
              } 
         } 
 	   
 	   
 	   
 	  	public function updateBetType(data:String,id:uint):void
 	  	{
  
 	  		 _serviceEvents.eventNameUpdate=data;
 	  	     _serviceEvents.eventId=id;
 	  	     _serviceEvents.callUpdate(resultSelect);
 	  	} 
 	   
 	 
 	  	public function resultSelect(event:ResultEvent):void
 	  	{    
 	   
 	  		trace(event.result)
 	  		 _repData=new ArrayCollection();
 		     _repData2=new ArrayCollection();
 		      component.myrep.dataProvider=null;
 		     if(_tabChangeByTable)
 		     {
 		          component.myrep2.dataProvider=null;
 		          component.editing.text="";
 		     }
 	  		 
 	  	    if(_checkData.validation(event.result)) 
	        {
	     
 	  	    component.mainDG.dataProvider=new ArrayCollection(event.result as Array)
 	  	 
 	  	    }
 	  	    else
 	  	    {
 	  	    	  component.mainDG.dataProvider=null
 	  	    }    event.currentTarget.removeEventListener("result",resultSelect);
 	   	}
 	  	
 	  	public function addNewEvent():void
 	  	{ 
 	  		 component.eventHeader.text=component.eventName.text;
 	   	} 
 	  	
 	  	public function addNewData():void
 	  	{ 
 	  		 _repData=new ArrayCollection();
 
 	     
 	  		for(var i:uint=0;i<uint(component.eventType.text);i++)
 	  		{
 	  	    	_repData.addItem({"name":""}); 
	 	    } 
	 	    	  	  component.myrep.dataProvider=_repData;
	 	 
 	  	}
 	  	
 	  	public function addNewDataUpdate():void
 	  	{ 
 	  		_serviceEvents.eventTypesName=component.eventTypeUpdate.text
 	  		_serviceEvents.callInsertTypes(selectEventsTypesRows)
 	  	}
 	  	
 	  
 	  	
 	  	public function saveEventData():void
 	  	{  
 	  		 
 	  		 
 	  			var noviArray:Array=new Array(); 
 	  		
 	  		if(_repData.length==0||_repData.length==1)
 	  		{
 	  			 Alert.show("Bet type must have minumim 2 bet instances")
 	  		}
 	  		
 	  		for(var i:uint=0;i<_repData.length;i++)
 	  		{
 	  			  if(_repData.getItemAt(i)["name"]!="")
		 	  	{
		 	  			
	 	  			 for(var ie:uint=0;ie<_repData.length;ie++)
		 	  		{
		 	  			 
			 	  			if(_repData.getItemAt(i)["name"]== noviArray[ie])
			 	  			{
			 	  				Alert.show("You have 2 or more bet instances with same name.")
			 	  				 return
			 	  			}
			 	  		 
		 	  		} 
		 	  	} 
 	  			 noviArray.push(_repData.getItemAt(i)["name"]) ;
 	  		}
                
               
 
 	  	     _serviceEvents.eventName= component.eventHeader.text 
 	  		 _serviceEvents.eventTypeForSave=noviArray;
 	  	     _serviceEvents.callInsert(loadTableInsertResult) 
 	 
 	  		
 	  		
 	  	}
 	  	
 	    private function loadTableInsertResult(event:ResultEvent):void
		 {      
			 if(_checkData.validation(event.result)) 
	        {
			  component.mainDG.dataProvider=new ArrayCollection(event.result  as Array); 
			 component.eventName.text="";
			 component.eventType.text="";
			 component.eventHeader.text="";
			 _repData.removeAll();
	        } 
			  event.currentTarget.removeEventListener("result",loadTableInsertResult);
		 } 
		
		private function selectEventsTypesRows(event:ResultEvent):void
		{  
		    if(_checkData.validation(event.result)) 
	        {
	         	
			    component.mainTab.selectedIndex=1 ;  
			    component.editing.text= model('Global').eventName ; 
			    _repData2=new ArrayCollection(event.result as Array);
			    component.myrep2.dataProvider=_repData2;
			    model("Global").eventTableType=_repData2;
	        }
	        else
	        {
	        	 if(_checkData.status=="duplicate")
			     {
			        Alert.show("Type exist, add diffrent type");
			        model('Global').sportsHeader="";
			     }  
	        	component.myrep2.dataProvider=_repData2;
	        }
	    	 
		    event.currentTarget.removeEventListener("result",selectEventsTypesRows); 
    	}
		  
 	    public function updateInstance(itemI:uint,textParam):void
 	  	{ 
 	  		 _serviceEvents.eventsTypesId= _repData2.getItemAt(itemI)["eventValueId"]; 
 	  		 _serviceEvents.eventNameTypeUpdate=textParam;  
 	  		 _serviceEvents.callUpdateTypes(selectEventsTypesRows);  
 	  	} 
 	  	
 	  	public function removeInstance(itemI:uint):void
 	  	{ 
 	  		 _serviceEvents.eventsTypesId=_repData2.getItemAt(itemI)["eventValueId"] 
  			 _serviceEvents.callDeleteTypes(selectEventsTypesRows) 
 	    }
 	  	
 	  	public function textChange(event:Event,itemI:uint):void
 	  	{
 	  		_repData.getItemAt(itemI)["name"]=event.currentTarget.text
 	   	}
 	   	
 	   	public function dataGridClickEvent(event:ListEvent):void
 	   	{ 
 	   		 if(event.columnIndex==1)
			 {	 
			 	 component.mainTab.selectedIndex=1;
			 	 model('Global').eventId = event.currentTarget.selectedItem.eventId ; 
		         model('Global').eventName= event.currentTarget.selectedItem.name ;  
		    	 _serviceEvents.eventId = event.currentTarget.selectedItem.eventId ;
		    	 _serviceEvents.callSelectTypes(selectEventsTypesRows); 
			 }
			 else 
			 {
			    component.mainTab.selectedIndex=0;
			 }
	   	}
	   	 
	    public function removeFromCreateEvent(data:uint):void
	    { 
	    	_repData.removeItemAt(data);
	    	component.eventType.text=_repData.length;
	    }
 	   	 
 	   	public function deleteEvent(dataID:uint):void
 	   	{  
 	   		_serviceEvents.eventId=dataID;
 	   		_serviceEvents.callDelete(resultSelect);
 	   	}
 	   	
 	   	public function deleteEventType(data:uint):void
 	   	{   
 	   		if(_repData2.length<3)
 	   		{
 	   			Alert.show(("Bet type must have minimum 2 bet instances"))
 	   		}
 	   		else
 	   		{
 	   			 	 
 	   			 	  _serviceEvents.eventsTypesId=_repData2.getItemAt(data)["eventValueId"];
					 _serviceEvents.callDeleteTypes(selectEventsTypesRows);
 	   		}
 	  
 	   		
 	   	}
 	   
	}
}