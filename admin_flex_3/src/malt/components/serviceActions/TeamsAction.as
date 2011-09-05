/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.serviceActions
{
	import malt.core.service.Service;
	import mx.rpc.events.ResultEvent;
	import mx.rpc.events.FaultEvent;
	import mx.collections.ArrayCollection;
    import malt.components.service.TeamsService;
	
	public class TeamsAction extends Service
	{
		private var _teamsService:TeamsService;		 
		private var _functionHolder:Function;	
		 
		public function TeamsAction( )
		{
			_teamsService=new TeamsService();
	 	}
    	 
	    public function callSelect(func:Function ):void
	    { 
	        _functionHolder=func
	         _teamsService.TeamsID.selectTeamsRows.addEventListener("result",loadDataResult);
	        _teamsService.TeamsID.selectTeamsRows(model("GroupsTeamsModel").groupsId);	
	    }
			
		public function callInsert(func:Function):void
		{	
		     _teamsService.TeamsID.insertTeamsRows.addEventListener("result",loadDataResult);
			_functionHolder=func ;
			 var array:Array=new Array();
		 
			  array.push([model("TeamsModel").newSportText, model("GroupsTeamsModel").groupsId]);
	 		  _teamsService.TeamsID.insertTeamsRows( array ); 
	 	}
			
		public function callUpdate(func:Function):void
		{	  
		       _functionHolder=func;
			  _teamsService.TeamsID.updateTeamsRows.addEventListener("result",loadDataResult);
			  var array:Array=new Array();
			  array.push([model("TeamsModel").textForUpdate,model("GroupsTeamsModel").groupsId,model('TeamsModel').teamsId]);
			  _teamsService.TeamsID.updateTeamsRows(array );  
		}
		
 
		
			
		public function callDelete(func:Function):void
		{
			 _functionHolder=func
 		     _teamsService.TeamsID.deleteTeamsRows.addEventListener("result",loadDataResult);
		     var array:Array=new Array(); 
			 array.push([model("GroupsTeamsModel").groupsId,  model('TeamsModel').teamsId]);
			 _teamsService.TeamsID.deleteTeamsRows(array);
		}
		
		private function loadDataResult(event:ResultEvent):void
		{
			 
			var datas=event.currentTarget.name
		    _teamsService.TeamsID[datas].removeEventListener("result",loadDataResult);
			
		 	if(event.result)
		 	{ 
		 		  trace(String(event.result)+"podaci od eventa sport"+datas)
		 	    _functionHolder(event.result );		  
		 	}
	 	 }
	 	 
	}
}