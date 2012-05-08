/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */

package malt.components.actions
{
	import malt.components.classes.CheckData;
	import malt.components.service.GroupsAction;
	import malt.components.service.SportsAction;
	import malt.components.service.TeamsAction;
	import malt.core.controls.Actions;
	import flash.events.Event;
	import mx.collections.ArrayCollection;
	import mx.controls.Alert;
	import mx.events.CloseEvent;
	import mx.events.ListEvent;
	import mx.rpc.events.ResultEvent;
   
	
	public class Groups extends Actions
	{
        private var _serviceGroup:GroupsAction ;
        private var _serviceTeam:TeamsAction;
        private var _checkData:CheckData;
    	private var _groupsData:ArrayCollection;
    	private var _service:SportsAction;
    	
    	public var _sportData:ArrayCollection;
		 
		public function Groups()
		{
			 _serviceGroup= GroupsAction.getInstance(); 
			 _serviceTeam=new TeamsAction(); 
	    _checkData=CheckData.getInstance(); 		
		      _service=SportsAction.getInstance( ); 
       	}
		
		public function constructComponent():void
 		{ 
  
 		    component.groupsTableDG.dataProvider=model('Global').sportsHeader;
            model('Global').addEventListener("sportsHeader",updatesSportHeader); 
            model('Global').addEventListener("groupsTable",groupsTableHandler); 
           
       
       	}
 	  	
 	  	private function groupsTableHandler(event:Event):void
 		{  
 		  _groupsData=model('Global').groupsTable;
 		   component.groupsTableDG.dataProvider= _groupsData;
 		} 
		 
 	   
		private function updatesSportHeader(event:Event):void
		{ 
		 	component.sportsHeader.title="Sport: "+model('Global').sportsHeader
		}	 
			 
		public function updateGroup(data:String, idGroups:uint):void
		{  
			 _serviceGroup.textForUpdate=data; 
			 _serviceGroup.groupsId=idGroups;
	 
		     _serviceGroup.callUpdate(loadDataResult); 
		}
		
	 
        
 	 
		 
	    public function cancelUpdateSport():void
		{
	 
		 }
		 
		 public function addNew():void
		 { 	   
		 
		    if(_serviceGroup.sportId==0)
		    {
		    	Alert.show("Please select sport");
		    	return
		    }
		     _serviceGroup.newGroupText = component.addNewTI.text
		     _serviceGroup.callInsert(loadDataResult);
		  
         }
		 
		  
		 private function loadDataResult(event:ResultEvent):void
		 { 
		 
		    if(_checkData.validation(event.result)) 
	        {
	        	var array=event.result as Array;
				_groupsData=new ArrayCollection(_checkData.message[0]);
				component.groupsTableDG.dataProvider=_groupsData;
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
	 	    		Alert.show("Sport does not exist")
	 	    	}
				
				
	 	    }
	 	    else
	 	    {
	 	  
	 	    	 _groupsData=new ArrayCollection(_checkData.message[0]);
	
				 model('Global').sportsTable=new ArrayCollection(_checkData.message[2]); 
				 component.groupsTableDG.dataProvider=_groupsData
	 	    	  
			 	     if(_checkData.status=="duplicate")
			       	  {
			       	  	Alert.show("Group exist, please add diffrent sport");
			       	  	   model('Global').sportsHeader="";
			       	  }  
	 	    }
	 	      
	 	    
	 	    
	 	    	    	event.currentTarget.removeEventListener("result",loadDataResult);
		 }
 	  	 
		 
		 public function deleteSport(data:uint):void
		 { 
		  
		 	  _serviceGroup.groupsId=data;
		 	  var mess:String="If you proceed you will delete all data under this group.";
		 	  Alert.show(mess,"",Alert.OK|Alert.CANCEL,component.groupsTableDG,deleteAlertHandler);
		 }	
		  
		 
		 public function getEditedSportRowIndex(event:ListEvent):void
 	  	{
 	  		 
 	  		if(event.columnIndex==2 )
 	  		{   
 	  			 _serviceGroup.groupsId=event.currentTarget.selectedItem.idGroups; 
 	  			 model('Global').groupHeader=event.currentTarget.selectedItem.name; 
 	  			 _serviceTeam.callSelect(getTeamData);
 	  			
 	  		}
 	  	
 	  	}
		
		public function getTeamData(event:ResultEvent):void
		{
			 if(_checkData.validation(event.result)) 
	        {
	        	   model('Global').groupsTable=new ArrayCollection(_checkData.message[2])
			       
			         var testGroup:uint=0;
	 	    	 for(var i:uint=0;i<model('Global').groupsTable.length;i++)
	 	    	 {
	 	    	 	 if(model('Global').groupsTable.getItemAt(i)['idGroups']==_serviceGroup.groupsId)
		 	    	 {
		 	    	 	testGroup= 1
		 	    	 	break
		 	    	 } 
	 	    	 }
	 	    	
	 	    	if(testGroup==0)
	 	    	{
	 	    	  Alert.show("Group does not exist")
	 	    	  _serviceGroup.callSelect(loadDataResult)
	 	    	
	 	     	}
	 	    	else
	 	    	{
	 	            model('Global').teamsTable=new ArrayCollection(_checkData.message[0]); 
	 	    	}
	 	     
			       
	 	    }
	 	    else
	 	    {
	 	  
	 	    	  model('Global').groupsTable=new ArrayCollection(_checkData.message[2]) 
	 	    }
	 	      
			event.currentTarget.removeEventListener("result",getTeamData);
	
		}
		
/*	    private function getGroupData(event:ResultEvent):void
 	  	{
 	  		 if(_checkData.validation(event.result)) 
	         {
				 	model('Global').groupsTable=new ArrayCollection(event.result  as Array);
	 	     }
 	  	
 	  	    event.currentTarget.removeEventListener("result",getGroupData);
 	  	}
*/
		 public function deleteAlertHandler(event:CloseEvent):void
		 {
		 	  if (event.detail==Alert.OK) 
		 	  {
		 	 	_serviceGroup.callDelete(loadDataResult);
              }
              else
              {
              	
              } 
         }
         
       	   
	}
}