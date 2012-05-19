Y.one('#sport_select').on('change',
	function(e)
	{ 
		resetView();
		var uri ='<?php echo  Application::getRouter()->getFullUrl(array('controller'=>'servicehtml','action'=>'view','params'=>'view=View_Admin_Widgets_GroupsSelect')) ?>&sports_id='+e.currentTarget.get('value');
		var cfg = { 
	    	method: 'POST', 
	         on: { 
					success: function(id, o, args) 
					{ 	 
						var result = Y.JSON.parse(o.responseText);
						if(result.status=='ok')
				      	{   
							 Y.one('#groupContent').setContent(result.html);
							  Y.one('#teamsContent').setContent();
							  setGroupListner()
							 eval(result.javascript);
						}
				      	else if(result.status=='error')
				      	{
				      		alert("Error on server, please try later")
				      	}
					},
					failure: function(){alert("Error on server, please try later")},
			}, 
	    }; 
		var request = Y.io(uri, cfg);  
		
		var uriEventsTypes ='<?php echo  Application::getRouter()->getFullUrl(array('controller'=>'servicehtml','action'=>'view','params'=>'view=View_Admin_Widgets_EventTypesSelect')) ?>&sports_id='+e.currentTarget.get('value');
		var cfgEventsTypes = { 
	    	method: 'POST', 
	         on: { 
					success: function(id, o, args) 
					{ 	 
						var result = Y.JSON.parse(o.responseText);
						if(result.status=='ok')
				      	{   
							 Y.one('#eventsTypesContent').setContent(result.html);
							 setEventTypesListener(); 
							 eval(result.javascript);
						}
				      	else if(result.status=='error')
				      	{
				      		alert("Error on server, please try later")
				      	}
					},
					failure: function(){alert("Error on server, please try later")},
			}, 
	    }; 
		Y.io(uriEventsTypes, cfgEventsTypes);  
	}
)
 
Y.one('#saveEvent').on('click',
	function(e)
	{   
		//Y.one('select[name=groups_id]').get('value')
	 
		disableError('#errorGroup'); 
		disableError('#errorEventEnd');
		disableError('#errorEventActive');
		disableError('#errorEventName');
		var isValid = true;
		
		if(Y.one('select[name=groups_id]')==null)
		{ 
			Y.one('#errorGroup').setStyle('display','block'); 
			Y.one('#errorGroup').setContent('Group not set'); 
			isValid = false;
		} 
		else
		{
			if(Y.one('select[name=groups_id]').get('value')=='')
			{
				Y.one('#errorGroup').setStyle('display','block'); 
				Y.one('#errorGroup').setContent('Please select group');
				isValid = false;
			}
		}
		 
		if(Y.one('#eventName').get('value')=='')
		{
			Y.one('#errorEventName').setStyle('display','block'); 
			Y.one('#errorEventName').append('<br />Please set event name');
			isValid = false;
		}
		 
		if(Y.one('#end').get('value')=='')
		{
			Y.one('#errorEventEnd').setStyle('display','block'); 
			Y.one('#errorEventEnd').append('<br />Please select event end date');  
			isValid = false;
		}
		
		if(Y.one('#active').get('value')=='')
		{
			Y.one('#errorEventActive').setStyle('display','block'); 
			Y.one('#errorEventActive').append('<br />Please select event active date');  
			isValid = false;
		} 
		
		if(Y.one('select[name=minutes_active]').get('value') =='')
		{
			Y.one('#errorEventActive').setStyle('display','block'); 
			Y.one('#errorEventActive').append('<br />Please select event active minutes');  
			isValid = false;
		} 
		
		if(Y.one('select[name=minutes_end]').get('value') =='')
		{
			Y.one('#errorEventEnd').setStyle('display','block'); 
			Y.one('#errorEventEnd').append('<br />Please select event end minutes');  
			isValid = false;
		} 
		 
		
		if(Y.one('select[name=hours_active]').get('value') =='')
		{
			Y.one('#errorEventActive').setStyle('display','block'); 
			Y.one('#errorEventActive').append('<br />Please select event active hours');  
			isValid = false;
		} 
		
		if(Y.one('select[name=hours_end]').get('value') =='')
		{
			Y.one('#errorEventEnd').setStyle('display','block'); 
			Y.one('#errorEventEnd').append('<br />Please select event end minutes');  
			isValid = false;
		} 
		 
		  
		 var yearEnd = Y.one('#end').get('value');
		 var yearActive = Y.one('#active').get('value'); 
		  
		 var minutesEnd = Y.one('select[name=minutes_end]').get('value');
		 var minutesActive = Y.one('select[name=minutes_active]').get('value');
		 
		 var hoursActive = Y.one('select[name=hours_active]').get('value');
		 var hoursEnd = Y.one('select[name=hours_end]').get('value'); 
		  
		 var yearEndArray = yearEnd.split('-'); 
		 var yearActiveArray = yearActive.split('-'); 
		
	 
		 var endDate =  new Date(yearEndArray[0],yearEndArray[1],yearEndArray[2],hoursEnd,minutesEnd);
		 var activeDate =  new Date(yearActiveArray[0],yearActiveArray[1],yearActiveArray[2],hoursActive,minutesActive);
		 
		 if(isNaN(endDate.getTime()))
		 {
			Y.one('#errorEventActive').setStyle('display','block'); 
		 	Y.one('#errorEventActive').append('<br />End time is not valid time');  
		 };

		 if(isNaN(activeDate.getTime()))
		 {
			Y.one('#errorEventActive').setStyle('display','block'); 
		 	Y.one('#errorEventActive').append('<br />Active time is not valid time');  
		 };
		
		 if(endDate.getTime()<=activeDate.getTime())
		 {
		 	Y.one('#errorEventActive').setStyle('display','block'); 
		 	Y.one('#errorEventActive').append('<br />Active time cant be larger or equal to end time');  
		 	isValid = false;	
		 }
		  
		 if(isValid == false)
		 {
			return;
		 }
		 
		 var postData = '&model[Model_BetsModel][bet_name]='+Y.one('#eventName').get('value');
		 postData+='&model[Model_BetsModel][groups_id_FK]='+Y.one('select[name=groups_id]').get('value') 
		 postData+='&model[Model_BetsModel][end_date]='+yearEnd+' '+hoursEnd+':'+minutesEnd+':'+'00'
		 postData+='&model[Model_BetsModel][bet_active]='+yearActive+' '+hoursActive+':'+minutesActive+':'+'00'
		 
		 
		var uri ='<?php echo  Application::getRouter()->getFullUrl(array('controller'=>'servicejson','action'=>'model')) ?>';
		var cfg = { 
	    	method: 'POST', 
	    	data:'method=insert'+postData,
	         on: { 
	         
					success: function(id, o, args) 
					{ 	 
						var result = Y.JSON.parse(o.responseText);
						if(result.status=='ok')
				      	{   
							alert('Event saved');
							Y.one('#sport_select').set('selectedIndex',0);
							resetView();
						}
				      	else if(result.status=='error')
				      	{
				      		alert("Error on server, please try later")
				      	}
					},
					failure: function(){alert("Error on server, please try later")},
			}, 
	    }; 
		var request = Y.io(uri, cfg);  
	}
)
  
