/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */

package malt.components.actions
{
    import malt.components.classes.CheckData;
    import malt.components.controls.EditBets;
    import malt.components.controls.EditBetsArhive;
    import malt.components.controls.ViewOdds;
    import malt.components.service.BetsAction;
    import malt.core.controls.Actions;
    import flash.events.Event;
    import mx.collections.ArrayCollection;
    import mx.events.MenuEvent;
    import mx.managers.PopUpManager;
    import mx.rpc.events.ResultEvent;
	
 
	
	public class ArhiveBets  extends Actions
	{
		private var _service:BetsAction;  	 
		private var _sportAndGroup:ArrayCollection;	 
		private var _betsAC:ArrayCollection;
        private var _checkData:CheckData;
		private var  _resultEventData:ArrayCollection;
		private var _editSportAndGroup:ArrayCollection;
		private var _selectedSport:String;
 
		public var status=false;
 
	 	public function constructComponent():void
 		{   
 			component.mainBetPanel.title=" " 
 		    _service=new BetsAction();
            _service.bookhouseId=model('Global').bookhouseId; 
       
   
            _service.status=2
          initSportbetService()
          
            _betsAC=new ArrayCollection();  
            _resultEventData=new ArrayCollection();
 		    _checkData=CheckData.getInstance(); 		    
  	  	} 
 	  	 
 	  	 public function initSportbetService():void
 	  	 { 
 	  	 	 _service.callSetDataForBet(resultMainSelect);
 	    
 	         status=true
 	  	 }
 	   
 	   public function filterCBEvent(event):void
 	   { 
 	   	   if(event.currentTarget.selected==true)
 	   	   {
 	   	  	 	component.filerEventHBox.enabled=true
          
 	   	   }
 	   	   else
 	   	   {
               component.filerEventHBox.enabled=false
 	   	   }
         
 	   }    
 	   
 	   public function setDateToCB(event):void
 	   {
 	   	   var date:Date=new Date();
 	   	   event.currentTarget.selectedIndex=date.getMonth() ; 
 	   }
 	   
 	   public function setYearToCB(event):void
 	   {
 	   		   var date:Date=new Date();
 	   		   switch(date.getFullYear())
 	   		   {
 	   		   	   case 2009:
 	   		   	    event.currentTarget.selectedIndex=0;
 	   		   	   break
 	   		   	   case 2010:
 	   		   	    event.currentTarget.selectedIndex=1;
 	   		   	   break
 	   		   	   case 2011:
 	   		   	    event.currentTarget.selectedIndex=2;
 	   		       break
 	   		   	
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
 	  	
 	  	 public function changeTypeData():void
 	  	 {
 	  	 	if(component.eventCB.selectedIndex==0)
 	  	 	{
 	  	 		_service.eventId=0
 	  	 	}
 	  	 	else
 	  	 	{
 	  	 		_service.eventId=component.eventCB.selectedItem.eventId ; 	
 	  	 	}
 	  	 	   	_service.callSelectBets(selectGroupsData); 
 	  	 }
 	  	
 	  	public function selectBet(event:MenuEvent):void
 	  	{ 
 	  	 
 	  	  
		    if(component.filerEventHBox.enabled==true)
 	  	 	{
 	  	 		  _service.eventId=component.eventCB.selectedItem.eventId ; 	
 	  	 	} 
 	  	 	else
 	  	 	{
 	  	 		 _service.eventId=0
 	  	 	}
 	  	 	_selectedSport=_sportAndGroup.getItemAt(event.currentTarget.selectedIndex)['name'] ;
             component.mainBetPanel.title=_selectedSport;
             _service.groupsId=event.menu.selectedItem.groupsId;
	 	 	
 	  	      setArhiveState( );  
 	   
 	  	}
 	  
 	  	 
 	  	 public function callBetEventService():void
		{ 	 
			_service.callSelectBets(selectGroupsData) ;
		 }
 	  	 
	 	 
	 	 
	  
	 	 
	 	 private function setArhiveState( ):void
	 	 {  
	 	 	 
		 	_service.dateArhiveBet=component.yearCB.selectedLabel +"-"+ component.monthCB.selectedLabel+"-"+"01"+" 00:00:00";  	 
		 	_service.status=2	 
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
	    	 		 _betsAC=new ArrayCollection();
	    	    	component.rep.visible=true; 
		   	 	   component.rep.includeInLayout=true; 
		   	  
		   	 	  
	    	 	 
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
					 				   	     
					 			
						    	 _betsAC.addItem({"eventBet":sports[i][0],"nameBet":sports[i][6], "active":sports[i][5],"databets":groupsAC,"dateinfo":sports[i][1],"count":sports[i][3],"betId":sports[i][2],"eventname":sports[i][4], "result":sports[i][7],"resultCorrect":sports[i][8]  })
				 
						    }
						    
						   //  _betsAC.getItemAt(0).toString()
						   
						    component.rep.dataProvider= _betsAC;
						 //   component.rep2.dataProvider= _betsAC; 
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
	 
		    
		     event.currentTarget.removeEventListener("result", selectGroupsData);    
	 	}
 	  	 
         public function showWindow(eventBet,betId,groupId):void 
         {    
         	       _service.groupsIdBetEdit=groupId;
         	       _service.betsId=eventBet;
         	  	   _service.eventBetId=betId;  
              	 	 _service.callSelectBetEditArhive(resultEditBetEnd); 
         }

	  public function callAddBet(id:uint):void
     {
     	_service.betsIdEvent=id
        _service.callSelectBets(selectGroupsData) ; 
        component.mainBetPanel.title =_selectedSport+" "+  _betsAC.getItemAt(0)['nameBet'] ; 	  
    }
		
		public function resultEditBetEnd(event:ResultEvent):void
		{    	 
		 
			    if(_checkData.validation(event.result))
			   {
			    
			  
			     var login:EditBetsArhive=EditBetsArhive(PopUpManager.createPopUp( component, EditBetsArhive, true));
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
               
                login.dataAC(arr[0],arr[1],arr[4],arr[2] );  
            
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
				 
		   
		        _resultEventData =new ArrayCollection(event.result[2] as Array);  
		  
 	  	    	 component.eventCB.dataProvider= _resultEventData;
 	  	  	
 	  	  		var groups:Array=event.result[1] ; 
				var sports:Array=  event.result[0]  
		    	_sportAndGroup =new ArrayCollection();  
		    
		    
		 
		    
		    
		    for(var i:uint=0;i<sports.length;i++)
		    {	
		        var groupsAC:ArrayCollection=new ArrayCollection();
		        var editGroupsAC:ArrayCollection=new ArrayCollection();
		        for(var ie:uint=0;ie<groups.length;ie++)
		   		{ 
		   			if(groups[ie][0]==sports[i][1])
		   			{ 
		   	        	groupsAC.addItem({"name":groups[ie][2],"groupsId":groups[ie][1] });
		   			}
		   	 	}
		   	 	 
		    	_sportAndGroup.addItem({"name":sports[i][0],"children":groupsAC}); 
		 
		     
		       
		       
		       
		    } 
		    component.sportsAndGroupsVMC.dataProvider=_sportAndGroup;
		    event.currentTarget.removeEventListener("result",resultMainSelect);
		}
		
 
      
      
 }
}