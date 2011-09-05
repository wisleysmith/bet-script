/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.core.containers
{
	import mx.core.LayoutContainer;
	import malt.components.service.*;
	
	public class ServiceHolder extends LayoutContainer
	{
		private var _serviceFunction:Class;
		
		public function ServiceHolder()
		{
		}
		
		public function get call():Class
		{
			return _serviceFunction
		}
		
		public function set action(ob:Class)
		{
			_serviceFunction=ob;
		}
		
		

	}
}