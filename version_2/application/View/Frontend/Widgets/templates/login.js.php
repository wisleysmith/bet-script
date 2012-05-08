Y.one('#loginButton').on('click',
	function()
	{
		Y.one('#errorsLogin').setContent('');
		var uriLoginForm = '<?php echo Application::getRouter()->getUrl(array('controller'=>'index','action'=>'login')); ?>';
		var cfg = {
		    method: 'POST',
			form: {
				id:'loginForm',
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
						window.location.reload();
					}
			      	else if(result.status=='error')
			      	{ 
				      	for(var instance in result.errors) 
				      	{ 
			    			for(var i=0;i< result.errors[instance].length;i++)
							{
								var prependText='';
								if(instance=='password')
								{
									prependText = 'Password: '
								}
								else
								{
									prependText = 'Username: '
								}
								Y.one('#errorsLogin').append(prependText+result.errors[instance][i]+'<br />');
							}
			    		} 
			      	}
				},
				failure: 
				function()
				{
					alert("Error on server, please try later")
				},
			},   
		};
		Y.io(uriLoginForm, cfg); 		
	}	
); 