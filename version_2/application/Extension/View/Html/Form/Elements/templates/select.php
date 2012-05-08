<?php 
$optionLabel = $this->getOptionLabelKey();
$optionValue = $this->getOptionValueKey();
$optionSelected = $this->getSelectedValue(); 
$selected = "";

?> 
	
<select   <?php echo $this->getAttributesHtml()?>  >
	 <?php 
	 	if($this->isDisplayDefault())
	 	{
	 		?>
	 		<option value=""><?php echo $this->getDefaultLabel()?></option>
	 <?php 	
	 	}
	 ?>  
	<?php foreach($this->getModel() as $m)
	{
		if($optionSelected===$m[$optionValue])
		{
			$selected = 'selected';
		}
		?>
		<option <?php if($selected!=''){echo $selected;}?> value="<?php echo $m[$optionValue]?>"><?php echo $m[$optionLabel] ?></option>
	<?php
		$selected ='';
	}
	 ?>
</select>