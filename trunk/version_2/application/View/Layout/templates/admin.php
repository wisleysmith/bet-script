<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>iBusiness</title>

<script src="http://yui.yahooapis.com/3.5.0/build/yui-base/yui-base-min.js"></script>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.5.0/build/cssreset/reset-min.css">

<link href="styles/ibstyles.css" rel="stylesheet" type="text/css" />
<link href="images/logo.gif" rel="shortcut icon" />
<script type="text/javascript" src="scripts/vwd_curvycorners.js"></script>
<script type="text/javascript" src="scripts/capply.js"></script>
 
 
<!--[if lt IE 7]>
<style type="text/css">
.home .row{
	padding-bottom:0;
}
.px_fix{
	left:1px;
	bottom:-3px;
}
</style>
<![endif]-->
  
  <style type="text/css">

#desc {
    margin-bottom: 20px;
    border-bottom: 1px dotted #333;
}
#desc span {
    background: #a3350d;
    padding :2px;
    color:# f27243;
}

.yui3-panel {
    outline: none;
}
.yui3-panel-content .yui3-widget-hd {
    font-weight: bold;
}
.yui3-panel-content .yui3-widget-bd {
    padding: 15px;
}
.yui3-panel-content label {
    margin-right: 30px;
}
.yui3-panel-content fieldset {
    border: none;
    padding: 0;
}
.yui3-panel-content input[type="text"] {
    border: none;
    border: 1px solid #ccc;
    padding: 3px 7px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    font-size: 100%;
    width: 200px;
}

#addRow {
    margin-top: 10px;
}

</style>
 
</head>
<body class="yui3-skin-sam"> 
<div id="main_cnr"> 
  <div id="in_cnr" class="home">
  
  <?php echo new View_Frontend_LoginAndRegistration()?>
  
    <div id="header_cnr">
      <div id="navigation_cnr" class="cbox">
      <img src="images/px_fix.gif" class="px_fix" />
        <ul>
         <li><a href="<?php echo Application::getRouter()->getUrl(array('controller'=>'index','action'=>'index'));?>" class="<?php if(Application::getController()=='index'){echo 'active';}?>">Front End</a></li>
          <li><a href="<?php echo Application::getRouter()->getUrl(array('controller'=>'admin','action'=>'index'));?>" class="<?php if(Application::getController()=='admin'){echo 'active';}?>">Admin</a></li>
 		</ul>
        <img src="images/logo.gif" id="logo" /> </div>
      <!--navigation_cnr-->
    </div>
    <!--header_cnr-->
    <?php 
    	$user = new Core_Auth_User();
		if($user->getRole()=='user')
		{ 
			?>
			<div style="float:left;padding:10px" >
				<a href="javascript:void(0)" class="systemServiceLink" servicehtml="<?php echo Application::getRouter()->getUrl(array('controller'=>'servicehtml','action'=>'view','params'=>'view=View_Frontend_UserBets'));?>" > My Bets </a>
				  | <a href="javascript:void(0)" class="systemServiceLink" servicehtml="<?php echo Application::getRouter()->getUrl(array('controller'=>'servicehtml','action'=>'view','params'=>'view=View_Frontend_UserBank'));?>"> My Bank</a>
			</div>
			<?php 
		}
    ?>
    <div id="body_cnr">
    	<?php 
    	 $menu = $this->getMenu();
    	 if(isset($menu))
    	 {  
    	?>
        <div > 
        <?php 
    	 
        ?>
        <?php 
        	echo $this->getMenu()->generateView();
        ?>
        </div>
        <?php 
    	 }
        ?>
        <div id="content">
    		<?php echo $this->getContent();?> 
        </div> 
    </div>
    <!--body_cnr-->
    <br />
    <div id="footer_cnr" class="cbox">
      <div class="fl">&copy; Oxidian d.o.o 2012 All Rights Reserved | <a href="http://www.oxidian.hr">Oxidian d.o.o</a></div>
      <!--.fl-->
    
      <!--.fr-->
    </div>
    <!--footer_cnr-->
  </div>
  <!--in_cnr-->
</div>
</div>

<script>   



