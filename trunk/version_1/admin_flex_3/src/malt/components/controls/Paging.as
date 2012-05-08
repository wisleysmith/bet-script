/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.controls
{
	import malt.components.controls.events.PagingEvent;
	
	import flash.events.MouseEvent;
	
	import mx.collections.ArrayCollection;
	import mx.containers.Box;
	import mx.containers.Canvas;
	import mx.controls.Button;
	import mx.controls.ToggleButtonBar;
	import mx.core.UIComponent;
	import mx.events.ItemClickEvent;
	
 
	[Event(name="pagingClick", type="malt.components.controls.events.PagingEvent")]
	public class Paging extends Canvas
	{   
	   
		private var _navigationNumber:ArrayCollection;
        //if needed display left buttons
        public var _leftVisibleButtons:Boolean;
		//if needed display right buttons
        public var _rightVisibleButtons:Boolean;
           //number of data in paging
        private var _box:Box;
        //main togleButtonBar - paging buttons
		private var _toggleButtonBar:ToggleButtonBar;
		//move to the start in paging
		private var _fullLeft:Button;
		//move one number down in paging
		private var _left:Button;
		//move one number up in paging
		private var _right:Button;
		//move to the end in paging
		private var _fullRight:Button;
		//maximum nuber paging buttons
	    private var _maxData:uint;
	    //maximum nuber in data to be display 
	    private var _displayLimit:uint;
	    //number of data
	    private var _dataNumber:uint;
        //current minimum diplayed number in paging
	    private var _currentMinPagNumber:uint;
	    //direction of layout HBOX or VBOX, changes direction of TogleButtonBar and HBox on call
	    private var _direction:String;
	    //itmeClickEvent of togleButtonBar
		private var _itemClickEvent:ItemClickEvent;
		//data provider is only use to get label for toogleButtonBar
		private var _label:ArrayCollection;
    
	 	public function Paging()
		{
			_fullLeft=new Button();
	        _left=new Button();
		    _right=new Button();
		    _fullRight=new Button();
		    _box=new Box();
			_toggleButtonBar=new ToggleButtonBar(); 
		    
		    _fullLeft.addEventListener(MouseEvent.CLICK,clickFullLeft)
	        _left.addEventListener(MouseEvent.CLICK,clickLeft)
		    _right.addEventListener(MouseEvent.CLICK,clickRight)
		    _fullRight.addEventListener(MouseEvent.CLICK,clickFullRight)
		    _toggleButtonBar.addEventListener(ItemClickEvent.ITEM_CLICK,togleHanlder)
		    
			init();
		}
		
		private function init():void
		{
			 _navigationNumber=new ArrayCollection()
			
			_currentMinPagNumber=0
			_toggleButtonBar.dataProvider=_navigationNumber;
			
			_fullLeft.label="<<";
	        _left.label="<";
		    _right.label=">";
		    _fullRight.label=">>";
		    
	        _leftVisibleButtons=true;
	        _rightVisibleButtons=true;
		    
		    _fullLeft.visible= _leftVisibleButtons;
	        _left.visible= _leftVisibleButtons;
		    _right.visible=_rightVisibleButtons;
		    _fullRight.visible=_rightVisibleButtons;
		     
	        direction="horizontal";
	       
	        _box.setStyle("horizontalGap", "0");
		    _box.setStyle("verticalGap", "0");
		    
		    display()
	    }
		 
		 private function display():void
		 {
		 	 addChild(_box);
			_box.addChild(_fullLeft);
			_box.addChild(_left)
			_box.addChild(_toggleButtonBar)
			_box.addChild(_right)
			_box.addChild(_fullRight)
			
			redrawPaging()
		 }
		
		private function togleHanlder(event:ItemClickEvent):void
		{
		     var object:Object=new Object()
        	 object.index=event.index+_currentMinPagNumber;
			 object.label=event.label;
			 object.minimunIndex=_currentMinPagNumber;
			 
			   
			 var eventObj:PagingEvent = new PagingEvent("pagingClick", object);
		     dispatchEvent(eventObj);
    	}
		
		private function clickFullLeft(event:MouseEvent):void
		{
		    _navigationNumber.removeAll();
		 	_currentMinPagNumber=0;
		   	redrawPaging();
		}
	    private function clickLeft(event:MouseEvent):void
	    {  
	        _navigationNumber.removeAll();
	    	 if(_currentMinPagNumber>0)
		 	  {
			   	_currentMinPagNumber--
			  }
	    	redrawPaging();   
	    }
		private function clickFullRight(event:MouseEvent):void
		{
		   _navigationNumber.removeAll();
			_currentMinPagNumber=Math.ceil( _dataNumber/_maxData)+1-_displayLimit
			redrawPaging();
		}
		 
	    private function clickRight(event:MouseEvent):void
		{
			_navigationNumber.removeAll();
			var max:uint=Math.ceil( _dataNumber/_maxData)+1-_displayLimit
			 if(_currentMinPagNumber<max)
		 	 {
			  _currentMinPagNumber++
			 }
			redrawPaging();
		}    
		    
		//directon of BOX container
        public function set direction(direction:String):void
        {
        	 _box.direction=direction;
        	 _toggleButtonBar.direction=direction;
        }
        
        public function get direction():String
        {
        	return _box.direction;
        }	
        
      
        
        //manage properties and styles for components in paging
        public function  component(component:String):Object
        {
          
            	var componentReturn:UIComponent;
	            switch (component) 
	        	{
	        		case "fullLeftButton":
	        		componentReturn=_fullLeft;
	        		break;
	        	    case "leftButton":
	        		componentReturn=_left;
	        		break;
	        		case "rightButton":
	        		componentReturn=_right;
	        		break;
	        		case "fullRightButton":
	        		componentReturn=_fullRight;
	        		break;
	        		case "TogleButtonBar":
	        		componentReturn=_toggleButtonBar;
	        		break;
	        		case "Box":
	        		componentReturn=_box;
	        		break;
	        		 
	        		
	        	}
        	 
             return componentReturn;
        } 
       	
        //redraws paging when needed
		public function redrawPaging():void
		 {  
		 	 var label:uint =Math.ceil( _dataNumber/_maxData)+1
            var i:uint=1+_currentMinPagNumber
		 	 var counter:uint=0
		 	 
			 	  
			 for( i+_currentMinPagNumber ;i<label+_currentMinPagNumber;i++)
			 {      
				 	
				 if(counter<_displayLimit)
				 {
				     _navigationNumber.addItem({label: String(i)});
				 }
				 counter++
			 }
			  
		 	  
		 	 if(_navigationNumber.length<_displayLimit)
		 	 {
			 	 _leftVisibleButtons=false;
			 	 _rightVisibleButtons=false
			 	 setVisibility()
			 }
		 	  else
		 	 {
		 	    _leftVisibleButtons=true
		 	 	_rightVisibleButtons=true
		 	 	setVisibility()
		 	 }
		 	 
		 	 if(_currentMinPagNumber==0)
		 	  {
			 	 _leftVisibleButtons =false;
			 	 setVisibility()
			  }
			  
			  var max:uint=Math.ceil( _dataNumber/_maxData)+1-_displayLimit
			  if(_currentMinPagNumber>=max)
		 	  {
			  	_rightVisibleButtons =false;
			  	setVisibility()
			  }
			  
		 }
		 
		 public function set maxData(num:uint):void
		 {
		    _navigationNumber.removeAll();
		    _maxData=num;
		    redrawPaging()
		 };
	    
	     public function set displayLimit(num:uint):void  
	     {
	        _navigationNumber.removeAll();
		    _displayLimit=num;
		    redrawPaging()
		 };
	     
	     public function set dataNumber(num:uint):void  
	     {
	       _navigationNumber.removeAll();
		   _dataNumber=num;
		   redrawPaging()
		 };
		 
	     public function get maxData():uint 
	     {
		  	return _maxData;
		 };
		 
	     public function get displayLimit():uint  
	     {
		    return _displayLimit;
		 };
		 
	     public function get dataNumber():uint  
	     {
			 return _maxData;
		 };
		 
		 private function setVisibility():void
		 {
		 	 _fullLeft.visible= _leftVisibleButtons;
	        _left.visible= _leftVisibleButtons;
		    _right.visible=_rightVisibleButtons;
		    _fullRight.visible=_rightVisibleButtons;
		    
		  
		  }
		  
 
		 
        

	}
}