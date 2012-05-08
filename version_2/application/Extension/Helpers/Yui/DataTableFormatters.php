<?php 
 
class Extension_Helpers_Yui_DataTableFormatters
{ 
	public function selectYesNo($options=array())
	{ 
		return '
			function(o)
			{  
				if(o.panel==undefined)
				{	 
					if(o.value==1)
					{
						return "Yes";
					}
					else
					{
						return "No";
					}
				}
				var html=\'<select  '.$this->getAttributes($options).' >\';
			
				var optionsArray = new Array()
				optionsArray["1"] = "Yes"
				optionsArray["0"] = "No";
				
				var selected = "";
				for(value in optionsArray)
				{
					if(o.value==value)
					{
						selected = "selected";
					}
					html += \'<option value="\'+value+\'" \'+selected+\' >\'+optionsArray[value]+\'</option>\';
					selected = "";
				} 
				html +=\'</select>\';
				return html;
			}';  
	} 
	
	public function  yesNoLabel($options=array())
	{
		return 'function(o)
			{ 
				
				if(o.value==1)
				{
					return "Yes";
				}
				else
				{
					return "No";
				}
				
			}';
	}

	public function labelFromModelCollection($options=array())
	{
			$html = '
			function(o)
			{   
				var optionsArray = new Array();'; 
			foreach ($options['values'] as $o)
			{
			    $html.= 'optionsArray.push({value:"'.$o->getData($options['value']).'" ,label:"'.$o->getData($options['label']).'"}) ;';
			}
			$html.='var selected = "";
				for(var i = 0;i< optionsArray.length;i++)
				{
					if(optionsArray[i]["value"]==o.value)
					{
						return optionsArray[i]["label"]; 
					} 
				};
			}';  
		return $html;  
	}   
	
	public  function selectFromModel($options=array())
	{
			$html = '
			function(o)
			{  
			
				var html=\'<select  '.$this->getAttributes($options).' >\';
				html += \'<option value=""  >-</option>\';
				var optionsArray = new Array();'; 
			foreach ($options['values'] as $o)
			{
			    $html.= 'optionsArray["'.$o->getData($options['value']).'"] = "'.$o->getData($options['label']).'";';
			}
			$html.='var selected = "";
				for(value in optionsArray)
				{
					if(o.value==value)
					{
						selected = "selected";
						if(o.panel==undefined)
						{
							 return optionsArray[value];
						}
					}
					html += \'<option value="\'+value+\'" \'+selected+\' >\'+optionsArray[value]+\'</option>\';
					selected = "";
				} 
				html +=\'</select>\';
				return html;
			}';  
		return $html;  
	}  
	
	public function inputField($options=array())
	{
		$html = '
			function(o)
			{
				if(o.panel==undefined)
				{
					return o.value;
				}
				var html=\'<input value="\'+o.value+\'" '.$this->getAttributes($options).'  />\';
				return html;
			}';  
		return $html;  
	}
	
	public function inputFieldCell($options=array())
	{
		$html = '
			function(o)
			{
				var html=\'<input   '.$this->getAttributes($options).'  />\';
				return html;
			}';  
		return $html;  
	}
	 
	private function getAttributes($options)
	{
		if(!isset($options['attributes']))
		{
			return '';
		}
		
		$html='';
		foreach ($options['attributes'] as $key=>$m)
		{
				$html .=' '.$key.'="'.$m.'"'; 
		}  
		return $html;
	}
}

?>