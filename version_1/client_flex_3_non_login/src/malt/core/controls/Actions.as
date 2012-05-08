/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.core.controls
{

	import malt.core.model.ModelBase;
	import malt.core.service.ServiceBase;
	
	
	public class Actions 
	{
		private var _id:String;
	    private var _componentHolder:*;
	    private var _modelBase:ModelBase;  
		
		public function Actions()
		{
		   _modelBase=ModelBase.getInstance(); 
		}
		
		public function get component():Object
		{
		  return _componentHolder 
		}
		
		public function   componentMain(data):void
		{
			_componentHolder=data
		}
		
		public function   model(data:String):Object
		{
		  return _modelBase.getModelObject(data) 
        }
		
		public function getInstance():Object
		{
			return this;
		} 
		
	 
		
 
	}
}