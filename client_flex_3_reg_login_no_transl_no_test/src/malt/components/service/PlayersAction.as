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
		
		 public var datefirst:String;
		 public var datesecond:String;
         public var statusOfBet:String;
        public var username:String; 
  	  	public var password:String; 
  	  	public var firstname:String; 
  	  	public var lastname:String; 
  	  	public var email:String; 
  	    public var pitanje:String; 
	   	public var odgovor:String;
	   	 
	     public function PlayersAction() 
	     {
	     	_playersService=new PlayersService();
	     }
	 
	 	public function callUvod(func:Function):void
		 {
		     _playersService.PlayersID.passwordRem.addEventListener("result",func);
             _playersService.PlayersID.passwordRem(model('Global').bookhouseId, lastname,email )	
		 }
		 
		 public function rememberLogin(func:Function):void
		 {
		     _playersService.PlayersID.rememberLogine.addEventListener("result",func);
             _playersService.PlayersID.rememberLogine(model('Global').bookhouseId, username,odgovor )	
		 }
	 
		 public function callInsertPlayersService(func:Function):void
		 {
		     _playersService.PlayersID.registerPlayer.addEventListener("result",func);
             _playersService.PlayersID.registerPlayer(model('Global').bookhouseId, username,password,firstname,lastname,email,pitanje,odgovor )	
		 }
		 
		 public function callTransactions(func:Function):void
		 {
		     _playersService.PlayersID.callTransactions.addEventListener("result",func);
             _playersService.PlayersID.callTransactions( model('Global').bookhouseId,datefirst,datesecond,statusOfBet);	
		 }
		 
		  public function callFunds(func:Function):void
		 {
		     _playersService.PlayersID.userFunds.addEventListener("result",func);
             _playersService.PlayersID.userFunds(model('Global').bookhouseId );	
		 }
		 
		   public function callUpdatePlayersService(func:Function):void
		 { 
	        _playersService.PlayersID.updatePlayersService.addEventListener("result",func);
	         _playersService.PlayersID.updatePlayersService( model('Global').bookhouseId, username, password,  firstname, lastname, email );	
		 }
		  public function callServiceOneUser(func:Function):void
		 { 
		     _playersService.PlayersID.serviceOneUser.addEventListener("result",func);
             _playersService.PlayersID.serviceOneUser(model('Global').bookhouseId );	
		 } 
	}
}