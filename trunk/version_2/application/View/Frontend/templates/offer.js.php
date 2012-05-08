var betSlipRecordSet = new Y.Recordset();


betSlipRecordSet.on('add',
	function(e)
	{ 
		var data = e.added[0].getValue();   
		var arrayEventBets = betSlipRecordSet.getValuesByKey('event_bets_id');
		
		for(var i=0;i<arrayEventBets.length;i++)
		{ 
			if(data['event_bets_id']==arrayEventBets[i])
			{
				var selectedIn = '';
				betSlipRecordSet.each(
				function(a,b,c)
				{
					var value = a.getValue();
					if(value['event_bets_id'] == data['event_bets_id']) 
					{
						selectedIn = value['name'];
					}
				})
				
				alert("Pick already selected in:\n"+selectedIn);
				e.preventDefault();
				return;
			}
		} 
		
		var arrayBets = betSlipRecordSet.getValuesByKey('bets_id');
		
		
		
		for(var i=0;i<arrayBets.length;i++)
		{  
			if(data['bets_id']==arrayBets[i])
			{
				var selectedIn = '';
				betSlipRecordSet.each(
				function(a,b,c)
				{
					var value = a.getValue();
					if(value['bets_id'] == data['bets_id']) 
					{
						selectedIn = value['name'];
					}
				})
			 
				alert("Pick already selected in:\n"+selectedIn);
				e.preventDefault();
				return;
			}
		} 
	}
)

betSlipRecordSet.after('add',
	function(e)
	{ 
		storeToTicketCookie()
		var insertData = e.target.getRecordByIndex(e.details[0].index).getValue() ;
		var html ='<p indexid="'+insertData['odd_value_id']+'" class="eventTypeBox">'+insertData['name']+'<img  class="deleteEventType" src="<?php echo Application::getBaseRelativeUrl().'/images/delete.png';?>" height="15" width="15" /><br />';
		html+=insertData['endDate']+'<br />';
		html+=insertData['key']+'   -   '+insertData['odds']; 
		html+='</p>';
		Y.one('#ticket').append(html);
		calculateOdds() 
	}
)

betSlipRecordSet.after('remove',
	function(e)
	{
		storeToTicketCookie()
		calculateOdds();  
	}
)

function calculateOdds()
{
	var odds = betSlipRecordSet.getValuesByKey('odds');
	var completeOdds=1;
	for(var i=0;i<odds.length;i++)
	{
		completeOdds=completeOdds*parseFloat(odds[i]);
	}
	Y.one('#betOdds').setContent(completeOdds.toFixed(2));
	calculateWinnings();
}
 
Y.delegate("click", 
	function(e)
	{     
		var odd_id = e.target.ancestor('.eventTypeBox').getAttribute('indexid');
  		var targetBox = e.target.ancestor('.eventTypeBox');
  		betSlipRecordSet.each(
			function(a,b,c)
			{
				var value = a.getValue(); 
				if(value['odd_value_id'] == odd_id) 
				{
					betSlipRecordSet.remove(b); 
					targetBox.remove();	
				}
			}
		)
	}
, Y.config.doc,'.deleteEventType')


function storeToTicketCookie()
{
	var records = betSlipRecordSet.get('records');
	var cookieHolder = {info:new Array()};
	for(var i=0;i<records.length;i++)
	{
		 cookieHolder['info'].push(records[i].get('data'));
	} 
	
	Y.Cookie.set("ticket", Y.JSON.stringify(cookieHolder));  
} 

Y.one('#betStake').on('keyup',
	function(e)
	{
		calculateWinnings();
	}
)

function calculateWinnings()
{
	var value = Y.one('#betStake').get('value'); 
	value = value.replace(',','.')
	var checkIfValid = value.split('.');
	if(checkIfValid[1]!=undefined)
	{
		if(checkIfValid[1].length>2)
		{ 
			var newValue = parseFloat(value);
		
			Y.one('#betStake').set('value',newValue.toFixed(2));
			alert('Only 2 decimal position allowed')
			return;
		}
	}
	var winnings =0;
	if(isNaN(value)==false)
	{
		winnings = value*Y.one('#betOdds').getContent();
	}
	
	Y.one('#betWinnings').setContent(winnings.toFixed(2));
}

Y.one('#placeBet').on('click',
	function(e)
	{
		<?php
			$user = new Core_Auth_User(); 
			$role = $user->getRole();
			if($role=='guest')
			{
				?>
				alert('Please login');
				return;
			<?php
			} 
		?>
		
		var oddsValues = betSlipRecordSet.getValuesByKey('odd_value_id'); 
	 	var oddsValuesString = '';
	 	
	 	if(oddsValues.length==0)
	 	{
	 		alert('Bet splip empty')
	 		return;
	 	}
	
		var value = Y.one('#betStake').get('value');
	
		if(isNaN(value)==true||value=='')
		{
			alert('Please enter stake');
			return;
		}
		 
		if(value<0.01)
		{
			alert('Please enter stake');
			return;
		} 
	 	
	 	for(var i=0;i<oddsValues.length;i++)
		{ 
		 	oddsValuesString+='&model[Model_PlaceBetModel][odds][]='+oddsValues[i];
	 	}
	 
		var uri ='<?php echo  Application::getRouter()->getUrl(array('controller'=>'servicejson','action'=>'model')) ?>';
		var cfg = { 
	    	method: 'POST', 
	    	data:'method=insert&model[Model_PlaceBetModel][stake]='+value+oddsValuesString,
	         on: { 
					success: function(id, o, args) 
					{ 	 
						var result = Y.JSON.parse(o.responseText);
						if(result.status=='ok')
				      	{    
							 alert('Bet is placed')
							 return;
						}
				      	else if(result.status=='error')
				      	{
				      		var alertMessage = '';
				      		for(var instance in result.errors) 
					      	{
					    		for(var i=0;i< result.errors[instance].length;i++)
								{
					    			alertMessage+= result.errors[instance][i]+'\n';
					    		} 
							} 
				          	
				      		alert(alertMessage);
				      	}
					},
					failure: function(){alert("Error on server, please try later")},
			}, 
	    }; 
		Y.io(uri, cfg);    
	}
)

Y.one('#resetBet').on('click',
	function(e)
	{
		Y.one('#ticket').setContent('');
		betSlipRecordSet.empty(); 
		calculateOdds() ; 
		storeToTicketCookie(); 
	}
)
  
  
var ticketCookie =  Y.Cookie.get("ticket");
var ticketCookieInfo = Y.JSON.parse(ticketCookie);
if(ticketCookieInfo!=null)
{
	for(var i=0;i<ticketCookieInfo.info.length;i++)
	{
		betSlipRecordSet.add(ticketCookieInfo.info[i]);
	}
}