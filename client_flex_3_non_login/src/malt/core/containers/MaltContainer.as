/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.core.containers
{
	import mx.core.LayoutContainer;
	import flash.utils.getDefinitionByName;
 
 
 
   public class MaltContainer extends LayoutContainer
   {
     
        private var _className:String;
        private var _actionClass:*;
        private var _component:Object;
 
        	 
		public function MaltContainer()
		{
 			 
        }
		
	    public function set ClassName(id:String):void
		{
		  //  throw new Error("Trying to set ClassName 2times");
		     _className=id;
		     setClass()
		}
		
		public function get ClassName():String
		{
		    return _className ;
		}
		
		private function setClass():void
		{
			  var classLoc:String="malt.components.actions."+ _className;
              var component:Class=getDefinitionByName(classLoc) as Class;
             _actionClass  = new component();
         
         }
		
		public function get call():Object
		{
		  return _actionClass
		}
		
		public function run(data)
		{
			_component=data   
			_actionClass.componentMain(_component) 
			_actionClass.constructComponent()
		}
		
		
		
        public function  service():void
		{
			 
		}  
		
	 
		
	}
}