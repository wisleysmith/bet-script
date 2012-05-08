/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */

package malt.components.actions
{ 
	 import malt.components.classes.CheckData;
	 import malt.components.controls.OneBetInfo;
	 import malt.components.controls.EditPlayerBank;
	 import malt.components.controls.EditPlayerBets;
	 import malt.components.service.PlayersAction;
	 import malt.core.controls.Actions;
	 import malt.components.controls.EditPlayer;
	 import mx.collections.ArrayCollection;
	 import mx.controls.Alert;
	 import mx.events.ValidationResultEvent;
	 import mx.managers.PopUpManager;
	 import mx.rpc.events.ResultEvent;
     
	 
	 
	public class Players extends Actions
	{  
		private var _service:PlayersAction;
	    private var _checkData=CheckData.getInstance(); 		
 		private var   selektet:uint;
 		private var   selektetSearch:uint;

	 	public function tabChange(event ):void
	 	{
	 		if(event.currentTarget.selectedIndex==0)
	 		{
	 			callPlayers()
	 		}
	 		else if(event.currentTarget.selectedIndex==1)
	 		{
	 	
  	  			
	 		}
	 	}
	 	
	 	public function setPlayersType():void
	 	{
	 		 _service.playerOrAdmin=component.playerGroup.selectedValue ;
	 		 _service.fromPagging=0;
	 		  _service.callSelectPlayersService(resultDataUsers);
	 	}
	  
	 	public function reset():void
	 	{
	 		    component.username.text="";
  	  			component.pass.text="";
  	  			component.funds.text="0";
  	  			component.namedata.text="";
  	  			component.lastname.text="";
  	  			component.email.text="";
  	  			component.adminOrUser.selectedIndex=0;
  	  			component.retPass.text="";
	 	}
		
	    public function constructComponent():void
 		{ 
 			 _service=new PlayersAction;
 			 _service.playerOrAdmin=0
 			 _service.fromPagging=0;
 		     _service.bookhouseId=model('Global').bookhouseId;
 			callPlayers()
  	  	}   
  	  	
  	  	public function callPlayers():void
  	  	{
  	  		 _service.callSelectPlayersService(resultDataUsers);
  	  	}
  	  	
  	  	
  	  	public function resultDataUsers(event:ResultEvent):void
  	  	{ 
  	  		  if(_checkData.validation(event.result)) 
	    	 {
  	  		var array=event.result as Array;
  	  		
  	  		 var array=event.result as Array;
		  	 var countData:uint=1;
		  	   if(array[1]!=0)
				{
					countData=array[1] 
				}
  	  		
  	  		
  	  		component.paging.dataNumber=countData;
  	  	  	component.dgUsers.dataProvider=new ArrayCollection(array[0])
  	  	    event.currentTarget.removeEventListener("result",resultDataUsers);
  	  	    component.paging.component('TogleButtonBar').selectedIndex=  selektet;
  	  	 	}
  	  	}
  	  	
       public function resultDataSearch(event:ResultEvent):void
  	  	{
  	  	     if(_checkData.validation(event.result)) 
	    	 {
  	  		 
			  	  var array=event.result as Array;
			  	 var countData:uint=1;
			  	   if(array[1]!=0)
					{
						countData=array[1] 
					}
			
	  	  	   component.pagingSearch.dataNumber=countData; 
	  	  	  	component.dgUsersSearch.dataProvider=new ArrayCollection(array[0])
	  	  	    event.currentTarget.removeEventListener("result",resultDataSearch);
	  	  	    component.pagingSearch.component('TogleButtonBar').selectedIndex=  selektetSearch; 
  	  	      }
  	  	}
  	  	
  	  	public function save():void
  	  	{   
  	  		  var vResult:ValidationResultEvent;
  	  				
  	  		      
  	  		     
  	  		     vResult = component.namedataValid.validate();
                if (vResult.type==ValidationResultEvent.INVALID) 
                    return;
        		
                   vResult = component.usernameValid.validate();
                if (vResult.type==ValidationResultEvent.INVALID) 
                    return;
 
                vResult = component.emailValid.validate();
                if (vResult.type==ValidationResultEvent.INVALID) 
                    return;
  	  		
  	  		 vResult = component.passValid.validate();
             if (vResult.type==ValidationResultEvent.INVALID) 
                    return;
  	  		
  	  		 vResult = component.retPassValid.validate();
             if (vResult.type==ValidationResultEvent.INVALID) 
                    return;
  	  		
  	  		 vResult = component.fundsValid.validate();
                if (vResult.type==ValidationResultEvent.INVALID) 
                    return;
  	  		
  	  		
  	  		if(component.retPass.text!=component.pass.text)
  	  		{
  	  			Alert.show("Password and retype password dont match")
  	  			return
  	  		}
  	  		
  	  		_service.username= component.username.text;
  	  		_service.password=component.pass.text;
  	  		_service.money=component.funds.text;
  	  		_service.firstname=component.namedata.text;
  	  		_service.lastname=component.lastname.text;
  	  		_service.email=component.email.text;
  	  		_service.adminOrUser=component.adminOrUser.selectedLabel;
  	  		_service.callInsertPlayersService(resultData)
  	  	}
  	  	
  	  	private function resultData(event:ResultEvent):void
  	  	{      
  	  		trace(event.result)
  	  	   if(_checkData.validation(event.result)) 
	    	 {
	    	 	Alert.show("User is set")
	    	    component.username.text="";
  	  			component.pass.text="";
  	  			component.funds.text="0";
  	  			component.namedata.text="";
  	  			component.lastname.text="";
  	  			component.email.text="";
  	  			component.adminOrUser.selectedIndex=0;
  	  			component.retPass.text="";
	    	 } 
	    	else 
	    	{
	    	  	 if(_checkData.status=="duplicate")
		      	 {
		      	  	 if(_checkData.message=="duplicate User")
		    		{
		    			Alert.show("User name alredy exist, please change username")
		    		}
		    		else if (_checkData.message=="duplicate Email")
		    		{
		    				Alert.show("Email alredy exist, please change email")
		    		}
		    		else
		    		{
		    			 
		     	    } 
		      	  }
	    	 }   
	    	   event.currentTarget.removeEventListener("result",resultData);
  	  	}
  	  	public function resultDeletePlayer(event:ResultEvent):void
  	  	{
  	  	    callPlayers()
  	  	    event.currentTarget.removeEventListener("result",resultDeletePlayer);
  	  	}
  	  	
  	  	public function deletePlayer(data):void
  	  	{
  	  		 _service.userEditId=data; 
  	  		_service.callServiceDeletePlayer(resultDeletePlayer)
  	  	}
  	  	 
  	  	public function editPlayer(data ):void
  	  	{ 
  	  	    _service.userEditId=data;
  	  	    _service.callServiceOneUser(editPlayerResult)
  	  	}
  	  	
  	  	public function editPlayerResult(event:ResultEvent):void
  	  	{   
  	  		  if(_checkData.validation(event.result)) 
	    	 {
	    	 	  var login:EditPlayer=EditPlayer(PopUpManager.createPopUp( component, EditPlayer , true));
                 login.dataAC(event.result as Array);  
	    	 }
	    	 else
	    	 {
	    	 	Alert.show("Problems on server, please try later.")
	    	 } 
	    	   	  	    event.currentTarget.removeEventListener("result",editPlayerResult);
  	  	}
  	  		
  	  	public function editBets(data ):void
  	  	{
  	  		   var login:EditPlayerBets=EditPlayerBets(PopUpManager.createPopUp( component, EditPlayerBets , true));
  	  		   login.width=component.box.width;
               login.height= component.box.height; 
                login.dataAC(data);  
  	  	}
  	  	
  	  		
  	  	public function editBank(data ):void
  	  	{
  	  		   var login:EditPlayerBank=EditPlayerBank(PopUpManager.createPopUp( component, EditPlayerBank , true));
               login.width=component.box.width;
               login.height= component.box.height; 
               login.dataAC(data);  
  	  	} 
  	  	
  	  	
  	  	public function statPlayer(data:uint):void
  	  	{
  	  		   
  	  	}
  	  	
  	  	public function doSearch():void
  	  	{
  	  	    _service.fromPaggingSearch=0;
  	  		_service.searchTermin=component.searchCompData.text;
  	  		_service.searchTerminCriteri=component.playerCBcriteri.selectedIndex;
  	  		_service.callSearchPlayer(resultDataSearch)
  	  		 selektetSearch=0;
  	  	}
  	  	
  	  	public function paggingSearch(event):void
  	  	{
  	  		_service.searchTermin=component.searchCompData.text;
  	  		 _service.searchTerminCriteri=component.playerCBcriteri.selectedIndex;
  	  		 _service.fromPaggingSearch=event.message.label*30-30; 
 			 _service.callSearchPlayer(resultDataSearch); 
  	  		 selektetSearch=event.message.index;
  	  	}
  	  	
  	  	public function pagging(event):void
  	  	{
  			 _service.fromPagging=event.message.label*30-30; 
 			 _service.callSelectPlayersService(resultDataUsers); 
 			  selektet=event.message.index;
  	  	}
	}	
}