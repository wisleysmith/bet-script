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
										 Y.one('#subContent').setContent(result.html);
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
				} 
			} 
		 , Y.config.doc, "a.systemSubServiceLink")
