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
	import malt.core.controls.Actions;
	
	import mx.collections.ArrayCollection;
	import mx.controls.Alert;
	import mx.events.CloseEvent;
	import mx.events.ListEvent;
	import mx.rpc.events.ResultEvent;
	
	public class Sports  extends Actions
	{
		private var _service:SportsAction;
		private var _serviceGroups:GroupsAction;
		private var _checkData:CheckData; 
		private var _sportData:ArrayCollection;
		
		public function constructComponent():void
 		{ 
 		   _service= SportsAction.getInstance( );  
 		   model('Global').addEventListener('sportsTable',updateSportTable)
 		   _serviceGroups=GroupsAction.getInstance(); 
		    callSelectSport( );
	      _checkData=CheckData.getInstance(); 		

 		  component.sportTableDG.dataProvider=model('Global').sportsTable;

     	} 
     	
     	public function updateSportTable(event):void
     	{ 
	       component.sportTableDG.dataProvider=model('Global').sportsTable;
     	}
 	  	
 	  	public function callSelectSport( )  		
 	  	{
 	  		  _service.callSelect(onlySelect);
 	  	}
 	  	
 	  
 	  	
 	  	public function addNewSport():void
 	  	{
 	  		_service.newSportText=component.sportsNameTI.text
 	  		_service.callInsert(loadDataResult)
 	  	}
 	  	
 	 
 	   private function onlySelect(event:ResultEvent ):void
		{ 
      
		    resetGroups()
			model('Global').sportsHeader="";
			model('Global').groupsTable=new ArrayCollection( );
		   if(_checkData.validation(event.result)) 
	       {
	       	   model('Global').sportsTable =new ArrayCollection(event.result as Array); 
		  
	       }
	      event.currentTarget.removeEventListener("result", onlySelect);
 	    
		}
 	  	
 	  	public function resetGroups():void
 	  	{
 	  		_service.sportId=0
			model('Global').sportsHeader="";
		   model('Global').groupsTable=new ArrayCollection( );
 	  	}
 	  	
 	  	
 	  	private function loadDataResult(event:ResultEvent ):void
		{ 
 
			resetGroups()
		   if(_checkData.validation(event.result)) 
	       {
	       	   model('Global').sportsTable =new ArrayCollection(_checkData.message[0]);  
	       }
	       else
	       {
	       	  if(_checkData.status=="duplicate")
	       	  {
	       	  	Alert.show("Sport exist, please add diffrent sport")
	       	  	   model('Global').sportsTable =new ArrayCollection(_checkData.message[0]); 
	       	  }
	       	  else if(_checkData.status=="constrain")
	       	  {
	       	  	Alert.show("You cant delete sports that have bet events")
	       	  	   model('Global').sportsTable =new ArrayCollection(_checkData.message[0]); 
	       	  }  
	    
	       	 	
	       }
	     	event.currentTarget.removeEventListener("result", loadDataResult);
		}
 	  	
 	  	public function getEditedSportRowIndex(event:ListEvent):void
 	  	{
 	  		if(event.columnIndex==2 )
 	  		{ 
 	  			 
 	  			  _service.sportId=event.currentTarget.selectedItem.idTable;
 	  			  model('Global').sportsHeader=event.currentTarget.selectedItem.name;
 	  			 _serviceGroups.callSelect(getGroupData);
 	  		}
 	  	}
 	  	
 	  	private function getGroupData(event:ResultEvent):void
 	  	{
 	  	   if(_checkData.validation(event.result)) 
	       {
 	  	   	  model('Global').groupsTable=new ArrayCollection(_checkData.message[0]);
 	  	   	   model('Global').sportsTable=new ArrayCollection(_checkData.message[2]); 
 	  	   }	event.currentTarget.removeEventListener("result",getGroupData);
 	  	}
 	  	
  
 	  	public function deleteSport(data ):void
 	  	{
 	  		_service.sportId=data;
		    var mess:String="If you proceed you will delete all data under this sport.";
		 	Alert.show(mess,"",Alert.OK|Alert.CANCEL,component.sportTableDG,deleteAlertHandler); 
 	  	}
 	  	
 	  	 public function deleteAlertHandler(event:CloseEvent):void
		 {
		 	  if (event.detail==Alert.OK) 
		 	  {
			 	  _service.callDelete(loadDataResult);
              }
              else
              {
              	
              } 
         }
 	  	
 	  	public function updateSport(sportUpdateTI,idTable):void
 	  	{
 	  		 _service.textForUpdate=sportUpdateTI ;
 	  		 _service.sportId=idTable;
 	  		_service.callUpdate(loadDataResult)
 	  	}
 	   
        
 	  
 	}
}