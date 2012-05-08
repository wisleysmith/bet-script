/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Samboliæ 
 */
package malt.components.actions
{
	import malt.components.classes.CheckData;
	import malt.components.controls.SystemBetsOverview;
	import malt.components.service.BetsAction;
	import malt.core.controls.Actions;
	
	import mx.collections.ArrayCollection;
	import mx.controls.Alert;
	import mx.managers.PopUpManager;
	import mx.resources.ResourceManager;
	import mx.rpc.events.ResultEvent;
	public class BetSlip extends Actions
	{
		private var _oddCount:Number=1; 
	    private var _service:BetsAction;  
	    private var _cash:Number;
	    private var _checkData:CheckData;
	    private	var D:Array ; 
	     private var resourceManager=ResourceManager.getInstance()
	    
	    public function constructComponent():void
 		{ 
 	      component.r.dataProvider=model('Global').betPlaced;
 		  model('Global').betPlaced.addEventListener('collectionChange',changeCollection);
 		  _service=new BetsAction(); 
 	      _checkData=CheckData.getInstance(); 
  	  	}   
  	  	
  	  	 
  	  	
  	  	public function changeCollection(event):void
  	  	{	
  	  	  _oddCount=1;
  	  		var len:uint=model('Global').betPlaced.length;
  	  		if(len==0)
  	  		{
  	  				_oddCount=1
  	  		}
  	  		for(var i:uint=0;i<len;i++)
			{
				_oddCount = _oddCount*model('Global').betPlaced.getItemAt(i)['odd'] ;
				
			}
			component.odd.text= _oddCount.toFixed(2)
		
		 setSystem()
  	  	}
  	  	
  	  	public function setSystem():void
  	  	{
  	  		if(model('Global').betPlaced.length >2)
  	  		{
  	  			
  	  			 createSystem( )  
  	  		}
  	  		else
  	  		{
  	  			 component.comList.visible=false;
		    	component.comList.includeInLayout=false;
		    	 component.systemBets.dataProvider=null
				 component.checkBoxSystem.selected=false
  	  		}
  	  	}
  	  	
  	  	
  	  
    public function  oddFormat(data:*):String
    {
    	 
		if(model('Global').oddFormat=="decimal")
		{
		   return String(data)	
		}
		else if(model('Global').oddFormat=="fractional")
		{
			 data--
		   
		   	  for(var i=1;i<10000;i++)
		   	  {
		   	  	var check=data*i
		   	  	if(check  is uint)
		   	  	{
		   	  		 
		   	  		 return check+"/"+i;
		   	  		break
		   	  	}
		   	  }
		    
		}
		else if(model('Global').oddFormat=="american")
		{
			   data--
		   
		   	  if(data<2)
		   	  {
		   	  	return  "-"+String(uint(100/data));
		   	  }
		   	  else
		   	  {
		   		  return "+"+String(data*100);
		   	  }
		    
		}
		
 return ""
						
	} 
  	  	
  	  	public function createSystem( ):void
  	  	{ 
  	  		
  	  		 if(component.checkBoxSystem.selected==true)
  	  		{
  	  			component.systemBets.enabled=true
	  	  		var combionations:ArrayCollection=new ArrayCollection();
	  	  		var len:uint=model('Global').betPlaced.length
	  	  		if(len>2)
	  	  		{
	  	  			for(var i=2;i<len;i++)
	  	  			{
	  	  				 combionations.addItem({label:i+"/"+len})
	  	  			}
	  	  		  component.systemBets.dataProvider= combionations;
	  	  		}
	  	  		else
	  	  		{
	  				 	Alert.show("Minimalno 3 događaja za sistem");
	  	  			component.checkBoxSystem.selected=false;
	  	  			 component.comList.visible=false;
			        component.comList.includeInLayout=false;
			        component.systemBets.dataProvider=null;
			        component.systemBets.enabled=false;
			        component.comWin.text=""
			        component.comStake.text=""
			        
	  	  		}
  	 	 	} 
  	 	 	else
  	 	 	{
  	 	 		component.systemBets.enabled=false;
  	 	 		 component.comList.visible=false;
			component.comList.includeInLayout=false;
			component.checkBoxSystem.selected==true
			   component.systemBets.dataProvider=null
  	 	 	}
  	  	}
  	  	
  	  	public function createCombionation(event)
  	  	{
  	 
  	  	    
  	  		
  	  		var numberOfCom:uint  
  	  		var str:String = event.currentTarget.selectedItem.label
			var a:Array = str.split(/\//); 
			 var data:Array=new Array();
  
			  for(var io:uint=0;io<a[1];io++)
			 {
			 	data[io]=io+1+"/"  
			 }  
		
		 D=new Array()
			Comb(a[0],  data , "", D)  ;
			component.comList.visible=true;
			component.comList.includeInLayout=true;
			var numOfCom:Number=D.length*_cash
             component.comStake.text="Ulog kombinacija:"+ numOfCom.toFixed(2);
           
           setCombionationWin()
  	  	}
  	  	
  	  	public function setCombionationWin()
  	  	{
  	  		  var allOdd:Number=1;
             for(var io:uint=0;io<D.length;io++)
			 {
			    var test:Array = D[io].split("/")
			    	 var oddCounter:Number=1; 
			    	 for(var ioo:uint=0;ioo<test.length-1;ioo++)
					 {
					   
					    oddCounter=oddCounter*model('Global').betPlaced.getItemAt(test[ioo]-1)['odd'] 
					 }  
					allOdd=oddCounter+allOdd
			 }  
			 
			var m:Number= allOdd*_cash 
			component.comWin.text="Dobitak komb.:"+ m.toFixed(2);
  	  	}
  	  	
  	  	public function comList():void
  	  	{
  	  		if(component.systemBets.selectedIndex==-1)
  	  	    {
  	  	    	Alert.show("Niste odabrali kombinacije.")
  	  	      return	
  	  	    }
  	  		
  	  		//var str= D.join("\n")
  	  		var stringCO:ArrayCollection=new ArrayCollection()
  	  		 for(var io:uint=0;io<D.length;io++)
			 {
			 	var test:Array = D[io].split("/")
			    	 var oddCounter:Number=1;
			         var innerAc:ArrayCollection=new ArrayCollection();
			    	 for(var ioo:uint=0;ioo<test.length-1;ioo++)
					 {
					     innerAc.addItem({"name":model('Global').betPlaced.getItemAt(test[ioo]-1)['name'],"oddname":model('Global').betPlaced.getItemAt(test[ioo]-1)['oddname'],"odddec":model('Global').betPlaced.getItemAt(test[ioo]-1)['odddec']});
					    oddCounter=oddCounter*model('Global').betPlaced.getItemAt(test[ioo]-1)['odd'] 
					 }  
					 var comString:String=D[io];
					 var bla:String= comString.substr(0,comString.length-1 )
					  var cashJonny:Number=oddCounter*_cash
					 
			       	stringCO.addItem({"system":bla,"oddCounter":oddCounter.toFixed(2),"children":innerAc,"win": cashJonny.toFixed(2)}) 
			 }  
  	             var login:SystemBetsOverview=SystemBetsOverview(PopUpManager.createPopUp(component.saveEvent, SystemBetsOverview , true));
          
           
                login.width= 700
                login.height= 400
                login.dataAC(stringCO);  
  	  		 
  	  	}
  	  	//n = number of combionation
  	  	//a=array
  	  	//z=
  	  	public function Comb(n:uint, a:Array, z, D:Array) 
		{
			 
			if (n==0) 
			{ 
				D[D.length] = z ; return 
			}
			for (var j=0 ; j < a.length ; j++)
			 { 			
			  Comb(n-1, a.slice(j+1), z+a[j], D)
			 } 
 
			return  
		}
		
	 

  	  	
  	  	public function setWin():void
  	  	{
  	  		_cash= Number(component.stake.text);
  	  		_cash=Number(_cash.toFixed(2))
  	   
  	  		component.odd.text= _oddCount.toFixed(2) ; 
  	  		 var test:Number=Number(_oddCount.toFixed(2))*_cash;
  	     component.win.text=test.toFixed(2)
  	     
  	     
  	     if(component.comList.includeInLayout)
           { 
           	component.comStake.text="Kombinacija ulog:"+ D.length*_cash
           	setCombionationWin()
           }  
  	  	}
  	  	
  	  	public function removeBet(data:uint):void
  	  	{
  	  		model('Global').betPlaced.removeItemAt(data);
  	  		 setWin();
  	  	}
  	  	
  	  	public function clearBet():void
  	  	{
  	  		component.stake.text="0";
  	  		model('Global').betPlaced.removeAll();
  	  		 setWin();
  	  	}
  	  	
  	  	public function placeBet():void
  	  	{
  	  		
  	      if(_cash>1000)
  	      {
  	      	Alert.show("maksimalni ulog je 1000");
  	      	return;
  	      }
  	  		
  	  		if(Number(component.stake.text)<0.1)
  	  		{
  	  			Alert.show("Molimo unesite ulog.")
  	  			 return
  	  		}
  	  		_service.money= Number(component.stake.text);
  	  		var len:uint=model('Global').betPlaced.length
  	  		
  	  		if(len<4)
  	  		{
  	  			Alert.show("Minimalno 3 događaja")
  	  			return;
  	  		}
  	  		var arrayData:Array=new Array();
  	  		for(var i:uint=0;i<len;i++)
  	  		{
  	  			arrayData.push([model('Global').betPlaced.getItemAt(i)['betTypeId'],model('Global').betPlaced.getItemAt(i)['odd']])
  	  		}
  	  	 
  	  		_service.betTypes=arrayData;
  	  		if(component.systemBets.selectedLabel=="")
  	  		{
  	  			_service.systemBetMin=1;
  	  			_service.systemBetMax=1;
  	  		}
  	  		else
  	  		{
  	  			Alert.show("Sistemske oklade nisu omogučene.")
  	  			return;
  	  			var string:String=component.systemBets.selectedLabel;
  	  		  	var arraySystemDC:Array=string.split("/");
  	  			_service.systemBetMin=arraySystemDC[0];
  	  			_service.systemBetMax=arraySystemDC[1]; 
  	  		}  
  	  		   _service.callUserInsertBet(insertBetResult);
  	  	}
  	  	
  	  	public function removeOutededData(data:Array):void
  	  	{
  	  		var len:uint=model('Global').betPlaced.length;
  	  		for(var i:uint=0;i<len;i++)
  	  		{
  	  			 if(model('Global').betPlaced.getItemAt(i)['betTypeId']==data[i])
  	  			 {
  	  			 	model('Global').betPlaced.removeItemAt(i)['betTypeId']
  	  			 }
  	  		}
  	  	}
  	  	
  	  	public function insertBetResult(event:ResultEvent):void
  	  	{
  	  		
 	        if(_checkData.validation(event.result)) 
	       {
	       		if (_checkData.status=="null")
		   		 {
		   		 	
		   		 	model('Global').betPlaced.removeAll()
		   		 	Alert.show("Vaša oklada je uplačena.");
		   		 	clearBet();
		   		 }
	       }
		   else
		   { 
		     	  if(_checkData.status=="oudated")
		   		 {
		   		 	
		   		 	Alert.show("Vaš listić ima evente koji su završili, molimo provjerite svoj listić.") 
		   		 	  		 model('Global').refreshBetsData();
		//    		removeOutededData(_checkData.message);
		   		 }
		   		 else if (_checkData.status=="money")
		   		 {
		   		 	Alert.show("Nemate dovoljno sredstava.")
		   		 }
		   		 else if (_checkData.status=="no")
		   		 {
		   		 		Alert.show("Problemi na serveru.")
		   		 }
		
		   }  
  	  	}
	}
}