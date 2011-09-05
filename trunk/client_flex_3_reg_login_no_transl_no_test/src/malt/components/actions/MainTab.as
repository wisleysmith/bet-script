/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.actions
{ 
    import malt.core.controls.Actions;
    import mx.events.ItemClickEvent;
    
	public class  MainTab  extends Actions
	{
	    [Bindable]
	    public var sel:uint=0;
	    
		public function constructComponent():void
	    { 
	 	}   
	  	  	
	    public function toogleButton(event:ItemClickEvent):void
		{ 
	   	  	 sel=event.index;
	    }
	    
	    public function changeCB():void
	    {
	    	model('Global').oddFormat=component.oddFormat.selectedLabel
	    }
		
	}

}