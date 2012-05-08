/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.model
{
	import malt.core.model.ModelManager;
	 
	  
	public class PlayersModel extends ModelManager  
	{ 
		private var _username:String;
		private var _password:String;
		private var _money:String;
		private var _firstname:String;
		private var _lastname:String;
		private var _email:String;
		
	     public function set email(data:String):void
        {
            _email=data;  
        }
        
        public function get email():String
        {
        	return _email;
        }  
        
		  
	    public function set username(data:String):void
        {
            _username=data;  
        }
        
        public function get username():String
        {
        	return _username;
        }  
        
         public function set password(data:String):void
        {
            _password=data;  
        }
        
        public function get password():String
        {
        	return _password;
        }  
        
         public function set money(data:String):void
        {
            _money=data;  
        }
        
        public function get money():String
        {
        	return _money;
        }  
        
         public function set firstname(data:String):void
        {
            _firstname=data;  
        }
        
        public function get firstname():String
        {
        	return _firstname;
        }  
        
         public function set lastname(data:String):void
        {
            _lastname=data;  
        }
        
        public function get lastname():String
        {
        	return _lastname;
        }  
		 
	}
}