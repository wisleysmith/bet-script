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
	    	
	    	import mx.collections.ArrayCollection;
	    	import mx.controls.Alert;
	    	import mx.events.ValidationResultEvent;
	    	import mx.rpc.events.ResultEvent;
  	
	public class  MySettings  extends Actions
	{
		    private var _service:PlayersAction;
		  	  private var   _checkData=CheckData.getInstance(); 		
  			var dataUser:ArrayCollection
	   public function constructComponent():void
 		{   
  				_service=new PlayersAction();
 		       _service.callServiceOneUser(resultData)
 		           
  	  	} 
  	  	 
  			
     		public function  dataAC(data:Array ):void
     		{ 
     		
     			 dataUser=new ArrayCollection(data) ;
     			 reset();
 		    }
     		
     		
     	  public function update( ):void 
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
  	  		

  	  		if(component.passRetype.text!=component.pass.text)
  	  		{
  	  			Alert.show("Lozinka i potvrda lozinke ne odgovaraju")
  	  			return
  	  		}
  	  		 		
  	  		 	 
  	  		   _service.username= component.username.text;
  	  		   _service.firstname=component.namedata.text;
  	  		   _service.lastname=component.lastname.text;
  	  		   _service.email=component.email.text;   
		  	   _service.password=component.pass.text; 
		  	   _service.callUpdatePlayersService(resultData) 
           }
 	  		 
 	  		 
 	  		 public function resultData(event:ResultEvent):void
 	  		 {  
 	  		        
 	  		     if( _checkData.validation(event.result))
 	  		     {
 	  		       dataUser=new ArrayCollection(event.result as Array);
 	  		       component.username.text=    dataUser.getItemAt(0)['name'];
 	  		       component.namedata.text=   dataUser.getItemAt(0)['firstname'];
 	  		       component.lastname.text=  dataUser.getItemAt(0)['lastname'];
 	  		       component.email.text=  dataUser.getItemAt(0)['mail'];  
 	  		       
	 	  		 
 	  		     }  
 	  		     else
 	  		     {
 	  		     	if(_checkData.status=="duplicateUser")
 	  		     	{
 	  		     		Alert.show("Korisničko ime postoji, molimo odaberite drugačije korisničko ime")
 	  		     		component.username.text=dataUser.getItemAt(0)['name'] ;
 	  		     	}
 	  		     	else if(_checkData.status=="duplicateEmail")
 	  		     	{
 	  		     		Alert.show("Email postoji, molimo odaberite drugačiju email adresu")
 	  		     		 component.email.text=dataUser.getItemAt(0)['mail'] ;
 	  		     	}
 	  		     	else
 	  		     	{
 	  		     		Alert.show("Provjerite unešene podatke")
 	  		     		reset();
 	  		     	}
 	  	
 	  		     }
 	  		 		     	trace(_checkData.status)
 	  		 	 
 	  		 	 
 	  		  }
 	  		  
 	  	  
 	  		 public function reset():void  
 	  		 {
     		 	component.username.text=dataUser.getItemAt(0)['name'] ;
     		 	component.namedata.text=dataUser.getItemAt(0)['firstname'];
     		 	component.lastname.text=dataUser.getItemAt(0)['lastname']  ;
     		 	component.email.text=dataUser.getItemAt(0)['mail'] ;
     		 }
     		 
 	  		 
 	  	
    } 
 	  	
 	 
  
}