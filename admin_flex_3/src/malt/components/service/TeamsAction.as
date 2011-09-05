/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.service
{
 
	
	public class TeamsAction  
	{
		private var _teamsService:TeamsService;	 
  	    private var _groupsInstance:GroupsAction;
  	    public var newSportText:String;  
  	    public var textForUpdate:String; 
  	    public var teamsId:uint;
  	    public var prebuildId:uint;
  	    public var groupsId:uint;
		
		public function TeamsAction( )
		{
			_teamsService=new TeamsService(); 
			_groupsInstance=GroupsAction.getInstance();   
	 	} 
    	 
    	public function get groupsInstanceId():uint
        {
        	return _groupsInstance.groupsId;
        }
        
         public function set groupsInstanceId(data:uint):void
        {
        	_groupsInstance.groupsId=data;
        } 
    
        
    	 
    	 
	    public function callSelect(func:Function ):void
	    { 
	    	 
            _teamsService.TeamsID.selectTeamsRows.addEventListener("result",func);
	        _teamsService.TeamsID.selectTeamsRows( groupsInstanceId, _groupsInstance.sportId);	
	    }
	    
	  
			
		public function callInsert(func:Function):void
		{	  
		       _teamsService.TeamsID.insertTeamsRows.addEventListener("result",func);
		       _teamsService.TeamsID.insertTeamsRows( newSportText, groupsInstanceId); 
	 	}
			
		public function callUpdate(func:Function):void
		{	  
		      _teamsService.TeamsID.updateTeamsRows.addEventListener("result",func); 
			  _teamsService.TeamsID.updateTeamsRows(textForUpdate, teamsId ,groupsInstanceId );  
		}
		
  
		public function callDelete(func:Function):void
		{
			_teamsService.TeamsID.deleteTeamsRows.addEventListener("result",func);
		    _teamsService.TeamsID.deleteTeamsRows( teamsId ,groupsInstanceId );
		}
		
	    public function callPrebuildGroups(func:Function):void
	    { 
	    	_teamsService.TeamsID.prebuildGroups.addEventListener("result",func);
		    _teamsService.TeamsID.prebuildGroups(  );
	     }
	     
	    public function callAddNewTeams(func:Function):void
	    {  
	        _teamsService.TeamsID.addNewTeams.addEventListener("result",func);
		   _teamsService.TeamsID.addNewTeams( prebuildId,groupsId );
	    }
	 
         public function callSelectPreteamsService(func:Function):void
	    {  
	        _teamsService.TeamsID.selectPreteamsService.addEventListener("result",func);
		   _teamsService.TeamsID.selectPreteamsService( prebuildId );
	    }

	    public function callInsertPrebuildTeamsService(func:Function):void
	    {  
	       _teamsService.TeamsID.insertPrebuildTeamsService.addEventListener("result",func);
		   _teamsService.TeamsID.insertPrebuildTeamsService( prebuildId,groupsId );
	    }
	}
}