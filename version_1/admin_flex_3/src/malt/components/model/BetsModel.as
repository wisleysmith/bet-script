/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.model
{
	import malt.core.model.ModelManager;
	
	import mx.collections.ArrayCollection;
	  
	public class BetsModel extends ModelManager  
	{ 
		//visual
		private var _selectedIndex:uint; 
		private var _betEventName:String;
		private var _betTypeSave:Array; 	
		private var _betTime:String; 
	    private var _betsData:ArrayCollection;
	    private var _betsIdType:String;
	    private var _betsId:String;
	    private var _betId:String
		
	    public function BetsModel()
	    {
	     	_betsData=new ArrayCollection();
	    }	
	    
 			
 	 
 			
	    public function set betsId(data:String):void
        {
            _betsId=data;  
        }
        
        public function get betsId():String
        {
        	return _betsId;
        }  
		
	  
	  
	    public function set betsIdType(data:String):void
        {
            _betsIdType=data;  
        }
        
        public function get betsIdType():String
        {
        	return _betsIdType;
        }  
		
	    
	    public function set betsData(data:ArrayCollection):void
        {
            _betsData=data;  
        }
        
        public function get betsData():ArrayCollection
        {
        	return _betsData;
        }  
		
		public function set betTypeSave(data:Array):void
        {
            _betTypeSave=data;  
        }
        
        public function get betTypeSave():Array
        {
        	return _betTypeSave;
        }   
		
		public function set betEventName(data:String):void
        {
            _betEventName=data;  
        }
        
        public function get betEventName():String
        {
        	return _betEventName;
        }    
        
        public function set betTime(data:String):void
        {
            _betTime=data;  
        }
        
        public function get betTime():String
        {
        	return _betTime;
        }  
	}
}