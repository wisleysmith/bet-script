/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.core.service
{

	import malt.core.model.ModelBase;
	import malt.core.service.ServiceBase;
	
	
	public class Service 
	{
	 
	    private var _modelBase:ModelBase; 
	    private var _serviceBase:ServiceBase
		
		public function Service()
		{
			 
		    _modelBase=ModelBase.getInstance();
		    _serviceBase=ServiceBase.getInstance();
		    
		}
		
	  
		public function   model(data:String):Object
		{
		  return _modelBase.getModelObject(data) 
        }
		
		public function getInstance():Object
		{
			return this;
		} 
		
	 
		
		public function  service(data:String):Object
		{
			return _serviceBase.getService(data);
		}
		
 
	}
}