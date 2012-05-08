/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.actions
{
	      
	 
	import malt.components.classes.CheckData;
	import malt.components.service.BetsAction;
	import malt.core.controls.Actions;
	
	import mx.collections.ArrayCollection;
	import mx.controls.Alert;
	import mx.events.MenuEvent;
	import mx.rpc.events.ResultEvent;
	
	public class  Bets  extends Actions
	{
		private var _service:BetsAction;  	 
		private var _sportAndGroup:ArrayCollection;	 
		private var _betsAC:ArrayCollection;
        private var _checkData:CheckData;
		private var  _resultEventData:ArrayCollection;
		private var _editSportAndGroup:ArrayCollection;
		private var _titleSport:String
		private var _eventArrayC:ArrayCollection;
		private var _betHolderData:ArrayCollection;
	 	public function constructComponent():void
 		{   
 		 
 		    _service=new BetsAction();
      
             
            _betsAC=new ArrayCollection();  
            _resultEventData=new ArrayCollection();
            _checkData= CheckData.getInstance(); 
            
            if( model('Global').bookhouseId!=0)
            {
            	_service.callSetDataForBet(resultMainSelect); 
            }
            
            model('Global').addEventListener("refreshBetsData",refreshBets)
            model('Global').addEventListener("bookhouseId",idIsSet)
 		    
  	  	} 
 	 
 	 public function idIsSet(event):void
 	 {
 	 	 
 	 	_service.callSetDataForBet(resultMainSelect);
 	    event.currentTarget.removeEventListener("result",idIsSet);    
 	 }
 	 
 	 public function set appId(appId:uint)
 	 {
 	
 	 	 model('Global').bookhouseId=appId
 	 	 
 	 } 	
 	 
 	public function  oddFormat(data:*):String
    {
    	 
		if(model('Global').oddFormat=="decimal")
		{
		   return String(data)	
		}
		else if(model('Global').oddFormat=="fractional")
		{
			 data--
		   
		   	  for(var i=1;i<10000;i++)
		   	  {
		   	  	var check=data*i
		   	  	if(check  is uint)
		   	  	{
		   	  		 
		   	  		 return check+"/"+i;
		   	  		break
		   	  	}
		   	  }
		    
		}
		else if(model('Global').oddFormat=="american")
		{
			   data--
		   
		   	  if(data<2)
		   	  {
		   	  	return  "-"+String(uint(100/data));
		   	  }
		   	  else
		   	  {
		   		  return "+"+String(data*100);
		   	  }
		    
		}
		
 return ""
						
	}
			   		    						 
 	 
 	public function loadBets(data:uint):void
 	{
 		_service.groupsId=_eventArrayC.getItemAt(data)['groupId'];
 		_service.eventId=_eventArrayC.getItemAt(data)['eventId'] ;
 		_service.callUserActiveBet(selectGroupsData) ;
 	}
 	
 	
    public function loadBetsAdd(data ):void
 	{  
 		_service.betId=data
 		_service.callUserActiveAddBet(selectGroupsData) ;
 	}
 	
 	 public function refreshBets(event)
 	 {
 	 		_service.callUserActiveBet(selectGroupsData) ;
 	 }
 	 
  public function selectBet(event:MenuEvent):void
  {
 
    if(event.menu.selectedItem.groupsId===undefined)
    {
    }
    else
    {
    	
    	  component.mainVS.selectedIndex=1;
  	   _service.groupsId=event.menu.selectedItem.groupsId;
  	   _service.callSelectBetEvents(resultEventBetData) 
    }
    
      
     
  }
  
  public function resultEventBetData(event:ResultEvent):void
  { _eventArrayC=new ArrayCollection(event.result as Array)
  	    component.rep.dataProvider=new ArrayCollection(); 
  	 component.betEventRepeater.dataProvider=_eventArrayC
  }
 
 	  
			
		private function selectGroupsData(event:ResultEvent):void
 	    {    
 	     
 	    	 var jok:Array=event.result as Array ; 
 	    	  
 	     	 if(_checkData.validation(event.result)) 
	    	 {
	    	  
	    	 	if(_checkData.status!='null')
	    	 	{
	    	     _betsAC=new ArrayCollection();
	    	     
	    	 	 
				 	var groups:Array=jok[1]  ; 
				 	groups.reverse();
					var sports:Array= jok[0]  ;
						 
				  
					
					var resCor:String;
							 
						    for(var i:uint=0;i<sports.length;i++)
						    {	
						     
						        var groupsAC:ArrayCollection=new ArrayCollection();
						        for(var ie:uint=0;ie<groups.length;ie++)
						   		{ 
						   			if(groups[ie][0]==sports[i][0])
						   			{ 
						   			    groupsAC.addItem({"oddname":groups[ie][1],"odd":oddFormat(groups[ie][2]),"odddec":groups[ie][2],"betTypeId":groups[ie][3]});
						   			    
						   			    if(sports[i][13]!=null)
							 			{
							 				 if(groups[ie][7]==sports[i][13])
							 				 {
							 				 	resCor= groups[ie][0];
							 				 }
							 			} 
						   			}
						   	 	}
					 				 
					 			
						    	 _betsAC.addItem({"eventBet":sports[i][0],"nameBet":sports[i][4], "databets":groupsAC,"dateinfo":sports[i][1],"count":sports[i][2],"eventname":sports[i][3],"betId":sports[i][5]})
						   
						    }
						      
						    component.rep.dataProvider= _betsAC; 
	    	 	}
	    	 	{
	    	 		 
	    	 	}
				 
		   }
		   else
		   {
		   		 
		   }
		   
		    
		     event.currentTarget.removeEventListener("result", selectGroupsData);    
	 	}
	   
	  
 	  	
 	  	private function resultMainSelect(event:ResultEvent):void
		{  
 
			 if(_checkData.validation(event.result)) 
	    	 { _resultEventData.addItemAt({"name":"All","eventId":"0"},0); 
 	   
 	  	  		var groups:Array=event.result[1] ; 
				var sports:Array=  event.result[0]  
		 
		    	_sportAndGroup =new ArrayCollection();  
		    
 
		    
		    for(var i:uint=0;i<sports.length;i++)
		    {	
		        var groupsAC:ArrayCollection=new ArrayCollection();
		        var editGroupsAC:ArrayCollection=new ArrayCollection();
		        for(var ie:uint=0;ie<groups.length;ie++)
		   		{
		   		var betsAC:ArrayCollection=new ArrayCollection();
 
		   			if(groups[ie][2]==sports[i][0])
		   			{
                        groupsAC.addItem({"name":groups[ie][0],"groupsId":groups[ie][1]});
		   			}
		   	 	}
		   	 	 
		    	_sportAndGroup.addItem({"name":sports[i][1],"children":groupsAC});   
		       
		    } 
		    
		    component.sportsAndGroupsVMC.dataProvider=_sportAndGroup;
	    	 }
	   
		    event.currentTarget.removeEventListener("result",resultMainSelect);
		}
		
	 

	public function addBet(data:Object,data2:ArrayCollection,int:uint ):void
	{
         
		var testingEventId:Boolean=true
		var len:uint=model('Global').betPlaced.length;
		for(var i:uint=0;i<len;i++)
		{
			if(model('Global').betPlaced.getItemAt(i)['betId']==data.betId)
			{
				testingEventId=false
				break;
			}
		}
		
		if(testingEventId)
		{
		  model('Global').betPlaced.addItem({'eventBet':data.eventBet,'name':data.nameBet,'oddname':data2.getItemAt(int)['oddname'],'odddec':data2.getItemAt(int)['odddec'],'odd':data2.getItemAt(int)['odd'],'betTypeId':data2.getItemAt(int)['betTypeId'],"betId":data.betId})
		}
		else
		{
			Alert.show("Samo jedan događaj po listiću")
		}
	
	}
 }
  
}