/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.classes
{    
    import flash.events.EventDispatcher;
	import flash.events.Event;
	import mx.controls.Alert;
	
	public class CheckData extends EventDispatcher
	{
		private var _status:String;
	    private var _message:Object;
	    private static var _instance:CheckData;
 
		public function CheckData(pvt:PrivateClass)
		
		public static function getInstance( ):CheckData
		{
			if(CheckData._instance == null)
			{
				CheckData._instance=new CheckData(new PrivateClass( ));
			 
			}
		 
			return 	CheckData._instance;
		}
	 
		
		
		public function validation(data:Object):Boolean
		{	
		   _status=data.info;
	       _message=data.message;
	 
			
	       if(data.type=="error")
	       { 
	         	displayError();
	     	   return false;
	       }
	    
	       return true
		}
		
		public function set status(data:String):void
		{
			_status = data;
		}
		
		public function get status():String
		{
		  return _status;
		}
		
		public function set message(data:Object):void
		{
			_message = data;
		}
		
		public function get message():Object
		{
		  return _message;
		}
		
		public function displayError():void
		{
			
			if(_status=="nologin")
			{
				Alert.show("Niste ulogirani"); 
				dispatchEvent(new Event("noLogin"));
 
			} 
	  }
			
	}
}
class PrivateClass
{
	public function PrivateClass( )
	{ 
	}
}

 