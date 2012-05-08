/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */

package malt.components.actions
{ 
	import malt.components.classes.CheckData;
	import malt.components.controls.EditSupertoto;
	import malt.components.controls.ItemRendererSupertoto;
	import malt.components.service.BetsAction;
	import malt.components.service.EventsSupertotoAction;
	import malt.components.service.SupertotoAction;
	import malt.components.service.TeamsAction;
	import malt.core.controls.Actions;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import mx.collections.ArrayCollection;
	import mx.controls.Alert;
	import mx.controls.TextInput;
	import mx.events.DragEvent;
	import mx.events.ListEvent;
	import mx.managers.DragManager;
	import mx.managers.PopUpManager;
	import mx.rpc.events.ResultEvent;

 
	public class SuperToto extends Actions
	{
		private var _itemEditor:ItemRendererSupertoto;
		private var _supertotoService:SupertotoAction;
		private var  _setData:ArrayCollection;
		private var _serviceTeam:TeamsAction;
		private var _serviceBets:BetsAction;  	
	    private var _sportAndGroup:ArrayCollection; 
	    private var _eventDataAC:ArrayCollection;
	    private var _teamName:String;
	    private var _teamId:uint;
	    [Bindable]
	    public var dataEventHolderType:ArrayCollection;
	    private var holderOfData:Array=new Array() ;
	    		private var _serviceEvents:EventsSupertotoAction;
               private var _checkData:CheckData;
               private var  lenOfRep:uint;


	   public function dragIt(event:MouseEvent ):void 
       {
		     _teamName=event.currentTarget.selectedItem.name;
              _teamId=event.currentTarget.selectedItem.idTeams;
       }
       
       	  public function resultEventData(event:ResultEvent):void
		  {
		  	component.eventCB.dataProvider=new ArrayCollection(event.result as Array) 
		  	event.currentTarget.removeEventListener("result",resultEventData);
		  }
       
		public function constructComponent():void
 		{  
 			              _serviceEvents=EventsSupertotoAction.getInstance();
 		 	     _serviceBets=new BetsAction(); 
 	  	       _checkData=CheckData.getInstance(); 		
 
 			_supertotoService=new SupertotoAction();
 		    _itemEditor=new ItemRendererSupertoto();
 	    //      _supertotoService.callSelectSupertoto(updateMainTable);
 		      _serviceTeam=new TeamsAction();  
 	 	} 
 	 	
 	 	public function superbetsComplete():void
 	 	{
 	 		   _serviceEvents.callSelect(resultEventData)   
 	 	}
 
  	  	  public function typebetCBClose(event:Event):void
		  { 
		      _serviceEvents.eventId= event.currentTarget.selectedItem.eventId; 
		  	  _serviceEvents.callSelectTypes(selectEventsTypesRows); 
		  }
		  
	
	
  	  	
  	  	private function updateMainTable(event):void
  	  	{
  	  	  //   component.dataSupertoto=new ArrayCollection(event as Array); 
  	  	     	   
  	  	}
  	   
  	   public function eventCBComplete():void
  	   {
  	     	component.comEvent.dataProvider= _eventDataAC;
  	   }
		
 	  	public function completeSportCBBet():void
 	  	{
 	  		 _serviceBets.callSetDataForBet(resultMainSelect);
 	  	}
 	  	
 	  	private function resultMainSelect(event:ResultEvent):void
		{  
		 
			 if(_checkData.validation(event.result)) 
	    	 {
							 
					 
					   	   var jok:Array=event.result as Array ; 
					  
			 	  	  		var groups:Array=jok[1] ; 
							var sports:Array= jok[0] ;  
					    	_sportAndGroup =new ArrayCollection();  
					     
				 
					    for(var i:uint=0;i<sports.length;i++)
					    {	
					        var groupsAC:ArrayCollection=new ArrayCollection();
					        var editGroupsAC:ArrayCollection=new ArrayCollection();
					        for(var ie:uint=0;ie<groups.length;ie++)
					   		{
					   		
					   			if(groups[ie][0]==sports[i][1])
					   			{
					   	        	groupsAC.addItem({"name":groups[ie][2],"groupsId":groups[ie][1]});
					   			}
					   	 	}
					   	 	 
					    	_sportAndGroup.addItem({"name":sports[i][0],"sportId":sports[i][1],"children":groupsAC});
					    	
					    } 
					     
					    if(component.sportCBBet!=null)
			 	  	    {
			 	  		  component.sportCBBet.dataProvider=_sportAndGroup;
			 	  	    }
					  
					   
				 
					       
					    
	    	 }event.currentTarget.removeEventListener("result",resultMainSelect);
		}
		
		 public function callEvents():void
	  {
	  		if(component.groupsCBBet.selectedItem==null)
 	  		{
 	  			Alert.show("Please select group");
 	  		}
 	  		else
 	  		{
		  	  _serviceBets.groupsId=component.groupsCBBet.selectedItem.groupsId;
		  	  _serviceBets.callSetBetBasicService(resultBetEvents);
		  	 }
	  }
	  
	    public function resultBetEvents(event:ResultEvent):void
	  {
	  	component.eventDG.dataProvider=new ArrayCollection(event.result as Array) ;
	  }
	  
			
			 public function selectGroupsData():void
	  {
	      _serviceBets.groupsId=component.groupsCBBet.selectedItem.groupsId;
	      _serviceBets.callGroupsData(selectGroupsDataResult)
	  }
	  
			 public function selectGroupsDataResult(event:ResultEvent):void
	  {
		     var array=event.result 
		   
	    	 component.eventDG.dataProvider=new ArrayCollection(array[2]) ;
	  	  	 component.teamsTableData.dataProvider=new ArrayCollection(array[0]);
	       
	  	  event.currentTarget.removeEventListener("result",selectGroupsDataResult);
	  }
		public function editStart(event:ListEvent):void
		{
		//	trace(event.columnIndex)
		}
		
  	  	private function  columnSet(event):void
  	  	{
  	  		
  	  	}
  	  	
  	  	public function removeDataButtons(data):void
  	  	{
  	  	       _setData.removeItemAt(data)
  	  	}
  	  	
  	  	public function changeMainTab(event):void
  	  	{
  	  		 
  	  	}
 
  	  

 		public function saveCoupon():void
 		{
 			model('SupertotoModel').nameOfCoupon=component.nameOfCoupon.text; 
 		    model('SupertotoModel').columnNames=""
 		  
 		   model('SupertotoModel').dateVisible = component.dateActive.formatedTime;
           model('SupertotoModel').dateEnd  =component.dateEnd.formatedTime;
 		  
 			var len:uint=component.repData.length;
 			var lenCol:uint=component.eventsRep.length;
 			var columnData:String;
 			    for (var i:int = 0; i < lenCol; i++)
                {
                   columnData+="-"+component.eventsRep.getItemAt(i)['name'];
                } 
 			
 			
 			model('SupertotoModel').columnNames=columnData; 
 			 
                for (var ie:int = 0; ie < len; ie++)
                { 
                    model('SupertotoModel').teamsSupertoto.push(component.betName[ie].text);
                } 
           
 		 // 	 _supertotoService.callInsert(insertResult);
 		}
 		
 		
		private var supertotoPosition:uint;
 		
 		public function wshadeCreationC(event):void
 		{
 			 if((component.dataSupertoto.getItemAt( event.currentTarget.currentIndexData)['databets'] is ArrayCollection))
	         { 
		          event.currentTarget.opened=true
	         }
 			
 		}
 		 
 	  
		
	    public function getTeamData(event:ResultEvent):void
		{ 
		  component.teamsTableData.dataProvider=new ArrayCollection(event.result as Array);
		}
		  
		  public function closeSportCBet (event:Event):void
		 {

		 	component.groupsCBBet.dataProvider=event.currentTarget.selectedItem.children;
		 }
		  
 		
 		
 		 public function WshadeClick(event)
         {
	         supertotoPosition=event.currentTarget.currentIndexData;
	         if(!(component.dataSupertoto.getItemAt(supertotoPosition)['databets'] is ArrayCollection))
	         { 
		          model("SupertotoModel").supertotoId=component.dataSupertoto.getItemAt(supertotoPosition)['supertotoId']
		 //           _supertotoService.callSelectSupertotoTeams(supertotoTeamsResult)
	         }
	      }
           
         private function supertotoTeamsResult(data):void
         { 
         	 if(  component.wshade[supertotoPosition].opened==true)
	         { 
	           	var newArr=new ArrayCollection();
	         	var array:Array=data as Array;
	         	var len = array.length; 
	         	
	         	for(var i:uint=0;i<len;i++)
	         	{
	         		newArr.addItem({"name":array[i][1],"supertotoTeamsId":array[i][0]})
	         	}
	         	
	         	component.dataSupertoto.getItemAt(supertotoPosition)['databets']=newArr;
	            component.dataSupertoto.refresh();
	            component.wshade[supertotoPosition].opened=true ;
	          } 
         }
 		
  	  	
  	  	public function insertResult(event):void
  	  	{
  	  		
  	  	}
  	  	
  	  	
  	    private function selectEventsTypesRows(event:ResultEvent):void
		{  
			  _setData=new ArrayCollection(new Array(uint(component.textRow.text)))
  	  	     	component.r.dataProvider=_setData; 
			
		    if(_checkData.validation(event.result))
    	  	{  
			 	 var string:String="";
				 	
				  
				 
					for(var i:uint=0;i<lenOfRep;i++)
		 	  		{ 
		 	  			_setData.addItem(new ArrayCollection(event.result as Array) )
		 	  		}  
		   }
	 
			   event.currentTarget.removeEventListener("result",selectEventsTypesRows);
			
	  	}
  	  	

  	  	 public function changeText(te)
 		{ 
 			holderOfData[te[0]][te[1]]=component.text[te[0]][te[1]].text 
 		}
  	  	
  	  	public function rowSet( ):void
  	  	{
  	  	   lenOfRep =uint(component.textRow.text)
  	  	    
  	  	    
  	  	/*  
  	  	   if(_setData.length==0)
  	  	   {
  	  	   	
	  	  	   	 for(var i:uint=0;i<len;i++)
	  	  	    { 
	  	  	  	 _setData.addItem({"team":"","teamId":0,"team2":"","teamId2":0});
	  	  	    } 
  	  	   } 
  	  	   
  	  	   else
  	  	   {
  	  	   	   if(len>_setData.length)
  	  	   	   {
  	  	   	   	   var ie:uint=_setData.length;
  	  	   	   		 for( ie;ie<len;ie++)
	  	  	    	{ 
	  	  	  		 _setData.addItem({"team":"","teamId":0,"team2":"","teamId2":0});
	  	  	   	 	} 
  	  	   	   }
  	  	   	   else if(len<_setData.length)
  	  	   	   {
  	  	   	   	   var iee:uint=_setData.length;
  	  	   	   		 for( iee;iee>len;iee--)
	  	  	    	{ 
	  	  	  			 _setData.removeItemAt(iee-1);
	  	  	  			 //addItem({"team":"","teamId":0,"team2":"","teamId2":0});
	  	  	   	 	} 
  	  	   	   } 
  	  	   }
  	  	    */
  	    
 
  	  	}
  	  	
  	  	public function rowSetReset( ):void
  	  	{
  	  	   var len:uint=uint(component.textRow.text)
  	  	   _setData =new ArrayCollection( );
  	  	   for(var i:uint=0;i<len;i++)
  	  	  { 
  	  	  	 _setData.addItem({"team":"","teamId":0,"team2":"","teamId2":0});
  	  	  } 
  	  	   
  	     	component.r.dataProvider=_setData; 
  	  	}
  	  	
 		public  function dragEnterHandler(event:DragEvent):void 
        {
                var dropTarget:TextInput=event.currentTarget as TextInput;
                DragManager.acceptDragDrop(dropTarget);
         }
 			
 		 public  function dragDropHandlerBetName(event:DragEvent):void 
         {  
             if( event.currentTarget.id=="betName")
             {
             	  _setData.getItemAt(event.currentTarget.instanceIndices)["team"]=_teamName;
             	    _setData.getItemAt(event.currentTarget.instanceIndices)["teamId"]=_teamId;
             }
             else
             {
             	  _setData.getItemAt(event.currentTarget.instanceIndices)["team2"]=_teamName;
             	    _setData.getItemAt(event.currentTarget.instanceIndices)["teamId2"]=_teamId;
             }
           
               component.r.dataProvider=_setData;
         } 	
 			
  	  
		public function removeData(data):void
		{
		  _setData.removeItemAt(data)  ;
  	      component.r.dataProvider=_setData;
  	       component.textRow.text=String(_setData.length)
		}
	 
       
     	 public function deleteSupertotoBet(dataID:uint):void
     	 {
     	 	 model("SupertotoModel").supertotoId=component.dataSupertoto.getItemAt(dataID)['supertotoId']
		   //  _supertotoService.callDeleteSupertoto(updateMainTable)
		    
     	 }
  	  	
  	  	 public function showWindow(i:uint):void 
         {
                var login:EditSupertoto=EditSupertoto(PopUpManager.createPopUp( component, EditSupertoto , true));
                login.width=component.box.width;
                login.height=component.box.height;
                login.dataAC=component.dataSupertoto.getItemAt(i);
         }
	}
}