<?php  
	$additionElements = $this->getAdditionalFilterElements();
	$filters = $this->getFilters();
	$filtersSize = sizeof($filters); 
?>
<div > 
<?php 
	if($filtersSize>0&&$this->isFilterButtonEnabled()===true)
	{
?>

<?php 
	}
?>
<form class="filterForm" id="<?php echo $this->getHtmlIds('filters_form') ?>"  name="<?php echo $this->getHtmlIds('filters_form') ?>" >

<?php
	$elementName='model['.$this->getModelName().'][filter]';  
	foreach ($filters as $f)
	{ 
		?>
		<span class="filterElement">
		<?php 
		$f['filter']->setAttribute('id',$f['filter']->getAttribute('name').'_'.$this->getId());
		$f['filter']->setAttribute('name',$elementName.'['.$f['filter']->getId().'][value]');
	 	echo $f['filter']->generateView(); 
	 	?> 
		<input type="hidden" name="<?php echo $elementName.'['.$f['filter']->getId().'][data]'?>" value='<?php echo json_encode($f['data'])?>' />
		</span>
		<?php 
	}
	foreach ($additionElements as $a)
	{
		echo $a->generateView(); 
	} 
?>
<input type="hidden" name="model[<?php echo $this->getModelName()?>][filterGroupOperators]" value='<?php echo json_encode($this->getFilterGroupsOperators());?>' />
<input type="hidden" id="<?php echo $this->getHtmlIds('limitStart') ?>" name ="model[<?php echo $this->getModelName()?>][limitStart]" />
<input type="hidden"  id="<?php echo $this->getHtmlIds('limitEnd') ?>" name="model[<?php echo $this->getModelName()?>][limitEnd]" />
<input type="hidden" id="<?php echo $this->getHtmlIds('sortBy') ?>" name="model[<?php echo $this->getModelName()?>][sortBy]" />
<input type="hidden"  name="model[<?php echo $this->getModelName()?>][count]" value="1" />
<?php 
	if($filtersSize>0&&$this->isFilterButtonEnabled()===true)
	{
?>
<input type="button" id="<?php echo $this->getHtmlIds('filterButton') ?>" value="Filter" />
<?php 	
	}
?>
</form>   </div> 
<div> 
</div>
<?php 
echo $this->getPaginator(); 
echo $this->getTable();
?>

 