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
		public var bookhouseId:uint;
		public var groupsId:uint;
		public var eventId:uint; 
		public var money:Number;
		public var betTypes:Array;
        public var userEditId:uint;
		public var datefirst:String;
		public var datesecond:String;
		public var statusOfBet:String;
		public var ticketId:uint;
		public var betId:uint;
		public var systemBet:uint;
		
		public var systemBetMin
		public var systemBetMax
 
  
			
		public function BetsAction()
		{
			_betsService=new BetsService(); 
		} 
	 	
	 	 
	 	
	     public function callSetDataForBet(func:Function):void
		{ 
			_betsService.BetsID.selectGroupAndSportsOffer.addEventListener("result",func);
			_betsService.BetsID.selectGroupAndSportsOffer();
		}
	 	
		
		
	    public function callSelectBetEvents(func:Function):void
		{  
		 
			 _betsService.BetsID.userGetEvents.addEventListener("result",func);
			_betsService.BetsID.userGetEvents(groupsId);
	 	}
	 	
	 	public function callUserActiveAddBet(func:Function):void
	 	{
	 		_betsService.BetsID.userActiveBetAdd.addEventListener("result",func);
			_betsService.BetsID.userActiveBetAdd(betId);
	 	}
	 	
	 	public function callUserActiveBet(func:Function):void
	 	{
	 		_betsService.BetsID.userActiveBet.addEventListener("result",func);
			_betsService.BetsID.userActiveBet(groupsId,eventId);
	 	}
	 	 	
	 	public function callUserInsertBet(func:Function):void
	 	{
	 		_betsService.BetsID.userInsertBet.addEventListener("result",func);
			_betsService.BetsID.userInsertBet(money,betTypes,systemBetMin,systemBetMax);
	 	}
	 	
	   public function callSelectUserPlacedBets(func:Function):void
		{
		    _betsService.BetsID.selectUserPlacedBets.addEventListener("result",func);
			_betsService.BetsID.selectUserPlacedBets(datefirst,datesecond,statusOfBet); 
		}
		 
		 public function callSelectBetInfo(func:Function):void
		 {
		    _betsService.BetsID.selectBetInfoNew.addEventListener("result",func);
		     _betsService.BetsID.selectBetInfoNew(ticketId); 
		 }

	}
}