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
    import malt.components.service.GroupsService;
	
	public class GroupsAction extends Service
	{
		private var _groupsService:GroupsService;		 
		private var _functionHolder:Function;	
		private var _groupsData:String;
		private var _sportsData:String;
		
 
		public function GroupsAction(groupsDataParam,sportsDataParam)
		{
			_groupsService=new GroupsService();
			_groupsData=groupsDataParam;
		    _sportsData=sportsDataParam;
    	}
    	
    	public function faultResult(event:FaultEvent):void
    	{
    		trace(event.fault)
    	}
		
	    public function callSelect(func:Function ):void
	    { 
	        _functionHolder=func
	        _groupsService.GroupsID.selectGroupsRows.addEventListener("result",loadDataResult);
	        _groupsService.GroupsID.selectGroupsRows(model(_sportsData).sportsId);	
	    }
			
		public function callInsert(func:Function):void
		{	
		     _groupsService.GroupsID.insertGroupsRows.addEventListener("result",loadDataResult);
			_functionHolder=func ;
			 var array:Array=new Array();
		 
			  array.push([model(_groupsData).newSportText, model(_sportsData).sportsId]);
	 		  _groupsService.GroupsID.insertGroupsRows( array ); 
	 	}
			
		public function callUpdate(func:Function):void
		{	  
		       _functionHolder=func;
			  _groupsService.GroupsID.updateGroupsRows.addEventListener("result",loadDataResult);
			  var array:Array=new Array();
			  array.push([model(_groupsData).textForUpdate, "name",model('Global').bookhouseId,model(_groupsData).groupsId]);
			  _groupsService.GroupsID.updateGroupsRows(array );  
		}
		
		public function callUpdateLive(func:Function):void
		{  
			  _functionHolder=func
			  _groupsService.GroupsID.updateGroupsRows.addEventListener("result",loadDataResult);
			  var array:Array=new Array();
			  array.push([model(_groupsData).newLiveStatus, "live",model('Global').bookhouseId,model(_groupsData).groupsId]);
			 _groupsService.GroupsID.updateGroupsRows(array );
	 
		}
		
			
		public function callDelete(func:Function):void
		{
			 _functionHolder=func
 		     _groupsService.GroupsID.deleteGroupsRows.addEventListener("result",loadDataResult);
		     var array:Array=new Array(); 
			 array.push([model('Global').bookhouseId,model(_groupsData).groupsId]);
			 _groupsService.GroupsID.deleteGroupsRows(array);
		}
		
		private function loadDataResult(event:ResultEvent):void
		{
			 
			var datas=event.currentTarget.name
		    _groupsService.GroupsID[datas].removeEventListener("result",loadDataResult);
			
		 	if(event.result)
		 	{ 
		 		  trace(String(event.result)+"podaci od eventa"+datas)
		 	    _functionHolder(event.result );		  
		 	}
	 	 }
	 	 
	}
}