/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.model
{
	import malt.core.model.ModelManager;
	
	import mx.collections.ArrayCollection;
	
	public class Global extends ModelManager
	{
		private var _bookhouseId:uint;
		//sport header in create bet
		private var _sportsHeader:String; 
		//group header in create bet
		private var _groupHeader:String;
		 //id of selected sport in create bet
 
		private var _groupsTable:ArrayCollection;
		//teams data in create bet
		private var _teamsTable:ArrayCollection=new ArrayCollection();
		//groups id in create bet
 
	    private var _selectedDrag:String;
	    //team id in create bet
        private var _teamsId:uint;
        //event name in create bet 
        private var _eventName:String;
        //event id in create bet 
		private var _eventId:uint; 
		//event table type data in create bet 
		private var _eventTableType:ArrayCollection; 
		//sport table data
		private var  _sportsTable
	   
 
		
		public function Global()
		{
			 bookhouseId=1;
		}
		 
		public function get eventTableType():ArrayCollection
		{
			return _eventTableType;
		}
		
	    public function set eventTableType(data:ArrayCollection):void
		{
			 _eventTableType=data; 
			 updateModel("eventTableType")
	 	}    
		  
	    public function get eventId():uint
		{
			return _eventId;
		}
		
	    public function set eventId(data:uint):void
		{
			 _eventId=data; 
	 	} 
		      
	    public function get eventName():String
		{
			return _eventName;
		}
		
	    public function set eventName(data:String):void
		{
			 _eventName=data; 
			 updateModel("eventName")
	 	} 
		  
	    public function get selectedDrag():String
		{
			return _selectedDrag;
		}
		
	    public function set selectedDrag(data:String):void
		{
			 _selectedDrag=data; 
	 	} 
		 
		public function get teamsId():uint
		{
			return _teamsId;
		}
		
	    public function set teamsId(data:uint):void
		{
			 _teamsId=data; 
	 	}  
		  
		public function get groupHeader():String
		{
			return _groupHeader;
		}
		
		public function set groupHeader(data:String):void
		{
			_groupHeader=data;
		   updateModel("groupHeader")
		 }
		
	    public function set teamsTable(data:ArrayCollection):void
		{
			 _teamsTable=data;
			 updateModel("teamsTable")
	 	}
	 	 
		public function get teamsTable():ArrayCollection
		{
			return _teamsTable;
		}
		
		public function get bookhouseId():uint
		{
			return _bookhouseId;
		}
		
	    public function set bookhouseId(data:uint):void
		{
			 _bookhouseId=data;
	 	}
	 	
	 	public function get  groupsTable():ArrayCollection
		{
			return _groupsTable;
		}
		
	    public function set groupsTable(data:ArrayCollection):void
		{
			 _groupsTable=data;
			 updateModel("groupsTable")
	 	}
	 	
	 	
	 	public function get  sportsTable():ArrayCollection
		{
			return _sportsTable;
		}
		
	    public function set sportsTable(data:ArrayCollection):void
		{
			 _sportsTable=data;
			 updateModel("sportsTable")
	 	}
	 	
	 	 public function set sportsHeader(data:String):void
        { 
            _sportsHeader=data;
        	updateModel("sportsHeader")
        }
        
        public function get sportsHeader():String
        {
        	return _sportsHeader;
        }
  
	 	 
	}
}