
				 Y.on("domready",
					function(e)
					{  
					 	Y.Cookie.set('betting_session','<?php echo session_id()?>');
						Y.all('.bs_widget').each(
							function(a,b,c)
							{   
								var serviceUrl = '<?php echo Application::getRouter()->getFullUrl(array('controller'=>'servicehtml','action'=>'view'))?>'; 
								var uri = serviceUrl+'&view='+a.getAttribute('id');
							 
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
												 args.element.setStyle('display','block'); 
												 args.element.setContent(result.html);
												 eval(result.javascript);
											}
									      	else if(result.status=='error')
									      	{ 
										      	console.log('bs loading widget failed')
									      	}
										},
										failure: function(){ console.log('bs loading widget failed');},
									},
									arguments:
									{
										element:a, 
									}, 
						    	}; 
						    	var request = Y.io(uri, cfg);  
							})
						}) 
					 
				 