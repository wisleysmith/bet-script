/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */

package malt.components.controls.events
{
	import flash.events.Event;
	
	public class PagingEvent extends Event
	{
	     public var message:Object;
	    
		public function PagingEvent(type:String,event:Object)
		{    
             super(type);
             message=event
        }
         public static const ENABLE_CHANGED:String = "pagingClick";
         override public function clone():Event
         {
            return new PagingEvent(type, message);
         }


	}
}