 Y.one('#registrationButton').on('click',
	function()
	{
		Y.one('#errorsRegistration').setContent('');
		var isValid  = true;
		var password = Y.one('#passwordReg').get('value');
 
 		var username = Y.one('#user_nameReg').get('value');
 
		if(username.length<3||username.length>20)
		{
			Y.one('#errorsRegistration').append('Username must be between 3-20 charachters long<br />');
			isValid  = false;
		}
		
		if( password.length<5||password.length>20)
		{
			Y.one('#errorsRegistration').append('Password must be between 5-20 charachters long<br />');
			isValid  = false;
		} 
		
		if(Y.one('#repassword').get('value')!=Y.one('#passwordReg').get('value'))
		{
			Y.one('#errorsRegistration').append('Password and repassword does not match<br />');
			isValid  = false;
		}
		
		
		if(Y.one('#first_name').get('value').length<1)
		{
			Y.one('#errorsRegistration').append('Firstname<br />');
			isValid  = false;
		}

		if(Y.one('#last_name').get('value').length<1)
		{
			Y.one('#errorsRegistration').append('Last name not set<br />');
			isValid  = false;
		}
		
		if(Y.one('#email').get('value').length<1)
		{
			Y.one('#errorsRegistration').append('Email not set<br />');
			isValid  = false;
		} 
		
	 	if(isValid  == false)
	 	{
	 		return false;
	 	}
		var uriLoginForm = '<?php echo Application::getRouter()->getFullUrl(array('controller'=>'index','action'=>'registration')); ?>';
		var cfg = {
		    method: 'POST',
			form: {
				id:'registrationForm',
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
						Y.one('#errorsRegistration').setStyle('color','green');
						Y.one('#registrationForm').setStyle('display','none')
						Y.one('#errorsRegistration').setContent(result.message);
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
								Y.one('#errorsRegistration').append(prependText+result.errors[instance][i]+'<br />');
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


