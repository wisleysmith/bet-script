/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.core.component
{
 
	
	public class ComponentHolder 
	{
		private static var _instance:ComponentHolder;
		private var _object:Object;
		private var number=0;
		private var _service:Object;
		private var _classAction:Object;
		
		public function ComponentHolder( )
		{
			_object=new Object();
			_service=new Object();
			 
		}
		
		 
		 	
		 public function addComponentID(add:Object):void
		 {
		 	_object[add]=new Object()
		 }
		 
		 public function addComponent(add:Object,component:Object):void
		 {
		 	_object[add].component=component;
		 }
		 
		 public function addClass(add:Object,activeClass:Object):void
		 {
		 	_object[add].activeClass=activeClass;
		 }
		 
		 public function activeClass(id:String):Object
		 {
		 	return _object[id].activeClass;
		 }
		 
		 public function component(id:String):Object
		 {
		 	return _object[id].component;
		 }
		 
		
 
	}
}

 