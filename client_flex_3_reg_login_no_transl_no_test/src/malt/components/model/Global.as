/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.model
{
	import malt.core.model.ModelManager;
	
	import mx.collections.ArrayCollection;
	
	public class Global extends ModelManager
	{
		private var _bookhouseId:uint; 
		private var _userId:uint;
		private var _betPlaced:ArrayCollection;
		private var _oddFormat:String;
		
		public function Global()
		{
		    _oddFormat="decimal";
			 _betPlaced=new ArrayCollection();
		}
		
		public function get bookhouseId():uint
		{
			
			return _bookhouseId;
		}
		
	    public function set bookhouseId(data:uint):void
		{
			  _bookhouseId=data;
			  updateModel("bookhouseId");
	    }
	     
		public function get userId():uint
		{
			return _userId;
		}
		
	    public function set userId(data:uint):void
		{
			 _userId=data;
	 	}
	 	 
	 	  
		public function get betPlaced():ArrayCollection
		{
			return _betPlaced;
		}
		
	    public function set betPlaced(data:ArrayCollection):void
		{
			 _betPlaced=data;
	 	}
	 	
	  	  
		public function get oddFormat():String
		{
			return _oddFormat;
		}
		
	    public function set oddFormat(data:String):void
		{
			 _oddFormat=data;
			 updateModel("refreshBetsData");
	 	}
	 	
	 	
	 	 
	   
	}
}