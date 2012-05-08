/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.core.component
{
    import malt.core.component.ComponentHolder;
    import flash.utils.getDefinitionByName;
    import malt.core.model.ModelBase;
    import malt.core.service.ServiceBase;

    
	public class MainBase
	{
		private var _componentHolder:ComponentHolder;
		private var _class:Object;
	    private var _modelBase:ModelBase;
	    private var _serviceBase:ServiceBase;
	    
		public function MainBase()
		{
			_class=new Object();
            _componentHolder=new ComponentHolder();
            _modelBase=ModelBase.getInstance();
            _serviceBase=ServiceBase.getInstance();
		}
		
		protected function setClass(data:Object):void
		{
		 
		}
		
	    protected function setModel(data:Object):void
		{
		    var serviceNameString:String=String(data);
			serviceNameString=serviceNameString.replace("[class ","")
			serviceNameString=serviceNameString.replace("]","")
		  	var classLoc:String="malt.components.model."+ serviceNameString;
            var model:Class=getDefinitionByName(classLoc) as Class;
            var mod:Object = new model();
            _modelBase.addModelObject(serviceNameString,mod);
		}
		
		protected function setService(data:Object):void
		{
		    var serviceNameString:String=String(data);
			serviceNameString=serviceNameString.replace("[class ","")
			serviceNameString=serviceNameString.replace("]","")
		  	var classLoc:String="malt.components.service."+ serviceNameString;
            var component:Class=getDefinitionByName(classLoc) as Class;
            var com:Object = new component();
            com.id=serviceNameString; 
            _serviceBase.setService(serviceNameString,com);
		}
		
		
    }
}