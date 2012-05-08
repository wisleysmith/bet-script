/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.serviceActions
{
 
	import mx.rpc.events.ResultEvent;
	import mx.collections.ArrayCollection;
	import malt.components.service.SportsService;
	import malt.core.service.Service;
	 
	public class SportsAction extends Service  
	{
		private var _functionHolder:Function;	
		private var _sportsService:SportsService;
			
		public function SportsAction()
		{
			_sportsService=new SportsService();
		}
		
	 
	    public function callSelect(func:Function):void
	    { 
	         _functionHolder=func;
	         _sportsService.SportsID.selectSportRows.addEventListener("result",loadDataResult);
	         _sportsService.SportsID.selectSportRows(model('Global').bookhouseId);
	    }
			
		public function callInsert(func:Function):void
		{
			_functionHolder=func;
			_sportsService.SportsID.insertSportRows.addEventListener("result",loadDataResult);
			 var array:Array=new Array();
			 array.push([model('SportsModel').newSportText,  model('Global').bookhouseId ]);
			 _sportsService.SportsID.insertSportRows(array) 
	 	}
			
		public function callUpdate(func:Function):void
		{
			  _functionHolder=func;
			  _sportsService.SportsID.updateSportRows.addEventListener("result",loadDataResult);
			  var array:Array=new Array();
			  array.push([model('SportsModel').textForUpdate, "name",model('Global').bookhouseId,model('SportsModel').sportsId]);
			  _sportsService.SportsID.updateSportRows(array );
		}
		
		public function callUpdateLive(func:Function):void
		{
			  _functionHolder=func;
			  _sportsService.SportsID.updateSportRows.addEventListener("result",loadDataResult);
			  var array:Array=new Array();
			  array.push([model('SportsModel').newLiveStatus, "live",model('Global').bookhouseId,model('SportsModel').sportsId]);
			  _sportsService.SportsID.updateSportRows(array );
		}
		
			
		public function callDelete(func:Function):void
		{   
				 _sportsService.SportsID.deleteSportRows.addEventListener("result",loadDataResult);
				 _functionHolder=func;
				 var array:Array=new Array();
				 array.push([model('Global').bookhouseId,model('SportsModel').sportsId]); 
			     _sportsService.SportsID.deleteSportRows(array);
		}
		
		private function loadDataResult(event:ResultEvent):void
		{
			var datas=event.currentTarget.name
		    _sportsService.SportsID[datas].removeEventListener("result",loadDataResult);
			
			if( _sportsService.SportsID.selectSportRows.hasEventListener("result"))
			{
			 	trace("postoji")
			}
			else
			{
				trace("ne postoji")
			}
			
		 	if(event.result)
		 	{ 
		 		trace(String(event.currentTarget.name))
		 		 _functionHolder(event.result);		  
		 	}
	 	 }
	 	 
	}
}