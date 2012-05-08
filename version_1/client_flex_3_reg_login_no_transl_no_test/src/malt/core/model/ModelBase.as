/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.core.model
{ 
	
	public class ModelBase
	{
		private static var _instance:ModelBase;
		private var _object:Object;
	 
	 	public function ModelBase(pvt:PrivateClass)
		{
			_object=new Object();
	 	}
		
		public static function getInstance( ):ModelBase
		{
			if(ModelBase._instance == null)
			{
				ModelBase._instance=new ModelBase(new PrivateClass( ));
		 	}
			else
			{
			 
			}
			return ModelBase._instance;
		}
		
	    public function addModelObject(string:String,id:*):void
		{
		  _object[string]=id;
		
		}
		
		 
		 public function getModelObject(string:String):Object
		{
		    return  _object[string];
		}
		
		 
	}
}

class PrivateClass
{
	public function PrivateClass( ) 
	{
 
	}
}
 