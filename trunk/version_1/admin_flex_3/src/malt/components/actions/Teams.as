/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */

package malt.components.actions
{
	import malt.components.classes.CheckData;
	import malt.components.service.TeamsAction;
	import malt.core.controls.Actions;
	import flash.events.Event;
	import mx.collections.ArrayCollection;
	import mx.controls.Alert;
	import mx.events.CloseEvent;
	import mx.rpc.events.ResultEvent;
 
	public class Teams extends Actions
	{
        private var _serviceTeams:TeamsAction ;
        private var _checkData:CheckData;
        private var _teams:ArrayCollection;
        
        
		public function Teams()
		{
			 _serviceTeams=new TeamsAction();
	    _checkData=CheckData.getInstance(); 		
      	}
     	 
		public function constructComponent():void
 		{ 
 			model('Global').addEventListener("groupHeader",updatesGroupsHeader);
 		    _teams=model('Global').teamsTable;
 		    component.teamsTableData.dataProvider= _teams;
            model('Global').addEventListener("teamsTable",updatesTeamsTable); 
  			component.groupsHeader.title="Sport: "+model('Global').sportsHeader+" -- Group: "+model('Global').groupHeader;       
  	    }
       	
        
 	  
		private function updatesGroupsHeader(event:Event):void
		{ 
			 component.groupsHeader.title="Sport: "+model('Global').sportsHeader+" -- Group: "+model('Global').groupHeader;
		}	 
			 
		public function updateTeam(data:String, idTeam:uint):void
		{ 
		   _serviceTeams.textForUpdate=data;
		   _serviceTeams.teamsId=idTeam; 
		   _serviceTeams.callUpdate(loadTableResult); 
		 }
	
 		private function updatesTeamsTable(event:Event ):void
 		{
 		   _teams=model('Global').teamsTable;;
 		   component.teamsTableData.dataProvider=model('Global').teamsTable; 
 		} 
		 
	   
		 
		 public function addNew():void
		 { 	  
            if(  _serviceTeams.groupsInstanceId==0)
		    {
		    	Alert.show("Please select group");
		    	return
		    }
	 
		    _serviceTeams.newSportText = component.addNewTI.text;
		     _serviceTeams.callInsert(loadTableResult);
         }
		 
		 private function loadTableResult(event:ResultEvent):void
		 {   
		  
		 	if(_checkData.validation(event.result)) 
	        {
	        	_teams=new ArrayCollection(event.result as Array);
	          	component.teamsTableData.dataProvider=_teams;
	        }
	        else
	        {
	           if(_checkData.status=="grouperror")
	           {
	           		Alert.show("Group for this team does no exist");
	           		 model('Global').teamsTable=null
	           } 
	          
	            if(_checkData.status=="duplicate")
			    {
			      Alert.show("Team exist, please add diffrent sport");
			      model('Global').sportsHeader="";
			    }  
	            
	        }
		       
		    event.currentTarget.removeEventListener("result",loadTableResult);
		 }
		  
		
				
		 public function deleteSport(data:uint):void
		 { 
		   _serviceTeams.teamsId=data;
		   _serviceTeams.callDelete(loadTableResult);
		 }		
		 
		 public function deleteAlertHandler(event:CloseEvent):void
		 {
		 	  if (event.detail==Alert.OK) 
		 	  {
		 	 	_serviceTeams.callDelete(loadTableResult);
              }
              else
              {
              	
              } 
         }
    
        
	}
}