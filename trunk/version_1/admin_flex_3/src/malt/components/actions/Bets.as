/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */

package malt.components.actions
{ 
	import malt.components.classes.CheckData;
	import malt.components.service.BetsAction;
	import malt.components.service.EventsAction;
	import malt.components.service.TeamsAction;
	import malt.core.controls.Actions;
	import flash.events.MouseEvent;
	import mx.collections.ArrayCollection;
	import mx.containers.VBox;
	import mx.controls.Alert;
	import mx.controls.TextInput;
	import mx.events.DragEvent;
	import mx.managers.DragManager;
	import mx.rpc.events.ResultEvent;
 
	    
	public class Bets extends Actions
	{
		private var _betsAction:BetsAction;
		private var _oddsArray:Array;
		private var _time:String;
		public var _betRepeater:ArrayCollection=new ArrayCollection();
		public var _betRepeaterReset:ArrayCollection=new ArrayCollection();
		private var _temBetType:ArrayCollection;
		private var _serviceEvents:EventsAction;
		public var _teamHolder:ArrayCollection; 
	    private var _serviceTeams:TeamsAction ;
	    private var _eventDataAC:ArrayCollection;
	  
	    public var  status:Boolean=false;
	    public var  status2:Boolean=false;
        private var _checkData:CheckData;
        
        [Bindable]
		private var _sportAndGroup:ArrayCollection; 
		
	    public function constructComponent():void
 		{ 
        	 
              _serviceEvents=EventsAction.getInstance();
 		      _betRepeater=new ArrayCollection();  
 		      _betsAction=new BetsAction(); 
 		      _betsAction.bookhouseId=model("Global").bookhouseId;   
 		      component.accordMain.addEventListener("change",groupClick)
 		      _betRepeaterReset=new ArrayCollection(); 
 		      _serviceTeams=new TeamsAction(  );
 		      _teamHolder=new ArrayCollection(); 
 		     
	    _checkData=CheckData.getInstance(); 		
 		     
 		       callSportData( )
 		       
 	        	var invoiceDate:Date = new Date();
				var millisecondsPerDay:int = 1000 * 60 * 60 * 24;
	 
				var dueDate:Date = new Date(invoiceDate.getTime() + (1 * millisecondsPerDay));
		        component.timerAct.dateField.selectedDate= dueDate;
		      
		         var invoiceDate:Date = new Date();
				var millisecondsPerDay:int = 1000 * 60 * 60 * 24;
			
				var dueDate:Date = new Date(invoiceDate.getTime() + (2 * millisecondsPerDay));
		        component.timer.dateField.selectedDate= dueDate
		         
 		      
  	  	}  
  	  	
  	  	public function eventComplete():void
  	  	{
  	  		  status=true; 
  	  	}
  	  	
  	    public function betComplete():void
  	  	{
  	  		  status2=true; 
  	  	}
 	  	
 	  	public function callSportData( ):void
 	  	{
 	  	  _betsAction.callSetDataForBet(resultMainSelect);
 	  	}
 	  	
 	  		  	
  	  	public function groupClick(event:Event):void
  	  	{
  	  			
  	  	    if(event.currentTarget.selectedIndex==0 )
 	  		{  
 	  		   component.sportCB.dataProvider=null;
 	  		   component.groupsCB.dataProvider=null;
 	  		   callSportData();
 	  		   component.betName.text="";
 	  		   component.myrep.dataProvider=null;
 	  		   _teamHolder.removeAll();
 	  		   component.teamsTableData.dataProvider=null;
 	  		   component.eventDG.dataProvider=null;
 	  		} 
 	  		else if(event.currentTarget.selectedIndex==1 )
 	  		{
 	  				if( status2)
					{
						component.eventDGE.dataProvider=null;
						component.eventTeamDataGrid.dataProvider=null;
						 callSportData();
						component.sportCBBet.dataProvider=null;
						_betRepeater.removeAll();
						_betRepeaterReset.removeAll();
						component.eventCBBet.dataProvider=null;
			  			component.groupsCBBet.dataProvider=null;
			  			component.eventCB.dataProvider=null;
			  			component.betNameTI.text= "";
	  	 	  			component.oneTeamCheckB.selected=false;
	 	  	  		    component.oneTeamSelect.enabled=false;
	 	  	  		    component.myrepBet.dataProvider=null;
	 	  	  			component.betActiveLabel.text="";
	  	           		component.betEndLabel.text = "" ;
					}
 	  			 
 	  		 }
  	  	}
  	  	 	 
   
 	  	
 	  
 	  	
 	   
 	   
 	  	public function completeSportCBBet():void
 	  	{
 	  		component.sportCBBet.dataProvider=_sportAndGroup;
 	  	}
 	  	
 	  	 
 	  	public function setEvent():void
 	  	{
 	  		var noviArray:Array=new Array(); 
 	  		
 	  		if(_teamHolder.length==0)
 	  	    {
 	  			//	Alert.show("Please insert minimum 1 team in this event.")
 	  			//	 return
 	  	     }
 	  		 
 	  			 
 	  			
 	  		for(var i:uint=0;i<_teamHolder.length;i++)
 	  		{
 	  		  noviArray.push([_teamHolder.getItemAt(i)["id"]]) ; 
 	  		}
             
 	  	  
 	  		 if(component.timer.dateField.selectedDate <   component.timerAct.dateField.selectedDate )
 	  		{
 	  			var text:String="'Active' date can't be higher then 'End' date."
 	  			Alert.show(text)
 	  			return  void;
 	  		}  
 	  		else  if(component.timer.dateField.selectedDate >  component.timerAct.dateField.selectedDate )
 	  		{
 	  			
 	  		}
 	  		else
 	  		{ 
		 	  		 if(component.timer.hours <   component.timerAct.hours)
		 	  		{
		 	  			var text:String="'Active' hour is higher that 'End' hour."
		 	  			Alert.show(text)
		 	  			return  void;
		 	  		} 
		 	  		else  if(component.timer.hours ==   component.timerAct.hours)
		 	  		{
		 	  			 if(component.timer.min <=   component.timerAct.min)
		 	  			 {
		 	  			 	var text:String="'Active' min is higher that 'End' min."
		 	  				Alert.show(text)
		 	  				return  void;
		 	  			 }
		 	  		}
		 	  			
 	  		}
 	  		_betsAction.groupsId= component.groupsCB.selectedItem.groupsId; 
 	  		_betsAction.betEventName=component.betName.text;
 	        _betsAction.betTypeSave=noviArray;
 	  		_betsAction.betTime=component.timer.formatedTime; 
 	  		_betsAction.betTimeActive=component.timerAct.formatedTime; 
 	  		if(_betsAction.groupsId==0)
 	  		{
 	  			Alert.show("Please select group.")
 	  			return  void;
 	  		}
 	  		 
 	  		else if(_betsAction.betTypeSave.length==0)
 	  		{
 	  			//Alert.show("Please add bet type instance.")
 	  			//	return
 	  		}  
 	  	 
 	  		_betsAction.callInsert(manageBetsData);
 	  	}
 	  	
 	   public function eventTypeChange(event):void
	   {
clearAllTeams()
	        	 component.oneTeamCheckB.selected=false;
	        	 component.oneTeamSelect.enabled=false;
				 component.oneTeamSelect.text="";
	        	 _betRepeater=new ArrayCollection();
		    
	  	           component.betActiveLabel.text=event.currentTarget.selectedItem.dateactive;
	  	           component.betEndLabel.text = event.currentTarget.selectedItem.enddate ;
	  	 
	  	        _betsAction.betsIdEvent=component.eventCBBet.selectedItem.betId;
			 	_betsAction.callBetsData(callBetsData)	  
	   }
	   
	   public function callBetsData(event:ResultEvent):void
	   { 
	   
	   	   component.eventTeamDataGrid.dataProvider=new ArrayCollection(event.result[0] as Array)
	       component.eventDGE.dataProvider=new ArrayCollection(event.result[2] as Array)
	       event.currentTarget.removeEventListener("result",callBetsData); 
	   }
 	  	
 	  	public function setOneTeamToNegative():void
 	  	{
 	  				component.oneTeamCheckB.selected=false;
 	  				component.oneTeamSelect.enabled=false;
 	  				component.oneTeamSelect.text="";
 	  	}
 	  	
 	    public function resultInsertNewBet(event:ResultEvent):void
 	  	{    
 	  	  	if(_checkData.validation(event.result))
    	  	{ 
     	  		Alert.show("Bet event is set.")
 	  			component.betNameTI.text=""; 
 	  			component.oneTeamCheckB.selected=false;
	        	 component.oneTeamSelect.enabled=false;
				 component.oneTeamSelect.text="";
 	  		     component.eventDGE.dataProvider=new ArrayCollection(event.result as Array);
 	  		   clearAllTeams()
 	  	 	 } 
     		 else
     		 {
     		 	if(_checkData.status=="error")
     		 	{
     		 	Alert.show("Problem on server, please check your data and try again.")	
     		 	}
     		 	
     		 	if(_checkData.status=="outdated")
     		 	{
     		 	Alert.show("Selected event does not exist in non-active or active status.")	
     		 	}
     		 	
     		 	if(_checkData.status=="teamcounter")
     		 	{
     		 	Alert.show("Minumun one team in bet.")	
     		 	}
     		 	
     		   if(_checkData.status=="duplicate")
			       	  {
			       	  	Alert.show("Two bets with same type of bet exist. Please check you bets and type of bets.");
			       	  	   model('Global').sportsHeader="";
			       	  }  
     		 	
     		 }
     	  
 	  	}
 
 	  	public function  saveEventBet():void
 	  	{  
		    var noviArray:Array=new Array(); 
 	  		var countTeams:uint=0;
 	  		for(var i:uint=0;i<_betRepeater.length;i++)
 	  		{
 	  			if(_betRepeater.getItemAt(i)["name"].length==0)
 	  			{
 	  				Alert.show("Instance name must have 1-100 char")
 	  				 return
 	  			}
 	  		
 
 	  			for(var ie:uint=0;ie<noviArray.length;ie++)
 	  			{ 
		 	  		 if(_betRepeater.getItemAt(i)["name"]==noviArray[ie][0])
		 	  		 {
		 	  		 	Alert.show("Bet instance must have uniqe names")
 	  				    return
		 	  		 }
 	  			 }
 	  		
 	  			noviArray.push([_betRepeater.getItemAt(i)["name"],_betRepeater.getItemAt(i)["odds"],_betRepeater.getItemAt(i)["teamId"]]) ;  
 	  			 
 	  			
 	  			if(_betRepeater.getItemAt(i)["teamId"]==null)
 	  			{
 	  		      	countTeams++ 
 	  			}
 	  			
 	  		}
 	  	 
 	  		_betsAction.betsIdType=component.eventCB.selectedItem.eventId;
 	  	    _betsAction.betOdds=noviArray;
		    _betsAction.eventBetId=component.eventCBBet.selectedItem.betId;
		    _betsAction.betNameTI=component.betNameTI.text;
		 
		    _betsAction.insertBetEvent(resultInsertNewBet);
 	  	}
 	  	
 
 	  	 
 	   	private function manageBetsData(event:ResultEvent):void
 	  	{   
 	  		 if(_checkData.validation(event.result)) 
	    	 {
	    	 	 Alert.show("Event is set")
 	  			component.betName.text="";  
 	  	        component.myrep.dataProvider=null; 
 	  	         _teamHolder.removeAll();
 	  	         component.eventDG.dataProvider=new ArrayCollection(event.result  as Array)
	    	 }
 	  		  
 	  	} 
        public  function dragEnterHandler(event:DragEvent):void 
        {
                var dropTarget:TextInput=event.currentTarget as TextInput;
                DragManager.acceptDragDrop(dropTarget);
         }
		
	    public  function dragEnterHandlerBox(event:DragEvent):void 
        {
        	    DragManager.acceptDragDrop(VBox(event.currentTarget));
         }
            
                
              
          public  function dragDropHandler(event:DragEvent):void 
          { 
            	event.currentTarget.text=model('Global').selectedDrag
          }
           
           public function dragDropHandlerHBox(event:DragEvent):void
           {
             //	 _betRepeater.addItem({"name":model('Global').selectedDrag ,"odds":"0","winner":model('Global').selectedDrag});
            }
            
              public function dragDropHandlerHBoxTeam(event:DragEvent):void
             {
               addTeamToAC(model('Global').selectedDrag , model('Global').teamsId)  
           
             }
             
             
             public function dragDropHandlerHBoxTeamBet(event:DragEvent):void
             { 
               _betRepeater.addItem({"name":model('Global').selectedDrag ,"odds":"0","winner":model('Global').selectedDrag,"teamId":model('Global').teamsId})
                component.myrepBet.dataProvider= _betRepeater;
             }
             
             
            
        
             public function addTeam(data:String,id:uint):void
             {
              addTeamToAC(data,id)
             }
           
           public function addTeamToAC(name:String,id:uint):void
           {
            
            	   var  len:uint= _teamHolder.length;
            	   for(var i:uint=0;i<len;i++)
            	   {
	            	   	if(id==_teamHolder.getItemAt(i)['id'])
	            	   	{
	            	   		return;
	            	   		break
	            	   	}
            	   } 
            	    _teamHolder.addItem({"name":name,"id":id});
            	   component.myrep.dataProvider= _teamHolder; 
           }
           
          public function callDeleteTeam(id:uint):void
          {
          	  _betRepeater.getItemAt(id)["teamId"]=null;
			  _betRepeater.getItemAt(id)["winner"]=null;
			   component.myrepBet.dataProvider=_betRepeater ;
          } 
           
         
         public function deleteTeamEvent(data:uint):void
         {
         	_teamHolder.removeItemAt(data)
         	 component.myrep.dataProvider= _teamHolder; 
         }  
           
           
         public  function dragDropHandlerBetName(event:DragEvent):void 
         {  
          	if(event.currentTarget.id=="betName")
          	{
          	    addTeamToAC(model('Global').selectedDrag , model('Global').teamsId)  
          		  
          		if(event.currentTarget.text=="")
            	{
            		event.currentTarget.text=model('Global').selectedDrag
            	}
            	else
            	{
            		event.currentTarget.text=event.currentTarget.text +" - "+model('Global').selectedDrag 
            	}
          	}
          	else if(event.currentTarget.id=="nameBType")
          	{
          		  
            		 _betRepeater.getItemAt(event.currentTarget.instanceIndices)["name"]=model('Global').selectedDrag;
            		 _betRepeater.getItemAt(event.currentTarget.instanceIndices)["teamId"]=model('Global').teamsId;
            		 	 _betRepeater.getItemAt(event.currentTarget.instanceIndices)["winner"]=model('Global').selectedDrag;
            		  component.myrepBet.dataProvider= _betRepeater;
            }
            else if(event.currentTarget.id=="oddBWinner")
            {
          		 if(!component.oneTeamCheckB.selected)
          		 {
            		 _betRepeater.getItemAt(event.currentTarget.instanceIndices)["winner"]=model('Global').selectedDrag;
            		 _betRepeater.getItemAt(event.currentTarget.instanceIndices)["teamId"]=model('Global').teamsId;
                	 component.myrepBet.dataProvider= _betRepeater;
                 }
                 else
                 {
                 	Alert.show("You set that this bet can have only one team, Please insert this team")
                 }
            } 
            else if(event.currentTarget.id=="oneTeamSelect")
            {
            	if(component.oneTeamCheckB.selected==true)
            	{
	              component.oneTeamSelect.text=model('Global').selectedDrag;
		          for(var i:uint=0;i<_betRepeater.length;i++)
		 	  	  {
		 	  			  _betRepeater.getItemAt(i)["winner"]=model('Global').selectedDrag;
		 	  			  _betRepeater.getItemAt(i)["teamId"]=model('Global').teamsId;
		 	  	  }
		  	   		component.myrepBet.dataProvider=_betRepeater 
            	}
            }
          	 
         } 
	    
	    
	    public function moveUp(data:uint):void
	    {
	    	if(data!=0)
	    	{
	    		var string1 = _betRepeater.getItemAt(data) ;
	       		var string2= _betRepeater.getItemAt(data-1) ;
	      		_betRepeater.setItemAt(string1,data-1);
	     		_betRepeater.setItemAt(string2,data);
	    	}
	    }
	    
	    public function moveDown(data:uint):void
	    { 
	    	if(data+1!=_betRepeater.length )
	    	{
	        	var string1= _betRepeater.getItemAt(data) ;
	       		var string2= _betRepeater.getItemAt(data+1) ;
	      		_betRepeater.setItemAt(string1,data+1);
	     		_betRepeater.setItemAt(string2,data);
	    	}
	    }
 			 
 		   public function dragEnd(event):void
		   {
		    	_betRepeater.addItem({"name":model('Global').selectedDrag ,"odds":"0","winner":model('Global').selectedDrag ,"teamId":model('Global').teamsId})
		   		event.preventDefault(); 
		   }
		   
		  
	
		 public function changeOddsBetWinner(text,data):void
		 {
		 	 _betRepeater.getItemAt(data)['winner']=text; 
		 }
		 
		
		 
		public function changeNameBetType(text,data):void
		{
			_betRepeater.getItemAt(data)['name']=text;
		}
		
		public function changeOddsBetType(text,data):void
		{
				_betRepeater.getItemAt(data)['odds']=text;
			 
		}
		
		 
		
		public function callDeleteType(data:uint):void
		{
			_betRepeater.removeItemAt(data);
		}
		
		public function oddBWinner(data:String):Boolean
		{
			
			if(data=="")
			{
				return true
			}
			return false
		}
		 
		
		public function oddBWinnerLabel(data:String):Boolean
		{
		 	if(data=="")
			{
				return true
			}
			return false
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
					    if(component.eventCB!=null)
					    {
					    	  component.eventCB.dataProvider= _eventDataAC;
					    }
					    
					   
					     component.sportCB.dataProvider=_sportAndGroup;
					       
					    
	    	 }event.currentTarget.removeEventListener("result",resultMainSelect);
		}
		
		 public function closeSportCB(event:Event):void
		 {
		 	component.groupsCB.dataProvider=event.currentTarget.selectedItem.children;
		 }
		  
		  public function closeSportCBet (event:Event):void
		 {
		    _serviceEvents.sportId=event.currentTarget.selectedItem.sportId
             _serviceEvents.callSelect(resultEventData)
		 	component.groupsCBBet.dataProvider=event.currentTarget.selectedItem.children;
		 }
		  
		  public function resultEventData(event:ResultEvent):void
		  {
		  	component.eventCB.dataProvider=new ArrayCollection(event.result as Array) 
		  	event.currentTarget.removeEventListener("result",resultEventData);
		  }
		  
		  public function typebetCBClose(event:Event):void
		  { 
		      _serviceEvents.eventId= event.currentTarget.selectedItem.eventId; 
		  	  _serviceEvents.callSelectTypes(selectEventsTypesRows); 
		  }
		  
	   	public function changeGroupsCBBet():void
 		{
 				callEventsBet()
 	     }	
		  
		  private function selectEventsTypesRows(event:ResultEvent):void
		{  
			  if(_checkData.validation(event.result))
    	  	{ 
     	  		 
 	  	
     		 
			 	setOneTeamToNegative()
			 	
			 	_betRepeaterReset.removeAll();
				 	 var resArray:Array=event.result as Array;
					 var len:uint=resArray.length;
					for(var i:uint=0;i<len;i++)
		 	  		{ 
		 	  			_betRepeaterReset.addItem({"name":resArray[i][1],"odds":"0","winner":null,"teamId":null}) ; 
		 	  		}
		 	  		
		 	  
		 	  		 
		 	  		_betRepeater=new ArrayCollection(	_betRepeaterReset.toArray());
		            component.myrepBet.dataProvider=_betRepeater;
		            
		            if(component.custonBetNameCB.selected==false)
	 				{ 
	 					if(!component.eventCBBet.selectedItem)
	 					{
	 						 component.betNameTI.text=component.eventCBBet.selectedItem.name 
	 					}
	 					else
	 					{
	 						 component.betNameTI.text= component.eventCBBet.selectedItem.name 
	 					} 
	  			    }
		         
		   }
		   else
		   {
		   	         _betRepeaterReset.removeAll();
		   			_betRepeater=new ArrayCollection( );
		            component.myrepBet.dataProvider=_betRepeater
		         
		   }
			   event.currentTarget.removeEventListener("result",selectEventsTypesRows);
			
	  	}
	
	   public function dragIt(event:MouseEvent ):void 
       {
		       model('Global').selectedDrag=event.currentTarget.selectedItem.name;
               model('Global').teamsId=event.currentTarget.selectedItem.idTeams;
       }
       
       public function dragItEvent(event:MouseEvent):void 
       { 
       	  model('Global').selectedDrag=event.currentTarget.selectedItem.name;
          model('Global').teamsId=event.currentTarget.selectedItem.teamHasId;   
       }
        
	  public function callEvents():void
	  {
	  		if(component.groupsCB.selectedItem==null)
 	  		{
 	  			Alert.show("Please select group");
 	  		}
 	  		else
 	  		{
		  	  _betsAction.groupsId=component.groupsCB.selectedItem.groupsId;
		  	  _betsAction.callSetBetBasicService(resultBetEvents);
		  	 }
	  }
	  
	  public function callEventsBet():void
	  {
	  	  _betsAction.groupsId=component.groupsCBBet.selectedItem.groupsId;
	  	  _betsAction.callSetBetBasicService(resultBetEventsBet);
	  	  		  
	  }
	  
	  public function selectGroupsData():void
	  {
	      _betsAction.groupsId=component.groupsCB.selectedItem.groupsId;
	      _betsAction.callGroupsData(selectGroupsDataResult)
	  }
	  
	  public function selectGroupsDataResult(event:ResultEvent):void
	  {
		     var array=event.result 
		    
	    	 component.eventDG.dataProvider=new ArrayCollection(array[2]) ;
	  	  	 component.teamsTableData.dataProvider=new ArrayCollection(array[0]);
	       
	  	  event.currentTarget.removeEventListener("result",selectGroupsDataResult);
	  }
	  
	 public function  changeCustonBetNameCB():void
	 {
	 	if(component.custonBetNameCB.selected==true)
	 	{
	 		component.betNameTI.editable=true
	 			
	 	}
	 	else if(component.custonBetNameCB.selected==false)
	 	{
	 		component.betNameTI.editable=false;
	 		  component.betNameTI.text=  component.eventCBBet.selectedItem.name 
	  	}
	 }
	 
	    
	  public function resultBetEventsBet(event:ResultEvent):void
	  {  
	    component.eventCBBet.dataProvider=new ArrayCollection(event.result as Array); 
	  } 
	  public function resultBetEvents(event:ResultEvent):void
	  {
	  	component.eventDG.dataProvider=new ArrayCollection(event.result as Array) ;
	  }
	  
	 
	  public function loadEventBets():void
	  {
	     if(component.eventCBBet.selectedItem==null)
 	  	 {
 	  		Alert.show("Please select event");
 	  	 }
 	  	else
 	  	{
	  		_betsAction.eventBetId=component.eventCBBet.selectedItem.betId;
	  		_betsAction.selectBetEventBets(loadEventBetsResult);
	  	}
	  }
	  
	  public function loadEventBetsResult(event:ResultEvent):void
	  { 
	  	 component.eventDGE.dataProvider=new ArrayCollection(event.result as Array)
	  }
	  
	  public function visiTeam(data:String):Boolean
	  {
			var bol:Boolean;
			 	 
			 	 if(!component.oneTeamCheckB.selected)
          		 {
            			if(data==null)
						{
							bol = false;
						}
						else
						{
							bol = true;
						}   
                 } 
            return bol;
		}
	  
	  public function oneTeamChange():void
	  {
	     component.oneTeamSelect.enabled=component.oneTeamCheckB.selected;	 
	  	 component.oneTeamSelect.text="";
	  	 clearAllTeams()
	  	
	  }
	  
	  public function clearAllTeams():void
	  {
	  	 for(var i:uint=0;i<_betRepeater.length;i++)
 	  	  {
 	  			 _betRepeater.getItemAt(i)["winner"]=null;
 	  			_betRepeater.getItemAt(i)["teamId"]=null;
 	  			  component.myrepBet.dataProvider=_betRepeater ; 
 	  	  }
	  }
	  
	  
	  
	}	
}