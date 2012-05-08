/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.service
{
 
	import malt.core.service.Service;
	
	import mx.rpc.events.ResultEvent;
    
	public class SupertotoAction extends Service
	{
		private var _functionHolder:Function;	
		private var _sportsService:SupertotoService;
	//	nameOfCoupon,  dateVisible, dateEnd, columnNames
			
		public function SupertotoAction()
		{
			_sportsService=new SupertotoService();
		} 
		/*	
		public function callInsert(func:Function):void
		{ 
			 
			_sportsService.SupertotoID.insertSupertotoService.addEventListener("result",func);
			 var array:Array=new Array();
			 array.push([ nameOfCoupon,  dateVisible, dateEnd, columnNames]);
			 _sportsService.SupertotoID.insertSupertotoService(array, teamsSupertoto) 
	 	}
		
	/*	public function callSelectSupertoto(func:Function):void
		{
			 
			_sportsService.SupertotoID.selectSupertoto.addEventListener("result",func);
			_sportsService.SupertotoID.selectSupertoto( ) 
		}	
		 
		public function callSelectSupertotoTeams(func:Function):void
		{
			 
			_sportsService.SupertotoID.selectSupertotoTeams.addEventListener("result",func);
		    _sportsService.SupertotoID.selectSupertotoTeams( supertotoId)  
		}
		
		public function callDeleteSupertoto(func:Function):void
		{
		     
			_sportsService.SupertotoID.deleteSupertoto.addEventListener("result",func);
		    _sportsService.SupertotoID.deleteSupertoto(  supertotoId)  
	 	}
	 
	   public function callUpdateSupertotoService(func:Function):void
	   {
	     	 
			_sportsService.SupertotoID.updateSupertotoService.addEventListener("result",func);
			 var array:Array=new Array();
			 array.push([ columnToUpdate, newData, supertotoId]);
			 _sportsService.SupertotoID.updateSupertotoService(array ) 
	   }
	   
	   public function callDeleteSupertotoTeamService(func:Function):void
	   {
	   	 
	   	_sportsService.SupertotoID.deleteSupertotoTeamService.addEventListener("result",func);
	   	 _sportsService.SupertotoID.deleteSupertotoTeamService( supertotoTeamsId) 
	   }
	 
		 */
	 	 
	}
}