/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.controls
{
	import mx.containers.Box;
	import mx.controls.DateField;
	import mx.controls.Label;
	import mx.controls.TextInput;
	import mx.core.LayoutContainer;
	import mx.events.CalendarLayoutChangeEvent;
	import flash.events.Event;
	public class DateTimer extends LayoutContainer
	{   //formated dateTime
	    private var _formatedTime:String;
		//formate data form dateField
		private var _formatedDate:String;
		//hours,min,sek
		private var _clockData:String="00:00:00";
		private var _hours:TextInput;
		private var _min:TextInput;
	 //	private var _sek:TextInput;
		private var _divateLabel:Label; 
		private var _box:Box;
		private var _dateField:DateField;
		 
		public function DateTimer()
		{
			super();
			_box=new Box();
		    _box.direction="horizontal";
		    addChild(_box)
		    //this.setStyle("verticalGap",0)
		   // this.setStyle("horizontalGap",0)
		     //this.setStyle("paddingRight",0) 
		    // this.setStyle("paddingLeft",0) 
		     
		    _hours=new TextInput();
		    _hours.maxChars=2;
		    _hours.text="00"
		   
		    _min=new TextInput();
		    _min.maxChars=2;
		    _min.text="00"
		    
		  //  _sek=new TextInput();
		  //  _sek.maxChars=2;
		    
		   _divateLabel=new Label(); 
		   _divateLabel.text=":"
		   
		  
		    var object=new Object();
		   object['rangeStart']=new Date();
		    
		    _dateField=new DateField();
		   /*  _dateField.selectableRange=object*/
		    _dateField.selectedDate=new Date();
		     var date=new Date()
		     var zero:String=""
		     if(date.month<10)
		     {
		     	zero="0"
		     }
		    _formatedTime="0"	;
		    _formatedDate=_dateField.selectedDate.getFullYear()+"-"+  (_dateField.selectedDate.getMonth()+1)+"-"+_dateField.selectedDate.getDate();
		    _box.addChild(_dateField)
		    _box.addChild(_hours)
		    _box.addChild(_divateLabel)
		    _box.addChild(_min);
		   // addChild(_divateLabel)
		   // addChild(_sek)
		 //   addChild(_divateLabel)
			
		    _hours.addEventListener("change",hoursChange)
		    _min.addEventListener("change",minChange) 
			_dateField.addEventListener("change",useDate)
		}
		
		public function get dateField():DateField
		{
			return _dateField;
		}
		
		private function hoursChange(event:Event):void
		{
			if(_hours.text!="")
			{
				if(uint(_hours.text)>23)
				{
					_hours.text="00"
				}
				else if(uint(_hours.text)==0)
				{
					_hours.text="0";
				}
			} 
				_clockData=_hours.text+":"+_min.text+":00";
				_formatedTime=_formatedDate+" "+_clockData;
		}
	
	    private function minChange(event:Event):void
		{
			if(_min.text!="")
		    {
				 if(uint(_min.text)>60)
				 {
					 _min.text="00"
				 }
				 else if(uint(_min.text)==0)
				 {
					 _min.text="0"
				 }
			}
			_clockData=_hours.text+":"+_min.text+":00";
			_formatedTime=_formatedDate+" "+_clockData;
		}
		 
		
		
	    private function useDate(eventObj:CalendarLayoutChangeEvent):void
        {
          
            if (eventObj.currentTarget.selectedDate == null) {
                return 
            }
	 			_formatedDate  = eventObj.currentTarget.selectedDate.getFullYear()+"-"+  (eventObj.currentTarget.selectedDate.getMonth()+1)+"-"+eventObj.currentTarget.selectedDate.getDate();
         _formatedTime=_formatedDate+" "+_clockData;
         }
		
	   public function get formatedTime():String
	   {
	   	 	if(_formatedTime=="0")
	   	 	{
	   	 		_formatedTime=_dateField.selectedDate.getFullYear()+"-"+  (_dateField.selectedDate.getMonth()+1)+"-"+_dateField.selectedDate.getDate()+" "+_clockData;
	   	 	}
	   		  return _formatedTime;
	   }
	   
	     public function set formatedTime(data:String):void
	   {
	   		if(data=="0000-00-00 00:00:00")
			{
				var dates=new Date();
			}
			else
			{
				_formatedTime=data
				var year =Number(data.substr(0,4));
				 if(data.substr(5,1)=="0")
				 {
					var month =Number(data.substr(6,1));
					 month--
				 }
				 else if(data.substr(5,1)!="0")
				 {
					month =Number(data.substr(5,2));
					month--
				}
				var day  = Number(data.substr(8,2));
			    var  dates = new Date(year,month,day);
			     _hours.text=data.substr(11,2)
			     _min.text=data.substr(14,2)
			//	dateNew = String(year)+"-"+String(month)+"-"+String(day)
			}  
	        _dateField.selectedDate=dates;  
	         
	   }
	   
	   public function get hours():uint
	   {
	   	   return uint(_hours.text);
	   }
	   
	   public function get min():uint
	   {
	      return uint(_min.text);
	   }
	}
}