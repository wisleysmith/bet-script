package malt.components.actions
{
	import malt.components.classes.CheckData;
	import malt.components.controls.SystemBetsOverview;
	import malt.components.service.BetsAction;
	import malt.core.controls.Actions;
	
	import mx.collections.ArrayCollection;
	import mx.controls.Alert;
	import mx.managers.PopUpManager;
	import mx.rpc.events.ResultEvent;
	public class BetSlip extends Actions
	{
		private var _oddCount:uint=1; 
	    private var _service:BetsAction;  
	    private var _cash:uint;
	    private var _checkData:CheckData;
	    private	var D:Array =new Array() ; 
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
  	  				_oddCount=0
  	  		}
  	  		for(var i:uint=0;i<len;i++)
			{
				_oddCount = _oddCount*model('Global').betPlaced.getItemAt(i)['odddec'] ;
			}
			component.odd.text=oddFormat(_oddCount) ; 
		
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
	  	  			Alert.show("Minimalno 3 događaja za sistem")
	  	  			component.checkBoxSystem.selected=false
	  	  			 component.comList.visible=false;
			        component.comList.includeInLayout=false;
			        component.systemBets.dataProvider=null
			        
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
		
		 
			Comb(a[0],  data , "", D)  ;
			component.comList.visible=true;
			component.comList.includeInLayout=true;
 
  	  	}
  	  	
  	  	public function comList():void
  	  	{
  	  		//var str= D.join("\n")
  	  		var string:ArrayCollection=new ArrayCollection()
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
			       	string.addItem({"system":bla,"oddCounter":oddCounter,"children":innerAc,"win":oddCounter*_cash}) 
			 }  
  	             var login:SystemBetsOverview=SystemBetsOverview(PopUpManager.createPopUp(component.saveEvent, SystemBetsOverview , true));
          

                login.width=800
                login.height=500
                login.dataAC( string );  
  	  		 
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
  	  		_cash= uint(component.stake.text);
  	  		component.odd.text=oddFormat(_oddCount) ; 
  	  		component.win.text=_oddCount*_cash;
  	     
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
  	  		if(Number(component.stake.text)<0.1)
  	  		{
  	  			Alert.show("Unesite ulog")
  	  			//return
  	  		}
  	  		_service.money= Number(component.stake.text);
  	  		var len:uint=model('Global').betPlaced.length
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
		   		 	
		   		 	
		   		 	Alert.show("Oklada je uplačena");
		   		 	clearBet();
		   		 }
	       }
		   else
		   { 
		     	  if(_checkData.status=="oudated")
		   		 {
		   		 	Alert.show("Vaš listić ima događaje koji su završili. Provjeriti svoj listić") 
		   		 	  		 model('Global').refreshBetsData();
		//    		removeOutededData(_checkData.message);
		   		 }
		   		 else if (_checkData.status=="money")
		   		 {
		   		 	Alert.show("Nemate dovoljno novca")
		   		 }
		   		 else if (_checkData.status=="no")
		   		 {
		   		 		Alert.show("Problemi na serveru probajte kasnije")
		   		 }
		
		   }  
  	  	}
	}
}