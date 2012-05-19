Y.one('#bankPanelLink').on('click',
	function ()
	{
		Y.one('#bankPanel').setStyle('display','block');
		Y.one('#betsPanel').setStyle('display','none');
	}
)

Y.one('#betsPanelLink').on('click',
	function ()
	{
		Y.one('#bankPanel').setStyle('display','none');
		Y.one('#betsPanel').setStyle('display','block');
	}
) 

Y.one('#addMoney').on('click',
	function()
	{ 
		var uriAddMoney = '<?php echo Application::getRouter()->getFullUrl(array('controller'=>'servicejson','action'=>'model')); ?>';
		var cfg = {
		    method: 'POST',
			form: {
				id:'addMoneyToUser',
				useDisabled: true
			},
		    on: 
		    { 
				success: 
				function(id, o, args)
				{ 
					var result = Y.JSON.parse(o.responseText); 
					if(result.status=='ok')
			      	{  
						 <?php echo $this->getBank()->getUserBankTable()->getTable()->getId()?>.datagridedit.filter();
					}
			      	else if(result.status=='error')
			      	{ 
			      		var errorMessage = '';
				      	for(var instance in result.errors) 
				      	{ 
			    			for(var i=0;i< result.errors[instance].length;i++)
							{ 
								errorMessage = result.errors[instance][i];
							}
			    		} 
			    		alert(errorMessage);
			      	}
				},
				failure: 
				function()
				{
					alert("Error on server, please try later")
				},
			},   
		};
		Y.io(uriAddMoney, cfg); 		
	}	
); 