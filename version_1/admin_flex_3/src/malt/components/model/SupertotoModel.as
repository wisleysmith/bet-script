/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.model
{
	import malt.core.model.ModelManager;

	
	public class SupertotoModel extends ModelManager  
	{ 
		private var _nameOfCoupon:String
		private var _dateVisible:String;
		private var _dateEnd:String;
		private var _columnNames:String;	
		private var _teamsSupertoto:Array;	 
		private var _supertotoId:String;
		private var _columnToUpdate:String;
     	private var _newData:String;
     	private var _supertotoTeamsId:String;
		 
		public function SupertotoModel():void
		{
			_teamsSupertoto =new Array();
		}
		 
		public function set supertotoTeamsId(data:String):void
		{
			_supertotoTeamsId=data
		}
		
	 	public function get supertotoTeamsId():String
		{
			return _supertotoTeamsId
		}
		 
		 
		public function set columnToUpdate(data:String):void
		{
			_columnToUpdate=data
		}
		
	 	public function get columnToUpdate():String
		{
			return _columnToUpdate
		}
		 
		 
		 public function set newData(data:String):void
		{
			_newData=data
		}
		
	 	public function get newData():String
		{
			return _newData
		}
		  
		 
		 
		public function set supertotoId(data:String):void
		{
			_supertotoId=data
		}
		
	 	public function get supertotoId():String
		{
			return _supertotoId
		}
		 
		 
		public function set nameOfCoupon(data:String):void
		{
			_nameOfCoupon=data
		}
		
	 	public function get nameOfCoupon():String
		{
			return _nameOfCoupon
		}
		
		public function set dateVisible(data:String):void
		{
			_dateVisible=data
		}
		
	 	public function get dateVisible():String
		{
			return _dateVisible
		}
		
		public function set dateEnd(data:String):void
		{
			_dateEnd=data
		}
		
	 	public function get dateEnd():String
		{
			return _dateEnd
		}
		
		public function set columnNames(data:String):void
		{
			_columnNames=data
		}
		
	 	public function get columnNames():String
		{
			return _columnNames
		}
		
	    public function set teamsSupertoto(data:Array):void
		{
			_teamsSupertoto=data
		}
		
	 	public function get teamsSupertoto():Array
		{
			return _teamsSupertoto
		}
	}
}