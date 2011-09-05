/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.model
{
	import malt.core.model.ModelManager;
	
	import mx.collections.ArrayCollection;
	
	
	public class SportsBetsModel extends ModelManager  
	{
		//visible
     	private var _sportsAndGroups:ArrayCollection;
	    //visible
		private var _betsTypes:ArrayCollection;
		//visible
		private var _betsData:ArrayCollection;
	 
		private var _groupID:String;
        //visible
        private var _selectedIndexCB:uint; 
        
        private var _selectedIndexGroupCB:uint; 
        
         private var _corectTypeID:String;
        
         private var _updateData:String ;
         
         private var _columnSelect:String;
         
         private var _groupIdEdited:String;
         
         private var _insertBetType:Array;
        
         private var _updateBetType=Array; 
        
    	
    	
        public function set corectTypeID(data:String):void
        {
            _corectTypeID=data; 
        }
        
        public function get corectTypeID():String
        {
        	return _corectTypeID;
        }
       
         public function set updateBetType(data:Array):void
        {
            _updateBetType=data; 
        }
        
        public function get updateBetType():Array
        {
        	return _updateBetType;
        }
       
  
        
         public function set insertBetType(data:Array):void
        {
            _insertBetType=data; 
        }
        
        public function get insertBetType():Array
        {
        	return _insertBetType;
        }
        
        public function set groupIdEdited(data:String):void
        {
            _groupIdEdited=data; 
        }
        
        public function get groupIdEdited():String
        {
        	return _groupIdEdited;
        }
        
        public function set columnSelect(data:String):void
        {
            _columnSelect=data; 
        }
        
        public function get columnSelect():String
        {
        	return _columnSelect;
        }
	 
	    public function set updateData(data:String):void
        {
            _updateData=data;
         }
        
        public function get updateData():String
        {
        	return _updateData;
        }
	 
        
        
         public function set selectedIndexGroupCB(data:uint):void
        {
            _selectedIndexGroupCB=data;
        	updateModel("selectedIndexGroupCB")
        }
        
        public function get selectedIndexGroupCB():uint
        {
        	return _selectedIndexGroupCB;
        }
	 
    
  	    public function set selectedIndexCB(data:uint):void
        {
            _selectedIndexCB=data;
        	updateModel("selectedIndexCB")
        }
        
        public function get selectedIndexCB():uint
        {
        	return _selectedIndexCB;
        }
	 
    
        public function set sportsAndGroups(data:ArrayCollection):void
        {
            _sportsAndGroups=data;
        	updateModel("sportsAndGroups")
        }
        
        public function get groupID():String
        {
        	return _groupID;
        } 
        
        public function set groupID(data:String):void
        {
            _groupID=data;
        	updateModel("groupID")
        }   
        
        public function get sportsAndGroups():ArrayCollection
        {
        	return _sportsAndGroups;
        } 
        
        public function set betsTypes(data:ArrayCollection):void
        {
            _betsTypes=data;
        	updateModel("betsTypes")
        }                
        
        public function get betsTypes():ArrayCollection
        {
        	return _betsTypes;
        } 
        
        public function set betsData(data:ArrayCollection):void
        {
            _betsData=data;
        	updateModel("betsData")
        }
        
        public function get betsData():ArrayCollection
        {
        	return _betsData;
        } 
         
      
        
        
     
	}
}