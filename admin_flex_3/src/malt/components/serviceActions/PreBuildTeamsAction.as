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
 
	
	public class PreBuildTeamsAction extends Service
	{
		private var _preBuildTeams:PreBuildTeamsService;		 
		private var _functionHolder:Function;	
 
		
 
		public function PreBuildTeamsAction( )
		{
			_preBuildTeams=new PreBuildTeamsService(); 
    	}
    	
    	public function faultResult(event:FaultEvent):void
    	{
    		trace(event.fault)
    	}
		
	    public function callSelect(func:Function ):void
	    { 
	        _functionHolder=func
	        _preBuildTeams.PrebuildID.selectPrebuildGroupsRows.addEventListener("result",loadDataResult);
	        _preBuildTeams.PrebuildID.selectPrebuildGroupsRows();	
	    }
	    
	    public function callSelectTeams(func:Function ):void
	    { 
	        _functionHolder=func;
	        _preBuildTeams.PrebuildID.selectPrebuildTeamsRows.addEventListener("result",loadDataResult);
	        _preBuildTeams.PrebuildID.selectPrebuildTeamsRows( model('PrebuildGroupsModel').teamsTableID);	
	    }
		 
		
		private function loadDataResult(event:ResultEvent):void
		{
			 
			var datas=event.currentTarget.name
		    _preBuildTeams.PrebuildID[datas].removeEventListener("result",loadDataResult);
			
		 	if(event.result)
		 	{ 
		 		  trace(String(event.result)+"podaci od eventa"+datas)
		 	    _functionHolder(event.result );		  
		 	}
	 	 }
	 	 
	}
}