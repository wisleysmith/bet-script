/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.actions
{ 
 
	 import malt.components.classes.CheckData;
	 import malt.components.service.PlayersAction;
	 import malt.core.controls.Actions;
	 
	 import mx.controls.Alert;
	 import mx.events.ValidationResultEvent;
	 import mx.rpc.events.ResultEvent;
      
	  
	public class PasswordRemember extends Actions
	{  
  
	  private var _service:PlayersAction=new PlayersAction();
	    private var _checkData=CheckData.getInstance(); 		
 		private var   selektet:uint;
 		private var   selektetSearch:uint;
 		private var user:String;
 	    private var loginBox
 	    private var mainTab

	 	 
	  
	  public function posaljiUvod():void
  	  	{   
  	  		  var vResult:ValidationResultEvent;
  	  				 
  	  		     
  	  		     vResult = component.lastnameValid.validate();
                if (vResult.type==ValidationResultEvent.INVALID) 
                    return; 
 
                vResult = component.emailValid.validate();
                if (vResult.type==ValidationResultEvent.INVALID) 
                    return;
  	  		 
  
  	  		_service.lastname=component.lastname.text; 
  	  	    _service.email=component.email.text;
  	  		_service.callUvod(resultData)
  	  	}
  	  	
  	  	
  	  	  public function posaljiTajno():void
  	  	{   
  	  		  var vResult:ValidationResultEvent;
  	  				
  	  		       
                    
                    vResult = component.odgovorValid.validate();
                         if (vResult.type==ValidationResultEvent.INVALID) 
                    return;
   
  	  		_service.odgovor= component.odgovor.text;
  	  	    _service.username=user;
          _service.rememberLogin(result)
  	  	}
  	  	
  	  	
  	  	public function setLoginBox( loginBoxParam, mainTabParam)
  	  	{
  	  		 
  	  		  loginBox=loginBoxParam
 	    	   mainTab=mainTabParam
  	  	}
  	  	
  	  	public function result(event:ResultEvent):void
  	  	{
  	  		 
  	  		 if(_checkData.validation(event.result))
	   		{ 
	   			 	 loginBox.includeInLayout=false;
		   			 loginBox.visible=false;
		   			 mainTab.visible=true
		   			 mainTab.visible=true
		   			 mainTab.call.sel=0
	   		}
	   		else
	   		{
	   			if(_checkData.status=="nouser")
	   			{
	   				Alert.show("Pogrešan odgovor na tajno pitanje");
	   			}
	   		}    
  	  		
  	  	  event.currentTarget.removeEventListener("result",result);
  	  	}
  	  	
  	  	
	  
	  public function resultData(event:ResultEvent):void
	  {
 
	    
	  	  if(_checkData.validation(event.result)) 
	    	 {
	    	     if(_checkData.status=="null")
	    	     {
	    	     	Alert.show("Korisnik ne postoji")
	    	     } 
	    	     else
	    	     {
	    	     	var array=event.result as Array;
	    	     	component.uvod.visible=false; 
	    	     	 component.uvod.includeInLayout=false; 
	    	       component.tajno.visible=true; 
	    	     	 component.tajno.includeInLayout=true; 
	    	     	 component.pitanje.text=array[0][0]; 
	    	     	 
	    	     	  user=array[0][1];
	    	     }
	    	 } 
	    	else 
	    	{
	    	
	   
		    }
	    			
	     
	  	  event.currentTarget.removeEventListener("result",resultData);
	  }
	  
	 	public function reset():void
	 	{
	 		    component.username.text="";
  	  			component.pass.text=""; 
  	  			component.namedata.text="";
  	  			component.lastname.text="";
  	  			component.email.text=""; 
  	  			component.retPass.text="";
  	  	        component.pitanje.text="";
  	  		    component.odgovor.text="";
	 	}
		
	    public function constructComponent():void
 		{ 
 			 
  	  	}   
  	  	
  	  	public function callPlayers():void
  	  	{
  	  		 
  	  	}
  	  	
  	  	
  	  	 
	}	
}