function disableError(id)
{
		Y.one(id).setStyle('display','none'); 
		Y.one(id).setContent(''); 
}


function setGroupListner()
{  
 	Y.one('select[name=groups_id]').on('change',
		function(e)
		{  
			var uri ='<?php echo  Application::getRouter()->getFullUrl(array('controller'=>'servicehtml','action'=>'view','params'=>'view=View_Admin_Widgets_TeamsTable')) ?>&groups_id='+e.currentTarget.get('value');
			var cfg = { 
		    	method: 'POST', 
		         on: { 
						success: function(id, o, args) 
						{ 	 
							var result = Y.JSON.parse(o.responseText);
							if(result.status=='ok')
					      	{   
								 Y.one('#teamsContent').setContent(result.html);
								 eval(result.javascript);
							}
					      	else if(result.status=='error')
					      	{
					      		alert("Error on server, please try later")
					      	}
						},
						failure: function(){alert("Error on server, please try later")},
				}, 
		    }; 
			Y.io(uri, cfg);  
		 
			var uriEvents ='<?php echo  Application::getRouter()->getFullUrl(array('controller'=>'servicehtml','action'=>'view','params'=>'view=View_Admin_Widgets_EventsSelect')) ?>&groups_id='+e.currentTarget.get('value');
			var cfgEvents = { 
		    	method: 'POST', 
		         on: { 
						success: function(id, o, args) 
						{ 	 
							var result = Y.JSON.parse(o.responseText);
							if(result.status=='ok')
					      	{   
								 Y.one('#eventsContent').setContent(result.html);
								   setBetsListener();
								 eval(result.javascript);
							}
					      	else if(result.status=='error')
					      	{
					      		alert("Error on server, please try later")
					      	}
						},
						failure: function(){alert("Error on server, please try later")},
				}, 
		    }; 
			Y.io(uriEvents, cfgEvents);  
		} 
	)
} 

function setEventTypesListener()
{  
 	Y.one('select[name=event_types_id]').on('change',
		function(e)
		{  
			var uri ='<?php echo  Application::getRouter()->getFullUrl(array('controller'=>'servicehtml','action'=>'view','params'=>'view=View_Admin_Widgets_CreateBetOddsTable')) ?>&event_types_id='+e.currentTarget.get('value');
			var cfg = { 
		    	method: 'POST', 
		         on: { 
						success: function(id, o, args) 
						{ 	 
							var result = Y.JSON.parse(o.responseText);
							if(result.status=='ok')
					      	{   
								 Y.one('#eventValues').setContent(result.html); 
								 eval(result.javascript);
							}
					      	else if(result.status=='error')
					      	{
					      		alert("Error on server, please try later")
					      	}
						},
						failure: function(){alert("Error on server, please try later")},
				}, 
		    }; 
			Y.io(uri, cfg);   
		} 
	)
}

