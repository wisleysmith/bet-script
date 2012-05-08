/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.service
{
 
	import malt.core.service.Service; 
	public class BetsAction extends Service  
	{
     	private var _betsService:BetsService;
		public var betEventName:String;
		public var groupsId:uint;
		public var betTypeSave:Array;
		public var betTime:String;
		public var eventId:uint;
		public var betTimeActive:String;
		public var bookhouseId:uint;
		public var betsIdType:uint;
		public var betsId:uint;
		public var updateData:String;
		public var corectTypeId:uint;
		public var groupIdEdited:uint;
		public var columnSelect:String ; 
		public var timeTo:String; 
		public var status:uint;
		public var statusDelete:uint;
		public var odd:String;
		public var oddName:String ;
		public var eventBetId:uint;
		public var betNameTI:String;
		public var betOdds:Array;
		public var arrayOfBets:Array;
		public var newTeamId:uint;
		public var betsIdEvent:uint;
		public var userEditId:uint;
		public var datefirst:String;
		public var datesecond:String;
		public var statusOfBet:String;
		public var deleteEventId:uint;
		public var oddForUpdate:String;
        public var groupsIdBetEdit:uint;
	    public var dateArhiveBet:String="";
	    public var arhiveBetType:uint;
	    public var eventIdForCombo:uint;
	    public var ticketId:uint;
 
		 public var insertBetType:uint;
		 public var  updateBetType:uint;
			
		public function BetsAction()
		{
			_betsService=new BetsService();
		}
		
			 public function callSelectBetInfo(func:Function):void
		 {
		    _betsService.BetsID.selectBetInfoNew.addEventListener("result",func);
		     _betsService.BetsID.selectBetInfoNew(ticketId); 
		 }
		
	    public function callSelectGroupsAndSport(func:Function):void
	    { 
	         _betsService.BetsID.selectSportBetsRows.addEventListener("result",func);
	         _betsService.BetsID.selectSportBetsRows(bookhouseId);
	    }
		 
		public function callSelectBets(func:Function):void
	    {    
	         _betsService.BetsID.selectSportBetsData.addEventListener("result",func); 
	         _betsService.BetsID.selectSportBetsData( groupsId, eventId,status,betsIdEvent,dateArhiveBet,eventIdForCombo );
	    }
	    
	    public function  callSelectSportOnlyBets(func:Function):void
	    {     
	         _betsService.BetsID.selectSportOnlyBets .addEventListener("result",func); 
	         _betsService.BetsID.selectSportOnlyBets( groupsId,timeTo,eventId,status,betsIdEvent);
	    }
	    
	   
		public function callInsert(func:Function):void
		{ 
			_betsService.BetsID.insertBets.addEventListener("result",func);   
	        _betsService.BetsID.insertBets( betEventName,groupsId,betTypeSave,betTime, betTimeActive ) 
	 	}
	 	
	 	public function callDelete(func:Function):void
		{ 
		    _betsService.BetsID.deleteBetsType.addEventListener("result",func);
		    _betsService.BetsID.deleteBetsType( betsIdType) 
	 	} 
	 	
	 	public function callUpdateBetType(func:Function):void
	 	{ 
	 		_betsService.BetsID.updateBetType.addEventListener("result",func);
			_betsService.BetsID.updateBetType(oddName,   betsId) 
	 	}
	 	
	 	
	 	public function callInsertNewOddService(func:Function):void
	 	{ 
	 		_betsService.BetsID.insertNewOddService.addEventListener("result",func);
			_betsService.BetsID.insertNewOddService( oddForUpdate,   betsId) 
	 	}
	 	
	 	public function callInsertBetType(func:Function):void
		{ 
			 _betsService.BetsID.insertBetType.addEventListener("result",func);
			_betsService.BetsID.insertBetType( insertBetType) 	
		}
	 	 
	 	public function callUpdateBet(func:Function):void
	 	{	 
	 		_betsService.BetsID.updateBets.addEventListener("result",func); 
	 	     _betsService.BetsID.updateBets(updateData, columnSelect , groupIdEdited) 
	 	}
	 	
	 	public function callUpdateBetMain(func:Function):void
	 	{	 
	 		 _betsService.BetsID.updateBetsMain.addEventListener("result",func); 
	 	     _betsService.BetsID.updateBetsMain(updateData, columnSelect , groupIdEdited) 
	 	}
	 	
	 	
	 	
	 	 	 
	 	public function callUpdateBetSaved(func:Function):void
	 	{	 
	 	   _betsService.BetsID.updateBetSavedService.addEventListener("result",func);
	 	   _betsService.BetsID.updateBetSavedService( updateData,corectTypeId ) 
	 	}
	 	
	 	public function callSelectViewOdds(func:Function):void
	 	{
	 	   _betsService.BetsID.selectViewOdds.addEventListener("result",func);
	 	   _betsService.BetsID.selectViewOdds( betsId) 
	 	}
	 	 
	 	public function callDeleteBet(func:Function)
	 	{  
		    _betsService.BetsID.deleteBet.addEventListener("result",func);
		    _betsService.BetsID.deleteBet(betsId) 
	 		
	 	}
	 	
	 	public function  callServiceDeleteActiveEvent(func:Function):void
	 	{
	 		_betsService.BetsID.serviceDeleteActiveEvent.addEventListener("result",func);

		    _betsService.BetsID.serviceDeleteActiveEvent(betsId) 
	 	}
	 	
	 		 	
	 	public function  callServiceDeleteActiveBet(func:Function):void
	 	{
	 				
	 		_betsService.BetsID.serviceDeleteActiveBet.addEventListener("result",func);
		    _betsService.BetsID.serviceDeleteActiveBet(betsId,statusDelete) 
	 	}
	 	 
	 	public function callSelectBetEdit(func:Function)
	 	{
	 	    _betsService.BetsID.selectBetEdit.addEventListener("result",func);
		    _betsService.BetsID.selectBetEdit(betsId,eventBetId) 
	 	}
	 	
	 	public function  callSelectBetEnd(func:Function):void
	 	{
	 		    _betsService.BetsID.selectBetEditEnd.addEventListener("result",func);
		        _betsService.BetsID.selectBetEditEnd(betsId) 
	 	}
	 	
	 	public function callSelectBetEditArhive(func:Function):void
	 	{
	 		_betsService.BetsID.selectBetEditArhive.addEventListener("result",func);
		    _betsService.BetsID.selectBetEditArhive(betsId) 
	 	}
	 	
	    public function callSetDataForBet(func:Function):void
		{
		 
			_betsService.BetsID.setDataForBet.addEventListener("result",func);
			_betsService.BetsID.setDataForBet(bookhouseId);
		}
	 	
	 	public function callGroupsData(func:Function):void
		{
			_betsService.BetsID.groupsData.addEventListener("result",func);
			_betsService.BetsID.groupsData(groupsId);
		}
	 	
	 		 	
	 	public function callBetsData(func:Function):void
		{
			_betsService.BetsID.betsData.addEventListener("result",func);
			_betsService.BetsID.betsData(betsIdEvent);
		}
	 	
	 	
	 	public function callSetBetBasicService(func:Function):void
		{
			_betsService.BetsID.setBetBasicService.addEventListener("result",func);
			_betsService.BetsID.setBetBasicService(groupsId);
		}
		
		public function insertBetEvent(func:Function):void
		{ 
		 
			_betsService.BetsID.insertBetEvent.addEventListener("result",func);
			_betsService.BetsID.insertBetEvent(betNameTI,eventBetId,betsIdType,betOdds); 
		}
		
		 
		public function selectBetEventBets(func:Function):void
		{
			_betsService.BetsID.selectEventBetsService.addEventListener("result",func);
			_betsService.BetsID.selectEventBetsService(eventBetId); 
		}
		
		public function callEditOddsService(func:Function):void
		{
			_betsService.BetsID.editOddsService.addEventListener("result",func);
			_betsService.BetsID.editOddsService( arrayOfBets); 
		}
		
		public function callEditEventService(func:Function):void
		{
			_betsService.BetsID.editEventService.addEventListener("result",func);
			_betsService.BetsID.editEventService(eventBetId,groupsIdBetEdit); 
		}
		
		public function callAddNewTeamToEventService(func:Function):void
		{
			_betsService.BetsID.addNewTeamToEventService.addEventListener("result",func);
			_betsService.BetsID.addNewTeamToEventService(betsId,newTeamId); 
		}
		
		public function callUpdateBetEventTeam(func:Function):void
		{
		    _betsService.BetsID.updateBetEventTeam.addEventListener("result",func);
			_betsService.BetsID.updateBetEventTeam(betsId,newTeamId); 
		}
		
		public function callDeleteBetsTeamsService(func:Function):void
		{
		    _betsService.BetsID.deleteBetsTeamsService.addEventListener("result",func);
			_betsService.BetsID.deleteBetsTeamsService(newTeamId); 
		}
		
		public function callSelectUserPlacedBets(func:Function):void
		{
		    _betsService.BetsID.selectUserPlacedBets.addEventListener("result",func);
			_betsService.BetsID.selectUserPlacedBets(userEditId,datefirst,datesecond,statusOfBet); 
		}
		
	    public function callDeleteEventBet(func:Function):void
		{
		    _betsService.BetsID.deleteEventBets.addEventListener("result",func);
			_betsService.BetsID.deleteEventBets(deleteEventId); 
		}
		
		public function callResetBet(func:Function):void
		{  
		    _betsService.BetsID.resetBetService.addEventListener("result",func);
			_betsService.BetsID.resetBetService(arhiveBetType); 
		}
	 
		public function deleteUnplayedFinsihed(func:Function):void
		{  
		    _betsService.BetsID.deleteUnplayedFinsihed.addEventListener("result",func);
			_betsService.BetsID.deleteUnplayedFinsihed(); 
		}
	 
		
	 
	}
}