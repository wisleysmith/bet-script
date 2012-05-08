<?php 
/**
 * @copyright   Copyright (c) 2009 Oxidian d.o.o (http://www.oxidian.hr)
 * @license     http://www.opensource.org/licenses/GPL-2.0 GPL 2.0
 * @author      Goran Sambolic 
 */

/**
 * put this file on your zend layout file, its YUI 3 code for handling frontend.
 * load javascript based on current controller or action
 * you can disable this by removing if then.
 * you can also place this script in your view
 * dont forget to load yui 3 library in template or view.
 <script src="http://yui.yahooapis.com/3.2.0/build/yui/yui-min.js"></script>
 */
$controllerName = $front->getRequest()->getControllerName();
$actionName = $front->getRequest()->getActionName();
$paramName = $front->getRequest()->getParams(); 

?>

<script>

YUI().use( 'anim','dd','node','event','event-valuechange', 'io-base','json-parse','overlay','widget','yui', 'tabview', function(Y) {
	var pagLinks= Y.one("#category-left"); 

    var cat=2;
	var curentElementRequest;
	function preventClick(e)
	{
		if(curentElementRequest==e.target)
		{
			e.preventDefault();
		}	
	}	
    
    Y.on('click',preventClick);
	
    function makeRequest()
	{   
		cfg['sync']=false; 
		var request = Y.io(sUrl, cfg); 
	}


	function onStartIO(transactionid, arguments) 
	{ 
		Y.one("body").setStyle("cursor","wait");
	}
		 
		// Subscribe to "io.start".
	  Y.on('io:start', onStartIO );

	function onEndIO(transactionid, arguments) {
			Y.one("body").setStyle("cursor","auto");
	}
			// Subscribe to "io.start".
	Y.on('io:end', onEndIO );
	<?
	 if($controllerName=="virtualbetting"&&$actionName=="index") 
 	  { 
 	  ?> 
 
 	    var sportLangId="";
		var sport= Y.one("#leagues"); 
		var commentAlive = Y.one("#commentAlive");
		var commentBox =Y.one("#commentBox");
		var betButtonSend=Y.one('#betButton');
		var oddsValues=1;
 		var ticketDiv= Y.one("#ticket");
 		var pairs="";
		commentAlive.on("click", function (e) 
		{  
			if(commentAlive.get('checked'))
			{
				commentBox.setStyle('display','block'); 
			} 
			else
			{
				commentBox.setStyle('display','none');
			} 	
		} );


		betButtonSend.on("click", function (e) 
		{  
			placeBet() ;
		} );

		var insertBetHandleSuccess = function(ioId, o){ 
			betStatus=0;
			var data = Y.JSON.parse(o.responseText); 
			if(data.data[0].value=="1")
			{
				alert(data.data[0].mess); 
				var ticketDivs= Y.one("#ticket").all("div");
	 			oddsValues=1; 
	 			Y.each(ticketDivs, function(v, k) 
	 		 	{ 
	 	 		 	v.remove(); 
	  		   }) 
		  		pairs="";
	    		Y.one("#odds").set("innerHTML","1");
	 			Y.one("#possibleWinning").set("innerHTML","0");
	 			moneyInput.get('value') ;
	 			moneyInput.set('value','0');
			}
			else
			{
				alert(data.data[0].mess); 
			}	
 			
		}; 

		var insertBetHandleFailure = function(ioId, o){ 
			betStatus=0;
		}; 
		var betStatus=0;
		function placeBet()
 		{ 
			if(betStatus==1)
	 		{
		 		return;
	 		}
			var money=moneyInput.get('value');
	 	
	 		if(money<=0)
	 		{
		 		alert("Niste unjeli ulog");
		 		return;
	 		}	

	 		if(pairs=="")
	 		{
				alert("Niste odabrali event");
				return;
		 	}
	 	
	 		var comment="";
	 		var visible="";
 
			
	 		if(Y.one("#ticketVis1").get('checked'))
		 	{
	 			visible="visiblebet=1&";
		 	}

	 		if(Y.one("#ticketVis2").get('checked'))
		 	{
	 			visible="visiblebet=2&";
		 	}

	 		if(Y.one("#ticketVis3").get('checked'))
		 	{
	 			visible="visiblebet=3&";
		 	}
	 		
	 		
	 		if(commentAlive.get('checked'))
	 		{
	 			comment="commenttrue=1&commentvalue="+commentBox.get('value')+"&";
	 		}	
	 		
 			sourceChecked=new Array();
 			var data=visible+comment+"money="+money+"&"+pairs; 
 			  cfg = {
 					method: "POST", 
 					data: data, 
 					headers: { 'X-Transaction': 'POST Example'},
 					 on: {
 				        //Our event handlers previously defined: 
 				        success: insertBetHandleSuccess,
 				        failure: insertBetHandleFailure  
 				    } 
 			};
 		    sUrl = "<?php echo $this->url( array(  'module'=>'default','controller'=>'virtualbetting', 'action'=>'insertbet' ), 'default', true)  ?>";
 		    betStatus=1;
 			makeRequest();
 		};
		
		//Y.one("#typesLeagues").set("innerHTML",o.responseText);
 		sport.delegate("click", function (e) 
 		{  
 			Y.one("#typesLeagues").set("innerHTML","");
			 sportLangId=e.target.getAttribute('linkid');  
 			virtualTypes( sportLangId);
 		}, "a");

 	
 		function calculateOdds()
 		{
 			pairs=""
 			var ticketDivs= Y.one("#ticket").all("div");
 			oddsValues=1; 
 			Y.each(ticketDivs, function(v, k) 
 		 	{ 
 	 		 	oddsValues=parseFloat(oddsValues)*parseFloat(v.getAttribute('value')); 
 	 		 	pairs+="pairs[]="+v.getAttribute('linkid')+"&"; 
 	 		 	
  		   }) 
  		   oddsValues=oddsValues.toFixed(2);
    		Y.one("#odds").set("innerHTML",oddsValues);
 		}	

 		var moneyInput=Y.one('#stake');
 		moneyInput.on('valueChange',function()
 		{ 
 			Y.one("#possibleWinning").set("innerHTML",moneyInput.get('value')*oddsValues);
 	 	})	
 
 		ticketDiv.delegate("click", function (e) 
 		{   
			 e.target.ancestor('div').remove();  
 			 calculateOdds(); 
 		}, "#deleteBet");
		
 		
 		var virtualTypesHandleSuccess = function(ioId, o){ 
 			Y.one("#types").set("innerHTML",o.responseText);
		}; 

		var virtualTypesHandleFailure = function(ioId, o){ 
		}; 

		var leaguesTypes= Y.one("body").one("#types"); 
		var bets =  Y.one("body").one("#typesLeagues");
	 	
		bets.delegate("click", function (e) 
 		{   
	 		var betid=e.target.getAttribute('betid'); 
	 		var ticketDivs= Y.one("#ticket").all("div");
 			var isOk=true;
 			Y.some(ticketDivs, function(v, k) 
 		 	{   
  	 			if(betid==v.getAttribute('betid'))
 		 		{ 
 			 		alert("Samo je jedan event dozvoljen po listicu");
 			 		isOk=false;
 			 		return true;
 		 		}	 
  		   }) 
	 	
	 		if(!isOk)
	 		{
		 		return false;
	 		}
 			var id=e.target.getAttribute('linkid'); 
 			var value=e.target.get('innerHTML'); 
 			var betName = e.target.ancestor('.betRow').one('.betName').get('innerHTML');
 			var name =e.target.getAttribute('value'); 
  			var link=Y.Node.create(
  		  			'<div  style="border:1px solid orange;padding:5px;margin:2px;" linkid="'+id+'" betid="'+betid+'" value="'+value+'" >'+betName+' <br /> Izbor : '+name+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Koef: '+value+' <a href="javascript:void(0)" id="deleteBet" >Obriši</a> </div>'
  		  	);
  		  	Y.one('#ticket').append(link);
    		calculateOdds()
 		}, "a");

		leaguesTypes.delegate("click", function (e) 
		 {   
			id=e.target.getAttribute('linkid'); 
		 	listOfBets(id);
		 }, "a");
		 
 		var betDetailsHandleSuccess = function(ioId, o){ 
 			Y.one("#typesLeagues").set("innerHTML",o.responseText);
		}; 

		var betDetailsHandleFailure  = function(ioId, o){ 
		}; 
		
		function listOfBets(value)
 		{ 
 			sourceChecked=new Array();
 			var data="value="+value+"&lang="+sportLangId; 
 			  cfg = {
 					method: "POST", 
 					data: data, 
 					headers: { 'X-Transaction': 'POST Example'},
 					 on: {
 				        //Our event handlers previously defined: 
 				        success: betDetailsHandleSuccess,
 				        failure: betDetailsHandleFailure  
 				    } 
 			};
 		    sUrl = "<?php echo $this->url( array(  'module'=>'default','controller'=>'virtualbetting', 'action'=>'betsdetails' ), 'default', true)  ?>";
 			makeRequest();
 		};
 		
 		function virtualTypes(value)
 		{ 
 			sourceChecked=new Array();
 			var data="value="+value; 
 			  cfg = {
 					method: "POST", 
 					data: data, 
 					headers: { 'X-Transaction': 'POST Example'},
 					 on: {
 				        //Our event handlers previously defined: 
 				        success: virtualTypesHandleSuccess,
 				        failure: virtualTypesHandleFailure  
 				    } 
 			};
 		    sUrl = "<?php echo $this->url( array(  'module'=>'default','controller'=>'virtualbetting', 'action'=>'types' ), 'default', true)  ?>";
 			makeRequest();
 		};
 		<?php 
 		}; 
 		?> 
	
	
	<?php 
  		if($controllerName=="virtualbetting"&&($actionName=="account"||$actionName=="bets")) 
  		{ 
  		?> 
  		var refresh=Y.one('#refresh');
  		refresh.on('click',function(e){
			<?php 
  					
  					if(Zend_Auth::getInstance()->getIdentity())
  			    	{ 
  			    		 echo "accountStatus();";
  			    	}
  			    	else
  			    	{
  			    		echo "alert('Niste ulogirani')";
  			    	}
  					?>
  			
  	  	} )
  	  	
  	  	function accountStatus()
 		{ 
  			var first=Y.one('#first').get('checked');
  			var second=Y.one('#second').get('checked');
  			var selectfirstdate=Y.one('#selectfirstdate').get('value');
  			var selectfirstmonth=Y.one('#selectfirstmonth').get('value');
  			var selectfirstyear=Y.one('#selectfirstyear').get('value');
  			var selectsecondday=Y.one('#selectsecondday').get('value');
  			var selectsecondmonth=Y.one('#selectsecondmonth').get('value');
  			var selectsecondyear=Y.one('#selectsecondyear').get('value'); 
 			sourceChecked=new Array();
 			var data="first="+first+"&second="+second+"&selectfirstdate="+selectfirstdate+"&selectfirstmonth="+selectfirstmonth+"&selectfirstyear="+selectfirstyear+"&selectsecondday="+selectsecondday+"&selectsecondmonth="+selectsecondmonth+"&selectsecondyear="+selectsecondyear; 
 			  cfg = {
 					method: "POST", 
 					data: data, 
 					headers: { 'X-Transaction': 'POST Example'},
 					 on: {
 				        //Our event handlers previously defined: 
 				        success: accountHandleSuccess,
 				        failure: accountHandleFailure
 				    } 
 			};
 		    sUrl = "<?php if($actionName=="account"){echo $this->url( array(  'module'=>'default','controller'=>'virtualbetting', 'action'=>'accountreport' ), 'default', true);}else{echo $this->url( array(  'module'=>'default','controller'=>'virtualbetting', 'action'=>'betsreport' ), 'default', true);};  ?>";
 			makeRequest();
 		};

 		var accountHandleSuccess = function(ioId, o){ 
 			Y.one("#bodyContent").set("innerHTML",o.responseText);
		}; 

		var accountHandleFailure  = function(ioId, o){ 
		}; 
  		
   	   <?php 
 		}
 	    ?>   
	
});  