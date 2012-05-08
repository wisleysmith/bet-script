/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.service
{ 
 
	public class SportsAction extends SportsService 
	{
		private static var _instance:SportsAction;
        
		public var newSportText:String;
		public var textForUpdate:String;
		public var sportId:uint;
		public var newLiveStatus:uint;
		public var globalId
			
	 
		
		public function SportsAction(pvt:PrivateClass)
		
		public static function getInstance( ):SportsAction
		{
			if(SportsAction._instance == null)
			{
				SportsAction._instance=new SportsAction(new PrivateClass( )); 
			}
		 
			return 	SportsAction._instance;
		}
	 
	    public function callSelect(func:Function):void
	    { 
	          SportsID.selectSportRows.addEventListener("result",func);
	          SportsID.selectSportRows( );
	    }
			
		public function callInsert(func:Function):void
		{
			   SportsID.insertSportRows.addEventListener("result",func);
			   SportsID.insertSportRows(newSportText, 1) 
	 	}
			
		public function callUpdate(func:Function):void
		{
			  SportsID.updateSportRows.addEventListener("result", func);
		      SportsID.updateSportRows(textForUpdate, sportId);
		}
 
			
		public function callDelete(func:Function):void
		{   
				  SportsID.deleteSportRows.addEventListener("result",func);
				    SportsID.deleteSportRows(sportId);
		} 
	}
}

class PrivateClass
{
	public function PrivateClass( )
	{ 
	}
}