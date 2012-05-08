/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.core.service
{ 
	
	public class ServiceBase
	{
		private static var _instance:ServiceBase;
	    private var _service:Object;
	 
	 	public function ServiceBase(pvt:PrivateClass)
		{
		   _service=new Object();
	 	}
		
		public static function getInstance( ):ServiceBase
		{
			if(ServiceBase._instance == null)
			{
				ServiceBase._instance=new ServiceBase(new PrivateClass( ));
		 	}
			else
			{
			 
			}
			return ServiceBase._instance;
		}
		
	    public function setService(name:String,data:Object):void
		 {
		 	_service[name]=data
		 }
		 
		 public function getService(data:String):*
		 {
		    return	_service[data]
		 }
		
		
		 
		 
	}
}

class PrivateClass
{
	public function PrivateClass( ) 
	{
 
	}
}
 