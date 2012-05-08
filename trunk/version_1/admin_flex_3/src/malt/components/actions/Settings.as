/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */

package malt.components.actions
{
   	import malt.components.service.BookhouseAction;
   	import malt.core.controls.Actions;
   	
   	import mx.rpc.events.ResultEvent; 
    
	public class Settings  extends Actions
	{ 
		private var _service:BookhouseAction=new BookhouseAction();
	 	public function constructComponent():void
 		{   
 	 		_service.callBookhouseData(resultBookhouseData)
  	  	}
  	  	
  	  	public function resultBookhouseData(event:ResultEvent):void
  	  	{
  	  		var array:Array=event.result as Array;
		  	  	component.nameDB.text=array[0][0];
				component.timezone.text=array[0][1];
				component.funds.text=array[0][2];
				component.register.selectedIndex=array[0][3];
  	  		event.currentTarget.removeEventListener("result",resultBookhouseData);
  	  	}  
  	  	
  	  	public function update():void
  	  	{
  	  		_service.callUpdateBookhouseData(resultUpdateData)
  	  	} 
  	  	
  	  	public function resultUpdateData(event:ResultEvent):void
  	  	{
  	  			if(_service.status==0)
  	  			{
  	  				component.funds.text=event.result
  	  			}
  	  			else
  	  			{
  	  				component.register.selectedIndex=event.result
  	  			}
  	  	}
  	  	
  	  	public function changeStatus():void
  	  	{
  	  		 	_service.updateData=component.register.selectedIndex ;
     	       	_service.status=1 ;
     	       	update()
  	  	}
  	  	
 	 	public function updateFunds():void
 	 	{
 	 	        _service.updateData=component.funds.text;
 	 		   	_service.status=0;
 	 		   	update()
 	 	}

 }
}