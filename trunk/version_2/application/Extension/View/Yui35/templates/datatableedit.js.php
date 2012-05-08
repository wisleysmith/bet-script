<?php
echo $this->getTable()->getId()?>.plug( Y.Plugin.DataTableEditRowPlugin,
	{
		panel:<?php echo $this->getPanel()->getId()?>,
		paginator:<?php echo $this->getPaginator()->getId()?>,
		elementNamespace:'<?php echo $this->getModelName()?>',
		urls:'<?php echo json_encode($this->getUrls())?>',
		updateRules:<?php echo json_encode($this->getUpdateRules())?>,
		insertRules:<?php echo json_encode($this->getInsertRules())?>, 
		primaryKeys:{keys:<?php echo json_encode($this->getPrimaryKeys())?>}, 
		filterForm:'<?php echo $this->getHtmlIds('filters_form') ?>'
	}
);
 
<?php 
	if($this->isAddButtonEnabled())
	{
?>
Y.one('<?php echo $this->getHtmlIds('add',true) ?>').on('click',
	function(e)
	{
		<?php echo $this->getTable()->getId()?>.datagridedit.showEditPanel('insert');
	}
)
<?php 
}
?>  
<?php echo $this->getPaginator()->getId();?>.on('changeRequest', function(state)
{  
	this.setPage(state.page, true);  
	this.setRowsPerPage(state.rowsPerPage, true);
	Y.one('<?php echo $this->getHtmlIds('limitStart',true) ?>').setAttribute('value',(state.page-1)*state.rowsPerPage); 
	Y.one('<?php echo $this->getHtmlIds('limitEnd',true) ?>').setAttribute('value',state.rowsPerPage); 
	<?php echo $this->getTable()->getId()?>.datagridedit.filter('<?php echo $this->getHtmlIds('filters_form') ?>');
	 
});

Y.one('<?php echo $this->getHtmlIds('limitStart',true) ?>').setAttribute('value',0); 
Y.one('<?php echo $this->getHtmlIds('limitEnd',true) ?>').setAttribute('value',<?php echo $this->getPaginator()->getId();?>.getRowsPerPage()); 
 
<?php 
$filters = $this->getFilters();
$filtersSize = sizeof($filters); 
 
if($filtersSize>0&&$this->isFilterButtonEnabled()===true)
	{ 
	?>
	 
	Y.one('<?php echo $this->getHtmlIds('filterButton',true) ?>').on('click',
		function()
		{ 
			<?php echo $this->getTable()->getId()?>.datagridedit.filter('<?php echo $this->getHtmlIds('filters_form') ?>');
		} 
	) 
	<?php 
} 
	?> 
