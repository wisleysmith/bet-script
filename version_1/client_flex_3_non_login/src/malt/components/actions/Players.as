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
     import malt.components.classes.CheckData;
	 import mx.controls.Alert;
	 import mx.events.ValidationResultEvent;
	 import mx.rpc.events.ResultEvent;
     
	 
	 
	public class Players extends Actions
	{  
		private var _service:PlayersAction=new PlayersAction();
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
	  
	  
	  public function save():void
  	  	{   
  	  		  var vResult:ValidationResultEvent;
  	  				 
  	  		     
  	  		       vResult = component.lastnameValid.validate();
                if (vResult.type==ValidationResultEvent.INVALID) 
                    return;
  	  		     
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
                    
                    vResult = component.pitanjeValid.validate();
                         if (vResult.type==ValidationResultEvent.INVALID) 
                    return;
                    
                    
                    vResult = component.odgovorValid.validate();
                         if (vResult.type==ValidationResultEvent.INVALID) 
                    return;
 
  	  		
  	  		if(component.retPass.text!=component.pass.text)
  	  		{
  	  			Alert.show("Lozinka i potvrda lozinke ne odgovaraju")
  	  			return
  	  		}
  	  		
  	  		_service.pitanje= component.pitanje.text;
  	  		_service.odgovor= component.odgovor.text;
  	  		_service.username= component.username.text;
  	  		_service.password=component.pass.text; 
  	  		_service.firstname=component.namedata.text;
  	  		_service.lastname=component.lastname.text; 
  	  	    _service.email=component.email.text;
  	  		_service.callInsertPlayersService(resultData)
  	  	}
  	  	
	  
	  public function resultData(event:ResultEvent):void
	  {
	   
	  	  if(_checkData.validation(event.result)) 
	    	 {
	    	 	Alert.show("Vaš račun je kreiran, sada se možete ulogirati")
	    	    component.username.text="";
  	  			component.pass.text=""; 
  	  			component.namedata.text="";
  	  			component.lastname.text="";
  	  			component.email.text=""; 
  	  			component.retPass.text="";
  	  		    component.pitanje.text="";
  	  		    component.odgovor.text="";
  	  		    
  	  		     component.registriranPoruka.visible=true
				 component.registriranPoruka.includeInLayout=true
				 component.forma.visible=false
				 component.forma.includeInLayout=false
	    	 } 
	    	else {
	    		 
	    		   if(_checkData.status=="duplicate")
			      	 {
			      	  	 if(_checkData.message=="duplicate User")
			    		{
			    			Alert.show("Korisničko ime postoji, odaberite drugačije korisničko ime")
			    		}
			    		else if (_checkData.message=="duplicate Email")
			    		{
			    				Alert.show("Email postoji, molim odaberite drugačiju email adresu")
			    		}
			    	 
			      	  }
	    		 
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