function setBetsListener()
{  
 	Y.one('select[name=bets_id]').on('change',
		function(e)
		{   
			var uri ='<?php echo  Application::getRouter()->getFullUrl(array('controller'=>'servicejson','action'=>'model')) ?>';
			var selectedIndex = e.currentTarget.get('selectedIndex');
			var options = e.currentTarget.get('options');
			Y.one('#betName').set('value',options.get('nodes')[selectedIndex].get('label')); 
			var cfg = { 
		    	method: 'POST',  
		    	data:'method=load&model[Model_BetsModel][filter][bets_id]='+e.currentTarget.get('value'),
		         on: { 
						success: function(id, o, args) 
						{ 	 
							var result = Y.JSON.parse(o.responseText);
							if(result.status=='ok')
					      	{   
					      		 var add = result.data.add_date; 
					      		 var end = result.data.end_date;
					      		 
					      		 Y.one('#eventStart').setContent(add);
	 							 Y.one('#eventEnds').setContent(end);
					      		  
								 eval(result.javascript);
								 return;
							}
					      	else if(result.status=='error')
					      	{
					      		alert("Error on server, please try later")
					      	}
						},
						failure: function(){alert("Error on server, please try later")},
				}, 
		    }; 
			Y.io(uri, cfg);   
		} 
	)
} 

Y.one('#saveBet').on('click',
	function(e)
	{    
		disableError('#errorGroup'); 
		disableError('#errorEventsContent');
		disableError('#errorTypesContent');
		disableError('#errorBetName'); 
		var isValid = true;
		
		var  oddsData ="";
		Y.all('.oddsInput').each(function (node) 
		{
		    oddsData+='&model[Model_CreateBetModel][odds_data]['+node.getAttribute('valueid')+']='+node.get('value');
		});
		 
		if(Y.one('select[name=groups_id]')==null)
		{ 
			Y.one('#errorGroup').setStyle('display','block'); 
			Y.one('#errorGroup').setContent('Please select group'); 
			isValid = false;
		} 
		else
		{
			if(Y.one('select[name=groups_id]').get('value')=='')
			{
				Y.one('#errorGroup').setStyle('display','block'); 
				Y.one('#errorGroup').setContent('Please select group');
				isValid = false;
			}
		}
		 
		if(Y.one('#betName').get('value')=='')
		{
			Y.one('#errorBetName').setStyle('display','block'); 
			Y.one('#errorBetName').append('<br />Please set event name');
			isValid = false;
		}
		 
		if(Y.one('select[name=event_types_id]')==null)
		{ 
			Y.one('#errorTypesContent').setStyle('display','block'); 
			Y.one('#errorTypesContent').setContent('Event Type not set'); 
			isValid = false;
		} 
		else
		{
			if(Y.one('select[name=event_types_id]').get('value')=='')
			{
				Y.one('#errorTypesContent').setStyle('display','block'); 
				Y.one('#errorTypesContent').setContent('Event type not set');
				isValid = false;
			}
		}
		
		if(Y.one('select[name=bets_id]')==null)
		{ 
			Y.one('#errorEventsContent').setStyle('display','block'); 
			Y.one('#errorEventsContent').setContent('Event not set'); 
			isValid = false;
		} 
		else
		{
			if(Y.one('select[name=bets_id]').get('value')=='')
			{
				Y.one('#errorEventsContent').setStyle('display','block'); 
				Y.one('#errorEventsContent').setContent('Event not set');
				isValid = false;
			}
		}
		   
		if(isValid == false)
		{
			return;
		}
		   
		var postData = '&model[Model_CreateBetModel][bets_id_FK]='+Y.one('select[name=bets_id]').get('value'); 
		postData+= '&model[Model_CreateBetModel][event_types_id_FK]='+Y.one('select[name=event_types_id]').get('value'); 
		postData+= '&model[Model_CreateBetModel][event_bets_name]='+Y.one('#betName').get('value'); 
		
		 
		 
		var uri ='<?php echo  Application::getRouter()->getFullUrl(array('controller'=>'servicejson','action'=>'model')) ?>';
		var cfg = { 
	    	method: 'POST', 
	    	data:'method=insert'+postData+oddsData,
	         on: { 
	         
					success: function(id, o, args) 
					{ 	 
						var result = Y.JSON.parse(o.responseText);
						if(result.status=='ok')
				      	{   
							alert('Event bet saved')
						}
				      	else if(result.status=='error')
				      	{
				      		var errorString ="";
				      		for(var instance in result.errors) 
	      					{
					      		for(var i=0;i< result.errors[instance].length;i++)
								{
									errorString+=result.errors[instance][i];
								}
							}
				      		alert(errorString)
				      	}
					},
					failure: function(){alert("Error on server, please try later")},
			}, 
	    }; 
		var request = Y.io(uri, cfg);  
	}
) 

function resetView()
{
	
	Y.one('#eventValues').setContent();
	Y.one('#groupContent').setContent();
	Y.one('#eventsTypesContent').setContent();
	Y.one('#eventsContent').setContent();
	Y.one('#eventStart').setContent('');
 	Y.one('#eventEnds').setContent('');
}