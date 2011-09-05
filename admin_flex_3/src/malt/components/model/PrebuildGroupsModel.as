/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.model
{
    import malt.core.model.ModelManager;
    
    import mx.collections.ArrayCollection;
   
	public class PrebuildGroupsModel extends ModelManager
	{ 
		//visible
         private var _groupsTable:ArrayCollection;
        //visible
         private var _teamsTable:ArrayCollection;
         private var _teamsTableID:String;
         
        public function set groupsTable(data:ArrayCollection):void
        {
            _groupsTable=data;
        	updateModel("groupsTable") 
        }
        
        public function get groupsTable():ArrayCollection
        {
        	return _groupsTable;
        }
          
        public function get teamsTable():ArrayCollection
        {
        	return _teamsTable;
        }
        
        public function set teamsTable(data:ArrayCollection):void
        {
            _teamsTable=data;
        	updateModel("teamsTable") 
        }
        
        public function get teamsTableID():String
        {
        	return _teamsTableID;
        }
        
        public function set teamsTableID(data:String):void
        {
            _teamsTableID=data; 
        }
         
	}
}