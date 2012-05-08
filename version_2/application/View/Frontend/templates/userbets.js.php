Y.delegate("click",
			function(e)
			{   
				if(e.target.get('nodeName')=='A')
				{ 
					var uri = e.target.getAttribute('servicehtml'); 
					if(uri=='')
					{
						return;
					}	
						
					var cfg = { 
				    	method: 'POST', 
				         on: { 
								success: function(id, o, args) 
								{ 	 
									var result = Y.JSON.parse(o.responseText);
									if(result.status=='ok')
							      	{   
										 Y.one('#subContentBets').setContent(result.html);
										 eval(result.javascript);
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
				    var request = Y.io(uri, cfg);  
				} 
			} 
		 , Y.config.doc, "a.systemSubServiceLinkBets");