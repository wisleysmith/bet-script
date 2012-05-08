/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.core.model
{
    import flash.events.Event;
    import flash.events.EventDispatcher;
    
	public class ModelManager extends EventDispatcher
	{
		public function ModelManager()
		{
		}
		
		public function updateModel(data):void
		{
			   dispatchEvent(new Event(data));
		}
	}
}