//START WRAPPER: The YUI.add wrapper is added by the build system, when you use YUI Builder to build your component from the raw source in this file
YUI.add("datatable-edit", function(Y) {
 	/* MyPlugin class constructor */
	function DataTableEditRowPlugin(config) 
	{
		DataTableEditRowPlugin.superclass.constructor.apply(this, arguments);
 	} 
 
	DataTableEditRowPlugin.ATTRS = 
	{
		urls : {}, 
		panel:{}, 
		paginator:{},
		elementNamespace:{},
		primaryKeys:{},
		currrentMode:{},   
		indexRowEdited:{},
		updateRules:{},
		insertRules:{},
		insertValues:{},
		disabledShowPanelColumns:{},
		host:{},
		filterForm:{},
	}; 

 	DataTableEditRowPlugin.NAME = "DataTableEditRowPlugin";
 	DataTableEditRowPlugin.NS = "datagridedit";     
  
 	/* MyPlugin extends the base Plugin.Base class */
 	Y.extend(DataTableEditRowPlugin, Y.Plugin.Base, {
  
 	showEditPanel : function(mode)
 	{  
 		this._displayPanel(mode);
 	}, 
	
 	_insert : function ()
 	{
 	 	var urls = this.get('urls');
 	 	var panel = this.get('panel');
		var uri = urls[currrentMode];
	 	var host = this.get('host');
		panel.bodyNode.all('p.errors').each(
	 	 	function(element)
	 	 	{
	 	 		element.setStyle('display','none');
	 	 		element.setContent("");
	 	 	}
	 	)
	 	
	 	panel.bodyNode.one('#currentStatus').setContent('');
	 	
	 	var cfg = { 
	        method: 'POST',
	        form: {
	            id: panel.bodyNode.one('#panelForm'),
	            useDisabled: true
	        },
	         on: { 
				success: host.datagridedit._successInsert,
				failure: function(){alert("Error on server, please try later")},
			},
			arguments:
			{
				host:host,
				panel:panel
			}, 
	    };
	    
	    // Start the transaction.
	    var request = Y.io(uri, cfg);
	}, 

 	filter : function(form)
 	{
 	 	if(form==undefined)
 	 	{
 	 		form = this.get('filterForm');
 	 	}
 	 	var urls = this.get('urls');
 	 	var paginator = this.get('paginator');
		var uri = urls['filter'];
		var host = this.get('host');
		var cfg = {
		    method: 'POST',
			    form: {
					id:form,
					useDisabled: true
			    },
			    on: 
			    { 
						success: 
							function(id, o, args)
							{ 
								 var result = Y.JSON.parse(o.responseText); 
								
				      			 args.host.data.reset();
				      			 if(result.data!=undefined) 
								 {
				      				args.host.data.reset();
								 	args.host.data.add(result.data);
								 	paginator.setTotalRecords(result.count, true);
								 } 
							},
						failure: function(){alert("Error on server, please try later")},
				},
				arguments:
				{
					host:host, 
					paginator:paginator
				},  
		    };
		Y.io(uri, cfg);
	} , 

	 // Define a function to handle the response data.
    _successInsert : function (id, o, args) 
    {
     	var result = Y.JSON.parse(o.responseText); 
		if(result.status=='ok')
      	{  
			if(currrentMode=="insert")
			{ 
				args.panel.bodyNode.one('#currentStatus').setContent('<span style="color:green">Insert saved</span><br />');
			} 
			else
			{
				args.panel.bodyNode.one('#currentStatus').setContent('<span style="color:green">Update saved</span><br />');
			}
			args.host.datagridedit.filter(); 
		}
      	else if(result.status=='error')
      	{
      		args.panel.bodyNode.one('#currentStatus').setContent('<span style="color:red">Your form has errors</span>');
	      	for(var instance in result.errors) 
	      	{
	    		var instanceID = '#error_'+instance;
	    	
	    		if(Y.one(instanceID)==undefined)
	    		{
	    			for(var i=0;i< result.errors[instance].length;i++)
					{
	    				args.panel.bodyNode.one('#currentStatus').append('<br /><span style="color:red">'+instance+' : '+result.errors[instance][i]+'</span>');
					}
	    		}
	    		else
	    		{
	    			Y.one(instanceID).setStyle('display','block');
	    			for(var i=0;i< result.errors[instance].length;i++)
					{
						Y.one(instanceID).append(result.errors[instance][i]+'<br />');
					}
	    		} 
			} 
      	}
    },

 	_displayPanel:function(mode,currentTarget)
  	{ 
 		currrentMode = mode; 
 		var trRow ;
 		var data;
 		var cells;  
 		var panel =  this.get('panel');
 		var host =  this.get('host');
 		var insertValues = this.get('insertValues')
 		 
  		if(currrentMode == 'update')
  		{
  	  		trRow = currentTarget.ancestor("tr") ;
  	  		host =  this.get('host');
  			data = host.getRecord(trRow.get('id')).toJSON();
  			indexRowEdited = trRow.get('rowIndex');
  			cells = trRow.all('td').get('nodes'); 
  		}			
  		
 		var columns = host.get('columns');
 		var panelEditorNodes = '<p id="currentStatus"></p><table border="1">';
  		
  		columnsLoop: for(var i=0;i<columns.length;i++)
  		{ 
  			var dataKeyValue='';
  			var isHidden = false;
  			var hiddenRules = new Array();
 	 	 	var excludeRules = new Array();
 	 	 	var elementNamespace = this.get('elementNamespace');
  
  			if(currrentMode == 'update')
  	 		{
  	 	 		if(this.get('updateRules')['hidden']!=undefined)
  	 	 		{
  	 	 			hiddenRules = this.get('updateRules')['hidden']; 
  	 	 		}
  	 	 		
  	 	 		if(this.get('updateRules')['exclude']!=undefined)
  	 	 		{
  	 	 			excludeRules = this.get('updateRules')['exclude']; 
  	 	 		} 
  	 	 		dataKeyValue = data[columns[i].key];  
  	 		}
  			else
  			{
  				if(this.get('insertRules')['hidden']!=undefined)
  	 	 		{
  	 	 			hiddenRules = this.get('insertRules')['hidden'];
  	 	 		}
  	 	 		
  	 	 		if(this.get('insertRules')['exclude']!=undefined)
  	 	 		{
  	 	 			excludeRules = this.get('insertRules')['exclude']; 
  	 	 		}

  	 	 	 	if(insertValues!=undefined)
  	 	 	 	{ 
  	  	 	 		if(insertValues[columns[i].key]!=undefined)
  	  	 	 		{
  	  	 	 			dataKeyValue =insertValues[columns[i].key];
  	  	 	 		} 
  	 	 	 	}
  			} 
  			    		
 			for(var iP=0;iP<hiddenRules.length;iP++)
 			{   
 				if(hiddenRules[iP]== columns[i].key)
 				{ 
 					isHidden = true;
 				};
 			} 
 	 
 			for(var iPP=0;iPP<excludeRules.length;iPP++)
 			{  
 				if(excludeRules[iPP]== columns[i].key)
 				{
 					continue columnsLoop;
 				};
 			} 
  			     		
       		var element =''; 
       		var label = columns[i].label;   
       		
       		if(columns[i].formatter == undefined && isHidden == false)
       		{  
           		if(dataKeyValue==undefined)
           		{
           			dataKeyValue='';
           		}
       			element = '<p class="errors" style="display:none;color:red" id="error_'+columns[i].key+'"></p><input type="text" value="'+dataKeyValue+'" name="model['+elementNamespace+']['+columns[i].key+']" />'
       		}
  			else if (isHidden == false)
  			{
  			    var o = {value:dataKeyValue,panel:true}; 
  			     			 
  			    if(typeof columns[i].formatter == 'function') 
  			    {
  			    	element ='<p class="errors" style="display:none;color:red" id="error_'+columns[i].key+'"></p>'+ columns[i].formatter(o); 
  			    }
  			    else
  			   	{
  			    	var formatterValue = columns[i].formatter;
  	  			   	if(formatterValue==undefined)
  	  			   	{
  	  			   		formatterValue='';
  	  			   	}
  			    	element ='<p class="errors" style="display:none;color:red" id="error_'+columns[i].key+'"></p>'+ formatterValue; 
  			    }
  			}
  			else if(isHidden==true)
  	 		{
  				element = '<input type="hidden" value="'+dataKeyValue+'" name="model['+elementNamespace+']['+columns[i].key+']" />'
  	 		}
  	 		
  	 		if(isHidden!=true)
  	 		{ 
  				panelEditorNodes +='<tr><td>'+label+'</td><td>'+element+'</td></tr>'; 
  	 		}  
  	 		else
  	 		{
  	 			panelEditorNodes +=element;
  	 		}  
 		} 
  			     	
 		panelEditorNodes +='</table>'; 

 		if(currrentMode == 'update')
  		{
 			panel.set('headerContent',"Update"); 
  		}
 		else
 		{
 			panel.set('headerContent',"Add");
 		}

 		panelEditorNodes += '<input type="hidden" value="'+currrentMode+'" name="method" />';
 		panelEditorNodes ='<form id="panelForm" > '+panelEditorNodes+' </form>';
  		 
 		panel.bodyNode.setContent(Y.Node.create(panelEditorNodes)); 
 		panel.show();	   
  	},


	_deleteTableRow:function(currentTarget)
	{ 
		var host = this.get('host');
		currrentMode = "delete";
		var trRow = currentTarget.ancestor('tr');
		var tdCell = currentTarget;
		var columns = host.get('columns');
 		column = columns[tdCell.get('cellIndex')]; 
 
		var rowIndex = trRow.get('rowIndex');
		var data = host.getRecord(trRow.get('id')).toJSON();
		var primaryKeys = this.get('primaryKeys');
		var dataString = 'method='+currrentMode;
		for(var i=0;i<primaryKeys.length;i++)
		{
			dataString+='&model['+this.get('elementNamespace')+']['+primaryKeys[i]+']='+data[primaryKeys[i]];
		}; 
 
		var cfg = { 
	    	method: 'POST',
	    	data: dataString,
	         on: { 
					success: host.datagridedit._successDelete,
					failure: function(){alert("Error on server, please try later")},
			},
			arguments:
			{
				host:host, 
				trRow:trRow,
			},  
	    };
	    
 	 	var urls = this.get('urls');
 	 	var panel = this.get('panel');
		var uri = urls[currrentMode];
	    var request = Y.io(uri, cfg); 
	},

	_successDelete:function(id, o, args) 
    {
     	var result = Y.JSON.parse(o.responseText);
		if(result.status=='ok')
      	{    
			args.host.datagridedit.filter();
      	}
      	else
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
	  
	initializer: function(config) 
	{ 	
		var host = this.get('host');
    	// Create the main modal form.
		this.set('panel',config.panel);
		this.set('paginator',config.paginator); 
		var panel = this.get('panel');
		this.set('elementNamespace',config.elementNamespace);  
		this.set('updateRules', config.updateRules);
		this.set('insertRules', config.insertRules); 
		this.set('filterForm', config.filterForm); 
		this.set('urls',Y.JSON.parse(config.urls)); 
		this.set('primaryKeys',config.primaryKeys.keys);
 
		panel.addButton({
			value  : 'Save',
			section: Y.WidgetStdMod.FOOTER,
			action : function (e) {
				e.preventDefault();
				host.datagridedit._insert();
			}
		});
 	
		panel.addButton({
	        value  : 'Cancel',
	        section: Y.WidgetStdMod.FOOTER,
	        action : function (e) {
	            e.preventDefault();
	            panel.hide(); 
	            panel.bodyNode.setContent('');
	        }
	    });
				
		host.delegate('click', function (e) 
		{ 
			e.preventDefault();
	    	e.stopPropagation(); 
			var currentTarget =  e.currentTarget.ancestor('td');
			if(currentTarget.one('a')==null)
			{
				return;
			}
			
			var isEdit = currentTarget.one('a').hasClass('yui_datatablepanel_edit');
			var isDelete = currentTarget.one('a').hasClass('yui_datatablepanel_delete');
 
			if(isEdit==false&&isDelete==false)
			{
				return false;
			}

			if(isDelete)
			{
				host.datagridedit._deleteTableRow(currentTarget);
				return;
			}	
			
	    	 
	     	host.datagridedit._displayPanel("update",currentTarget);
	     	
    	}, 'td a.tableLinks'); 
     }, 

     destructor : function() {
         /*
          * destructor is part of the lifecycle introduced by 
          * the Base class. It is invoked when the plugin is unplugged.
          *
          * Any listeners registered using Plugin.Base's onHostEvent/afterHostEvent methods,
          * or any methods displaced using it's beforeHostMethod/afterHostMethod methods 
          * will be detached/restored by Plugin.Base's destructor.
          *
          * We only need to clean up anything we change on the host
          *             
          * It does not need to invoke the superclass destructor. 
          * destroy() will call initializer() for all classes in the hierarchy.
          */
     },

     /* Supporting Methods */

     _onHostRenderEvent : function(e) {
         /* React on the host render event */
     },
 

     _afterHostRenderEvent : function(e) {
         /* React after the host render event */
     },
     
     _beforeHostShowMethod : function() {
         /* Inject logic before the host's show method is called. */
     },

     _afterHostShowMethod : function() {
         /* Inject logic after the host's show method is called. */
     },
 
 });

 Y.namespace("Plugin");
 Y.Plugin.DataTableEditRowPlugin = DataTableEditRowPlugin; 

}, "3.5.0", {requires:["plugin"]});





//START WRAPPER: The YUI.add wrapper is added by the build system, when you use YUI Builder to build your component from the raw source in this file
YUI.add("datatable-pf", function(Y) {
	/* MyPlugin class constructor */
	function DataTablePFPlugin(config) 
	{
		DataTablePFPlugin.superclass.constructor.apply(this, arguments);
	} 

	DataTablePFPlugin.ATTRS = 
	{
		urls : {},  
		paginator:{},
		elementNamespace:{}, 
		insertValues:{}, 
		host:{},
		filterForm:{},
	}; 

	DataTablePFPlugin.NAME = "DataTablePFPlugin";
	DataTablePFPlugin.NS = "datagridpf";     

	/* MyPlugin extends the base Plugin.Base class */
	Y.extend(DataTablePFPlugin, Y.Plugin.Base, {
 
	filter : function(form)
	{
	 	if(form==undefined)
	 	{
	 		form = this.get('filterForm');
	 	}
	 	var urls = this.get('urls');
	 	var paginator = this.get('paginator');
		var uri = urls['filter'];
		var host = this.get('host');
		var cfg = {
		    method: 'POST',
			    form: {
					id:form,
					useDisabled: true
			    },
			    on: 
			    { 
						success: 
							function(id, o, args)
							{ 
								 var result = Y.JSON.parse(o.responseText); 
								
				      			 args.host.data.reset();
				      			 if(result.data!=undefined) 
								 {
				      				args.host.data.reset();
								 	args.host.data.add(result.data);
								 	paginator.setTotalRecords(result.count, true);
								 } 
							},
						failure: function(){alert("Error on server, please try later")},
				},
				arguments:
				{
					host:host, 
					paginator:paginator
				},  
		    };
		Y.io(uri, cfg);
	} , 
 
	initializer: function(config) 
	{ 	
		var host = this.get('host'); 
		this.set('paginator',config.paginator); 
		var panel = this.get('panel');
		this.set('elementNamespace',config.elementNamespace);   
		this.set('filterForm', config.filterForm); 
		this.set('urls',Y.JSON.parse(config.urls));   
   },  
});

Y.namespace("Plugin");
Y.Plugin.DataTablePFPlugin = DataTablePFPlugin; 

}, "3.5.0", {requires:["plugin"]});

 
YUI.add("popup-calendar", function(Y) { 
	function PopUpCalendar(config) 
	{
		PopUpCalendar.superclass.constructor.apply(this, arguments);
 	}  
	PopUpCalendar.NAME = "PopUpCalendar";
	PopUpCalendar.NS = "popup-calendar";     
   
 	Y.extend(PopUpCalendar, Y.Plugin.Base, {
    
	initializer: function(config) 
	{ 	 
		var host = this.get('host');
		host.render(); 
		host.hide();   
		
		var calendarImageHtml = '<img class="calendarPopUp" width="20" height="20" alt="Year" src="/images/x_office_calendar.png">';
		var calendarInputHtml = '<input '+config.inputAttributes+'  class="inputPopUp" ></input>'
		var calendarImageNode = Y.Node.create(calendarImageHtml);
		var calendarInputNode = Y.Node.create(calendarInputHtml);
 
		host.get('boundingBox').insert(calendarImageNode,'before')
 		host.get('boundingBox').insert(calendarInputNode,'before')
 		var closeInputNode = Y.Node.create('<span style="background-color:red">Close</span>');
 		
 		host.get('contentBox').insert(closeInputNode,'before')
 		closeInputNode.on('click',
 			function (e)
 			{ 
 				host.hide(); 
 			}
 		)
 		host.get('boundingBox').setStyle('position', 'absolute');  
 		host.get('boundingBox').setStyle('z-index', '1000');  
		
		Y.one(calendarImageNode).on('click',
			function (e)
			{ 
				host.show(); 
			}
		)
		
		var dtdate = Y.DataType.Date;
		host.on("selectionChange", function (ev) 
		{
		      var newDate = ev.newSelection[0]; 
		      calendarInputNode.set('value',dtdate.format(newDate)); 
		   	  host.hide(); 
		});
	},  
 
 });

 Y.namespace("Plugin");
 Y.Plugin.PopUpCalendar = PopUpCalendar; 

}, "3.5.0", {requires:["plugin"]});


YUI().use( <?php echo Application::getSingleton('Extension_View_Yui35_ModuleDependencies')->getWidgetDependenciesHtml();?>
,"datatable-edit",
"popup-calendar",
"datatable-pf",
	function(Y) 
	{		
 <?php  
		 echo Core_View_Layout_JavascriptTemplate::singleton()->getJavascript();
		 echo $this->getMenu()->generateJavascript();
		 ?>
	 
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
										 Y.one('#content').setContent(result.html);
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
		 , Y.config.doc, "a.systemServiceLink")

	}
)
</script> 


<!--main_cnr-->
</body>
</html>
