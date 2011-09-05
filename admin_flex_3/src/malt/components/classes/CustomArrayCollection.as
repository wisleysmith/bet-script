/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */

package malt.components.classes
{
	import mx.collections.ArrayCollection;
	
	public class CustomArrayCollection extends ArrayCollection
	{
		
		public function CustomArrayCollection()
		{
			super();
		}
		
		public function addItemToAc(name,id):void
		{ 
 			if(checkForDup(id))
 			{
 				this.addItem({"name":name,"eventId":id}) ;
 			}
		}
		
		public function checkForDup(id):Boolean
		{
			 for(var i:uint=0;i<this.length;i++)
		 	 {
		 	  	 if(this.getItemAt(i)["eventId"]== id)
			 	 {
			 	    return false;
		 	  	 } 
		 	 }
		 	 return true
		}
		
		

	}
}