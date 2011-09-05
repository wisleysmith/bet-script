/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.service
{
 
   import malt.components.service.BookhouseService;
	public class BookhouseAction  
	{
     	 private var _service:BookhouseService;
     	 public var  updateData:Number;
     	 public var status:uint;
		public function BookhouseAction()
		{
			_service =new BookhouseService();
		}
		
	     
		public function callBookhouseData(func:Function):void
		{  
		    _service.Bookhouse.callDatabaseData.addEventListener("result",func);
			_service.Bookhouse.callDatabaseData(); 
		}
	 
	 	     
		public function callUpdateBookhouseData(func:Function):void
		{  
		    _service.Bookhouse.updateBookhouseData.addEventListener("result",func);
			_service.Bookhouse.updateBookhouseData(updateData,status); 
		}
	 
		
	 
		
	 
	}
}