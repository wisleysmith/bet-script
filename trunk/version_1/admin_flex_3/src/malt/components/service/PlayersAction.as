/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.service
{
	import malt.core.service.Service;
 
 
	
	public class PlayersAction extends Service
	{
		 private var _playersService:PlayersService;		 
		 public var bookhouseId:uint;
		 public var username:String;
		 public var password:String;
		 public var money:Number;
		 public var firstname:String;
		 public var lastname:String;
		 public var email:String;
		 public var userId:uint;
		 public var updateData:String;
		 public var userEditId:uint;
		 public var datefirst:String;
		 public var datesecond:String;
         public var statusOfBet:String;
         public var adminOrUser:String;
         public var fromPagging:uint;
         public var searchTermin:String;
         public var searchTerminCriteri:uint;
         public var fromPaggingSearch:uint; 
         public var moneyInput:String;
         public var statusTransaction:uint;
         public var playerOrAdmin:uint;
 
         
	 
	     public function PlayersAction() 
	     {
	     	_playersService=new PlayersService();
	     }
	    
	 
	     public function callSearchPlayer (func:Function):void
		 { 
	         _playersService.PlayersID.searchUser.addEventListener("result",func);
	         _playersService.PlayersID.searchUser(fromPaggingSearch,searchTerminCriteri,searchTermin);	
		 }
		 
	    
		 public function callInsertPlayersService(func:Function):void
		 { 
	        _playersService.PlayersID.insertPlayersService.addEventListener("result",func);
	         _playersService.PlayersID.insertPlayersService(  username, password, money, firstname, lastname, email,adminOrUser);	
		 }
		 
		  public function callUpdatePlayersService(func:Function):void
		 { 
	        _playersService.PlayersID.updatePlayersService.addEventListener("result",func);
	         _playersService.PlayersID.updatePlayersService( userEditId, username, password,  firstname, lastname, email );	
		 }
		 
		 public function callSelectPlayersService(func:Function):void
		 { 
	        _playersService.PlayersID.selectPlayersService.addEventListener("result",func);
             _playersService.PlayersID.selectPlayersService(fromPagging,playerOrAdmin);	
		 }
		 
		 public function callUpdateService(func:Function,update:String):void
		 {
		     _playersService.PlayersID.updateUserData.addEventListener("result",func);
             _playersService.PlayersID.updateUserData(update,userId,updateData);	
		 }
		 
		 public function callTransactions(func:Function):void
		 {
		     _playersService.PlayersID.callTransactions.addEventListener("result",func);
             _playersService.PlayersID.callTransactions(userEditId,datefirst,datesecond,statusOfBet);	
		 }
		 
		 public function serviceTransaction(func:Function):void
		 {
		     _playersService.PlayersID.serviceTransaction.addEventListener("result",func);
             _playersService.PlayersID.serviceTransaction(moneyInput,statusTransaction,userEditId);	
		 }
		 
		 
		  public function callFunds(func:Function):void
		 {
		     _playersService.PlayersID.userFunds.addEventListener("result",func);
             _playersService.PlayersID.userFunds(userEditId );	
		 }
		 
		 public function callServiceOneUser(func:Function):void
		 { 
		     _playersService.PlayersID.serviceOneUser.addEventListener("result",func);
             _playersService.PlayersID.serviceOneUser(userEditId );	
		 } 
		
		 public function callServiceDeletePlayer(func:Function):void
		 { 
		     _playersService.PlayersID.deletePlayer.addEventListener("result",func);
             _playersService.PlayersID.deletePlayer(userEditId  );	
		 }
	}
}