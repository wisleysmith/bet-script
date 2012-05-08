/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.service
{
    import malt.components.service.SportsAction;
	
	public class GroupsAction extends GroupsService 
	{ 
		private var _groupsData:String;
		private var _sportsData:String;
		public var newGroupText:String; 
		public var textForUpdate:String;
		public var groupsId:uint;
		public var newLiveStatus:uint; 
		private var _serviceSport:SportsAction= SportsAction.getInstance();; 
		
		private static var _instance:GroupsAction;
		
 
		public function GroupsAction(pvt:PrivateClass)
		
		public static function getInstance( ):GroupsAction
		{
			if(GroupsAction._instance == null)
			{
				GroupsAction._instance=new GroupsAction(new PrivateClass( ));
			}
		 
			return 	GroupsAction._instance;
		}
    	
        public function get sportId():uint
        {
        	return _serviceSport.sportId
        }
        
         public function set sportId(data:uint):void
        {
        	 _serviceSport.sportId=data;
        }
        
	    public function callSelect(func:Function ):void
	    {  
	        GroupsID.selectGroupsRows.addEventListener("result",func);
	        GroupsID.selectGroupsRows(_serviceSport.sportId);	
	    }
			
		public function callInsert(func:Function):void
		{	
		     GroupsID.insertGroupsRows.addEventListener("result",func ); 
		     GroupsID.insertGroupsRows(newGroupText,_serviceSport.sportId); 
	 	}
			
		public function callUpdate(func:Function):void
		{	 
			 GroupsID.updateGroupsRows.addEventListener("result",func);
		     GroupsID.updateGroupsRows( textForUpdate,  groupsId, _serviceSport.sportId);  
		}
		
  
		public function callDelete(func:Function):void
		{ 
 		     GroupsID.deleteGroupsRows.addEventListener("result",func);
		     GroupsID.deleteGroupsRows(groupsId,_serviceSport.sportId);
		}
		
	 
	}
}

class PrivateClass
{
	public function PrivateClass( )
	{ 
	}
}