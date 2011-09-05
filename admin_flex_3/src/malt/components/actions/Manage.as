/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */

package malt.components.actions
{ 
	import malt.components.classes.CheckData;
	import malt.components.service.EventsAction;
	import malt.components.service.GroupsAction;
	import malt.core.controls.Actions;
	import malt.components.service.SportsAction;
	
	import mx.collections.ArrayCollection;
	import mx.rpc.events.ResultEvent;

	public class Manage extends Actions
	{
		 private var _serviceGroup= GroupsAction.getInstance(); 
		  private var _serviceSport= SportsAction.getInstance(); 
	    private var  _checkData=CheckData.getInstance(); 		
	     private var _serviceEvents:EventsAction = EventsAction.getInstance(); 
	     private var _eventCreated:Boolean=false;
	     
	    public function constructComponent():void
 		{ 
 			model('Global').addEventListener("teamsTable",changeToTeam);
 		    component.accordMain.getHeaderAt(1).enabled=false;    
  	  	} 
  	  	
 		public function changeToTeam(event):void
  	  	{  
 		     if(model('Global').teamsTable==null)
 		     {
 		     	 component.accordMain.selectedIndex=0;
 		     	 _serviceGroup.callSelect(resultGroupsAndSports)
 		     }
 		     else
 		     {
 		     		     component.accordMain.selectedIndex=1;
 		     }
 	
 	  	}  
 	  	
 	  	public function changeMainAccordian():void
 	  	{
 	  		if(component.accordMain.selectedIndex==0)
 	  		{
 	  			_serviceGroup.callSelect(resultGroupsAndSports)
 	  		}
 	  		else if (component.accordMain.selectedIndex==2)
 	  		{
 	  				if( _eventCreated) 
 	  				{
 	  					_serviceSport.callSelect(resultSelectEvent);
 	  				}
 	  				else
 	  				{
 	  					_eventCreated=true
 	  				} 
 	  		}
 	  	}
 	  	
 	  	public function resultSelectEvent(event):void
 	  	{ 
 	  		 if(_checkData.validation(event.result)) 
	        { 
 	  	  
 	          component.events.eventSportCombo.dataProvider=new ArrayCollection(event.result as Array); 
		   
 	  	  	  component.events.mainDG.dataProvider=	new ArrayCollection( )
 	  	  	  component.events.mainTab.selectedIndex=0;
 	  	  	  component.events.call._repData=new ArrayCollection(); 
 		      component.events.myrep.dataProvider=null;
 		   
 		     
 		      
 		       if(component.events.call._tabChangeByTable)
	 		   {
	 		      component.events.call.myrep2.dataProvider=null;
	 		      component.events.editing.text="";
	 		   }
 	  		 
 	  	     } 
 	  		  event.currentTarget.removeEventListener("result", resultSelectEvent);
 	  	}
 	  	
 	  	public function resultGroupsAndSports(event:ResultEvent):void
 	  	{
 	  		 if(_checkData.validation(event.result)) 
	        {
	        	 
				model('Global').groupsTable=new ArrayCollection(_checkData.message[0]);
				model('Global').sportsTable=new ArrayCollection(_checkData.message[2]); 
				
				  var testGroup:uint=0;
	 	    	 for(var i:uint=0;i<model('Global').sportsTable.length;i++)
	 	    	 {
	 	    	 	 if(model('Global').sportsTable.getItemAt(i)['idTable']==_serviceGroup.sportId)
		 	    	 {
		 	    	 	testGroup= 1
		 	    	 	break
		 	    	 } 
	 	    	 }
	 	    	
	 	    	if(testGroup==0)
	 	    	{
	 	    		model('Global').sportsHeader="";
	 	    		_serviceGroup.sportId=0;
	 	    		_serviceGroup.groupsId=0;
 
	 	    	}
				
				
	 	    }
	 	    else
	 	    {
	 	  
	 	 		model('Global').groupsTable=new ArrayCollection(_checkData.message[0]);
	        	 model('Global').sportsTable=new ArrayCollection(_checkData.message[2]);  
	 	    	  
			    
	 	    }
 	  	}
	}	
}