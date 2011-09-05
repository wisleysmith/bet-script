/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */

package malt.components.actions
{
    import malt.components.classes.CheckData;
    import malt.components.classes.CustomArrayCollection;
    import malt.components.controls.EditBets;
    import malt.components.controls.EditBetsEnd;
    import malt.components.controls.EditOnlyBets;
    import malt.components.controls.ViewOdds;
    import malt.components.service.BetsAction;
    import malt.components.service.EventsAction;
    import malt.core.controls.Actions;
    import flash.events.Event;
    import mx.collections.ArrayCollection;
    import mx.controls.Alert;
    import mx.events.CloseEvent;
    import mx.events.ItemClickEvent;
    import mx.events.MenuEvent;
    import mx.managers.PopUpManager;
    import mx.rpc.events.ResultEvent;
 
	
	public class SportsBets  extends Actions
	{
		private var _eventService=EventsAction.getInstance( )
		private var _service:BetsAction;  	 
		private var _sportAndGroup:ArrayCollection;	 
		private var _betsAC:ArrayCollection;
        private var _checkData:CheckData;
		private var  _resultEventData:ArrayCollection;
		private var _editSportAndGroup:ArrayCollection;
		private var _titleSport:String
		public var status=false;
	    private var titleStatus:String;
 	  	private var groupTitle:String; 
 	  	private var sportId:uint;
 	  	private var deactivateOrDelete:String;
 	  	
 	  	private var _eventNames:CustomArrayCollection=new CustomArrayCollection();
 	  	
	 	public function constructComponent():void
 		{   
 			component.mainBetPanel.title="All - Active" 
 		    _service=new BetsAction();
            _service.bookhouseId=model('Global').bookhouseId; 
             deactivateOrDelete="deactivate"
             _service.groupsId=0;
            
          initSportbetService()
          
            _betsAC=new ArrayCollection();  
            _resultEventData=new ArrayCollection();
	      _checkData=CheckData.getInstance(); 		
  	  	} 
 	  	 
 	  	 public function initSportbetService():void
 	  	 { 
 	  	 	  _service.callSetDataForBet(resultMainSelect);
 	  	 	 	if(component.group.selectedValue=="Events")
		 	   {
		 	   	 _service.callSelectSportOnlyBets(selectGroupsData);
		 	   }
			   else if(component.group.selectedValue=="Bets")
		 	   {
		 	   	_service.callSelectBets(selectGroupsData); 
		 	   } 
 	       
 	         status=true
 	  	 }
 	   
 	   public function betTypes():void
 	   { 
 	   	  _service.eventId=component.eventCB.selectedItem.eventId ;
 	   	  _service.callSelectBets(selectGroupsData) ;
 	   }
 	   
 	   public function filterCBEvent(event):void
 	   { 
 	   	   if(event.currentTarget.selected==true)
 	   	   {
 	   	  	 	component.filerEventHBox.enabled=true  ;
 	   	   }
 	   	   else
 	   	   {
 	   	        _service.eventId=0
 	  	 	    component.filerEventHBox.enabled=false;
 	   	   } 
 	   }    
 	 
 	   public function  filterCBTime(event):void
 	   { 
 	   	   if(event.currentTarget.selected==true)
 	   	   {
 	   	  	 	component.filerTimeHBox.enabled=true  
 	   	   }
 	   	   else
 	   	   {
 	   	   		component.filerTimeHBox.enabled=false
 	   	   		_service.timeTo="0"; 
 	   	   }
 	  
 	   }    
 	  	
 	  	public function deleteUnplayedFinished()
 	  	{
 	  		//_service.deleteUnplayedFinished(selectGroupsData); 
 	  	}
 	  	 
 	  	
 	  	public function selectBet(event:MenuEvent):void
 	  	{  
             _service.groupsId=event.menu.selectedItem.groupsId;
             _service.eventId=0;
	 	  
 	  	    if(event.currentTarget.selectedIndex==0)
 	  	    {
 	  	    	_titleSport="All"; 
 	  	    	groupTitle ="";
	 	  	} 
	 	  	else
	 	  	{
	 	  		 _titleSport=_sportAndGroup.getItemAt(event.currentTarget.selectedIndex)['name'] ;
	 	     	groupTitle =event.menu.selectedItem.nameGroup;
	 	  	}
	 	  	    switch(event.index)
			 	 	{
			 	 		case 1:
					        setActiveState( );  
					         titleStatus="Active";
					        break;
					    case 2:
					        setFinshedState( );
					        titleStatus="Finished";
					        break;
					    case 3:
					         setArhiveState( );
					         titleStatus="Arhive"  ;
					        break;  
					    case 0:
					         setNonActiveState( );
					         titleStatus="Non-Active"  ;
					        break;      
			 	 	}
 	  	    
 	  		 
 	  		if(groupTitle!="")
 	  		{
 	  		groupTitle=	" - "+  groupTitle +" - "
 	  		}
 	  		component.mainBetPanel.title=_titleSport+groupTitle+" "+ titleStatus
 	  
 	   
 	  	}
 	  
 	  	 
 	  	 public function callBetEventService():void
		{
			
			if(component.group.selectedValue=="Events")
		 	   {
		 	   		_service.callSelectSportOnlyBets(selectGroupsData)
		 	   }
			   else if(component.group.selectedValue=="Bets")
		 	   {
		 	   		 _service.callSelectBets(selectGroupsData) ;
		 	   }
		}
 	  	 
	 	 private function setNonActiveState( ):void
	 	 {  
	 	 	_service.status=3;
	    	_service.betsIdEvent=0;
			component.editBetButton =false;  
		 	component.saveResultButton=false;
		 	component.editRep=true;
	        component.dataBetButton=true;
 
			callBetEventService()
	 	 }
	 	 
	 	 
	 	 private function setActiveState( ):void
	 	 {  
	    	_service.status=0;
	        _service.betsIdEvent=0;
        	 component.editBetButton =true; 
		 	component.saveResultButton =false;
		 	component.dataBetButton=true;
		 	component.editRep=false; 
		 	 callBetEventService()
		 
	 	 }
	 	 
	 	 private function setArhiveState( ):void
	 	 {  
		 	_service.status=2;
		 	_service.betsIdEvent=0;
	
	 	   	component.editBetButton =false; 
		 	component.saveResultButton =true;
		   	component.dataBetButton=false;
		   	component.editRep=false;
		   		 	callBetEventService()  
	 	 }
	 	 	 
	 	 private function setFinshedState( ):void
	 	 {  
	 	 	_service.status=1;
	 	    _service.betsIdEvent=0;
	 	
		 	component.editBetButton =false; 
		 	component.saveResultButton =true;
		   	component.dataBetButton=false;
		   	component.editRep=false;
		    callBetEventService() 
	 	 }
	 	 
 	   
 	  	private function selectGroupsData(event:ResultEvent):void
 	    {  
 	   
 	         if(_checkData.validation(event.result)) 
	    	 {
	    	       var jok:Array=event.result as Array ; 
	    	 	if(_checkData.status!='null')
                 {
                
	    	 	
	    	 	        if(_service.eventId==0)
				        {
				             	 	_eventNames.removeAll();
				        }
	    	 	
	    	 	
	    	 		 _betsAC=new ArrayCollection();
	    	    	component.rep.visible=true; 
		   	 	   component.rep.includeInLayout=true; 
		   	  
		   	 	   
	    	 		if(component.group.selectedValue=="Events")
	    	 		{
	    	 			 var array= event.result as Array
	    	 			 if(array[0]=="")
	    	 			 {
	    	 			 	_betsAC=new ArrayCollection();
	    	 			 }
	    	 			 else
	    	 			 {
	    	 			 	_betsAC=new ArrayCollection(array);
	    	 			 }
	    	 			
	    	 		     component.rep.dataProvider= _betsAC;
	    	 			 
	    	 		}
	    	 		else if(component.group.selectedValue=="Bets")
	    	 		{ 
	    	 	 
				 	var groups:Array=jok[1]  ; 
					var sports:Array= jok[0]  ; 
					var resCor:String;
						 
					  
						    for(var i:uint=0;i<sports.length;i++)
						    {	
						     
						        var groupsAC:ArrayCollection=new ArrayCollection();
						        for(var ie:uint=0;ie<groups.length;ie++)
						   		{ 
						   			if(groups[ie][0]==sports[i][0])
						   			{ 
						   			    groupsAC.addItem({"oddname":groups[ie][1],"odd":groups[ie][2],"betTypeId":groups[ie][3]});
						   			    
						   			    if(sports[i][13]!=null)
							 			{
							 				 if(groups[ie][7]==sports[i][13])
							 				 {
							 				 	resCor= groups[ie][0];
							 				 }
							 			} 
						   			}
						   	 	}
					 			   	     
					 			
						    	 _betsAC.addItem({"eventBet":sports[i][0],"nameBet":sports[i][6], "active":sports[i][5],"databets":groupsAC,"dateinfo":sports[i][1],"count":sports[i][3],"betId":sports[i][2],"eventname":sports[i][4]  })
				               
				                if(_service.eventId==0)
					                { 
				             
				                   _eventNames.addItemToAc(sports[i][4],sports[i][7]) ;
				          	      }
				      }
					              
					          
						      if(_service.eventId==0)
				                {
				                      component.eventCB.dataProvider=_eventNames;
				                }
						   //  _betsAC.getItemAt(0).toString()
						
						    component.rep.dataProvider= _betsAC;
						 //   component.rep2.dataProvider= _betsAC;
	    	 			
	    	 			
	    	 				  
	    	 		}  
	    	 		
	    	 	}
	    	 	else
	    	 	{ 
	    	 		     var _betsAC:ArrayCollection=new ArrayCollection();
	    	 		     component.rep.dataProvider= _betsAC;
	    	 	}
	    	 	{
	    	 		
	    	 	}
				 
		   }
		   else
		   {
		   		 
		   }
	        trace(_checkData.status)
		     event.currentTarget.removeEventListener("result", selectGroupsData);    
	 	}
 	  	
        public function showWindowOdds(i:uint):void 
        { 
        	     _service.betsId=_betsAC.getItemAt(i)['eventBet'];
        	     _service.callSelectViewOdds(resViewBet);
        }
         
         public function showWindow(eventBet,betId,groupId):void 
         {        
         	 
         	      _service.groupsIdBetEdit=groupId;
         	 	 _service.betsId=eventBet;
         	 	   _service.eventBetId=betId; 
              if(component.group.selectedValue=="Events")
		 	   {	  
		 	   	    if(_service.status==3)
		 	   	  {
		 	   
             		_service.callEditEventService(resultEditOnlyBet);
		 	   	  }
		 	   	  else
		 	   	  {
		 	   	  	 Alert.show("You can only edit un-active events")
		 	   	  } 
		 	   }
			   else if(component.group.selectedValue=="Bets")
		 	   {
		 	   	  
		 	   	  if(_service.status==3)
		 	   	  {
		 	   	
              	 	 _service.callSelectBetEdit(resultEditBet);
		 	   	  }
		 	   	  else if(_service.status==0)
		 	   	  {
		 	   
        	     	 _service.callSelectViewOdds(resViewBet);
		 	   	  }
		 	   	  else if(_service.status==1)
		 	   	  {
	 
              	 	 _service.callSelectBetEnd(resultEditBetEnd);
		 	   	  }
		 	   	  
		 	    
		 	   } 
         }

		
		
		public function resultEditOnlyBet(event:ResultEvent):void
		{    	 
			    if(_checkData.validation(event.result))
			    { 
				     var login:EditOnlyBets=EditOnlyBets(PopUpManager.createPopUp( component, EditOnlyBets , true));
	                login.width=component.box.width;
	                login.height=component.box.height;   
	                login.dataAC(event.result as Array );   
			    }
			    event.currentTarget.removeEventListener("result",resultEditOnlyBet);
		}
		
		public function resultEditBetEnd(event:ResultEvent):void
		{    	 
		 
			    if(_checkData.validation(event.result))
			   {
			    
			  
			     var login:EditBetsEnd=EditBetsEnd(PopUpManager.createPopUp( component, EditBetsEnd , true));
                login.width=component.box.width;
                login.height=component.box.height; 
                
                var arr:Array=event.result as Array; 
                login.dataAC(arr[0],arr[1]  );  
            
			    } 
			   event.currentTarget.removeEventListener("result",resultEditBetEnd);
		}
			
		
		public function resultEditBet(event:ResultEvent):void
		{    	  
			    if(_checkData.validation(event.result))
			   { 
			     var login:EditBets=EditBets(PopUpManager.createPopUp( component, EditBets , true));
                login.width=component.box.width;
                login.height=component.box.height; 
                
                var arr:Array=event.result as Array; 
               
                login.dataAC(arr[0],arr[1],arr[4], _eventNames );  
            
			    } 
			   
			   event.currentTarget.removeEventListener("result",resultEditBet);
		}
 	  	
 	  	public function resViewBet(event:ResultEvent):void
 	  	{     
 	  		 
 	  		   if(_checkData.validation(event.result))
			   {
		           var login:ViewOdds=ViewOdds(PopUpManager.createPopUp( component, ViewOdds , true));
             	   login.width=component.box.width;
             	   login.height=component.box.height;
             	   login.dataAC= event.result as Array ; 
             	   event.currentTarget.removeEventListener("result",resViewBet);
      			}
      			else
      			{
      				 
      			}  
 	  	}
 	  	
 	  	private function selectHandler(event:Event):void
 	  	{
 	  	    component.sportsAndGroups.dataProvider=model('SportsBetsModel').sportsAndGroups;
 	  	}
 	  	
 	  	
 	  	private function resultMainSelect(event:ResultEvent):void
		{  
			 	 _resultEventData.addItemAt({"name":"All","eventId":"0"},0); 
 	   
 	  	  		var groups:Array=event.result[1] ; 
				var sports:Array=  event.result[0]  
		    	_sportAndGroup =new ArrayCollection();  
		    
		    
		     var betsAC1:ArrayCollection=new ArrayCollection();
		    betsAC1.addItem({"name":"Non-Active" ,"groupsId":"0","nameGroup":null });
		    betsAC1.addItem({"name":"Active" ,"groupsId":"0","nameGroup":null });
		    betsAC1.addItem({"name":"Finished" ,"groupsId":"0","nameGroup":null }); 
		   
		   _sportAndGroup.addItem({"name":"All",children:betsAC1 })
		    
		    for(var i:uint=0;i<sports.length;i++)
		    {	
		        var groupsAC:ArrayCollection=new ArrayCollection();
		        var editGroupsAC:ArrayCollection=new ArrayCollection();
		        for(var ie:uint=0;ie<groups.length;ie++)
		   		{
		   		var betsAC:ArrayCollection=new ArrayCollection();
		   			 betsAC.addItem({"name":"Non-active" ,"groupsId":null,"nameGroup":null  });
		 	         betsAC.addItem({"name":"Active" ,"groupsId":null,"nameGroup":null  });
		 	         betsAC.addItem({"name":"Finished" ,"groupsId":null,"nameGroup":null  }); 
		 	         
		   			if(groups[ie][0]==sports[i][1])
		   			{
		   				betsAC.getItemAt(0)['groupsId']=groups[ie][1];
		   				betsAC.getItemAt(1)['groupsId']=groups[ie][1];
		   				betsAC.getItemAt(2)['groupsId']=groups[ie][1]; 
		   				betsAC.getItemAt(0)['nameGroup']=groups[ie][2];
		   				betsAC.getItemAt(1)['nameGroup']=groups[ie][2];
		   				betsAC.getItemAt(2)['nameGroup']=groups[ie][2]; 
		  
		   	        	groupsAC.addItem({"name":groups[ie][2],"groupsId":groups[ie][1],children:betsAC});
		   			}
		   	 	}
		   	 	 
		    	_sportAndGroup.addItem({"name":sports[i][0],"children":groupsAC});   
		       
		    } 
		    
		    component.sportsAndGroupsVMC.dataProvider=_sportAndGroup;
		    event.currentTarget.removeEventListener("result",resultMainSelect);
		}
		
 	  	 public function changeGroup(event:ItemClickEvent)
 	  	 {
 	  	 	if(component.group.selectedValue=="Events")
		 	   {
		 	   		_service.callSelectSportOnlyBets(selectGroupsData);
		 	   		component.filterCBEvent.enabled=false; 
					component.filerEventHBox.enabled=false;  
		 	   }
			   else if(component.group.selectedValue=="Bets")
		 	   {
		 	   		 _service.callSelectBets(selectGroupsData) ;
		 	     	component.filterCBEvent.enabled=true; 
					component.filerEventHBox.enabled=false; 
		 	   }
 	  	 }
	 	 
	 	 
	
	 	  
	 	  public function selectSavedBet(event:ResultEvent):void
	 	  { 
	 	  	if(event.result=="ok")
	 	  	{
	 	  	   _service.callSelectBets(selectGroupsData); 
	 	  	}
	 	  }
	 	 
	 	 public function addCorectInstance(event):void
	 	 { 
	 	 	  
	 	 	_betsAC.getItemAt(event[0])['result']= _betsAC.getItemAt(event[0])['databets'].getItemAt(event[1])['betTypeId'] ;  
	         component.corectLabel[event[0]].text= _betsAC.getItemAt(event[0])['databets'].getItemAt(event[1])['oddname'] ;//
	     }
	 	 
	 	 public function deleteBetEvent(data):void
	 	 { 
	 	 	_service.betsId= data
	 	         Alert.okLabel = "Sent to Arhive";
	 	         Alert.buttonWidth=150; 
				var text:String='If you click on "Sent to Arhive" placed picks on this bet are off' ;
 	  			Alert.show(text,"", Alert.OK |   Alert.CANCEL ,component.box , deleteAlertHandlerEvent  ) 
 	  		 
 	  		          Alert.okLabel = "OK";
	 	     
	 	 }
	 	 
	 	 
	 	  public function deleteBet(data):void
	 	 { 
	 	 	
	 	 	 _service.betsId=data;
	 	         Alert.okLabel = "Sent to Finished";
	 	         Alert.buttonWidth=150;
                Alert.yesLabel = 'Sent to Arhive';
				var text:String='If you click on "Sent to Finished" placed picks on this bet will be valid and you have to set result for this bet\nIf you click on "Sent to Arhive" placed picks for this bets are off' ;
 	  			Alert.show(text,"", Alert.OK | Alert.YES | Alert.CANCEL ,component.box , deleteAlertHandlerBet  ) 
 	  		  Alert.okLabel = "OK"; 
	 	 }
	 	 public function deleteAlertHandlerEvent(event:CloseEvent):void
		 {
 
		 	  if (event.detail==Alert.OK) 
		 	  { 
	         	 _service.callServiceDeleteActiveEvent(resultUpdateActivesBet)
              }
           
         }
         
         public function resultUpdateActivesBet(event:ResultEvent):void
         {
         	  if(_checkData.validation(event.result))
			  {
	 	 	     _service.callSelectBets(selectGroupsData); 
	 	 		 event.currentTarget.removeEventListener("result",resultUpdateActivesBet);
	 	 	  }  
         }
	 	 
	 	 public function resultUpdateActives(event:ResultEvent):void
	 	 { 
 			
	 	 	  if(_checkData.validation(event.result))
			  {
	 	 	     _service.callSelectSportOnlyBets(selectGroupsData);
	 	 		 event.currentTarget.removeEventListener("result",resultUpdateActives);
	 	 	  }  
	 	 
	 	 }
	 	 
	 	 	 public function deleteAlertHandlerBet(event:CloseEvent):void
		 {
		 	  if (event.detail==Alert.OK) 
		 	  { 
		 	  	_service.statusDelete=0;
			 	 _service.callServiceDeleteActiveBet(resultUpdateActives)
              }
              else if (event.detail==Alert.YES) 
              {
              	_service.statusDelete=1;
               	_service.callServiceDeleteActiveBet(resultUpdateActives)
              } 
         }
	 	 
	 	 
	 	 public function deleteEvent(eventBet,betId):void
	 	 {
	 	      if(component.group.selectedValue=="Events")
		 	   {
		 	   	  if(_service.status==3)
		 	   	  {
		 	   		    _service.betsId=betId;
						_service.callDeleteBet(deleteEventBet);
		 	   	  }
		 	   	  else if(_service.status==0 )
		 	   	  { 
		 	        deleteBet(betId)
		 	   	  }
		 	   	  else if(_service.status==1)
		 	   	  {
		 	   	  	deleteBetFinished(betId)
		 	   	  } 
		 	   }
			   else if(component.group.selectedValue=="Bets")
		 	   {
		 	   	  if(_service.status==3)
		 	   	  {
		 	   		  _service.deleteEventId=eventBet;
	 	 			  _service.callDeleteEventBet(deleteEventBet);
		 	   	  }
		 	   	  else if(_service.status==0||_service.status==1)
		 	   	  { 
		 	           deleteBetEvent(eventBet)
		 	   	  } 
		 	   }  
	 	 }
	 	 
	 	 public function deleteBetFinished(data):void
	 	 {     
	 	 	   _service.betsId=data
	 	        Alert.okLabel = "Sent to Arhive";
	 	        Alert.buttonWidth=150; 
				var text:String='If you click on "Sent to Arhive" placed picks for this bets are off' ;
 	  			Alert.show(text,"", Alert.OK |  Alert.CANCEL ,component.box , deleteAlertHandlerBetFinished  ) 
 	  		    Alert.okLabel = "OK"; 
	 	     
	 	 }
	 	 
	 	 public function deleteAlertHandlerBetFinished (event):void
	 	 {
	 	 	if (event.detail==Alert.OK) 
		 	{ 
		 	  	_service.statusDelete=2;
			 	 _service.callServiceDeleteActiveBet(resultUpdateActives)
            }
	 	 }
	 	 
	 	 public function deleteEventBet(event):void
	 	 {  
	 	 	  if(_checkData.validation(event.result)) 
	    	 {
	 	 	       _service.callSelectBets(selectGroupsData);
	 	 	       event.currentTarget.removeEventListener("result",resultMainSelect);
	 	 	       callBetEventService()
	 	 	  }  
	 	 	  else
	 	 	  {
	 	 	  }
	 	 }
			 public function  updateOdds(data,updateText):void
     		 {  
     			  _service.odd=updateText;
     			  _service.oddName="text";
     			 _service.betsId=data;
    			 // _service.callUpdateBetType( test)
     		  }
     		  
      
     	      
     	    public function callAddBet(id:uint):void
     	    {
  					 component.group.selectedValue="Bets"; 
     	    	  	_service.betsIdEvent=id
     	    		 _service.callSelectBets(selectGroupsData) ; 
     	    		 component.mainBetPanel.title = component.mainBetPanel.title=_titleSport+groupTitle+" "+ titleStatus+" - "+_betsAC.getItemAt(0)['nameBet'] ; 	  
     	     }
 
 }
}